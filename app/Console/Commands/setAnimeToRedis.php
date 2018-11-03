<?php

namespace App\Console\Commands;

use App\Model\Anime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class setAnimeToRedis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setAnimeToRedis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set Anime To Redis';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Start: Set Anime To Redis');
        try {
            $animes = Anime::orderBy('updated_at', 'desc')->get();
            foreach ($animes as $anime) {
                Redis::hSet('anime', $anime->id, $anime->name);
            }
        } catch (\Exception $e) {
                $this->error('Error Set Anime To Redis. Message : ' . $e->getMessage());
            }
        $this->info('Finish: Set Anime To Redis');
    }
}
