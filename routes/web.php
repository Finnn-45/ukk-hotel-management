<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\MidtransController;

// ==============================
// AUTH ADMIN (terpisah total)
// ==============================
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login');
    
    // Admin protected routes
    Route::middleware('admin.auth')->group(function () {
        Route::post('/logout', function (\Illuminate\Http\Request $request) {
            \Illuminate\Support\Facades\Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/admin/login');
        })->name('admin.logout');

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        
        // Bookings
        Route::get('/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
        Route::get('/bookings/create', [BookingController::class, 'create'])->name('admin.bookings.create');
        Route::post('/bookings', [BookingController::class, 'store'])->name('admin.bookings.store');
        Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('admin.bookings.show');
        Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('admin.bookings.edit');
        Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('admin.bookings.update');
        Route::post('/bookings/{booking}/check-in', [BookingController::class, 'checkIn'])->name('admin.bookings.check-in');
        Route::post('/bookings/{booking}/check-out', [BookingController::class, 'checkOut'])->name('admin.bookings.check-out');
        Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('admin.bookings.destroy');
        
        // Rooms
        Route::get('/rooms', [RoomController::class, 'index'])->name('admin.rooms.index');
        Route::get('/rooms/create', [RoomController::class, 'create'])->name('admin.rooms.create');
        Route::post('/rooms', [RoomController::class, 'store'])->name('admin.rooms.store');
        Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('admin.rooms.edit');
        Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('admin.rooms.update');
        Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('admin.rooms.destroy');
        
        // Room Types
        Route::get('/room-types', [RoomController::class, 'roomTypeIndex'])->name('admin.room-types.index');
        Route::post('/room-types', [RoomController::class, 'roomTypeStore'])->name('admin.room-types.store');
        Route::get('/room-types/{roomType}/edit', [RoomController::class, 'roomTypeEdit'])->name('admin.room-types.edit');
        Route::put('/room-types/{roomType}', [RoomController::class, 'roomTypeUpdate'])->name('admin.room-types.update');
        Route::delete('/room-types/{roomType}', [RoomController::class, 'roomTypeDestroy'])->name('admin.room-types.destroy');
        
        // Guests
        Route::get('/guests', [GuestController::class, 'index'])->name('admin.guests.index');
        Route::get('/guests/create', [GuestController::class, 'create'])->name('admin.guests.create');
        Route::post('/guests', [GuestController::class, 'store'])->name('admin.guests.store');
        Route::get('/guests/{guest}/edit', [GuestController::class, 'edit'])->name('admin.guests.edit');
        Route::put('/guests/{guest}', [GuestController::class, 'update'])->name('admin.guests.update');
        Route::delete('/guests/{guest}', [GuestController::class, 'destroy'])->name('admin.guests.destroy');
        
        // Payments
        Route::get('/payments', [PaymentController::class, 'index'])->name('admin.payments.index');
        Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('admin.payments.show');
        Route::put('/payments/{payment}', [PaymentController::class, 'update'])->name('admin.payments.update');
        
        // Restaurant
        Route::prefix('restaurant')->group(function () {
            Route::get('/menu', [RestaurantController::class, 'menuIndex'])->name('admin.restaurant.menu.index');
            Route::get('/menu/create', [RestaurantController::class, 'menuCreate'])->name('admin.restaurant.menu.create');
            Route::post('/menu', [RestaurantController::class, 'menuStore'])->name('admin.restaurant.menu.store');
            Route::get('/menu/{restaurantMenu}/edit', [RestaurantController::class, 'menuEdit'])->name('admin.restaurant.menu.edit');
            Route::put('/menu/{restaurantMenu}', [RestaurantController::class, 'menuUpdate'])->name('admin.restaurant.menu.update');
            Route::delete('/menu/{restaurantMenu}', [RestaurantController::class, 'menuDestroy'])->name('admin.restaurant.menu.destroy');
            Route::get('/orders', [RestaurantController::class, 'orderIndex'])->name('admin.restaurant.order.index');
            Route::get('/orders/{order}', [RestaurantController::class, 'orderShow'])->name('admin.restaurant.order.show');
            Route::post('/orders/{order}/status', [RestaurantController::class, 'updateStatus'])->name('admin.restaurant.order.status');
        });
    });
});

// Midtrans Notification
Route::post('/payment/midtrans/notification', [PaymentController::class, 'midtransNotification'])->name('payment.midtrans.notification');

