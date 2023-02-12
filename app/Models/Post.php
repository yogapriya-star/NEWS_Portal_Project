<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
       use HasFactory;

    protected $fillable = [
      'sub_category_id',
      'post_title',
      'post_detail',
      'post_photo',
      'visitors',
      'author_id',
      'admin_id',
      'is_share',
      'is_comment',
    ];

    public function subcategory(){
      return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
