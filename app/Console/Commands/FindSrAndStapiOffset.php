<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FindSrAndStapiOffset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:find-offset';

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
        // Get the file from the config()
        $response = file_get_contents(config('app.sr_results_url'));
        $electionResults = json_decode($response, true)["kantone"][1]["vorlagen"];

        // Iterate through $electionResults till offset is found for electionResult["vorlagenTitel"][0]["text"] == "Erneuerungswahl Stadtrat 2026–2030" and electionResult["vorlagenTitel"][0]["text"] == "Erneuerungswahl Stadtpräsidium 2026–2030"
        foreach ($electionResults as $index => $electionResult) {
            if ($electionResult["vorlagenTitel"][0]["text"] == "Erneuerungswahl Stadtrat 2026–2030") {
                $this->info("Offset for Erneuerungswahl Stadtrat 2026–2030: " . $index);
            }
            if ($electionResult["vorlagenTitel"][0]["text"] == "Erneuerungswahl Stadtpräsidium 2026–2030") {
                $this->info("Offset for Erneuerungswahl Stadtpräsidium 2026–2030: " . $index);
            }
        }
    }
}
