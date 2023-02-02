<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class AdminCategoryController extends Controller
{
  public function show(){
    $categories = Category::orderBy('category_order', 'asc')->get();
    return view('admin.category_show', compact('categories'));
  }

  public function create(){
  return view('admin.category_create');
  }

  public function store(Request $request){

    $request->validate([
        'category_name' => 'required',
        'show_on_menu' => 'required',
        'category_order' => 'required',
    ]);
    $category_data = new Category();
    $category_data->category_name = $request->category_name;
    $category_data->show_on_menu = $request->show_on_menu;
    $category_data->category_order = $request->category_order;
    $category_data->save();
    return redirect()->back()->with('success', 'Category is created successfully');
  }

  public function  edit($id){
    $category_data = Category::where('id', $id)->first();
      return view('admin.category_edit', compact('category_data'));
  }

    public function  update(Request $request, $id){

      $category_data = Category::where('id',$id)->first();
      $category_data->category_name = $request->category_name;
      $category_data->show_on_menu = $request->show_on_menu;
      $category_data->category_order = $request->category_order;
      $category_data->update();
      return redirect()->back()->with('success', 'Category is updated successfully');
  }

  public function  delete($id){
      $category_data = Category::where('id',$id)->first();
      $category_data->delete();
      return redirect()->route('admin_category_show')->with('success', 'Category is deleted successfully');
  }
}
