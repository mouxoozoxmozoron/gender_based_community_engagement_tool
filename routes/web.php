<?php

// use App\Http\Controllers\API\users\UserController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\web\AdminController;
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

Route::get('smssend', [UserController::class, 'sendTestSms']);


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

//system admin routes
Route::get('system_admindashboard', [AdminController::class, 'Dashboard'])->name('system_admindashboard');
Route::get('allgroupmembers', [AdminController::class, 'AllgroupMembers'])->name('allgroupmembers');
Route::get('allgroupmanagers', [AdminController::class, 'AllGroupMnagers'])->name('allgroupmanagers');
Route::get('allorganisation', [AdminController::class, 'AllOrganisations'])->name('allorganisation');
Route::post('saveneworganisation', [AdminController::class, 'SaveNewOrganisation'])->name('saveneworganisation');
Route::get('organisationgroups/{id}', [AdminController::class, 'AllOrganisationGroups'])->name('organisationgroups');

// action on organisation
Route::post('/approve-organisation/{id}', [AdminController::class, 'approveOrganisation'])->name('approve-organisation');
Route::post('/suspend-organisation/{id}', [AdminController::class, 'suspendOrganisation'])->name('suspend-organisation');
Route::post('/backup-organisation/{id}', [AdminController::class, 'backupOrganisation'])->name('backup-organisation');
Route::post('/delete-organisation/{id}', [AdminController::class, 'deleteOrganisation'])->name('delete-organisation');

//action on groups
Route::post('/approve-group/{id}', [AdminController::class, 'approveGroup'])->name('approve-group');
Route::post('/suspend-group/{id}', [AdminController::class, 'suspendGroup'])->name('suspend-group');
Route::post('/backup-group/{id}', [AdminController::class, 'backupGroup'])->name('backup-group');
Route::post('/delete-group/{id}', [AdminController::class, 'deleteGroup'])->name('delete-group');
