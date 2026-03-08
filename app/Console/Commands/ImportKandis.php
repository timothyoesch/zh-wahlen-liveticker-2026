<?php

namespace App\Console\Commands;

use App\Models\District;
use App\Models\Grkandi;
use App\Models\Srkandi;
use App\Models\Srresult;
use App\Models\Stapikandi;
use App\Models\Stapiresult;
use App\Settings\DataSettings;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
        $settings = app(DataSettings::class);
        $this->info("Importing Kandis...");
        $this->info("Truncating tables...");
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Grkandi::truncate();
        Srresult::truncate();
        Srkandi::truncate();
        Stapiresult::truncate();
        Stapikandi::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // Import Srkandis
        $srresponse = file_get_contents(config('app.sr_results_url'));


        $srkandis = json_decode($srresponse, true)["kantone"][1]["vorlagen"][$settings->sr_vorlage_offset]["resultat"]["kandidaten"];
        $stapikandis = json_decode($srresponse, true)["kantone"][1]["vorlagen"][$settings->stapi_vorlage_offset]["resultat"]["kandidaten"];
        foreach ($srkandis as $kandi) {
            $this->info("Importing " . $kandi["vorname"] . " " . $kandi["nachname"]);
            Srkandi::updateOrCreate(
                ["identifier" => $kandi["kandidatNummer"]],
                [
                    "identifier" => $kandi["kandidatNummer"],
                    "first_name" => $kandi["vorname"],
                    "last_name" => $kandi["nachname"],
                    "party" => $kandi["partei"][0]["text"]
                ]
            );
        }

        foreach ($stapikandis as $kandi) {
            $this->info("Importing " . $kandi["vorname"] . " " . $kandi["nachname"]);
            Stapikandi::updateOrCreate(
                ["identifier" => $kandi["kandidatNummer"]],
                [
                    "identifier" => $kandi["kandidatNummer"],
                    "first_name" => $kandi["vorname"],
                    "last_name" => $kandi["nachname"],
                    "party" => $kandi["partei"][0]["text"]
                ]
            );
        }

        $grresponse = file_get_contents(config('app.gr_results_url'));
        $grkandis = json_decode($grresponse, true)["kantone"][1]["vorlagen"][$settings->gr_vorlage_offset]["resultat"]["kandidaten"];
        foreach ($grkandis as $kandi) {
            $this->info("Importing " . $kandi["vorname"] . " " . $kandi["nachname"]);
            $distrctId = District::where("number", explode("_", $kandi["kandidatNummer"])[0])->first()->id;
            Grkandi::updateOrCreate(
                ["identifier" => $kandi["kandidatNummer"]],
                [
                    "number" => explode(".", $kandi["kandidatNummer"])[1],
                    "identifier" => $kandi["kandidatNummer"],
                    "first_name" => $kandi["vorname"],
                    "last_name" => $kandi["nachname"],
                    "party" => $kandi["listeCode"],
                    "incumbent" => $kandi["bisher"],
                    "district_id" => $distrctId
                ]
            );
        }
    }
}
