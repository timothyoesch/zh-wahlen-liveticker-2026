<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResultsSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'results:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Updating results...");
        $this->call("results:update");
        $this->info("Find offsets");
        $this->call("app:find-offsets");
        $this->info("Getting SR and Stapi results...");
        $this->call('results:get-sr-stapi');
        $this->info("Getting GR results...");
        $this->call('results:get-gr');
    }
}
