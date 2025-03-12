<?php

use Illuminate\Support\Facades\Route;

$items = [
    [
        'from' => '/gelios-novomskovsk/nashi-vrachi/',
        'to' => '/nashi-speczialisty'
    ],
    [
        'from' => '/gelios-novomskovsk/semejnaya-mediczina-novomoskovsk/',
        'to' => '/semejnaya-mediczina'
    ],
    [
        'from' => '/gelios-novomskovsk/funkczionalnaya-diagnostika/',
        'to' => '/funkcionalna-diagnostika'
    ],
    [
        'from' => '/gelios-novomskovsk/ortopediya-i-travmatologiya/',
        'to' => '/vzroslym/ortopediya-i-travmatologiya'
    ],
    [
        'from' => '/gelios-novomskovsk/laboratornaya-diagnostika/',
        'to' => '/laboratornaya-diagnostika'
    ],
    [
        'from' => '/autizm/',
        'to' => '/reabilitacziya/autizm'
    ],
    [
        'from' => '/vzroslym/reproduktologiya/',
        'to' => '/reproduktologiya'
    ],
    [
        'from' => '/gelios-novomskovsk/ehokg/',
        'to' => '/funkcionalna-diagnostika/ekg-i-ehokg'
    ],
    [
        'from' => '/gelios-novomskovsk/ekg/',
        'to' => '/funkcionalna-diagnostika/ekg-i-ehokg'
    ],
    [
        'from' => '/gelios-novomskovsk/uzi/',
        'to' => '/uzi-s-elastografiej'
    ],
    [
        'from' => '/prajs/',
        'to' => '/prices'
    ],
    [
        'from' => '/team-member/zavizion-%D1%94vgen-mikolajovich/',
        'to' => '/'
    ],
    [
        'from' => '/team-member/chabanecz-valeriya-sergeevna/',
        'to' => '/'
    ],
];

if (!empty($items)) {
    foreach ($items as $item) {
        Route::get($item['from'], function () use ($item) {
            return redirect()->away(config('app.url') . $item['to'], 301);
        });
    }
}
