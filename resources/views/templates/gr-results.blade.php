<p>
    Der Wahlkreis {{ $district->name }} hat Ergebnisse zu den Gemeinderatswahlen publiziert.
</p>
<h1>Parteiergebnisse</h1>
<ol>
    @foreach($district->partyResults->sortByDesc("percentage") as $partyResult)
        <li>{{ $partyResult->party }}: {{ number_format($partyResult->percentage, 2) }}% ({{ number_format(sprintf("%+f", $partyResult->percentage), 2) }}%)</li>
    @endforeach
</ol>

<h1>SP-Kandidat:innen</h1>
<ol>
    @foreach($district->candidateResults()->where("party", "SP")->orderByDesc("ranking")->orderBy("number")->get() as $candidateResult)
        <li>
            {{ $candidateResult->first_name }} {{ $candidateResult->last_name }}@if($candidateResult->incumbent) (bisher)@endif:
            {{ number_format($candidateResult->votes) }} Stimmen</li>
    @endforeach
</ol>
