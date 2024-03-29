<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\BoardLayoutController;
use App\Http\Controllers\MainDashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\WelcomeController;

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

Route::middleware('auth', 'verified', 'can:superadmin')->group(function ()
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

Route::middleware('auth', 'verified')->group(function ()
{
    Route::get('/dashboard',
        [MainDashboardController::class, 'viewMainDashboard'])
        ->name('dashboard');

    Route::get('/project/new', [ProjectController::class, 'viewEdit'])
        ->name('project.new');
    Route::get('/{projectname}/edit', [ProjectController::class, 'viewEdit'])
        ->name('project.edit');
    Route::post('/project', [ProjectController::class, 'postEdit'])
        ->name('project.post_edit');

    Route::get('/{projectname}/board/new', [BoardController::class, 'viewBoard'])
        ->name('board.new');
    Route::post('/board', [BoardController::class, 'postEdit'])
        ->name('board.post_edit');
    
    Route::post('/boardlayout', [BoardLayoutController::class, 'postEdit'])
        ->name('boardlayout.post_edit');
});

require __DIR__ . '/auth.php';

Route::get('/', [WelcomeController::class, 'viewWelcome'])
    ->name('welcome');
Route::get('/{projectname}', [ProjectController::class, 'viewProject'])
    ->name('project.project_view');
Route::get('/{projectname}/{boardname}', [BoardController::class, 'viewBoard'])
    ->name('board.view');
