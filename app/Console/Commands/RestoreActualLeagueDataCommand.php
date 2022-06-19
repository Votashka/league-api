<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BaseService;
use Illuminate\Support\Facades\Redis;

class RestoreActualLeagueDataCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:actualize_league_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private BaseService $baseService;

    public function __construct(BaseService $baseService)
    {
        $this->baseService = $baseService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     *
     */
    public function handle()
    {
        $redis = Redis::connection();

        $data = $this->baseService->getLeaguesData();

        $redis->set('league_actual', json_encode($data));
    }
}
