<?php

namespace App\Services;

class LeagueService extends BaseService
{
    public function getAllLeagues($startTimestamp = null)
    {
        $leagues = $this->getActualLeagues();

        if(! empty($startTimestamp)) {
            array_filter($leagues, function($k) use ($startTimestamp){
                return $k['start_timestamp'] > $startTimestamp;
            });
        }

        $ids = array_column($leagues, 'league_id');

        return $ids;
    }

    public function getLeagueName($leagueId)
    {
        $leagues = $this->getActualLeagues();

        array_filter($leagues, function($k) use ($leagueId){
            return $k['league_id'] = $leagueId;
        });

        $names = array_column($leagues, 'name');

        return $names[0];
    }

}
