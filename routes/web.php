<?php

use App\Models\Message;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\messageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\proposalController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Admin\Jobs\AdminJobController;
use App\Http\Controllers\Admin\Proposals\AdminProposalController;
use App\Http\Controllers\client\jobs\JobController as ClientJobController;
use App\Http\Controllers\client\messages\MessageController as ClientMessageController;
use App\Http\Controllers\client\proposals\proposalController as ClientProposalController;
use App\Http\Controllers\provider\messages\MessageController as ProviderMessageController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login-data', [AuthenticationController::class, 'loginData'])->name('login-data');
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
Route::get('/registeration-form', [AuthenticationController::class, 'registerationForm'])->name('registeration-form');

Route::post('/register-data', [AuthenticationController::class, 'registerData'])->name('register-data');


Route::get('admin/dashboard', [AuthenticationController::class, 'adminDashboard'])->name('admin-dashboard')->middleware('checkRole');






Route::group(['middleware' => 'isClient'], function() {
    Route::get('client/dashboard', [ClientController::class, 'clientDashboard'])->name('client-dashboard');
    
    Route::get('client/jobs', [ClientJobController::class, 'list'])->name('client.jobs');
    Route::get('client/jobs/create', [jobController::class, 'createJob'])->name('client.jobs.create');
    Route::post('client/jobs/store', [jobController::class, 'createJobData'])->name('client.create-job-data');
    Route::get('client/job/{id}/detail', [ClientJobController::class, 'detail'])->name('client.job.detail'); //        
    Route::get('client/jobs/{id}/edit', [ClientJobController::class, 'edit'])->name('client.jobs.edit');
    Route::post('client/job/{id}/edit', [ClientJobController::class, 'editData'])->name('client.jobs.edit');
    Route::post('client/job/{id}/delete', [ClientJobController::class, 'Delete'])->name('client.job.delete');
    
    
    Route::get('client/jobs/{job_id}/proposals', [ClientProposalController::class, 'proposals'])->name('client.jobs.proposal.list');
    Route::get('client/job/{jobId}/proposal/{proposalId}', [proposalController::class, 'clientProposal'])->name('client.job.proposal.view');

    Route::get('/client/change-message-status', [ClientMessageController::class, 'changeStatus']);


    Route::get('client/profile', [ProfileController::class, 'clientProfile'])->name('client.profile');
    Route::get('client/{id}/profile/edit', [ProfileController::class, 'editClientProfile'])->name('client.profile.edit');
    Route::post('client/profile/edit/{old_picture?}', [ProfileController::class, 'editClientProfileData'])->name('client.profile.editData');
});

// function () {
//     $unseenNotifications = Message::whereNull('status')->where('receiver_id', Auth::user()->id)->get();

//         dd($unseenNotifications); // Safe in render()
// }

Route::group(['middleware' => 'isProvider'], function() {
    Route::get('provider/dashboard', [ProviderController::class, 'providerController'])->name('provider-dashboard');
    // Route::get('provider/dashboard', function(){
    //     $unseenNotifications = Message::with('sender')
    //     ->whereNull('status')
    //     ->where('receiver_id', Auth::id())
    //     ->get();
    //     dd($unseenNotifications);
    // })->name('provider-dashboard');
    Route::get('provider/jobs', [JobController::class, 'jobs'])->name('provider.jobs');
    Route::get('provider/jobs/{id}', [JobController::class, 'providerJobDetail'])->name('provider.jobs.detail');
    
    Route::get('provider/jobs/{id}/proposal/create', [proposalController::class, 'create'])->name('provider.jobs.proposal.create');
    Route::post('provider/jobs/{id}/proposal/store', [proposalController::class, 'store'])->name('provider.jobs.proposal.store');
    Route::get('provider/job/{jobId}/proposal/{proposalId}',[proposalController::class, 'view'])->name('provider.job.proposal.view');
    // Route::get('provider/jobs/{jobId}/proposal/{proposalId}', [proposalController::class, 'view'])->name('provider.jobs.proposal.chat');
    Route::get('/provider/change-message-status', [messageController::class, 'changeStatus']);
    
    Route::get('provider/profile', [ProfileController::class, 'providerProfile'])->name('provider.profile');
    Route::get('provider/profile/edit/{id}', [ProfileController::class, 'editProviderProfile'])->name('provider.profile.edit');
    Route::post('provider/profile/edit/{old_picture?}', [ProfileController::class, 'editProviderProfileData'])->name('provider.profile.editData');
});



Route::group(['middleware' => 'isAdmin'], function(){
    Route::get('admin/jobs', [AdminJobController::class, 'jobs'])->name('admin.jobs');
    Route::get('admin/job/{id}/detail', [AdminJobController::class, 'jobDetail'])->name('admin.job.detail');
    Route::post('admin/job/{id}/delete', [AdminJobController::class, 'Delete'])->name('admin.job.delete');


    Route::get('admin/job/{job_id}/proposals', [AdminProposalController::class, 'proposals'])->name('admin.jobs.proposals.list');
    Route::get('admin/job/{job_id}/proposal/{proposal_id}', [AdminProposalController::class, 'proposal'])->name('admin.jobs.proposal.detail');


    Route::get('admin/profile', [ProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::get('admin/{id}/profile/edit', [ProfileController::class, 'editAdminProfile'])->name('admin.profile.edit');
    Route::post('admin/profile/edit/{old_picture?}', [ProfileController::class, 'editAdminProfileData'])->name('admin.profile.editData');
});     