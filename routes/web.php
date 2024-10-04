<?php

// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;

// /*
// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider and all of them will
// | be assigned to the "web" middleware group. Make something great!
// |
// */

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

use App\Http\Controllers\Admin\FilmController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\ShowtimeController;
use App\Http\Controllers\AdminRatingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\User\UserFilmController;
use App\Http\Controllers\UserProfileController;

// Route::get('/', function () {
//     return view('user.home'); // Home bisa diakses tanpa login
// })->name('user.home');

Route::get('/', [UserFilmController::class, 'index'])->name('user.home');
Route::get('/user/film/{id}', [UserFilmController::class, 'show'])->name('user.film.show');
Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
Route::put('/user/ratings/{id}', [RatingController::class, 'update'])->name('user.ratings.update');
Route::delete('/user/ratings/{id}', [RatingController::class, 'destroy'])->name('user.ratings.destroy');

Route::get('/booking/{showtimeId}', [BookingController::class, 'show'])->name('booking.show');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::post('/booking/confirm', [BookingController::class, 'confirm'])->name('booking.confirm');
Route::post('/booking/confirm', [BookingController::class, 'confirm'])->name('booking.confirm');
// Route::delete('/booking/{id}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk admin
Route::middleware('role:admin')->group(function () {
    // film list
    Route::get('/admin/home', [FilmController::class, 'index'])->name('admin.home');
    Route::get('/admin/films/create', [FilmController::class, 'create'])->name('admin.films.create');
    Route::get('/admin/films/{id}', [FilmController::class, 'show'])->name('admin.films.show');
    Route::post('/admin/films', [FilmController::class, 'store'])->name('admin.films.store');
    Route::get('/admin/films/{id}/edit', [FilmController::class, 'edit'])->name('admin.films.edit');
    Route::put('/admin/films/{id}', [FilmController::class, 'update'])->name('admin.films.update');
    Route::delete('/admin/films/{id}', [FilmController::class, 'destroy'])->name('admin.films.destroy');
    // genre list
    Route::get('/admin/genre', [GenreController::class, 'index'])->name('admin.genre.home');
    Route::get('/admin/genre/create', [GenreController::class, 'create'])->name('admin.genre.create');
    Route::post('/admin/genre', [GenreController::class, 'store'])->name('admin.genre.store');
    Route::get('/admin/genre/{id}/edit', [GenreController::class, 'edit'])->name('admin.genre.edit');
    Route::put('/admin/genre/{id}', [GenreController::class, 'update'])->name('admin.genre.update');
    Route::delete('/admin/genre/{id}', [GenreController::class, 'destroy'])->name('admin.genre.destroy');
    // showtime list
    Route::get('/admin/showtime', [ShowtimeController::class, 'index'])->name('admin.showtime.home');
    Route::get('/admin/showtime/create', [ShowtimeController::class, 'create'])->name('admin.showtime.create');
    Route::post('/admin/showtime', [ShowtimeController::class, 'store'])->name('admin.showtime.store');
    Route::get('/admin/showtime/{id}/edit', [ShowtimeController::class, 'edit'])->name('admin.showtime.edit');
    Route::put('/admin/showtime/{id}', [ShowtimeController::class, 'update'])->name('admin.showtime.update');
    Route::delete('/admin/showtime/{id}', [ShowtimeController::class, 'destroy'])->name('admin.showtime.destroy');
    Route::get('/admin/showtime/{id}', [ShowtimeController::class, 'show'])->name('admin.showtime.show');
    // ratings
    Route::get('/admin/ratings', [AdminRatingController::class, 'index'])->name('admin.ratings.home');
    Route::get('/admin/ratings/{film_id}', [AdminRatingController::class, 'show'])->name('admin.ratings.details');

    // rooms
    Route::get('/admin/rooms', [RoomController::class, 'index'])->name('admin.rooms.home');
    Route::get('/admin/rooms/create', [RoomController::class, 'create'])->name('admin.rooms.create');
    Route::get('/admin/rooms/{film_id}', [RoomController::class, 'show'])->name('rooms.details');
    Route::post('/admin/rooms', [RoomController::class, 'store'])->name('admin.rooms.store');
    Route::get('/admin/rooms/{id}/edit', [RoomController::class, 'edit'])->name('admin.rooms.edit');
    Route::put('/admin/rooms/{id}', [RoomController::class, 'update'])->name('admin.rooms.update');
    Route::delete('/admin/rooms/{id}', [RoomController::class, 'destroy'])->name('admin.rooms.destroy');
});

Route::delete('/booking/{id}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');

Route::middleware(['auth'])->group(function () {
    Route::get('/user/profile', [UserProfileController::class, 'index'])->name('user.profile');
});

// Route untuk user
Route::middleware('role:user')->group(function () {
    Route::get('/user/home', [UserFilmController::class, 'index'])->name('user.home');
    // Route::get('/user/film/{id}', [UserFilmController::class, 'show'])->name('user.film.show');
});

Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
// Route::prefix('admin')->name('admin.')->group(function () {
//     // Route::resource('rooms', \App\Http\Controllers\Admin\RoomController::class);
// });

// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('/ratings', [AdminRatingController::class, 'index'])->name('ratings.index');
//     Route::get('/ratings/{film_id}', [AdminRatingController::class, 'show'])->name('ratings.details');

//     // Route::get('/ratings/{film_id}', [AdminRatingController::class, 'details'])->name('ratings.details');
//     // Route::delete('/ratings/{id}', [AdminRatingController::class, 'destroy'])->name('ratings.destroy');
// });