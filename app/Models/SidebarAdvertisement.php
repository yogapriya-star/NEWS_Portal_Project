<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidebarAdvertisement extends Model
{
    use HasFactory;

  protected $fillable = [
    'sidebar_ad',
    'sidebar_ad_url',
    'sidebar_ad_location',
  ];
}
