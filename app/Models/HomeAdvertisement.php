<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class HomeAdvertisement extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $fillable = [
    'above_search_ad',
    'above_search_ad_url',
    'above_search_ad_status',
    'above_footer_ad',
    'above_footer_ad_url',
    'above_footer_ad_status'
  ];
}
