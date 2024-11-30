<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\HotelController as AdminHotelController;
use App\Http\Controllers\Admin\ResortController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\EnqueryController as AdminEnquiryController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\HotelController as FrontHotelController;
use App\Http\Controllers\Front\ResortController as FrontResortController ;
use App\Http\Controllers\Front\EnquiryController;



//Front Rout
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/package/{slug}', [HomeController::class, 'tourPackage'])->name('package');
Route::get('/corporate/{slug}', [HomeController::class, 'corporatePackage'])->name('corporate');
Route::get('/about', [HomeController::class, 'aboutUs'])->name('about');


Route::get('/enquiry', [HomeController::class, 'enquiry'])->name('enquiry');
Route::get('hotel/enquiry', [HomeController::class, 'enquiry'])->name('hotel.enquiry');
Route::get('/package/details/{slug}', [HomeController::class, 'packageDetails'])->name('package.details');
Route::get('/hotels', [FrontHotelController::class, 'hotels'])->name('hotels');
Route::get('/hotel-deatail/{slug}', [FrontHotelController::class, 'hotelDetail'])->name('hotel.detail');

Route::get('/resort', [FrontResortController::class, 'resort'])->name('resort');
Route::get('/resort-detail/{slug}', [FrontResortController::class, 'resortDetail'])->name('resort.detail');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/testimonial', [HomeController::class, 'testimonial'])->name('testimonial');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('gallery/image/{slug}', [HomeController::class, 'imageGallery'])->name('gallery/image');
Route::get('/blog/detail/{slug}', [HomeController::class, 'blogDetail'])->name('blog/detail');
Route::get('/termsconditions', [HomeController::class, 'termsConditions'])->name('termsconditions');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');

Route::post('/enquiry/save', [EnquiryController::class, 'enquirySave'])->name('enquiry/save');
Route::post('/contact/save', [EnquiryController::class, 'ContactSave'])->name('contact/save');
Route::get('/payment', [HomeController::class, 'payment'])->name('payment');

//Backend

Route::get('/register', [UserController::class, 'registerForm'])->name('register');

