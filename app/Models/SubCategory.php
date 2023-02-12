<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
  use HasFactory;

  protected $fillable = [
    'sub_category_name',
    'show_on_menu',
    'sub_category_order',
    'category_id'
  ];

  public function category(){
    return $this->belongsTo(Category::class, 'category_id');
  }

}
