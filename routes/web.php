<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\FarmerUserController;
use App\Http\Controllers\CropTypeController;
use App\Http\Controllers\PestController;
use App\Http\Controllers\PesticideController;
use App\Http\Controllers\FertilizerController;
use App\Http\Controllers\CropMonitoringController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\VarietyController_;

// 🔁 Redirect root to login
Route::get('/', fn () => redirect()->route('login'))->name('root');

// 🔓 Public Auth Routes
Route::get('/index', [AuthController::class, 'showindexForm'])->name('index');
Route::get('/index', [AuthController::class, 'showindexForm'])->name('login'); // ✅ Fix for "Route [login] not found"
Route::post('/index', [AuthController::class, 'index'])->name('index.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 🔐 Authenticated Routes (Custom 'admin' guard)
Route::middleware(['auth:admin'])->group(function () {

    // ✅ Admin Routes
    Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'role:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

         Route::resource('farmers', FarmerUserController::class);
        Route::resource('crops', CropTypeController::class)->only(['index', 'create', 'store']);
        Route::resource('pests', PestController::class)->except(['show']);
        Route::resource('pesticides', PesticideController::class);
        Route::resource('fertilizers', FertilizerController::class);

        Route::get('/cropmonitoring', [CropMonitoringController::class, 'index'])->name('cropmonitoring.index');
        Route::get('/cropmonitoring/plantingdetails/{id}', [CropMonitoringController::class, 'viewPlantingDetails'])->name('cropmonitoring.plantingdetails');
        Route::get('/cropmonitoring/create/{user}', [CropMonitoringController::class, 'create'])->name('cropmonitoring.create');
        Route::post('/cropmonitoring/store', [CropMonitoringController::class, 'store'])->name('cropmonitoring.store');
        Route::get('/cropmonitoring/{activity}/edit', [CropMonitoringController::class, 'edit'])->name('cropmonitoring.edit');
        Route::put('/cropmonitoring/{activity}', [CropMonitoringController::class, 'update'])->name('cropmonitoring.update');

        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/{id}', [ReportController::class, 'show'])->name('reports.show');
        Route::get('/reports/{id}/pdf', [ReportController::class, 'generatePdf'])->name('reports.pdf');

        Route::resource('varieties', VarietyController_::class);

        Route::resource('account', AccountController::class)->except(['archived', 'restore']);
        Route::get('/account/archived', [AccountController::class, 'archived'])->name('account.archived');
        Route::put('/account/restore/{id}', [AccountController::class, 'restore'])->name('account.restore');
   });

    // ✅ Superadmin Routes
    Route::prefix('superadmin')->name('superadmin.')->middleware(['auth:admin', 'role:superadmin'])->group(function () {
        Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');

        Route::resource('farmers', FarmerUserController::class);
        Route::resource('crops', CropTypeController::class)->only(['index', 'create', 'store']);
        Route::resource('pests', PestController::class)->except(['show']);
        Route::resource('pesticides', PesticideController::class);
        Route::resource('fertilizers', FertilizerController::class);

        Route::get('/cropmonitoring', [CropMonitoringController::class, 'index'])->name('cropmonitoring.index');
        Route::get('/cropmonitoring/plantingdetails/{id}', [CropMonitoringController::class, 'viewPlantingDetails'])->name('cropmonitoring.plantingdetails');
        Route::get('/cropmonitoring/create/{user}', [CropMonitoringController::class, 'create'])->name('cropmonitoring.create');
        Route::post('/cropmonitoring/store', [CropMonitoringController::class, 'store'])->name('cropmonitoring.store');
        Route::get('/cropmonitoring/{activity}/edit', [CropMonitoringController::class, 'edit'])->name('cropmonitoring.edit');
        Route::put('/cropmonitoring/{activity}', [CropMonitoringController::class, 'update'])->name('cropmonitoring.update');

        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/{id}', [ReportController::class, 'show'])->name('reports.show');
        Route::get('/reports/{id}/pdf', [ReportController::class, 'generatePdf'])->name('reports.pdf');

        Route::resource('varieties', VarietyController_::class);

        Route::resource('account', AccountController::class)->except(['archived', 'restore']);
        Route::get('/account/archived', [AccountController::class, 'archived'])->name('account.archived');
        Route::put('/account/restore/{id}', [AccountController::class, 'restore'])->name('account.restore');
    });

    // ✅ Redirect to dashboard by role
    Route::get('/dashboard', function () {
        $user = Auth::guard('admin')->user();
        if (!$user) {
            return redirect()->route('login');
        }
        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'superadmin' => redirect()->route('superadmin.dashboard'),
            default => abort(403),
        };
    })->middleware('auth:admin')->name('dashboard');
});
