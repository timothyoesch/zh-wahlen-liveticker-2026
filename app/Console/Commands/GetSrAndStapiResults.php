<?php

namespace App\Console\Commands;

use App\Models\Botmessage;
use App\Models\Datafile;
use App\Models\District;
use App\Models\Srkandi;
use App\Models\Srresult;
use App\Models\Stapikandi;
use App\Models\Stapiresult;
use App\Settings\DataSettings;
use Illuminate\Console\Command;

class GetSrAndStapiResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'results:get-sr-stapi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the results for the Stapi and SR elections';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $settings = app(DataSettings::class);
        $newDatafile = Datafile::where('type', 'sr')->where('processed', false)->orderBy('timestamp', 'desc')->first();
        if (!$newDatafile) {
            $this->info("No new datafile found");
            return;
        } else {
            $this->info("Processing datafile from " . $newDatafile->timestamp);
            $newDatafile->processed = true;
            $newDatafile->save();
        }
        $response = file_get_contents($newDatafile->filepath);
        $electionResults = json_decode($response, true)["kantone"][1]["vorlagen"];
        $srResults = $electionResults[$settings->sr_vorlage_offset];
        $stapiResults = $electionResults[$settings->stapi_vorlage_offset];

        $this->handleSrResults($srResults);
        $this->handleStapiResults($stapiResults);
    }

    protected function handleSrResults($srResults)
    {
        $doneDistricts = District::where("donesr", true)->pluck("number")->toArray();
        $newDistricts = [];

        foreach ($srResults["zaehlkreise"] as $districtData) {
            if (!$districtData["resultat"]["gebietAusgezaehlt"]) continue;
            // Extract first digit of geoLevelnummer to get the district number
            $districtNumber = (string)$districtData["geoLevelnummer"];
            $districtNumber = $districtNumber[0];
            $district = District::where("number", $districtNumber)->where("donesr", false)->first();
            if (!$district) continue;
            $district->update(["donesr" => true]);
            $newDistricts[] = $district->id;
            foreach ($districtData["resultat"]["kandidaten"] as $candidateData) {
                $candidate = Srkandi::where("identifier", $candidateData["kandidatNummer"])->first();
                if (!$candidate) continue;
                $result = Srresult::updateOrCreate(
                    [
                        "srkandi_id" => $candidate->id,
                        "district_id" => $district->id,
                    ],
                    [
                        "votes" => $candidateData["stimmen"]
                    ]
                );
            }
        }

        foreach ($newDistricts as $districtId) {
            $districtResults = Srresult::where("district_id", $districtId)->with("candidate")->orderBy("votes", "desc")->get();
            $districtCutoff = ceil($districtResults->sum("votes") / 9 * config('app.cutoff_percentage'));
            $allResults = Srresult::groupBy("srkandi_id")->selectRaw("sum(votes) as votes, srkandi_id")->orderBy("votes", "desc")->get();
            $allCutoff = ceil($allResults->sum("votes") / 9 * config('app.cutoff_percentage'));
            $absoluteMajority = ceil($allResults->sum("votes") / 18);
            Botmessage::create([
                "title" => "Ergebnis Stadtratswahlen im Wahlkreis " . District::find($districtId)->name,
                "content" => htmlToMarkdownV2(view("templates.sr-results", [
                    "districtResults" => $districtResults,
                    "district" => District::find($districtId),
                    "absoluteMajority" => $absoluteMajority,
                    "allResults" => $allResults,
                    "districtCutoff" => $districtCutoff,
                    "allCutoff" => $allCutoff,
                    ])->render()),
            ]);
        }
    }

    protected function handleStapiResults($stapiResults)
    {
        $doneDistricts = District::where("donestapi", true)->pluck("number")->toArray();
        $newDistricts = [];

        foreach ($stapiResults["zaehlkreise"] as $districtData) {
            if (!$districtData["resultat"]["gebietAusgezaehlt"]) continue;
            // Extract first digit of geoLevelnummer to get the district number
            $districtNumber = (string)$districtData["geoLevelnummer"];
            $districtNumber = $districtNumber[0];
            $district = District::where("number", $districtNumber)->where("donestapi", false)->first();
            if (!$district) continue;
            $district->update(["donestapi" => true]);
            $newDistricts[] = $district->id;
            foreach ($districtData["resultat"]["kandidaten"] as $candidateData) {
                $candidate = Stapikandi::where("identifier", $candidateData["kandidatNummer"])->first();
                if (!$candidate) continue;
                $result = Stapiresult::updateOrCreate(
                    [
                        "stapikandi_id" => $candidate->id,
                        "district_id" => $district->id,
                    ],
                    [
                        "votes" => $candidateData["stimmen"]
                    ]
                );
            }
        }

        foreach ($newDistricts as $districtId) {
            $districtResults = Stapiresult::where("district_id", $districtId)->with("candidate")->orderBy("votes", "desc")->get();
            $districtCutoff = ceil($districtResults->sum("votes") * config('app.cutoff_percentage'));
            $allResults = Stapiresult::groupBy("stapikandi_id")->selectRaw("sum(votes) as votes, stapikandi_id")->orderBy("votes", "desc")->get();
            $allCutoff = ceil($allResults->sum("votes") * config('app.cutoff_percentage'));
            $absoluteMajority = ceil($allResults->sum("votes") / 2);
            Botmessage::create([
                "title" => "Ergebnis Stadtratswahlen im Wahlkreis " . District::find($districtId)->name,
                "content" => htmlToMarkdownV2(view("templates.stapi-results", [
                    "districtResults" => $districtResults,
                    "district" => District::find($districtId),
                    "absoluteMajority" => $absoluteMajority,
                    "allResults" => $allResults,
                    "districtCutoff" => $districtCutoff,
                    "allCutoff" => $allCutoff,
                    ])->render()),
            ]);
        }
    }
}
