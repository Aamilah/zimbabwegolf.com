<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\PlayerAdminController;
use App\Http\Controllers\PlayerTournamentController;
use App\Http\Controllers\OfficialAdminController;
use App\Http\Controllers\CourseDetailController;
use App\Http\Controllers\CourseHoleController;
use App\Http\Controllers\TeeAssignmentController;
use App\Http\Controllers\ScoreboardRequestController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\MyTournamentController;


Route::get('/', [MainController::class, 'welcome'])->name('home');
Route::get('/about', function () { return view('about');})->name('about');

Route::get('/contact', function () { 
    return view('contact');
})->name('contact');
Route::post('/contact', [MainController::class, 'send'])->name('contact.send');

Route::get('/tournaments', [MainController::class, 'tournaments'])->name('tournaments');
Route::get('/players', [MainController::class, 'players'])->name('players');

Route::prefix('blog')->group(function () {
    Route::get('/', [MainController::class, 'blog'])->name('blog');
    Route::get('/{slug}', [MainController::class, 'blog_show'])->name('blog.show');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', function() {
        $user = Auth::user();

        if ($user->department === 'staff') {
            return redirect()->route('admin.admin-dashboard');
        } elseif ($user->department === 'player') {
            return redirect()->route('admin.player-dashboard');
        } elseif ($user->department === 'tournament_official') {
            return redirect()->route('admin.tournament-official-dashboard');
        } else {
            abort(403, 'Unauthorized.');
        }
    });

    // Staff dashboard at /admin/admin-admin-dashboard
    Route::get('/admin-dashboard', [AdminController::class, 'index'])
        ->middleware('department:staff')
        ->name('admin-dashboard');

    // Player dashboard at /admin/player-dashboard
    Route::get('/player-dashboard', [PlayerAdminController::class, 'index'])
        ->middleware('department:player')
        ->name('player-dashboard');

    // Player dashboard at /admin/tournament-official-dashboard
    Route::get('/tournament-official-dashboard', [OfficialAdminController::class, 'index'])
        ->middleware('department:tournament_official')
        ->name('tournament-official-dashboard');

    Route::prefix('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

});

require __DIR__.'/auth.php';

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::middleware('department:staff,tournament_official,player')->group(function () {
        Route::prefix('course-details')->group(function () {
            Route::get('/{courseDetail}', [CourseDetailController::class, 'show'])->name('course-details.show');
        });
        Route::get('tee-assignments/{tournament}', [TeeAssignmentController::class, 'show'])->name('tee-assignments.show');

        Route::prefix('scoreboard-requests')->name('scoreboard-requests.')->group(function () {
            Route::get('/create/{tournament}/{player?}', [ScoreboardRequestController::class, 'create'])->name('create');
            Route::post('/', [ScoreboardRequestController::class, 'store'])->name('store');
        });
        Route::get('/leaderboard/{tournamentId}', [LeaderboardController::class, 'show'])->name('leaderboard.show');
         Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');
    });

    // Tournaments CRUD restricted to staff
    Route::middleware('department:staff')->group(function () {
        Route::prefix('tournaments')->name('tournaments.')->group(function () {
            Route::get('/create', [TournamentController::class, 'create'])->name('create');
            Route::post('/', [TournamentController::class, 'store'])->name('store');
            Route::get('/{tournament}/edit', [TournamentController::class, 'edit'])->name('edit');
            Route::put('/{tournament}', [TournamentController::class, 'update'])->name('update');
            Route::delete('/{tournament}', [TournamentController::class, 'destroy'])->name('destroy');
        });
        // Players
        Route::get('players', [AdminController::class, 'players'])->name('players.index');
        Route::resource('players', PlayerController::class)->except(['index']);

        //Blog
        Route::get('blog', [AdminController::class, 'blog'])->name('blog.index');
        Route::resource('blog', BlogController::class)->except(['index']);
    });

    Route::middleware('department:staff,tournament_official')->group(function () {
        // Tournaments accessible to staff and tournament_official (index, show, players)
        Route::prefix('tournaments')->name('tournaments.')->group(function () {
            Route::get('/', [AdminController::class, 'tournaments'])->name('index');
            Route::get('/{tournament}', [TournamentController::class, 'show'])->name('show');
            Route::get('/{tournament}/players', [TournamentController::class, 'showPlayers'])->name('players');
        });

        Route::prefix('course-details')->name('course-details.')->group(function () {
            Route::get('/', [CourseDetailController::class, 'index'])->name('index');
            Route::get('/create', [CourseDetailController::class, 'create'])->name('create');
            Route::post('/', [CourseDetailController::class, 'store'])->name('store');
            Route::get('/{courseDetail}/edit', [CourseDetailController::class, 'edit'])->name('edit');
            Route::put('/{courseDetail}', [CourseDetailController::class, 'update'])->name('update');
            Route::delete('/{courseDetail}', [CourseDetailController::class, 'destroy'])->name('destroy');
        });

        Route::get('course-details/{courseDetail}/holes/create', [CourseHoleController::class, 'create'])->name('course-holes.create');
        Route::post('course-details/{courseDetail}/holes', [CourseHoleController::class, 'store'])->name('course-holes.store');
        Route::get('course-details/{courseDetail}/holes/edit', [CourseHoleController::class, 'edit'])->name('course-holes.edit');
        Route::put('course-details/{courseDetail}/holes', [CourseHoleController::class, 'update'])->name('course-holes.update');
        Route::delete('course-details/{courseDetail}/holes', [CourseHoleController::class, 'destroy'])->name('course-holes.destroy');
        
        Route::prefix('tee-assignments')->name('tee-assignments.')->group(function () {
            Route::get('/', [TeeAssignmentController::class, 'index'])->name('index');
            Route::get('/{tournament}/create', [TeeAssignmentController::class, 'create'])->name('create');
            Route::post('/{tournament}', [TeeAssignmentController::class, 'store'])->name('store');
            Route::get('/{tournament}/edit', [TeeAssignmentController::class, 'edit'])->name('edit');
            Route::put('/{tournament}', [TeeAssignmentController::class, 'update'])->name('update');

        });
        
        Route::prefix('scoreboard-requests')->name('scoreboard-requests.')->group(function () {
            Route::get('/', [ScoreboardRequestController::class, 'index'])->name('index');
            Route::get('/{tournament}', [ScoreboardRequestController::class, 'show'])->name('show');
            Route::post('/{tournamentId}/{playerId}/{round}/approve', [ScoreboardRequestController::class, 'approve'])->name('approve');
        });

    });

    Route::middleware('department:player')->group(function () {

        Route::prefix('player-tournaments')->name('player-tournaments.')->group(function () {
            Route::get('/', [PlayerTournamentController::class, 'index'])->name('index');
            Route::get('/{tournament}/create', [PlayerTournamentController::class, 'create'])->name('create');
            Route::post('/{tournament}', [PlayerTournamentController::class, 'store'])->name('store');
        });
         Route::prefix('my-tournaments')->name('my-tournaments.')->group(function () {
            Route::get('/', [MyTournamentController::class, 'index'])->name('index');
        });

    });
});
