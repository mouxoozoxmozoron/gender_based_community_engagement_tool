<?php

// use App\Http\Controllers\API\users\UserController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\web\GroupController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\InsightController;
use App\Http\Controllers\web\UserController;
use Illuminate\Support\Facades\Route;
use Aws\S3\S3Client;
use Illuminate\Support\Facades\Mail;

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

Route::get('/', [HomeController::class, 'web_home'])->name('/');

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

Route::POST('login_check', [UserController::class, 'login_check'])->name('login_check');
Route::POST('insight_check', [InsightController::class, 'saveuserinsight'])->name('insight_check');
Route::POST('registration_check', [UserController::class, 'registration_check'])->name('registration_check');

Route::get('group_details/{id}', [GroupController::class, 'group_detail'])->name('group_details');
Route::get('group_details/{id}/members', [GroupController::class, 'group_members'])->name('group_details.members');
Route::get('group_details/{id}/posts', [GroupController::class, 'group_posts'])->name('group_details.posts');
Route::get('group_details/{id}/events', [GroupController::class, 'group_events'])->name('group_details.events');
Route::get('group_user_delete/{id}', [GroupController::class, 'deleteuser'])->name('group_details.user.delete');
Route::get('group_event_delete/{id}', [GroupController::class, 'deleteevent'])->name('group_details.event.delete');
Route::get('group_event_view/{group}/{event}', [GroupController::class, 'viewevent'])
    ->name('group_details.events.viewevent');
Route::get('group_event_feedback_delete/{id}', [GroupController::class, 'deletefeedbac'])->name('group_details.event.feedback.delete');
Route::get('group_post_delete/{id}', [GroupController::class, 'deletepost'])->name('group_details.post.delete');

Route::post('/send-email', [EmailController::class, 'sendEmail'])->name('send.email');
