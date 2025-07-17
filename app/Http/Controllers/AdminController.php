<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournaments; 
use App\Models\Players;
use App\Models\Blog;
use Carbon\Carbon; 
class AdminController extends Controller
{
    public function index() {
        $playerCount = Players::count();
        $tournamentCount = Tournaments::count();
        $articleCount = Blog::count();

        $today = Carbon::today();

        // Current tournament if any
        $currentTournament = Tournaments::whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->first();

        // Next 3 upcoming tournaments
        $upcomingTournaments = Tournaments::whereDate('start_date', '>=', $today)
            ->orderBy('start_date', 'asc')
            ->take(5)
            ->get();

        // 5 most recent articles
        $recentArticles = Blog::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $playersList = players::orderBy('created_at', 'desc')
            ->take(5)
            ->get();


        return view('admin.admin-dashboard', compact(
            'playerCount',
            'tournamentCount',
            'articleCount',
            'currentTournament',
            'upcomingTournaments',
            'recentArticles',
            'playersList'
        ));
    }


    public function tournaments(Request $request)
    {
        $today = now()->toDateString();
        $search = $request->input('search');

        $tournaments = Tournaments::with('courseDetail')
            ->select('*')
            ->selectRaw("
                CASE 
                    WHEN ? BETWEEN start_date AND end_date THEN 1
                    WHEN start_date > ? THEN 2
                    ELSE 3
                END as status_order
            ", [$today, $today])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('tournament_title', 'like', "%{$search}%")
                    ->orWhere('presenter', 'like', "%{$search}%");
                });
            })
            ->orderBy('status_order')
            ->orderBy('start_date', 'asc')
            ->paginate(10)
            ->appends(['search' => $search]); // maintain search on pagination links

        return view('admin.tournaments.index', compact('tournaments', 'search'));
    }

    public function players() {
        $players = players::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.players.index', compact('players'));
    }

    public function blog() {
        $blog = blog::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.blog.index', compact('blog'));
    }
}