// Landing Page Management & Settings & Activity Logs & Notifications
Route::prefix('admin')->middleware('admin.auth')->group(function () {
    Route::get('/landing-page', [\App\Http\Controllers\Admin\LandingPageController::class, 'index'])->name('admin.landing-page.index');
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin.settings.index');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.settings.update');
    Route::get('/activity-logs', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('admin.activity-logs.index');
    Route::get('/notifications', [\App\Http\Controllers\Admin\NotificationController::class, 'index'])->name('admin.notifications.index');
    Route::post('/notifications/mark-all-read', [\App\Http\Controllers\Admin\NotificationController::class, 'markAllRead'])->name('admin.notifications.mark-all-read');
    Route::post('/notifications/{id}/read', [\App\Http\Controllers\Admin\NotificationController::class, 'markRead'])->name('admin.notifications.read');
    Route::post('/landing-page/section/{section}', [\App\Http\Controllers\Admin\LandingPageController::class, 'updateSection'])->name('admin.landing-page.section.update');
    Route::post('/landing-page/service', [\App\Http\Controllers\Admin\LandingPageController::class, 'storeService'])->name('admin.landing-page.service.store');
    Route::post('/landing-page/service/{service}', [\App\Http\Controllers\Admin\LandingPageController::class, 'updateService'])->name('admin.landing-page.service.update');
    Route::delete('/landing-page/service/{service}', [\App\Http\Controllers\Admin\LandingPageController::class, 'destroyService'])->name('admin.landing-page.service.destroy');
    Route::post('/landing-page/gallery', [\App\Http\Controllers\Admin\LandingPageController::class, 'storeGallery'])->name('admin.landing-page.gallery.store');
    Route::delete('/landing-page/gallery/{gallery}', [\App\Http\Controllers\Admin\LandingPageController::class, 'destroyGallery'])->name('admin.landing-page.gallery.destroy');
    Route::post('/landing-page/testimonial', [\App\Http\Controllers\Admin\LandingPageController::class, 'storeTestimonial'])->name('admin.landing-page.testimonial.store');
    Route::delete('/landing-page/testimonial/{testimonial}', [\App\Http\Controllers\Admin\LandingPageController::class, 'destroyTestimonial'])->name('admin.landing-page.testimonial.destroy');
});

// ==============================
// AUTH CUSTOMER (terpisah total)
// ==============================
Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
Route::post('/login', [CustomerAuthController::class, 'login']);
Route::get('/register', [CustomerAuthController::class, 'showRegisterForm'])->name('customer.register');
Route::post('/register', [CustomerAuthController::class, 'register']);
Route::get('/email/verify/{id}', [CustomerAuthController::class, 'verifyEmail'])->name('verification.verify');
Route::get('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

// Review
Route::post('/review', [App\Http\Controllers\ReviewController::class, 'store'])->name('customer.review.store');

// ==============================
// CUSTOMER FRONTEND
// ==============================
Route::get('/', [CustomerController::class, 'home'])->name('home');
Route::get('/kamar', [CustomerController::class, 'rooms'])->name('rooms.index');
Route::get('/kamar/{room}', [CustomerController::class, 'roomDetail'])->name('customer.room.detail');
Route::get('/galeri', [App\Http\Controllers\CustomerController::class, 'gallery'])->name('customer.gallery');
Route::get('/kontak', [App\Http\Controllers\CustomerController::class, 'contact'])->name('customer.contact');

// Midtrans Payment Flow
Route::get('/payment/midtrans/success', [MidtransController::class, 'paymentSuccess'])->name('payment.midtrans.success');
Route::get('/payment/midtrans/pending', [MidtransController::class, 'paymentPending'])->name('payment.midtrans.pending');
Route::get('/payment/midtrans/error', [MidtransController::class, 'paymentError'])->name('payment.midtrans.error');
Route::get('/payment/midtrans/{booking}/token', [MidtransController::class, 'getSnapToken'])->name('payment.midtrans.token');

Route::middleware('auth')->group(function () {
    Route::post('/booking', [CustomerController::class, 'booking'])->name('customer.booking');
    Route::get('/checkout', [CustomerController::class, 'checkout'])->name('customer.checkout');
    Route::post('/process-booking', [CustomerController::class, 'processBooking'])->name('customer.process-booking');
    Route::get('/booking-sukses/{booking}', [CustomerController::class, 'bookingSuccess'])->name('customer.booking.success');
    Route::get('/booking-saya', [CustomerController::class, 'myBookings'])->name('customer.bookings');
    Route::post('/booking/{booking}/cancel', [CustomerController::class, 'cancelBooking'])->name('customer.booking.cancel');
    Route::post('/booking/{booking}/checkout', [CustomerController::class, 'customerCheckOut'])->name('customer.booking.checkout');
    Route::get('/profile', [CustomerController::class, 'profile'])->name('customer.profile');
    Route::post('/profile', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');
    Route::get('/wishlist', [CustomerController::class, 'wishlist'])->name('customer.wishlist');
    Route::get('/notifications', [CustomerController::class, 'notifications'])->name('customer.notifications');
    Route::get('/reviews', [CustomerController::class, 'reviews'])->name('customer.reviews');
    
    // Restaurant Ordering
    Route::get('/restaurant/menu', [App\Http\Controllers\CustomerRestaurantController::class, 'menu'])->name('customer.restaurant.menu');
    Route::post('/restaurant/order', [App\Http\Controllers\CustomerRestaurantController::class, 'placeOrder'])->name('customer.restaurant.order.place');
    Route::get('/restaurant/order/{order}/confirmation', [App\Http\Controllers\CustomerRestaurantController::class, 'orderConfirmation'])->name('customer.restaurant.order.confirmation');
    Route::get('/restaurant/orders', [App\Http\Controllers\CustomerRestaurantController::class, 'myOrders'])->name('customer.restaurant.orders');
    Route::get('/restaurant/order/{order}', [App\Http\Controllers\CustomerRestaurantController::class, 'orderDetail'])->name('customer.restaurant.order.detail');
});
