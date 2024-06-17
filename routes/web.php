<?php

use App\Http\Controllers\email_controller;
use App\Http\Controllers\web\group_controller;
use App\Http\Controllers\web\home_controller;
use App\Http\Controllers\web\insight_controller;
use App\Http\Controllers\web\user_controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [home_controller::class, 'web_home'])->name('/');




// auth routes
Route::get('register', function () {
    return view('screens/auth/register');
});
Route::get('login', function () {
    return view('screens/auth/login');
});
Route::get('exit', function () {
    if (session()->has('user_id')) {
        session()->pull('user_id');
        session()->pull('user_groupname');
        session()->pull('user_object');
        return redirect('/');
    }
})->name('exit');
Route::POST('login_check', [user_controller::class, 'login_check'])->name('login_check');
Route::POST('insight_check', [insight_controller::class, 'saveuserinsight'])->name('insight_check');
Route::POST('registration_check', [user_controller::class, 'registration'])->name('registration_check');


// management
Route::get('group_details/{id}', [group_controller::class, 'group_detail'])->name('group_details');
Route::get('group_details/{id}/members', [group_controller::class, 'group_members'])->name('group_details.members');
Route::get('group_details/{id}/posts', [group_controller::class, 'group_posts'])->name('group_details.posts');
Route::get('group_details/{id}/events', [group_controller::class, 'group_events'])->name('group_details.events');
Route::get('group_user_delete/{id}', [group_controller::class, 'deleteuser'])->name('group_details.user.delete');
Route::get('group_event_delete/{id}', [group_controller::class, 'deleteevent'])->name('group_details.event.delete');
Route::get('group_post_delete/{id}', [group_controller::class, 'deletepost'])->name('group_details.post.delete');





Route::post('/send-email', [email_controller::class, 'sendEmail'])->name('send.email');
