<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\leadershipController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\historyController;
use App\Http\Controllers\feedController;
use App\Http\Controllers\eventController;
use App\Http\Controllers\houseController;
use App\Http\Controllers\roomsController;
use App\Http\Controllers\reservationsController;
use App\Http\Controllers\hotelController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\ForgotPasswordController;

// Route::get('/', function () {return view('welcome');});
Route::get('/', [hotelController::class, 'index']);
Route::get('/the-rooms', [hotelController::class, 'rooms']);
Route::get('/the-rooms/{id}', [hotelController::class, 'show'])->name('room.details');
Route::get('/about', [hotelController::class, 'about']);
Route::get('/contact', [hotelController::class, 'contact']);
Route::post('contact', [ContactController::class, 'store'])->name('contact.us.store');
// Route::get('/the-reservation', [hotelController::class, 'reservation']);
Route::group(['middleware' => ['auth']], function () {
    Route::get('/the-rooms/{id}/book', [hotelController::class, 'reservation'])->name('booking.form');
    Route::post('/the-rooms/{id}/book', [BookingController::class, 'store'])->name('booking.payment');
});
Route::get('/the-events', [hotelController::class, 'events']);
Route::get('/the-events/{id}', [hotelController::class, 'showevents'])->name('event.details');
Route::post('/check-availability', [hotelController::class, 'checkAvailability']);
Route::get('/check-availability', [hotelController::class, 'showAvailabilityForm']);

// Route::get('stripe', [BookingController::class, 'index']);
// Route::post('stripe/create-charge', [BookingController::class, 'createCharge'])->name('stripe.create-charge');

Route::middleware(['throttle:uploads'])->group(function () {
    Auth::routes(['verify' => true]);
});

Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('permissions', controller: PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);
    Route::resource('leadership', leadershipController::class);
    Route::resource('Gallery', ImageController::class);
    Route::resource('history', historyController::class);
    Route::resource('feed', feedController::class);
    Route::resource('event', eventController::class);
    Route::resource('house', houseController::class);
    Route::resource('rooms', roomsController::class);
    Route::resource('reservations', reservationsController::class);
    Route::get('/availablerooms', [HotelController::class, 'availableRooms']);
    Route::get('generate-pdf', [PDFController::class, 'generatePDF'])->name('download.pdf');
    Route::get('users-export', [HotelController::class, 'export'])->name('users.export');
    Route::post('users-import', [HotelController::class, 'import'])->name('users.import');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name(
        'home',
        // ->middleware('verified')
    );
});

// Route::group(['middleware' => ['auth', 'role:abdool']], function () {
//     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name(
//         'home',
//         // ->middleware('verified')
//     );
// });

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');

Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');

Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
