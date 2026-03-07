<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use function Laravel\Prompts\select;

class ImportKandis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kandis:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import SR and Stapi Kandis';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = select(
            'Which type of kandis do you want to import?',
            [
                "sr" => 'SR Kandis',
                "stapi" => 'Stapi Kandis',
            ],
        );
        if ($type === "sr") {
            $offset = config('app.sr_vorlage_offset');
            $model = \App\Models\Srkandi::class;
        } else {
            $offset = config('app.stapi_vorlage_offset');
            $model = \App\Models\Stapikandi::class;
        }
        $response = file_get_contents(config('app.sr_results_url'));
        $kandis = json_decode($response, true)["kantone"][1]["vorlagen"][$offset]["resultat"]["kandidaten"];
        foreach ($kandis as $kandi) {
            $this->info("Importing " . $kandi["vorname"] . " " . $kandi["nachname"]);
            $model::updateOrCreate(
                ["identifier" => $kandi["kandidatNummer"]],
                [
                    "identifier" => $kandi["kandidatNummer"],
                    "first_name" => $kandi["vorname"],
                    "last_name" => $kandi["nachname"],
                    "party" => $kandi["partei"][0]["text"]
                ]
            );
        }
    }
}
