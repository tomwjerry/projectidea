<?php
use App\Http\Controllers\BoardController;
use App\Http\Controllers\BoardLayoutController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MainDashboardController;
use App\Http\Controllers\AdminController;

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

Route::middleware('auth', 'can:superadmin')->group(function ()
{
    Route::get('/admin', function () {
        return view('admin.admin_panel');
        })
        ->name('admin.panel');
    Route::get('/admin/globalpermission',
        [AdminController::class, 'viewEditGlobalPermissions'])
        ->name('admin.view_glob_perm');
    Route::get('/admin/role', [AdminController::class, 'viewEditRolePermissions'])
        ->name('admin.view_role');
    Route::post('/admin/globalpermission',
        [AdminController::class, 'postEditGlobalPermissions'])
        ->name('admin.post_glob_perm');
    Route::post('/admin/role', [AdminController::class, 'postEditRolePermissions'])
        ->name('admin.post_role');
});

Route::middleware('auth')->group(function ()
{
    Route::get('/dashboard',
        [MainDashboardController::class, 'viewMainDashboard'])
        ->name('dashboard');

    Route::get('/project/new', [ProjectController::class, 'viewEdit'])
        ->name('project.new');
    Route::get('/{projectname}/edit', [ProjectController::class, 'viewEdit'])
        ->name('project.edit');
    Route::get('/{projectname}', [ProjectController::class, 'viewProject'])
        ->name('project.project_view');
    Route::post('/project', [ProjectController::class, 'postEdit'])
        ->name('project.post_edit');

    Route::get('/{projectname}/board/new', [BoardController::class, 'viewEdit'])
        ->name('board.new');
    Route::get('/{projectname}/{boardname}/edit', [BoardController::class, 'viewEdit'])
        ->name('board.edit');
    Route::get('/{projectname}/{boardname}/layout', [
            BoardLayoutController::class, 'viewEdit'
        ])
        ->name('boardlayout.view');
});

require __DIR__.'/auth.php';
