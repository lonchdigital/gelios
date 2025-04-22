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

    // directions
    [
        'from' => '/pediatriya/',
        'to' => '/pediatriya-dityacha/pediatriya'
    ],
    [
        'from' => '/pediatriya/otolaringologiya/',
        'to' => '/pediatriya/otolaringologiyadityacha'
    ],
    [
        'from' => '/detskij-massazh/',
        'to' => '/pediatriya/detskij-massazh'
    ],
    [
        'from' => '/pediatriya/kardiologiya/',
        'to' => '/pediatriya/kardiorevmatologiya-dityacha'
    ],
    [
        'from' => '/nefrologiya-detskaya/',
        'to' => '/pediatriya/nefrologiya-detskaya'
    ],
    [
        'from' => '/vzroslym/hirurgiya/',
        'to' => '/hirurgiya'
    ],
    [
        'from' => '/vzroslym/nejrohirurgiya/',
        'to' => '/hirurgiya/nejrohirurgiya'
    ],
    [
        'from' => '/vzroslym/hirurgiya-2/',
        'to' => '/hirurgiya/zagalna-hirurgiya/hirurgiya-2'
    ],
    [
        'from' => '/vzroslym/hirurgicheskoe-lechenie-kishechnoj-neprohodimosti-v-dnepre/',
        'to' => '/hirurgiya/zagalna-hirurgiya/hirurgicheskoe-lechenie-kishechnoj-neprohodimosti-v-dnepre'
    ],
    [
        'from' => '/vzroslym/hirurgicheskoe-lechenie-zhkb/',
        'to' => '/hirurgiya/zagalna-hirurgiya/hirurgicheskoe-lechenie-zhkb'
    ],
    [
        'from' => '/vzroslym/hirurgicheskoe-lechenie-gerb-v-dnepre/',
        'to' => '/hirurgiya/zagalna-hirurgiya/hirurgicheskoe-lechenie-gerb-v-dnepre'
    ],
    [
        'from' => '/vzroslym/hirurgicheskoe-lechenie-kist-pecheni-v-dnepre/',
        'to' => '/hirurgiya/zagalna-hirurgiya/hirurgicheskoe-lechenie-kist-pecheni-v-dnepre'
    ],
    [
        'from' => '/vzroslym/hirurgichne-likuvannya-kisti-selezinki-v-dnipri/',
        'to' => '/hirurgiya/zagalna-hirurgiya/hirurgichne-likuvannya-kisti-selezinki-v-dnipri'
    ],
    [
        'from' => '/vzroslym/hirurgichne-likuvannya-virazki-shlunku-v-dnipri/',
        'to' => '/hirurgiya/zagalna-hirurgiya/hirurgichne-likuvannya-virazki-shlunku-v-dnipri'
    ],
    [
        'from' => '/vzroslym/hirurgichne-likuvannya-peritonitu-v-dnipri/',
        'to' => '/hirurgiya/zagalna-hirurgiya/hirurgichne-likuvannya-peritonitu-v-dnipri'
    ],
    [
        'from' => '/vzroslym/35229-2/',
        'to' => '/hirurgiya/zagalna-hirurgiya/35229-2'
    ],
    [
        'from' => '/vzroslym/operativne-likuvannya-divertikulyarno%d1%97-hvorobi-tovsto%d1%97-kishki/',
        'to' => '/hirurgiya/zagalna-hirurgiya/operativne-likuvannya-divertikulyarno%D1%97-hvorobi-tovsto%D1%97-kishki'
    ],
    [
        'from' => '/vzroslym/hirurgichne-likuvannya-mehanichno%d1%97-zhovtyaniczi-v-dnipri/',
        'to' => '/hirurgiya/zagalna-hirurgiya/ambulatorna-hirurgiya/hirurgichne-likuvannya-mehanichno%D1%97-zhovtyaniczi-v-dnipri'
    ],
    [
        'from' => '/vzroslym/hirurgichne-vidalennya-rodimki-nevusa-v-dnipri/',
        'to' => '/hirurgiya/zagalna-hirurgiya/ambulatorna-hirurgiya/hirurgichne-vidalennya-rodimki-nevusa-v-dnipri'
    ],
    [
        'from' => '/vzroslym/laparoskopichna-gernioplastika-v-dnipri/',
        'to' => '/hirurgiya/zagalna-hirurgiya/likuvannya-grizhi/grizhi-zhivota/laparoskopichna-gernioplastika-v-dnipri'
    ],
    [
        'from' => '/vzroslym/hirurgichne-vidalennya-lipomi-zhirovika-v-dnipri/',
        'to' => '/hirurgiya/zagalna-hirurgiya/ambulatorna-hirurgiya/hirurgichne-vidalennya-lipomi-zhirovika-v-dnipri'
    ],
    [
        'from' => '/vzroslym/hirurgichne-vidalennya-fibrom-v-dnipri/',
        'to' => '/hirurgiya/zagalna-hirurgiya/ambulatorna-hirurgiya/hirurgichne-vidalennya-fibrom-v-dnipri'
    ],
    [
        'from' => '/vzroslym/hirurgichne-vidalennya-ateromi-v-dnipri/',
        'to' => '/hirurgiya/zagalna-hirurgiya/ambulatorna-hirurgiya/hirurgichne-vidalennya-ateromi-v-dnipri'
    ],
    [
        'from' => '/vzroslym/nejrohirurgiya/',
        'to' => '/hirurgiya/nejrohirurgiya'
    ],
    [
        'from' => '/vzroslym/plasticheskaya-hirurgiya/',
        'to' => '/hirurgiya/plasticheskaya-hirurgiya'
    ],
    [
        'from' => '/reabilitacziya-v-travmatologii/',
        'to' => '/reabilitacziya/reabilitacziya-v-travmatologii'
    ],
    [
        'from' => '/programma-rechevoj-reabilitaczii/',
        'to' => '/reabilitacziya/programma-rechevoj-reabilitaczii'
    ],
    [
        'from' => '/reabilitacziya-v-nevrologii/',
        'to' => '/reabilitacziya/reabilitacziya-v-nevrologii'
    ],
    [
        'from' => '/insult/',
        'to' => '/reabilitacziya/insult'
    ],
    [
        'from' => '/cherepno-mozkova-travma-chmt/',
        'to' => '/reabilitacziya/cherepno-mozkova-travma-chmt'
    ],
    [
        'from' => '/spinalna-travma/',
        'to' => '/reabilitacziya/spinalna-travma'
    ],
    [
        'from' => '/fizichnaya-reabilitacziya-pri-rozsiyanomu-sklerozi/',
        'to' => '/reabilitacziya/fizichnaya-reabilitacziya-pri-rozsiyanomu-sklerozi'
    ],
    [
        'from' => '/bil-u-suglobah/',
        'to' => '/reabilitacziya/bil-u-suglobah'
    ],
    [
        'from' => '/reabilitacziya-pislya-travmi-oprno-ruhovogo-aparatu/',
        'to' => '/reabilitacziya/reabilitacziya-pislya-travmi-oprno-ruhovogo-aparatu'
    ],
    [
        'from' => '/fizichna-reabilitacziya-pislya-endoprotezuvannya-suglobiv/',
        'to' => '/reabilitacziya/fizichna-reabilitacziya-pislya-endoprotezuvannya-suglobiv'
    ],
    [
        'from' => '/fizichnaya-reabilitacziya-pri-porushennyah-postavi-u-ditej-ta-doroslih/',
        'to' => '/reabilitacziya/fizichnaya-reabilitacziya-pri-porushennyah-postavi-u-ditej-ta-doroslih'
    ],
    [
        'from' => '/fizichnij-terapevt/',
        'to' => '/reabilitacziya/fizichnij-terapevt'
    ],
    [
        'from' => '/ergoterapevt/',
        'to' => '/reabilitacziya/ergoterapevt'
    ],
    // [
    //     'from' => '/reabilitacziya/postkovidnaya-reabilitacziya/',
    //     'to' => '/reabilitacziya/postkovidnaya-reabilitacziya'
    // ],
    [
        'from' => '/dityachij-czerebralnij-paralich/',
        'to' => '/reabilitacziya/dityachij-czerebralnij-paralich'
    ],
    [
        'from' => '/ultrazvukovaya-diagnostika-detej/',
        'to' => '/uzi-s-elastografiej/ultrazvukovaya-diagnostika-detej'
    ],
    [
        'from' => '/pediatriya/likuvannya-zapalennya-legen-u-ditej-v-dnipri/',
        'to' => '/pediatriya/pediatriya-dityacha/likuvannya-zapalennya-legen-u-ditej-v-dnipri'
    ],
    [
        'from' => '/pediatriya/likuvannya-otitu-u-ditej-v-dnipri/',
        'to' => '/pediatriya/pediatriya-dityacha/likuvannya-otitu-u-ditej-v-dnipri'
    ],
    [
        'from' => '/pediatriya/likuvannya-tonzilitu-u-ditej-v-dnipri/',
        'to' => '/pediatriya/pediatriya-dityacha/likuvannya-tonzilitu-u-ditej-v-dnipri'
    ],
    [
        'from' => '/pediatriya/likuvannya-gostrogo-rinosinusitu-grs-u-ditej-v-dnipri/',
        'to' => '/pediatriya/pediatriya-dityacha/likuvannya-gostrogo-rinosinusitu-grs-u-ditej-v-dnipri'
    ],
    [
        'from' => '/vzroslym/bariatrichna-operacziya/',
        'to' => '/hirurgiya/bariatrichna-operacziya'
    ],
    [
        'from' => '/vzroslym/operaczi%D1%97-pri-spajkovij-hvorobi/',
        'to' => '/hirurgiya/hirurgiya-v-ginekologiyi/operaczi%D1%97-pri-spajkovij-hvorobi'
    ],
    [
        'from' => '/amplipulsterapiya/',
        'to' => '/aparatna-fizioterapiya/amplipulsterapiya'
    ],
    [
        'from' => '/magnitoterapiya/',
        'to' => '/aparatna-fizioterapiya/magnitoterapiya'
    ],
    [
        'from' => '/pressoterapiya/',
        'to' => '/aparatna-fizioterapiya/pressoterapiya'
    ],
    [
        'from' => '/uzt/',
        'to' => '/aparatna-fizioterapiya/uzt'
    ],
    [
        'from' => '/udarno-volnovaya-terapiya-btl/',
        'to' => '/aparatna-fizioterapiya/udarno-volnovaya-terapiya-btl'
    ],
    [
        'from' => '/stress-test/',
        'to' => '/funkcionalna-diagnostika/stress-test'
    ],
    [
        'from' => '/ekg-i-ehokg/',
        'to' => '/funkcionalna-diagnostika/ekg-i-ehokg'
    ],
    [
        'from' => '/funkczionalnaya-diagnostika/',
        'to' => '/funkcionalna-diagnostika/funkczionalnaya-diagnostika'
    ],
    [
        'from' => '/elektroenczefalogramma-golovnogo-mozga/',
        'to' => '/funkcionalna-diagnostika/elektroenczefalogramma-golovnogo-mozga'
    ],
    [
        'from' => '/vzroslym/sluzhba-lecheniya-boli/',
        'to' => '/sluzhba-lecheniya-boli'
    ],
    [
        'from' => '/zapisatsya-na-priem-k-mammologu-onkologu',
        'to' => '/vzroslym/mammologiya'
    ],
    [
        'from' => '/ultrazvukovaya-i-funkczionalnaya-diagnostika-vzroslyh',
        'to' => '/uzi-s-elastografiej'
    ],
    // directions END
];

if (!empty($items)) {
    foreach ($items as $item) {
        Route::get($item['from'], function () use ($item) {
            return redirect()->away(config('app.url') . $item['to'], 301);
        });
    }
}
