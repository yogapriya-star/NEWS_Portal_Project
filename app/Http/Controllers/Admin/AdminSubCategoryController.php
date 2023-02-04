<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;

class AdminSubCategoryController extends Controller
{
  public function show(){
    $subcategories = SubCategory::with('category')->orderBy('sub_category_order', 'asc')->get();
    return view('admin.subcategory_show', compact('subcategories'));
  }

  public function create(){
    $categories = Category::orderBy('category_order', 'asc')->get();
  return view('admin.subcategory_create', compact('categories'));
  }

  public function store(Request $request){

    $request->validate([
        'sub_category_name' => 'required',
        'show_on_menu' => 'required',
        'sub_category_order' => 'required',
    ]);
    $subcategory_data = new SubCategory();
    $subcategory_data->sub_category_name = $request->sub_category_name;
    $subcategory_data->show_on_menu = $request->show_on_menu;
    $subcategory_data->sub_category_order = $request->sub_category_order;
    $subcategory_data->category_id = $request->category_id;
    $subcategory_data->save();
    return redirect()->back()->with('success', 'SubCategory is created successfully');
  }

  public function  edit($id){
      $categories = Category::orderBy('category_order', 'asc')->get();
    $subcategory_data = SubCategory::where('id', $id)->first();
      return view('admin.subcategory_edit', compact('subcategory_data','categories'));
  }

    public function  update(Request $request, $id){

      $subcategory_data = SubCategory::where('id',$id)->first();
      $subcategory_data->sub_category_name = $request->sub_category_name;
      $subcategory_data->show_on_menu = $request->show_on_menu;
      $subcategory_data->sub_category_order = $request->sub_category_order;
      $subcategory_data->category_id = $request->category_id;
      $subcategory_data->update();
      return redirect()->back()->with('success', 'SubCategory is updated successfully');
  }

  public function  delete($id){
      $subcategory_data = SubCategory::where('id',$id)->first();
      $subcategory_data->delete();
      return redirect()->route('admin_subcategory_show')->with('success', 'SubCategory is deleted successfully');
  }
}
