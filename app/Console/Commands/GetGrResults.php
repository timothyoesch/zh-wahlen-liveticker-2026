<?php

namespace App\Console\Commands;

use App\Models\Botmessage;
use App\Models\Datafile;
use App\Models\District;
use App\Models\Grkandi;
use Illuminate\Console\Command;
use SebastianBergmann\Environment\Console;

class GetGrResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'results:get-gr';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the results for the Gemeinderat election';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $newDatafile = Datafile::where('type', 'gr')->where('processed', false)->orderBy('timestamp', 'desc')->first();
        if (!$newDatafile) {
            $this->info("No new datafile found");
            return;
        } else {
            $this->info("Processing datafile from " . $newDatafile->timestamp);
            $newDatafile->processed = true;
            $newDatafile->save();
        }
        // Make GET Request to config('app.gr_results_url') and save the response to a variable
        $response = file_get_contents($newDatafile->filepath);
        $electionResults = json_decode($response, true)["kantone"][1]["vorlagen"][7];

        $this->handleDistricts($electionResults["wahlkreise"], $electionResults["resultat"]["kandidaten"]);
    }

    protected function handleDistricts($districts, $candidateResults)
    {
        $doneDistricts = District::where("done", true)->pluck("number")->toArray();
        $newDistricts = [];

        foreach ($districts as $districtData) {
            $this->info("Handling district: " . $districtData["wahlkreisBezeichnung"]);
            $district = District::where("number", $districtData["wahlkreisNummer"])->where("done", $districtData["resultat"]["gebietAusgezaehlt"])->first();
            if(!$district && !in_array($districtData["wahlkreisNummer"], $doneDistricts)) {
                $this->info("Updating/Creating district: " . $districtData["wahlkreisBezeichnung"]);
                $district = District::updateOrCreate(
                    ["number" => $districtData["wahlkreisNummer"]],
                    [
                        "number" => $districtData["wahlkreisNummer"],
                        "name" => $districtData["wahlkreisBezeichnung"],
                        "done" => $districtData["resultat"]["gebietAusgezaehlt"]
                    ]
                );

                if ($districtData["resultat"]["gebietAusgezaehlt"]) {
                    $this->handlePartyResults($district, $districtData["resultat"]["listen"]);
                    $newDistricts[] = $districtData["wahlkreisNummer"];
                }
            }
        }

        $this->handleCandidateResults($candidateResults);

        foreach ($newDistricts as $districtNumber) {
            Botmessage::create([
                "title" => "Ergebnis Gemeinderatswahlen im Wahlkreis " . $districtNumber,
                "content" => htmlToMarkdownV2(view("templates.gr-results", ["district" => District::where("number", $districtNumber)->first()])->render()),
            ]);
        }
    }

    protected function handlePartyResults(District $district, $partyResults)
    {
        foreach ($partyResults as $partyResult) {
            $district->partyResults()->updateOrCreate(
                ['party' => $partyResult["listeCode"]],
                [
                    "party" => $partyResult["listeCode"],
                    "votes" => $partyResult["stimmen"],
                    "electors" => $partyResult["waehler"],
                    "percentage" => $partyResult["waehlerProzent"],
                    "change" => $partyResult["gewinnWaehlerProzent"]
                ]
            );
        }
    }

    protected function handleCandidateResults($candidateResults)
    {
        foreach ($candidateResults as $candidateResult) {
            $districtNumber = explode("_", $candidateResult["kandidatNummer"])[0];
            // Check if district is done
            $district = District::where("number", $districtNumber)->where("done", true)->first();
            if (!$district) continue;
            Grkandi::updateOrCreate(
                ["number" => $candidateResult["kandidatNummer"]],
                [
                    "number" => $candidateResult["kandidatNummer"],
                    "first_name" => $candidateResult["vorname"],
                    "last_name" => $candidateResult["nachname"],
                    "party" => $candidateResult["listeCode"],
                    "incumbent" => $candidateResult["bisher"],
                    "votes" => $candidateResult["stimmen"],
                    "ranking" => $candidateResult["rangInListeInWahlkreis"],
                    "district_id" => $district->id
                ]
            );
        }
    }

}
