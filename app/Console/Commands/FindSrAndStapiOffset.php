<?php

namespace App\Console\Commands;

use App\Settings\DataSettings;
use Illuminate\Console\Command;

class FindSrAndStapiOffset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:find-offsets';

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
        $settings = app(DataSettings::class);
        // Get the file from the config()
        $response = file_get_contents(config('app.sr_results_url'));
        $SrelectionResults = json_decode($response, true)["kantone"][1]["vorlagen"];
        $GrelectionResults = json_decode(file_get_contents(config('app.gr_results_url')), true)["kantone"][1]["vorlagen"];

        // Iterate through $electionResults till offset is found for electionResult["vorlagenTitel"][0]["text"] == "Erneuerungswahl Stadtrat 2026–2030" and electionResult["vorlagenTitel"][0]["text"] == "Erneuerungswahl Stadtpräsidium 2026–2030"
        foreach ($SrelectionResults as $index => $electionResult) {
            if ($electionResult["vorlagenTitel"][0]["text"] == "Erneuerungswahl Stadtrat 2026–2030" && $electionResult["geoLevelnummer"] == 261) {
                $this->info("Offset for Erneuerungswahl Stadtrat 2026–2030: " . $index);
                $settings->sr_vorlage_offset = (string)$index;
            }
            if ($electionResult["vorlagenTitel"][0]["text"] == "Erneuerungswahl Stadtpräsidium 2026–2030") {
                $this->info("Offset for Erneuerungswahl Stadtpräsidium 2026–2030: " . $index);
                $settings->stapi_vorlage_offset = (string)$index;
            }
        }

        foreach ($GrelectionResults as $index => $electionResult) {
            if ($electionResult["vorlagenTitel"][0]["text"] == "Erneuerungswahl Gemeinderat 2026-2030" && $electionResult["geoLevelnummer"] == 261) {
                $this->info("Offset for Erneuerungswahl Gemeinderat 2026–2030: " . $index);
                $settings->gr_vorlage_offset = (string)$index;
            }
        }
        $settings->save();
    }
}
