<?php
$vereinzelteWahlkreis = 0;
$vereinzelteTotal = 0;
?>
<p>
    Der Wahlkreis {{ $district->name }} hat Ergebnisse zu den Stadtratswahlen publiziert.
</p>

<h1>Wahlkreis-Ergebnisse</h1>
<ol>
    @foreach($districtResults as $result)
        <?php
        if ($result->votes < $districtCutoff || $result->candidate->last_name == "Vereinzelte") :
            $vereinzelteWahlkreis += $result->votes;
        else :
        ?>
        <li><b>{{ $result->candidate->first_name }} {{ $result->candidate->last_name }}</b>@if($result->candidate->party) ({{ $result->candidate->party }})@endif: {{ number_format($result->votes) }} Stimmen</li>
        <?php
        endif;
        ?>
        @if ($loop->last && $vereinzelteWahlkreis > 0)
            <li>Andere Kandidierende: {{ number_format($vereinzelteWahlkreis) }} Stimmen</li>
        @endif
    @endforeach
</ol>
<hr>
<h1>Zwischenergebnis (ganze Stadt)</h1>
<ol>
    @foreach($allResults as $result)
        <?php
        if ($result->votes < $allCutoff || $result->candidate->last_name == "Vereinzelte") :
            $vereinzelteTotal += $result->votes;
        else :
        ?>
        <li><b>{{ $result->candidate->first_name }} {{ $result->candidate->last_name }}</b>@if($result->candidate->party) ({{ $result->candidate->party }})@endif: {{ number_format($result->votes) }} Stimmen</li>
        <?php
        endif;
        ?>
        @if ($loop->last && $vereinzelteTotal > 0)
            <li>Andere Kandidierende: {{ number_format($vereinzelteTotal) }} Stimmen</li>
        @endif
    @endforeach
</ol>
<b>Absolutes Mehr: {{ number_format($absoluteMajority) }} Stimmen</b>
