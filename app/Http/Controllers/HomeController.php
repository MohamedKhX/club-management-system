<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Player;
use App\Models\SportFederation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $federations = SportFederation::all();
        $clubs = Club::all();

        return view('home', compact('federations', 'clubs'));
    }

    public function showFederation(SportFederation $federation)
    {
        $clubs = Club::where('sport_federation_id', $federation->id)->get();
        return view('federation', compact('federation', 'clubs'));
    }

    public function showClub(Club $club)
    {
        $players = Player::whereHas('contracts', function ($query) use ($club) {
            $query->where('club_id', $club->id)
                ->where('end_date', '>=', now())
                ->where('start_date', '<=', now());
        })->get();

        return view('club-show', compact('club', 'players'));
    }
}
