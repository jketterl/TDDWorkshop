<?php
header('Content-Type:application/json');

$data = Array(
    Array(
        'text' => 'Wir melden uns heute live von der CeBIT.'
    ),
    Array(
        'text' => 'Die Teilnehmer der Veranstaltung betreten erstmal den roten Teppich.'
    ),
    Array(
        'text' => 'Auch bekannte Gesichter wie Mathias Plica konnten gesichtet werden!'
    )
);

echo json_encode($data);