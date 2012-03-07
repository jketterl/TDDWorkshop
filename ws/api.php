<?php
header('Content-Type:application/json');

$data = Array(
    Array(
        'text' => 'Wir melden uns heute live von der CeBIT'
    ),
    Array(
        'text' => 'Die Teilnehmer der Veranstaltung betreten erstmal den roten Teppich'
    )
);

echo json_encode($data);