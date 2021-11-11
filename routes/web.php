<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ApprovalController;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/presence');
Route::get('/presence', function () {return view('presence');})->name('presence-page');
Route::get('/register', function () {return view('register');})->name('register-page');
Route::get('/approval/sick', function () {return view('sick');})->name('sick-page');
Route::get('/approval/paid', function () {return view('paid');})->name('paid-page');
Route::post('/approval', [ApprovalController::class, 'approvalStore'])->name('approval.store');
Route::post('/presence',[PresenceController::class, 'presence'])->name('presence');
Route::get('/login', function () {return view('login');})->name('login-page');
Route::post('/login',[AuthController::class, 'login'])->name('login');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');
Route::post('/user', [UserController::class, 'store'])->name('user.store');

// Route::get('/inventory',[InventoryController::class, 'index'])->name('inventory.index');
// Route::get('/resumes',[ResumeController::class, 'index'])->name('resume');

Route::middleware(['auth.user'])->prefix('admin')->group(function () {
    Route::get('/user',[UserController::class, 'index'])->name('user.index');
    Route::get('/employee',[EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/employee/{id}',[EmployeeController::class, 'detail'])->name('employee.detail');
    Route::get('/presence',[PresenceController::class, 'index'])->name('presence.index');
    Route::get('/approval',[ApprovalController::class, 'index'])->name('approval.index');
    Route::get('/approval/{id}',[ApprovalController::class, 'detail'])->name('approval.detail');
    Route::get('/approval/{id}/action',[ApprovalController::class, 'approvalAction'])->name('approval.action');

    // Route::get('/inventory/create', function() {$categories = Category::get();  return view('pages.inventory-create', compact('categories'));})->name('inventory.create');
    // Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
    // Route::get('/inventory/{id}',[InventoryController::class, 'edit'])->name('inventory.edit');
    // Route::put('/inventory/{id}',[InventoryController::class, 'update'])->name('inventory.update');
});
// Route::middleware(['auth.user', 'auth.admin'])->group(function () {
//     Route::delete('/user/{id}',[UserController::class, 'destroy'])->name('user.destroy');
//     Route::delete('/inventory/{id}',[InventoryController::class, 'destroy'])->name('inventory.destroy');
// });