Route::post('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'loginForm'])->name('login');
Route::post('login/post', [UserController::class, 'login'])->name('login.post');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


Route::middleware(['admin_login'])->group(function () {
Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
Route::get('package-type', [PackageController::class, 'packageType'])->name('package/type');
Route::get('package-type/create', [PackageController::class, 'packageTypecreate'])->name('package-type/create');
Route::post('package-type/save', [PackageController::class, 'packageTypeSave'])->name('package-type/save');
Route::get('package-type/edit/{id}', [PackageController::class, 'packageTypeEdit'])->name('package-type/edit');
Route::post('package-type/update', [PackageController::class, 'packageTypeUpdate'])->name('package-type/update');
Route::post('package-type/delete/{id}', [PackageController::class, 'packageDelete'])->name('package-type/delete');
//Package
Route::get('package-list', [PackageController::class, 'index'])->name('package/list');
Route::get('package-create', [PackageController::class, 'Package'])->name('package/create');
Route::post('package/save', [PackageController::class, 'packageSave'])->name('package/save');
Route::get('package-edit/{id}', [PackageController::class, 'PackageEdit'])->name('package/edit');
Route::post('package/update', [PackageController::class, 'packageUpdate'])->name('package/update');
Route::delete('/delete-packageimage/{id}', [PackageController::class, 'deleteImage'])->name('delete.packageimage');
Route::post('/package/delete/{id}', [PackageController::class, 'deletePackage'])->name('package/delete');



//Hotel
Route::get('hotel-list', [AdminHotelController::class, 'index'])->name('hotel/list');
Route::get('hotel-create', [AdminHotelController::class, 'create'])->name('hotel/create');
Route::post('hotel/save', [AdminHotelController::class, 'hotelSave'])->name('hotel/save');
Route::get('hotel-edit/{id}', [AdminHotelController::class, 'edit'])->name('hotel/edit');
Route::delete('/delete-hotelimage/{id}', [AdminHotelController::class, 'deleteImage'])->name('delete/hotelimage');
Route::post('hotel/update', [AdminHotelController::class, 'hotelUpdate'])->name('hotel/update');
Route::post('/hotel/popular/update', [AdminHotelController::class, 'updatePopularStatus'])->name('hotel.popular.update');
Route::post('/hotel/delete/{id}', [AdminHotelController::class, 'deleteHotel'])->name('hotel/delete');
Route::get('/api/get-states', [AdminHotelController::class, 'getStates']);
Route::get('/api/get-cities/{state_id}', [AdminHotelController::class, 'getCities']);

//Resort
Route::get('resort-list', [ResortController::class, 'index'])->name('resort/list');
Route::get('resort-create', [ResortController::class, 'create'])->name('resort/create');
Route::post('resort/save', [ResortController::class, 'resortSave'])->name('resort/save');
Route::get('resort-edit/{id}', [ResortController::class, 'edit'])->name('resort/edit');
Route::post('resort/update', [ResortController::class, 'resortUpdate'])->name('resort/update');
Route::delete('/delete-image/{id}', [ResortController::class, 'deleteImage'])->name('delete/image');
Route::post('/resort/delete/{id}', [ResortController::class, 'deleteResort'])->name('resort/delete');


//Enquiry
Route::get('enquiry/list', [AdminEnquiryController::class, 'index'])->name('enquiry/list');
Route::get('/enquiry/edit/{id}', [AdminEnquiryController::class, 'edit'])->name('enquiry.edit');
Route::post('enquiry/update', [AdminEnquiryController::class, 'enquiryUpdate'])->name('enquiry/update');

Route::get('contact/list', [AdminEnquiryController::class, 'contact'])->name('contact/list');
Route::get('/contact/edit/{id}', [AdminEnquiryController::class, 'contactedit'])->name('contact.edit');

Route::get('gallery-list', [GalleryController::class, 'index'])->name('gallery/list');
Route::get('gallery-create', [GalleryController::class, 'create'])->name('gallery/create');
Route::post('gallery/save', [GalleryController::class, 'gallerySave'])->name('gallery/save');
Route::get('gallery-edit/{slug}', [GalleryController::class, 'edit'])->name('gallery/edit');
Route::post('gallery/update', [GalleryController::class, 'galleryUpdate'])->name('gallery/update');
Route::post('/gallery/delete/{id}', [GalleryController::class, 'deleteGall'])->name('gallery/delete');

Route::get('city-list', [GalleryController::class, 'cityList'])->name('city.list');
Route::get('city-create', [GalleryController::class, 'cityCreate'])->name('city.create');
Route::post('city/save', [GalleryController::class, 'citySave'])->name('city/save');
Route::post('/city/delete/{id}', [GalleryController::class, 'deleteCity'])->name('gallery/delete');

Route::get('user-list', [UserController::class, 'userList'])->name('user.list');
Route::get('change-password/{id}', [UserController::class, 'changePassword'])->name('change.password');
Route::post('password/update', [UserController::class, 'passwordUpdate'])->name('password/update');


//Banner
Route::get('banner-list', [GalleryController::class, 'bannerIndex'])->name('banner/list');
Route::get('banner-create', [GalleryController::class, 'bannerCreate'])->name('banner/create');
Route::post('banner/save', [GalleryController::class, 'bannerSave'])->name('banner/save');
Route::get('banner-edit/{slug}', [GalleryController::class, 'bannerEdit'])->name('banner/edit');
Route::post('banner/update', [GalleryController::class, 'bannerUpdate'])->name('banner/update');
Route::post('/banner/delete/{id}', [GalleryController::class, 'deletebanner'])->name('banner/delete');

Route::get('blog/list', [BlogController::class, 'index'])->name('blog/list');
Route::get('blog/create', [BlogController::class, 'create'])->name('blog/create');
Route::post('blog/save', [BlogController::class, 'save'])->name('blog/save');
Route::post('/blog/image/upload', [BlogController::class, 'uploadImage'])->name('blog.image.upload');
Route::get('blog/edit/{slug}', [BlogController::class, 'edit'])->name('blog/edit');
Route::post('blog/update', [BlogController::class, 'update'])->name('blog/update');
Route::post('/blog/delete/{id}', [BlogController::class, 'deleteBlog'])->name('blog/delete');
    // All other admin routes

});
//Package Type 



Route::post('/payment_success',[App\Http\Controllers\PaymentController::class,'payment_success'])->name('payment_success');







