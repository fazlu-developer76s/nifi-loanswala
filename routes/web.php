<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ZipController;
use App\Http\Controllers\AssignrouteController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\ProvidersController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Home;
use App\Http\Controllers\SignupController;





Route::get('/signup', [SignupController::class, 'signup'])->name('signup');

Route::match(['get','post'],'/user-login', [SignupController::class, 'user_login'])->name('user.login');
Route::post('/student-signup', [SignupController::class, 'student_signup'])->name('student.signup');
Route::post('/tutors-signup', [SignupController::class, 'tutors_signup'])->name('tutors.signup');

Route::get('/', function () {
    return view('home.home');
})->name('front.home');
Route::get('/login', function () {
    return view('auth.login');
});


Route::post('/submitted_request', [Home::class, 'lead_create'])->name('front.lead');

Auth::routes();
Route::get('/profile-update',[MemberController::class, 'profile_update'])->name('profile.update')->middleware('auth');
Route::post('/member/update', [MemberController::class, 'update'])->name('member.update')->middleware('auth');
Route::post('/send_otp', [CompanyController::class, 'send_otp'])->name('send_otp');
// Grouping all routes with auth middleware
Route::middleware(['auth','checkRole'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    // Role Routes
    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
    Route::post('/store-roles', [RoleController::class, 'store_roles'])->name('store.roles');
    Route::get('/edit-roles/{id}', [RoleController::class, 'edit_roles'])->name('edit.roles');
    Route::delete('/destroy-roles/{id}', [RoleController::class, 'destroy_roles'])->name('destroy.roles');


    // Member Routes
    Route::get('/member', [MemberController::class, 'index'])->name('member');
    Route::match(['get', 'post'], '/member/create', [MemberController::class, 'create'])->name('member.create');
    Route::get('/member/edit/{id}', [MemberController::class, 'edit'])->name('member.edit');

    Route::delete('/member/delete/{id}', [MemberController::class, 'destroy'])->name('member.destroy');


    Route::post('/export-users', [MemberController::class, 'exportUsers'])->name('export-users');

    // Permission Route
    Route::get('/permission/{id}', [RoleController::class, 'permission'])->name('permission');
    Route::post('/permission/update', [RoleController::class, 'update_permission'])->name('permission.update');

    // Status Active Inactive Route
    Route::post('/change-status', [RoleController::class, 'change_status'])->name('change.status');
    Route::post('/user-verified', [RoleController::class, 'user_verified'])->name('user.verified');

    // Lead Routes
    Route::get('/lead', [LeadController::class, 'index'])->name('lead');
    Route::get('/lead-admin', [LeadController::class, 'admin_lead'])->name('lead.admin');
    Route::match(['get', 'post'], '/lead/create', [LeadController::class, 'create'])->name('lead.create');
    Route::get('/lead/edit/{id}', [LeadController::class, 'edit'])->name('lead.edit');
    Route::get('/lead/view/{id}', [LeadController::class, 'view'])->name('lead.view');
    Route::post('/lead/update', [LeadController::class, 'update'])->name('lead.update');
    Route::delete('/lead/delete/{id}', [LeadController::class, 'destroy'])->name('lead.destroy');
    Route::post('/viewright-modal', [LeadController::class, 'viewright_modal'])->name('viewright.modal');
    Route::get('/lead-qualified', [LeadController::class, 'qualified_leads'])->name('lead.qualified');
    Route::get('/lead-rejected', [LeadController::class, 'rejected'])->name('lead.rejected');
    Route::get('/kyclead/view/{id}', [LeadController::class, 'kyclead_view'])->name('kyclead.view');
    Route::post('/kyc-process', [LeadController::class, 'kyc_process'])->name('kyc.process');
    Route::post('/assign-lead', [LeadController::class, 'assign_lead'])->name('assign.lead');
    Route::post('/export-lead', [LeadController::class, 'exportLead'])->name('export-lead');
    Route::post('/export-enc', [LeadController::class, 'exportEnc'])->name('export-enc');

    // Route
    Route::get('/route', [RouteController::class, 'index'])->name('route');
    Route::match(['get', 'post'], '/route/create', [RouteController::class, 'create'])->name('route.create');
    Route::get('/route/{id}', [RouteController::class, 'edit'])->name('route.edit');
    Route::post('/route/update', [RouteController::class, 'update'])->name('route.update');
    Route::delete('/route/delete/{id}', [RouteController::class, 'destroy'])->name('route.destroy');

    // Providers
    Route::get('/providers', [ProvidersController::class, 'index'])->name('providers');
    Route::match(['get', 'post'], '/providers/create', [ProvidersController::class, 'create'])->name('providers.create');
    Route::get('/providers/{id}', [ProvidersController::class, 'edit'])->name('providers.edit');
    Route::post('/providers/update', [ProvidersController::class, 'update'])->name('providers.update');
    Route::delete('/providers/delete/{id}', [ProvidersController::class, 'destroy'])->name('providers.destroy');

    //  Zipcodes
    Route::get('/routezip', [ZipController::class, 'index'])->name('routezip');
    Route::match(['get', 'post'], '/routezip/create', [ZipController::class, 'create'])->name('routezip.create');
    Route::get('/routezip/{id}', [ZipController::class, 'edit'])->name('routezip.edit');
    Route::post('/routezip/update', [ZipController::class, 'update'])->name('routezip.update');
    Route::delete('/routezip/delete/{id}', [ZipController::class, 'destroy'])->name('routezip.destroy');

    // Assign Route
    Route::get('/routeassign', [AssignrouteController::class, 'index'])->name('routeassign');
    Route::match(['get', 'post'], '/routeassign/create', [AssignrouteController::class, 'create'])->name('routeassign.create');
    Route::get('/routeassign/{id}', [AssignrouteController::class, 'edit'])->name('routeassign.edit');
    Route::post('/routeassign/update', [AssignrouteController::class, 'update'])->name('routeassign.update');
    Route::delete('/routeassign/delete/{id}', [AssignrouteController::class, 'destroy'])->name('routeassign.destroy');
    Route::get('/routeassign-view/{id}', [AssignrouteController::class, 'view'])->name('routeassign.view');

    // Notes Route
    Route::post('/note/save-notes', [NotesController::class, 'create'])->name('notes.create');
    Route::post('/note/fetch-notes', [NotesController::class, 'fetch_notes'])->name('notes.fetch');
    Route::post('/note/notes-delete', [NotesController::class, 'delete_notes'])->name('notes.delete');
    Route::post('/note/notes-disscuss', [NotesController::class, 'notes_disscuss'])->name('notes.disscuss');

    Route::get('company/{id}/edit', [CompanyController::class, 'edit'])->name('company.edit');
    Route::post('company/{id}', [CompanyController::class, 'update'])->name('company.update');
    Route::get('enquiry', [CompanyController::class, 'enquiry'])->name('enquiry');


});
