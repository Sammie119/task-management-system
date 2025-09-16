<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\subTaskController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    Route::prefix('employee')->group(function () {
        Route::controller(StaffController::class)->group(function () {
            Route::get('/staff', 'index')->name('staff');
            Route::post('/staff', 'store')->name('staff');
            Route::put('/staff', 'update')->name('staff');
            Route::post('/destroy_staff', 'destroy')->name('destroy_staff');
        });


    });

    Route::prefix('employee')->group(function () {
        Route::controller(TaskController::class)->group(function () {
            Route::get('/task', 'index')->name('task');
            Route::post('/task', 'store')->name('task');
            Route::put('/task', 'update')->name('task');
            Route::post('/destroy_task', 'destroy')->name('destroy_task');
        });

    });

        Route::get('/employee/task', function () {
        $tasks = App\Models\Task::all();
        return view('task.index', compact('tasks'));
});
    Route::prefix('employee')->group(function () {
        Route::controller(subTaskController::class)->group(function () {
            Route::get('/sub_task', 'index')->name('sub_task');
            Route::post('/sub_task', 'store')->name('sub_task');
            Route::put('/sub_task', 'update')->name('sub_task');
            Route::post('/destroy_sub_task', 'destroy')->name('destroy_sub_task');
        });

    });

        Route::get('/employee/sub_task', function () {
        $sub_tasks = App\Models\subTask::all();
        return view('sub_task.index', compact('sub_tasks'));
});


    });
