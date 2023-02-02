<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TopAdvertisement;

class AdminTopAdvertisementController extends Controller
{
  public function top_ad_show(){
    $top_ad_data = TopAdvertisement::where('id',1)->first();
      return view('admin.advertisement_top_view', compact('top_ad_data'));
  }

  public function top_ad_update(Request $request){
      $top_ad_data = TopAdvertisement::where('id',1)->first();
      if ($request->hasFile('top_ad')) {

          $request->validate([
              'top_ad' => 'image|mimes:jpg,jpeg,png,gif',
          ]);
          $image_path = public_path('uploads/'.$top_ad_data->top_ad);
          if(file_exists($image_path)){
              unlink($image_path);
          }
          $file = $request->file('top_ad');
          $filename= date('YmdHi').$file->getClientOriginalName();
          $request->file('top_ad')->move(public_path('uploads/'),$filename);
          $top_ad_data->top_ad = $filename;
      }
      $top_ad_data->top_ad_url =$request->top_ad_url;
      $top_ad_data->top_ad_status =$request->top_ad_status;
      $top_ad_data->update();
      return redirect()->back()->with('success', 'Data is saved successfully');
  }
}
