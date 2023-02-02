<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SidebarAdvertisement;

class AdminSidebarController extends Controller
{
  public function sidebar_ad_show(){
    $sidebar_ad_data = SidebarAdvertisement::get();
      return view('admin.advertisement_sidebar_view', compact('sidebar_ad_data'));
  }

  public function sidebar_ad_create(){
      return view('admin.advertisement_sidebar_create');
  }

  public function sidebar_ad_store(Request $request){

    $request->validate([
        'sidebar_ad' => 'required|image|mimes:jpg,jpeg,png,gif',
    ],[],[
      // 'sidebar_ad.required' => 'Select a photo for ads',
      //   'sidebar_ad.image' => 'Photo must be an image',
      //     'sidebar_ad.mimes' => 'Correct mimes needed',
       'sidebar_ad' => 'Advertisement',
    ]);
    $file = $request->file('sidebar_ad');
    $filename= date('YmdHi').$file->getClientOriginalName();
    $request->file('sidebar_ad')->move(public_path('uploads/'),$filename);
    $sidebar_ad_data = new SidebarAdvertisement();
    $sidebar_ad_data->sidebar_ad = $filename;
    $sidebar_ad_data->sidebar_ad_url = $request->sidebar_ad_url;
    $sidebar_ad_data->sidebar_ad_location = $request->sidebar_ad_location;
    $sidebar_ad_data->save();
    return redirect()->back()->with('success', 'Data is created successfully');
  }

  public function  sidebar_ad_edit($id){
    $sidebar_ad_data = SidebarAdvertisement::where('id', $id)->first();
      return view('admin.advertisement_sidebar_edit', compact('sidebar_ad_data'));
  }

    public function  sidebar_ad_update(Request $request, $id){

      $sidebar_ad_data = SidebarAdvertisement::where('id',$id)->first();
      if ($request->hasFile('sidebar_ad')) {

          $request->validate([
              'sidebar_ad' => 'required|image|mimes:jpg,jpeg,png,gif',
          ]);
          $image_path = public_path('uploads/'.$sidebar_ad_data->sidebar_ad);
          if(file_exists($image_path)){
              unlink($image_path);
          }
          $file = $request->file('sidebar_ad');
          $filename= date('YmdHi').$file->getClientOriginalName();
          $request->file('sidebar_ad')->move(public_path('uploads/'), $filename);
          $sidebar_ad_data->sidebar_ad = $filename;
      }
      $sidebar_ad_data->sidebar_ad_url = $request->sidebar_ad_url;
      $sidebar_ad_data->sidebar_ad_location = $request->sidebar_ad_location;
      $sidebar_ad_data->update();
      return redirect()->back()->with('success', 'Data is updated successfully');
  }

  public function  sidebar_ad_delete($id){
      $sidebar_ad_data = SidebarAdvertisement::where('id',$id)->first();
      $image_path = public_path('uploads/'.$sidebar_ad_data->sidebar_ad);
      if(file_exists($image_path)){
          unlink($image_path);
      }
      $sidebar_ad_data->delete();
      return redirect()->route('admin_sidebar_ad_show')->with('success', 'Data is deleted successfully');
  }
}
