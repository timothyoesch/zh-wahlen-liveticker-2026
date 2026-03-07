<?php

namespace App\Console\Commands;

use App\Models\Datafile;
use DateTime;
use Illuminate\Console\Command;

class CheckForUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'results:updates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if the source file was updated and if yes, download it and add it to the database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the JSON from config(app.gr_results_url) and config(app.sr_results_url)
        $grResponse = file_get_contents(config('app.gr_results_url'));
        $srResponse = file_get_contents(config('app.sr_results_url'));
        // Decode the JSON
        $grData = json_decode($grResponse, true);
        $srData = json_decode($srResponse, true);

        $latestGrFile = Datafile::where('type', 'gr')->orderBy('timestamp', 'desc')->first();
        $latestSrFile = Datafile::where('type', 'sr')->orderBy('timestamp', 'desc')->first();

        if (!$latestGrFile || new DateTime($latestGrFile->timestamp) < new DateTime($grData['timestamp'])) {
            // Download the file and save it to storage/app/gr_results-TIMESTAMP.json
            $grFilePath = storage_path('app/gr_results_' . $grData['timestamp'] . '.json');
            file_put_contents($grFilePath, $grResponse);
            // Add it to the database
            Datafile::create([
                'timestamp' => $grData['timestamp'],
                'filepath' => $grFilePath,
                'type' => 'gr',
            ]);
        } else {
            $this->info("No GR File update found");
        }

        if (!$latestSrFile || new DateTime($latestSrFile->timestamp) < new DateTime($srData['timestamp'])) {
            // Download the file and save it to storage/app/sr_results-TIMESTAMP.json
            $srFilePath = storage_path('app/sr_results_' . $srData['timestamp'] . '.json');
            file_put_contents($srFilePath, $srResponse);
            // Add it to the database
            Datafile::create([
                'timestamp' => $srData['timestamp'],
                'filepath' => $srFilePath,
                'type' => 'sr',
            ]);
        } else {
            $this->info("No SR File update found");
        }
    }
}
