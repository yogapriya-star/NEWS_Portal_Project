<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SubCategory extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

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
