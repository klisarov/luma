<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CalendarEventController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WorkoutPlanController;
use App\Notifications\TestPushNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', DashboardController::class)
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Tasks
    |--------------------------------------------------------------------------
    */

    Route::get('/work', [TaskController::class, 'workList'])
        ->name('tasks.work-list');

    Route::post('/tasks', [TaskController::class, 'store'])
        ->name('tasks.store');

    Route::patch('/tasks/{task}', [TaskController::class, 'update'])
        ->name('tasks.update');

    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggleComplete'])
        ->name('tasks.toggle');

    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
        ->name('tasks.destroy');


    /*
    |--------------------------------------------------------------------------
    | Categories
    |--------------------------------------------------------------------------
    */

    Route::post('/categories', [CategoryController::class, 'store'])
        ->name('categories.store');

    Route::get('/categories/{category}', [CategoryController::class, 'show'])
        ->name('categories.show');

    Route::patch('/categories/{category}', [CategoryController::class, 'update'])
        ->name('categories.update');

    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy');


    /*
    |--------------------------------------------------------------------------
    | Subcategories
    |--------------------------------------------------------------------------
    */

    Route::post('/subcategories', [SubcategoryController::class, 'store'])
        ->name('subcategories.store');


    /*
    |--------------------------------------------------------------------------
    | Calendars
    |--------------------------------------------------------------------------
    */

    Route::get('/calendars', [CalendarController::class, 'index'])
        ->name('calendars.index');

    Route::post('/calendars', [CalendarController::class, 'store'])
        ->name('calendars.store');

    Route::get('/calendars/{calendar}', [CalendarController::class, 'show'])
        ->name('calendars.show');

    Route::patch('/calendars/{calendar}', [CalendarController::class, 'update'])
        ->name('calendars.update');

    Route::delete('/calendars/{calendar}', [CalendarController::class, 'destroy'])
        ->name('calendars.destroy');


    /*
    |--------------------------------------------------------------------------
    | Calendar Events
    |--------------------------------------------------------------------------
    */

    Route::post('/calendar-events', [CalendarEventController::class, 'store'])
        ->name('calendar-events.store');

    Route::patch(
        '/calendar-events/{calendarEvent}',
        [CalendarEventController::class, 'update']
    )->name('calendar-events.update');

    Route::delete(
        '/calendar-events/{calendarEvent}',
        [CalendarEventController::class, 'destroy']
    )->name('calendar-events.destroy');


    /*
    |--------------------------------------------------------------------------
    | Workout Plans
    |--------------------------------------------------------------------------
    */

    Route::get('/workout-plans', [WorkoutPlanController::class, 'index'])
        ->name('workout-plans.index');

    Route::post('/workout-plans', [WorkoutPlanController::class, 'store'])
        ->name('workout-plans.store');

    Route::patch(
        '/workout-plans/{workoutPlan}',
        [WorkoutPlanController::class, 'update']
    )->name('workout-plans.update');

    Route::delete(
        '/workout-plans/{workoutPlan}',
        [WorkoutPlanController::class, 'destroy']
    )->name('workout-plans.destroy');


    /*
    |--------------------------------------------------------------------------
    | Web Push Subscription
    |--------------------------------------------------------------------------
    */

    Route::post('/push/subscribe', function (Request $request) {

        $validated = $request->validate([
            'endpoint' => [
                'required',
                'string',
            ],

            'keys' => [
                'required',
                'array',
            ],

            'keys.p256dh' => [
                'required',
                'string',
            ],

            'keys.auth' => [
                'required',
                'string',
            ],

            'content_encoding' => [
                'nullable',
                'string',
            ],
        ]);

        $request->user()->updatePushSubscription(
            $validated['endpoint'],
            $validated['keys']['p256dh'],
            $validated['keys']['auth'],
            $validated['content_encoding'] ?? 'aes128gcm'
        );

        return response()->json([
            'success' => true,
            'message' => 'Push subscription saved.',
        ]);

    })->name('push.subscribe');


    /*
    |--------------------------------------------------------------------------
    | Test Web Push Notification
    |--------------------------------------------------------------------------
    */

    Route::post('/push/test', function (Request $request) {

        $request->user()->notify(
            new TestPushNotification()
        );

        return response()->json([
            'success' => true,
            'message' => 'Test notification sent.',
        ]);

    })->name('push.test');


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';