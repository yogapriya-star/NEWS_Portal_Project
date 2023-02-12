<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminHomeAdvertisementController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Admin\AdminTopAdvertisementController;
use App\Http\Controllers\Admin\AdminSidebarController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminSubCategoryController;
use App\Http\Controllers\Admin\AdminPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Front End */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

/* Admin Home */
Route::get('/admin/home', [AdminHomeController::class, 'index'])->name('admin_home')
->middleware('admin:admin');

/* Admin Login */
Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin_login');
Route::post('/admin/login-submit', [AdminLoginController::class, 'login_submit'])->name('admin_login_submit');

/* Admin Forget Password */
Route::get('/admin/forget-password', [AdminLoginController::class, 'forget_password'])->name('admin_forget_password');
Route::post('/admin/forget-password-submit', [AdminLoginController::class, 'forget_password_submit'])
->name('admin_forget_password_submit');

/* Admin Reset Password */
Route::get('/admin/reset-password/{token}/{email}', [AdminLoginController::class, 'reset_password'])
->name('reset_password');
Route::post('/admin/reset-password-submit', [AdminLoginController::class, 'reset_password_submit'])
->name('admin_reset_password_submit');

/* Admin Logout*/
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin_logout');

/* Admin Profile*/
Route::get('/admin/edit-profile', [AdminProfileController::class, 'index'])->name('admin_profile')
->middleware('admin:admin');
Route::post('/admin/edit-profile-submit', [AdminProfileController::class, 'profile_submit'])
->name('admin_profile_submit');
/* Top Advertisement */
Route::get('/admin/top-advertisement', [AdminTopAdvertisementController::class, 'top_ad_show'])
->name('admin_top_ad_show')->middleware('admin:admin');
Route::post('/admin/top-advertisement-update', [AdminTopAdvertisementController::class, 'top_ad_update'])
->name('admin_top_ad_update');

/* Home Advertisement */
Route::get('/admin/home-advertisement', [AdminHomeAdvertisementController::class, 'home_ad_show'])
->name('admin_home_ad_show')->middleware('admin:admin');
Route::post('/admin/home-advertisement-update', [AdminHomeAdvertisementController::class, 'home_ad_update'])
->name('admin_home_ad_update');

/* Sidebar Advertisement */
Route::get('/admin/sidebar-advertisement-view', [AdminSidebarController::class, 'sidebar_ad_show'])
->name('admin_sidebar_ad_show')->middleware('admin:admin');
Route::get('/admin/sidebar-advertisement-create', [AdminSidebarController::class, 'sidebar_ad_create'])
->name('admin_sidebar_ad_create')->middleware('admin:admin');
Route::post('/admin/sidebar-advertisement-store', [AdminSidebarController::class, 'sidebar_ad_store'])
->name('admin_sidebar_ad_store');
Route::get('/admin/sidebar-advertisement-edit/{id}', [AdminSidebarController::class, 'sidebar_ad_edit'])
->name('admin_sidebar_ad_edit')->middleware('admin:admin');
Route::post('/admin/sidebar-advertisement-update/{id}', [AdminSidebarController::class, 'sidebar_ad_update'])
->name('admin_sidebar_ad_update');
Route::get('/admin/sidebar-advertisement-delete/{id}', [AdminSidebarController::class, 'sidebar_ad_delete'])
->name('admin_sidebar_ad_delete')->middleware('admin:admin');

/* Category */
Route::get('/admin/category/show', [AdminCategoryController::class, 'show'])
->name('admin_category_show')->middleware('admin:admin');
Route::get('/admin/category/create', [AdminCategoryController::class, 'create'])
->name('admin_category_create')->middleware('admin:admin');
Route::post('/admin/category/store', [AdminCategoryController::class, 'store'])
->name('admin_category_store');
Route::get('/admin/category/edit/{id}', [AdminCategoryController::class, 'edit'])
->name('admin_category_edit')->middleware('admin:admin');
Route::post('/admin/category/update/{id}', [AdminCategoryController::class, 'update'])
->name('admin_category_update');
Route::get('/admin/category/delete/{id}', [AdminCategoryController::class, 'delete'])
->name('admin_category_delete')->middleware('admin:admin');

/* Sub Category */
Route::get('/admin/subcategory/show', [AdminSubCategoryController::class, 'show'])
->name('admin_subcategory_show')->middleware('admin:admin');
Route::get('/admin/subcategory/create', [AdminSubCategoryController::class, 'create'])
->name('admin_subcategory_create')->middleware('admin:admin');
Route::post('/admin/subcategory/store', [AdminSubCategoryController::class, 'store'])
->name('admin_subcategory_store');
Route::get('/admin/subcategory/edit/{id}', [AdminSubCategoryController::class, 'edit'])
->name('admin_subcategory_edit')->middleware('admin:admin');
Route::post('/admin/subcategory/update/{id}', [AdminSubCategoryController::class, 'update'])
->name('admin_subcategory_update');
Route::get('/admin/subcategory/delete/{id}', [AdminSubCategoryController::class, 'delete'])
->name('admin_subcategory_delete')->middleware('admin:admin');

/*Posts*/
Route::get('/admin/post/show', [AdminPostController::class, 'show'])
->name('admin_post_show')->middleware('admin:admin');
Route::get('/admin/post/create', [AdminPostController::class, 'create'])
->name('admin_post_create')->middleware('admin:admin');
Route::post('/admin/post/store', [AdminPostController::class, 'store'])
->name('admin_post_store');
Route::get('/admin/post/edit/{id}', [AdminPostController::class, 'edit'])
->name('admin_post_edit')->middleware('admin:admin');
Route::post('/admin/post/update/{id}', [AdminPostController::class, 'update'])
->name('admin_post_update');
Route::get('/admin/post/delete/{id}', [AdminPostController::class, 'delete'])
->name('admin_post_delete')->middleware('admin:admin');

/*Delete Tag*/
Route::get('/admin/post/tag/delete/{tagid}/{postid}', [AdminPostController::class, 'delete_tag'])
->name('admin_post_delete_tag')->middleware('admin:admin');
