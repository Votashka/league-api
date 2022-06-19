<?php

namespace App\Http\Controllers;

use App\Services\LeagueService;
use Illuminate\Http\Request;

class LeagueController extends Controller
{

    private LeagueService $leagueService;

    public function __construct(LeagueService $leagueService)
    {
        $this->leagueService = $leagueService;
    }

    public function index(Request $request)
    {
        $startTimestamp = $request->get('start_timestamp');

        $leagues = $this->leagueService->getAllLeagues(
            startTimestamp: $startTimestamp
        );

        return response()->json(['league_ids' => $leagues]);
    }

    public function getLeagueName(Request $request, $leagueId)
    {
        $leagueName = $this->leagueService->getLeagueName(
            leagueId: $leagueId
        );

        return response()->json(['league_name' => $leagueName]);
    }

}
