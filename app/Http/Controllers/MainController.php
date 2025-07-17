<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournaments; 
use App\Models\Players;
use App\Models\Blog;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class MainController extends Controller
{
    public function welcome() {
        $today = Carbon::today();

        $tournaments = Tournaments::select('*')
            ->selectRaw("
                CASE 
                    WHEN ? BETWEEN start_date AND end_date THEN 1  -- Current
                    WHEN start_date > ? THEN 2                    -- Upcoming
                    ELSE 3                                        -- Past
                END as status_order
            ", [$today, $today])
            ->orderBy('status_order')
            ->orderBy('start_date', 'asc')
            ->take(3)
            ->get();

        $playersHome = Players::orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // 5 most recent articles
        $recentArticles = Blog::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('welcome', compact(
            'tournaments',
            'recentArticles',
            'playersHome',
        ));
    }

    public function blog() {
        $blog = blog::orderBy('created_at', 'desc')->paginate(9);
        $recentArticles = Blog::orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('blog.index', compact('blog', 'recentArticles'));
    }

    public function blog_show($slug) {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        // 5 most recent articles
        $recentArticles = Blog::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('blog.show', compact('blog', 'recentArticles'));
    }

    
    public function players() {
        $players = players::orderBy('created_at', 'desc')->paginate(6);


        return view('players', compact('players'));
    }

    public function tournaments() {
        $today = Carbon::today();

        $tournaments = Tournaments::select('*')
            ->selectRaw("
                CASE 
                    WHEN ? BETWEEN start_date AND end_date THEN 1  -- Current
                    WHEN start_date > ? THEN 2                    -- Upcoming
                    ELSE 3                                        -- Past
                END as status_order
            ", [$today, $today])
            ->orderBy('status_order')
            ->orderBy('start_date', 'asc')
            ->paginate(9);

        $currentTournament = Tournaments::whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->first();

        return view('tournaments', compact('tournaments', 'currentTournament'));
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Mail::to('aamilahdawood65@gmail.com')->send(new ContactFormMail($validated));

        return back()->with('success', 'Your message has been sent successfully.');
    }

}
