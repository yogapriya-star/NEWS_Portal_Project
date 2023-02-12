<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use DB;
class AdminPostController extends Controller
{
  public function show(){
    $posts = Post::with('subcategory.category')->get();
    return view('admin.post_show', compact('posts'));
  }

  public function create(){
    $sub_categories = SubCategory::with('category')->get();
  return view('admin.post_create', compact('sub_categories'));
  }

  public function store(Request $request){

    $request->validate([
        'post_title' => 'required',
        'post_detail' => 'required',
        'post_photo' => 'required|image|mimes:jpg,jpeg,png,gif',
    ]);

    $q = DB::select("SHOW TABLE STATUS LIKE 'posts'");
    $ai_id = $q[0]->Auto_increment;


    $file = $request->file('post_photo');
    $filename= date('YmdHi').$file->getClientOriginalName();
    $request->file('post_photo')->move(public_path('uploads/'),$filename);

    $post = new Post();
    $post->sub_category_id = $request->sub_category_id;
    $post->post_title = $request->post_title;
    $post->post_detail = $request->post_detail;
    $post->post_photo = $filename;
    $post->visitors = 1;
    $post->author_id = 0;
    $post->admin_id = Auth::guard('admin')->user()->id;
    $post->is_share = $request->is_share;
    $post->is_comment = $request->is_comment;
    $post->save();

if($request->tags != ''){
  $tags_array_new =[];
  $tags_array = explode(',',$request->tags);
  for($i=0; $i<count($tags_array);$i++){
    $tags_array_new[] = trim($tags_array[$i]);
  }
  $tags_array_new = array_values(array_unique($tags_array_new));
  for($i=0; $i<count($tags_array_new);$i++){
    $tag = new Tag();
    $tag->post_id = $ai_id;
    $tag->tag_name = trim($tags_array_new[$i]);
    $tag->save();
    //echo $tags_array[$i].' ';
  }

}

    return redirect()->route('admin_post_show')->with('success', 'Post is created successfully');
  }

  public function  edit($id){
    $sub_categories = SubCategory::with('category')->get();
    $existing_tags = Tag::where('post_id', $id)->get();
    $post_data = Post::where('id', $id)->first();
      return view('admin.post_edit', compact('post_data', 'sub_categories', 'existing_tags'));
  }

    public function  update(Request $request, $id){

      $post_data = Post::where('id',$id)->first();

      $request->validate([
          'post_title' => 'required',
          'post_detail' => 'required',
          'post_photo' => 'required|image|mimes:jpg,jpeg,png,gif',
      ]);
      if ($request->hasFile('post_photo')) {
          $image_path = public_path('uploads/'.$post_data->post_photo);
          if(file_exists($image_path)){
              unlink($image_path);
          }
          $file = $request->file('post_photo');
          $filename= date('YmdHi').$file->getClientOriginalName();
          $request->file('post_photo')->move(public_path('uploads/'), $filename);
          $post_data->post_photo = $filename;
      }
      $post_data->post_title = $request->post_title;
      $post_data->post_detail = $request->post_detail;
      $post_data->is_share = $request->is_share;
      $post_data->is_comment = $request->is_comment;
      $post_data->update();
      if($request->tags != ''){
        $tags_array = explode(',', $request->tags);
        for($i=0; $i<count($tags_array);$i++){
          $total = Tag::where('post_id', $id)->where('tag_name', trim($tags_array[$i]))->count();
          if(!$total){
            $tag = new Tag();
            $tag->post_id = $id;
            $tag->tag_name = trim($tags_array[$i]);
            $tag->save();
          }
        }
      }
      return redirect()->back()->with('success', 'Post is updated successfully');
  }

  public function  delete($id){
    $post_data = Post::where('id',$id)->first();
    if ($post_data->post_photo != '' && $post_data->post_photo !=NULL) {
      $image_path = public_path('uploads/'.$post_data->post_photo);
      if(file_exists($image_path)){
          unlink($image_path);
        }
      }
    $post_data->delete();
    Tag::where('post_id', $id)->delete();
      return redirect()->route('admin_post_show')->with('success', 'Post is deleted successfully');
  }

  public function  delete_tag($tagid, $postid){
    $tag = Tag::where('id', $tagid)->first();
    $tag->delete();
      return redirect()->route('admin_post_edit', $postid)->with('success', 'Tag is deleted successfully');
  }
}
