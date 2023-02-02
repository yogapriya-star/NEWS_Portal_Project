<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SidebarAdvertisement extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $fillable = [
    'sidebar_ad',
    'sidebar_ad_url',
    'sidebar_ad_location',
  ];
}
