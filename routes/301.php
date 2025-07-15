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
    // [
    //     'from' => '/ultrazvukovaya-i-funkczionalnaya-diagnostika-vzroslyh',
    //     'to' => '/uzi-s-elastografiej'
    // ],
    // directions END

    [
        'from' => '/vzroslym/vidalennya-migdalikiv-tonzilektomiya/',
        'to' => '/hirurgiya/hirurgiya-v-otolaringologiyi/vidalennya-migdalikiv-tonzilektomiya'
    ],
    [
        'from' => '/vzroslym/vidalennya-melanomi/',
        'to' => '/hirurgiya/dermatoonkologiya/vidalennya-melanomi'
    ],
    [
        'from' => '/vzroslym/tomosintez-molochnoї-zalozi-u-mcz-gelios/',
        'to' => '/czifrova-mamografiya-u-gelios/tomosintez-molochnoyi-zalozi-u-mcz-gelios'
    ],
    [
        'from' => '/vzroslym/terapiya/',
        'to' => '/vzroslym/terapiya-3'
    ],
    [
        'from' => '/vzroslym/rak-tila-matki-endometriyu/',
        'to' => '/vzroslym/onkoginekologiya/rak-tila-matki-endometriyu'
    ],
    [
        'from' => '/vzroslym/rak-shijki-matki/',
        'to' => '/vzroslym/onkoginekologiya/rak-shijki-matki'
    ],
    [
        'from' => '/vzroslym/plasticheskaya-hirurgiya/',
        'to' => '/hirurgiya/plasticheskaya-hirurgiya'
    ],
    [
        'from' => '/vzroslym/operativne-likuvannya-raku-matkovih-trub-v-dnipri/',
        'to' => '/vzroslym/onkoginekologiya/operativne-likuvannya-raku-matkovih-trub-v-dnipri'
    ],
    [
        'from' => '/vzroslym/operativne-likuvannya-divertikulyarnoї-hvorobi-tovstoї-kishki/',
        'to' => '/hirurgiya/zagalna-hirurgiya/operativne-likuvannya-divertikulyarnoyi-hvorobi-tovstoyi-kishki'
    ],
    /// 1-10
    [
        'from' => '/vzroslym/operacziї-pri-spajkovij-hvorobi/',
        'to' => '/hirurgiya/zagalna-hirurgiya/operacziyi-pri-spajkovij-hvorobi'
    ],
    [
        'from' => '/vzroslym/operacziї-pri-spajkovij-hvorobi-2/',
        'to' => '/hirurgiya/hirurgiya-v-mamologiyi/operacziyi-pri-spajkovij-hvorobi-2'
    ],
    [
        'from' => '/vzroslym/nejrohirurgiya/',
        'to' => '/hirurgiya/nejrohirurgiya'
    ],
    [
        'from' => '/vzroslym/laparoskopichna-gernioplastika-v-dnipri/',
        'to' => '/hirurgiya/zagalna-hirurgiya/likuvannya-grizhi/grizhi-zhivota/laparoskopichna-gernioplastika-v-dnipri'
    ],
    [
        'from' => '/vzroslym/hirurgiya-2/',
        'to' => '/vzroslym/hirurgiya'
    ],
    [
        'from' => '/vzroslym/hirurgichne-vidalennya-rodimki-nevusa-v-dnipri/',
        'to' => '/hirurgiya/zagalna-hirurgiya/ambulatorna-hirurgiya/hirurgichne-vidalennya-rodimki-nevusa-v-dnipri'
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
        'from' => '/vzroslym/hirurgichne-likuvannya-virazki-shlunku-v-dnipri/',
        'to' => '/hirurgiya/zagalna-hirurgiya/hirurgichne-likuvannya-virazki-shlunku-v-dnipri'
    ],
    /// 11-20
    [
        'from' => '/vzroslym/hirurgichne-likuvannya-raku-vulvi-v-dnipri/',
        'to' => '/vzroslym/onkoginekologiya/hirurgichne-likuvannya-raku-vulvi-v-dnipri'
    ],
    [
        'from' => '/vzroslym/hirurgichne-likuvannya-peritonitu-v-dnipri/',
        'to' => '/hirurgiya/zagalna-hirurgiya/hirurgichne-likuvannya-peritonitu-v-dnipri'
    ],
    [
        'from' => '/vzroslym/hirurgichne-likuvannya-mehanichnoї-zhovtyaniczi-v-dnipri/',
        'to' => '/hirurgiya/zagalna-hirurgiya/ambulatorna-hirurgiya/hirurgichne-likuvannya-mehanichnoyi-zhovtyaniczi-v-dnipri'
    ],
    [
        'from' => '/vzroslym/hirurgichne-likuvannya-kisti-selezinki-v-dnipri/',
        'to' => '/hirurgiya/zagalna-hirurgiya/hirurgichne-likuvannya-kisti-selezinki-v-dnipri'
    ],
    [
        'from' => '/vzroslym/hirurgichne-likuvannya-gostrogo-gemoroyu-v-dnipri/',
        'to' => '/hirurgiya/proktologichn-hirurgiya/hirurgichne-likuvannya-gostrogo-gemoroyu-v-dnipri'
    ],
    [
        'from' => '/vzroslym/hirurgicheskoe-lechenie-zhkb/',
        'to' => '/hirurgiya/zagalna-hirurgiya/hirurgicheskoe-lechenie-zhkb'
    ],
    [
        'from' => '/vzroslym/hirurgicheskoe-lechenie-kist-pecheni-v-dnepre/',
        'to' => '/hirurgiya/zagalna-hirurgiya/hirurgicheskoe-lechenie-kist-pecheni-v-dnepre'
    ],
    [
        'from' => '/vzroslym/hirurgicheskoe-lechenie-kishechnoj-neprohodimosti-v-dnepre/',
        'to' => '/hirurgiya/zagalna-hirurgiya/hirurgicheskoe-lechenie-kishechnoj-neprohodimosti-v-dnepre'
    ],
    [
        'from' => '/vzroslym/hirurgicheskoe-lechenie-gerb-v-dnepre/',
        'to' => '/hirurgiya/zagalna-hirurgiya/hirurgicheskoe-lechenie-gerb-v-dnepre'
    ],
    [
        'from' => '/vzroslym/czifrova-mamografiya-u-gelios/',
        'to' => '/czifrova-mamografiya-u-gelios'
    ],
    /// 21-30
    [
        'from' => '/vzroslym/bariatrichna-operacziya/',
        'to' => '/hirurgiya/bariatrichna-operacziya'
    ],
    [
        'from' => '/ultrazvukovaya-diagnostika-detej/',
        'to' => '/ultrazvukova-diagnostika/ultrazvukovaya-diagnostika-detej'
    ],
    [
        'from' => '/udarno-volnovaya-terapiya-btl/',
        'to' => '/aparatna-fizioterapiya/udarno-volnovaya-terapiya-btl'
    ],
    [
        'from' => '/ua/vzroslym/vidalennya-migdalikiv-tonzilektomiya/',
        'to' => '/ua/hirurgiya/hirurgiya-v-otolaringologiyi/vidalennya-migdalikiv-tonzilektomiya'
    ],
    [
        'from' => '/ua/vzroslym/vidalennya-melanomi/',
        'to' => '/ua/hirurgiya/dermatoonkologiya/vidalennya-melanomi'
    ],
    [
        'from' => '/ua/vzroslym/rak-tila-matki-endometriyu/',
        'to' => '/ua/vzroslym/onkoginekologiya/rak-tila-matki-endometriyu'
    ],
    [
        'from' => '/ua/vzroslym/plasticheskaya-hirurgiya/',
        'to' => '/ua/hirurgiya/plasticheskaya-hirurgiya'
    ],
    [
        'from' => '/ua/vzroslym/operativne-likuvannya-raku-matkovih-trub-v-dnipri/',
        'to' => '/ua/vzroslym/onkoginekologiya/operativne-likuvannya-raku-matkovih-trub-v-dnipri'
    ],
    [
        'from' => '/ua/vzroslym/nejrohirurgiya/',
        'to' => '/ua/hirurgiya/nejrohirurgiya'
    ],
    [
        'from' => '/ua/vzroslym/laparoskopichna-gernioplastika-v-dnipri/',
        'to' => '/ua/hirurgiya/zagalna-hirurgiya/likuvannya-grizhi/grizhi-zhivota/laparoskopichna-gernioplastika-v-dnipri'
    ],
    [
        'from' => '/ua/vzroslym/hirurgiya-2/',
        'to' => '/ua/vzroslym/hirurgiya'
    ],
    [
        'from' => '/ua/vzroslym/hirurgichne-vidalennya-rodimki-nevusa-v-dnipri/',
        'to' => '/ua/hirurgiya/zagalna-hirurgiya/ambulatorna-hirurgiya/hirurgichne-vidalennya-rodimki-nevusa-v-dnipri'
    ],
    [
        'from' => '/ua/vzroslym/hirurgichne-vidalennya-lipomi-zhirovika-v-dnipri/',
        'to' => '/ua/hirurgiya/zagalna-hirurgiya/ambulatorna-hirurgiya/hirurgichne-vidalennya-lipomi-zhirovika-v-dnipri'
    ],
    [
        'from' => '/ua/vzroslym/hirurgichne-vidalennya-fibrom-v-dnipri/',
        'to' => '/ua/hirurgiya/zagalna-hirurgiya/ambulatorna-hirurgiya/hirurgichne-vidalennya-fibrom-v-dnipri'
    ],
    [
        'from' => '/ua/vzroslym/hirurgichne-vidalennya-ateromi-v-dnipri/',
        'to' => '/ua/hirurgiya/zagalna-hirurgiya/ambulatorna-hirurgiya/hirurgichne-vidalennya-ateromi-v-dnipri'
    ],
    [
        'from' => '/ua/vzroslym/hirurgichne-likuvannya-raku-vulvi-v-dnipri/',
        'to' => '/ua/vzroslym/onkoginekologiya/hirurgichne-likuvannya-raku-vulvi-v-dnipri'
    ],
    [
        'from' => '/ua/vzroslym/hirurgichne-likuvannya-peritonitu-v-dnipri/',
        'to' => '/ua/hirurgiya/zagalna-hirurgiya/hirurgichne-likuvannya-peritonitu-v-dnipri'
    ],
    [
        'from' => '/ua/vzroslym/hirurgichne-likuvannya-kisti-selezinki-v-dnipri/',
        'to' => '/ua/hirurgiya/zagalna-hirurgiya/hirurgichne-likuvannya-kisti-selezinki-v-dnipri'
    ],
    [
        'from' => '/ua/vzroslym/hirurgichne-likuvannya-gostrogo-gemoroyu-v-dnipri/',
        'to' => '/ua/hirurgiya/proktologichn-hirurgiya/hirurgichne-likuvannya-gostrogo-gemoroyu-v-dnipri'
    ],
    [
        'from' => '/ua/vzroslym/hirurgicheskoe-lechenie-kist-pecheni-v-dnepre/',
        'to' => '/ua/hirurgiya/zagalna-hirurgiya/hirurgicheskoe-lechenie-kist-pecheni-v-dnepre'
    ],

    /////////// 33-50

    [
        'from' => '/ua/vzroslym/hirurgicheskoe-lechenie-kishechnoj-neprohodimosti-v-dnepre/',
        'to' => '/ua/hirurgiya/zagalna-hirurgiya/hirurgicheskoe-lechenie-kishechnoj-neprohodimosti-v-dnepre'
    ],
    [
        'from' => '/ua/vzroslym/hirurgicheskoe-lechenie-gerb-v-dnepre/',
        'to' => '/ua/hirurgiya/zagalna-hirurgiya/hirurgicheskoe-lechenie-gerb-v-dnepre'
    ],
    [
        'from' => '/ua/vzroslym/czifrova-mamografiya-u-gelios/',
        'to' => '/ua/czifrova-mamografiya-u-gelios'
    ],
    [
        'from' => '/ua/vzroslym/bariatrichna-operacziya/',
        'to' => '/ua/hirurgiya/bariatrichna-operacziya'
    ],
    [
        'from' => '/ua/vzroslym/bariatrichna-operacziya-2/',
        'to' => '/ua/hirurgiya/dermatoonkologiya/bariatrichna-operacziya-2'
    ],
    [
        'from' => '/ua/ultrazvukovaya-diagnostika-detej/',
        'to' => '/ua/uzi-s-elastografiej/ultrazvukovaya-diagnostika-detej'
    ],
    [
        'from' => '/ua/udarno-volnovaya-terapiya-btl/',
        'to' => '/ua/aparatna-fizioterapiya/udarno-volnovaya-terapiya-btl'
    ],
    [
        'from' => '/ua/stress-test/',
        'to' => '/ua/funkcionalna-diagnostika/stress-test'
    ],
    [
        'from' => '/ua/spinalna-travma/',
        'to' => '/ua/reabilitacziya/spinalna-travma'
    ],
    [
        'from' => '/ua/revmatologiya/',
        'to' => '/ua/vzroslym/revmatologiya'
    ],
    [
        'from' => '/ua/reproductology/',
        'to' => '/ua/vzroslym/reproduktologiya'
    ],
    [
        'from' => '/ua/reabilitacziya-v-travmatologii/',
        'to' => '/ua/reabilitacziya/reabilitacziya-v-travmatologii'
    ],
    [
        'from' => '/ua/reabilitacziya-v-nevrologii/',
        'to' => '/ua/reabilitacziya/reabilitacziya-v-nevrologii'
    ],
    [
        'from' => '/ua/reabilitacziya-pislya-travmi-oprno-ruhovogo-aparatu/',
        'to' => '/ua/reabilitacziya/reabilitacziya-pislya-travmi-oprno-ruhovogo-aparatu'
    ],
    [
        'from' => '/ua/proktologiya/',
        'to' => '/ua/vzroslym/proktologiya'
    ],
    [
        'from' => '/ua/programma-rechevoj-reabilitaczii/',
        'to' => '/ua/reabilitacziya/programma-rechevoj-reabilitaczii'
    ],
    [
        'from' => '/ua/pediatriya/nevrologiya-detskaya/',
        'to' => '/ua/pediatriya-dityacha/nevrologiya-detskaya'
    ],
    [
        'from' => '/ua/pediatriya/likuvannya-zapalennya-legen-u-ditej-v-dnipri/',
        'to' => '/ua/pediatriya-dityacha/pediatriya/likuvannya-zapalennya-legen-u-ditej-v-dnipri'
    ],
    [
        'from' => '/ua/pediatriya/likuvannya-tonzilitu-u-ditej-v-dnipri/',
        'to' => '/ua/pediatriya-dityacha/pediatriya/likuvannya-tonzilitu-u-ditej-v-dnipri'
    ],
    [
        'from' => '/ua/pediatriya/likuvannya-otitu-u-ditej-v-dnipri/',
        'to' => '/ua/pediatriya-dityacha/pediatriya/likuvannya-otitu-u-ditej-v-dnipri'
    ],
///// 51-70

    [
        'from' => '/ua/pediatriya/likuvannya-gostrogo-rinosinusitu-grs-u-ditej-v-dnipri/',
        'to' => '/ua/pediatriya-dityacha/pediatriya/likuvannya-gostrogo-rinosinusitu-grs-u-ditej-v-dnipri'
    ],
    [
        'from' => '/ua/pediatriya/kardiologiya/',
        'to' => '/ua/vzroslym/kardiologiya'
    ],
    [
        'from' => '/ua/pediatriya/gastroenterologiya-detskaya/',
        'to' => '/ua/pediatriya-dityacha/gastroenterologiya-detskaya'
    ],
    [
        'from' => '/ua/pediatriya/fizicheskaya-reabilitacziya/',
        'to' => '/ua/pediatriya-dityacha/fizicheskaya-reabilitacziya'
    ],
    [
        'from' => '/ua/pediatriya/detskij-ortoped/',
        'to' => '/ua/pediatriya-dityacha/detskij-ortoped'
    ],
    [
        'from' => '/ua/pediatriya/detskij-endokrinolog/',
        'to' => '/ua/pediatriya-dityacha/detskij-endokrinolog'
    ],
    [
        'from' => '/ua/otolaringologiya/',
        'to' => '/vzroslym/otolaringologiya'
    ],
    [
        'from' => '/ua/ortopediya-i-travmatologiya/',
        'to' => '/ua/vzroslym/ortopediya-i-travmatologiya'
    ],
    [
        'from' => '/ua/nejrosonografiya/',
        'to' => '/ua/ultrazvukova-diagnostika/uzi-s-elastografiej/nejrosonografiya'
    ],
    [
        'from' => '/ua/nefrologiya-detskaya/',
        'to' => '/ua/pediatriya-dityacha/nefrologiya-detskaya'
    ],
    [
        'from' => '/ua/nashi-speczialisty-vzroslye/',
        'to' => '/ua/nashi-speczialisty'
    ],
    [
        'from' => '/ua/ginekologiya/',
        'to' => '/ua/vzroslym/ginekologiya'
    ],
    [
        'from' => '/ua/gelios-novomskovsk/ortopediya-i-travmatologiya/',
        'to' => '/ua/vzroslym/ortopediya-i-travmatologiya'
    ],
    [
        'from' => '/ua/gelios-novomskovsk/laboratornaya-diagnostika/',
        'to' => '/ua/laboratornaya-diagnostika'
    ],
    [
        'from' => '/ua/gelios-novomskovsk/funkczionalnaya-diagnostika/',
        'to' => '/ua/funkcionalna-diagnostika/funkczionalnaya-diagnostika'
    ],
    [
        'from' => '/ua/gastroenterologiya/',
        'to' => '/ua/vzroslym/gastroenterologiya'
    ],
    [
        'from' => '/ua/funkczionalnaya-diagnostika/',
        'to' => '/ua/funkcionalna-diagnostika'
    ],
    [
        'from' => '/ua/fizichnij-terapevt/',
        'to' => '/ua/reabilitacziya/fizichnij-terapevt'
    ],
    [
        'from' => '/ua/fizichnaya-reabilitacziya-pri-rozsiyanomu-sklerozi/',
        'to' => '/ua/reabilitacziya/fizichnaya-reabilitacziya-pri-rozsiyanomu-sklerozi'
    ],
    [
        'from' => '/ua/fizichnaya-reabilitacziya-pri-porushennyah-postavi-u-ditej-ta-doroslih/',
        'to' => '/ua/reabilitacziya/fizichnaya-reabilitacziya-pri-porushennyah-postavi-u-ditej-ta-doroslih'
    ],
///// 71-90
    [
        'from' => '/ua/fizichna-reabilitacziya-pislya-endoprotezuvannya-suglobiv/',
        'to'   => '/ua/reabilitacziya/fizichna-reabilitacziya-pislya-endoprotezuvannya-suglobiv'
    ],
    [
        'from' => '/ua/fgds-kolonoskopiya/',
        'to'   => '/ua/vzroslym/fgds-kolonoskopiya'
    ],
    [
        'from' => '/ua/ergoterapevt/',
        'to'   => '/ua/reabilitacziya/ergoterapevt'
    ],
    [
        'from' => '/ua/endokrinologiya/',
        'to'   => '/ua/vzroslym/endokrinologiya'
    ],
    [
        'from' => '/ua/elektroenczefalogramma-golovnogo-mozga/',
        'to'   => '/ua/funkcionalna-diagnostika/elektroenczefalogramma-golovnogo-mozga'
    ],
    [
        'from' => '/ua/elastografiya-pecheni/',
        'to'   => '/ua/ultrazvukova-diagnostika/uzi-s-elastografiej/elastografiya-pecheni'
    ],
    [
        'from' => '/ua/ekg-i-ehokg/',
        'to'   => '/ua/funkcionalna-diagnostika/ekg-i-ehokg'
    ],
    [
        'from' => '/ua/dityachij-czerebralnij-paralich/',
        'to'   => '/ua/reabilitacziya/dityachij-czerebralnij-paralich'
    ],
    [
        'from' => '/ua/dietologiya/',
        'to'   => '/ua/vzroslym/dietologiya'
    ],
    [
        'from' => '/ua/dermatovenerologiya/',
        'to'   => '/ua/vzroslym/dermatovenerologiya'
    ],
    [
        'from' => '/ua/declaracia_semeyniy_doctor/',
        'to'   => '/ua/dlya-paczientov/declaracia-semeyniy-doctor'
    ],
    [
        'from' => '/ua/czentr-mentalnogo-zdorovya-gelios/',
        'to'   => '/ua/one-center/czentr-mentalnogo-zdorovya-gelios'
    ],
    [
        'from' => '/ua/cherepno-mozkova-travma-chmt/',
        'to'   => '/ua/reabilitacziya/cherepno-mozkova-travma-chmt'
    ],
    [
        'from' => '/ua/category/reabilitacziya/',
        'to'   => '/ua/reabilitacziya'
    ],
    [
        'from' => '/ua/bil-u-suglobah/',
        'to'   => '/ua/reabilitacziya/bil-u-suglobah'
    ],
    [
        'from' => '/stress-test/',
        'to'   => '/funkcionalna-diagnostika/stress-test'
    ],
    [
        'from' => '/spinalna-travma/',
        'to'   => '/reabilitacziya/spinalna-travma'
    ],
    [
        'from' => '/revmatologiya/',
        'to'   => '/ua/vzroslym/revmatologiya'
    ],
    [
        'from' => '/reproductology/',
        'to'   => '/ua/vzroslym/reproduktologiya'
    ],
    [
        'from' => '/reabilitacziya-v-travmatologii/',
        'to'   => '/ua/reabilitacziya/reabilitacziya-v-travmatologii'
    ],

/////// 91-110

    [
        'from' => '/reabilitacziya-v-nevrologii/',
        'to'   => '/reabilitacziya/reabilitacziya-v-nevrologii'
    ],
    [
        'from' => '/reabilitacziya-pislya-travmi-oprno-ruhovogo-aparatu/',
        'to'   => '/reabilitacziya/reabilitacziya-pislya-travmi-oprno-ruhovogo-aparatu'
    ],
    [
        'from' => '/proktologiya/',
        'to'   => '/vzroslym/proktologiya'
    ],
    [
        'from' => '/programma-rechevoj-reabilitaczii/',
        'to'   => '/reabilitacziya/programma-rechevoj-reabilitaczii'
    ],
    [
        'from' => '/pediatriya/nevrologiya-detskaya/',
        'to'   => '/pediatriya-dityacha/nevrologiya-detskaya'
    ],
    [
        'from' => '/pediatriya/likuvannya-zapalennya-legen-u-ditej-v-dnipri/',
        'to'   => '/pediatriya-dityacha/pediatriya/likuvannya-zapalennya-legen-u-ditej-v-dnipri'
    ],
    [
        'from' => '/pediatriya/likuvannya-tonzilitu-u-ditej-v-dnipri/',
        'to'   => '/pediatriya-dityacha/pediatriya/likuvannya-tonzilitu-u-ditej-v-dnipri'
    ],
    [
        'from' => '/pediatriya/likuvannya-otitu-u-ditej-v-dnipri/',
        'to'   => '/pediatriya-dityacha/pediatriya/likuvannya-otitu-u-ditej-v-dnipri'
    ],
    [
        'from' => '/pediatriya/likuvannya-gostrogo-rinosinusitu-grs-u-ditej-v-dnipri/',
        'to'   => '/pediatriya-dityacha/pediatriya/likuvannya-gostrogo-rinosinusitu-grs-u-ditej-v-dnipri'
    ],
    [
        'from' => '/pediatriya/kardiologiya/',
        'to'   => '/vzroslym/kardiologiya'
    ],
    [
        'from' => '/pediatriya/gastroenterologiya-detskaya/',
        'to'   => '/pediatriya-dityacha/gastroenterologiya-detskaya'
    ],
    [
        'from' => '/pediatriya/fizicheskaya-reabilitacziya/',
        'to'   => '/pediatriya-dityacha/fizicheskaya-reabilitacziya'
    ],
    [
        'from' => '/pediatriya/detskij-ortoped/',
        'to'   => '/pediatriya-dityacha/detskij-ortoped'
    ],
    [
        'from' => '/pediatriya/detskij-endokrinolog/',
        'to'   => '/pediatriya-dityacha/detskij-endokrinolog'
    ],
    [
        'from' => '/otolaringologiya/',
        'to'   => '/vzroslym/otolaringologiya'
    ],
    [
        'from' => '/ortopediya-i-travmatologiya/',
        'to'   => '/vzroslym/ortopediya-i-travmatologiya'
    ],
    [
        'from' => '/nejrosonografiya/',
        'to'   => '/ultrazvukova-diagnostika/uzi-s-elastografiej/nejrosonografiya'
    ],
    [
        'from' => '/nefrologiya-detskaya/',
        'to'   => '/pediatriya-dityacha/nefrologiya-detskaya'
    ],
    [
        'from' => '/nashi-speczialisty-vzroslye/',
        'to'   => '/nashi-speczialisty'
    ],
    [
        'from' => '/insult/',
        'to'   => '/reabilitacziya/insult'
    ],
///// 111-130

    [
        'from' => '/ginekologiya/',
        'to'   => '/vzroslym/ginekologiya'
    ],
    [
        'from' => '/gelios-novomskovsk/ortopediya-i-travmatologiya/',
        'to'   => '/vzroslym/ortopediya-i-travmatologiya'
    ],
    [
        'from' => '/gelios-novomskovsk/laboratornaya-diagnostika/',
        'to'   => '/laboratornaya-diagnostika'
    ],
    [
        'from' => '/gelios-novomskovsk/funkczionalnaya-diagnostika/',
        'to'   => '/funkcionalna-diagnostika/funkczionalnaya-diagnostika'
    ],
    [
        'from' => '/gastroenterologiya/',
        'to'   => '/vzroslym/gastroenterologiya'
    ],
    [
        'from' => '/funkczionalnaya-diagnostika/',
        'to'   => '/funkcionalna-diagnostika'
    ],
    [
        'from' => '/fizichnij-terapevt/',
        'to'   => '/reabilitacziya/fizichnij-terapevt'
    ],
    [
        'from' => '/fizichnaya-reabilitacziya-pri-rozsiyanomu-sklerozi/',
        'to'   => '/reabilitacziya/fizichnaya-reabilitacziya-pri-rozsiyanomu-sklerozi'
    ],
    [
        'from' => '/fizichnaya-reabilitacziya-pri-porushennyah-postavi-u-ditej-ta-doroslih/',
        'to'   => '/reabilitacziya/fizichnaya-reabilitacziya-pri-porushennyah-postavi-u-ditej-ta-doroslih'
    ],
    [
        'from' => '/fizichna-reabilitacziya-pislya-endoprotezuvannya-suglobiv/',
        'to'   => '/reabilitacziya/fizichna-reabilitacziya-pislya-endoprotezuvannya-suglobiv'
    ],
    [
        'from' => '/fgds-kolonoskopiya/',
        'to'   => '/vzroslym/fgds-kolonoskopiya'
    ],
    [
        'from' => '/ergoterapevt/',
        'to'   => '/reabilitacziya/ergoterapevt'
    ],
    [
        'from' => '/endokrinologiya/',
        'to'   => '/vzroslym/endokrinologiya'
    ],
    [
        'from' => '/elektroenczefalogramma-golovnogo-mozga/',
        'to'   => '/funkcionalna-diagnostika/elektroenczefalogramma-golovnogo-mozga'
    ],
    [
        'from' => '/elastografiya-pecheni/',
        'to'   => '/ultrazvukova-diagnostika/uzi-s-elastografiej/elastografiya-pecheni'
    ],
    [
        'from' => '/ekg-i-ehokg/',
        'to'   => '/funkcionalna-diagnostika/ekg-i-ehokg'
    ],
    [
        'from' => '/dityachij-czerebralnij-paralich/',
        'to'   => '/reabilitacziya/dityachij-czerebralnij-paralich'
    ],
    [
        'from' => '/dietologiya/',
        'to'   => '/vzroslym/dietologiya'
    ],
    [
        'from' => '/dermatovenerologiya/',
        'to'   => '/vzroslym/dermatovenerologiya'
    ],
    [
        'from' => '/declaracia_semeyniy_doctor/',
        'to'   => '/dlya-paczientov/declaracia-semeyniy-doctor'
    ],
    ///// 131-150

    [
        'from' => '/czentr-mentalnogo-zdorovya-gelios/',
        'to'   => '/one-center/czentr-mentalnogo-zdorovya-gelios'
    ],
    [
        'from' => '/cherepno-mozkova-travma-chmt/',
        'to'   => '/reabilitacziya/cherepno-mozkova-travma-chmt'
    ],
    [
        'from' => '/category/reabilitacziya/',
        'to'   => '/ua/reabilitacziya'
    ],
    [
        'from' => '/bil-u-suglobah/',
        'to'   => '/reabilitacziya/bil-u-suglobah'
    ],
    [
        'from' => '/amplipulsterapiya/',
        'to'   => '/aparatna-fizioterapiya/amplipulsterapiya'
    ],
    [
        'from' => '/allergologiya/',
        'to'   => '/vzroslym/allergologiya'
    ],
    [
        'from' => '/ua/uzi-shhitovidnoj-zhelezy-detyam/',
        'to'   => '/ua/ultrazvukova-diagnostika/ultrazvukovaya-diagnostika-detej/uzi-shhitovidnoj-zhelezy-detyam'
    ],
    [
        'from' => '/uzi-shhitovidnoj-zhelezy-detyam/',
        'to'   => '/ultrazvukova-diagnostika/ultrazvukovaya-diagnostika-detej/uzi-shhitovidnoj-zhelezy-detyam'
    ],
    [
        'from' => '/nashi-speczialisty-detskie/',
        'to'   => '/nashi-speczialisty'
    ],
    [
        'from' => '/ua/nashi-speczialisty-detskie/',
        'to'   => '/ua/nashi-speczialisty'
    ],
    [
        'from' => '/ua/urologiya/',
        'to'   => '/ua/vzroslym/urologiya'
    ],
    [
        'from' => '/urologiya/',
        'to'   => '/vzroslym/urologiya'
    ],
    [
        'from' => '/vzroslym/bariatrichna-operacziya-2/',
        'to'   => '/hirurgiya/dermatoonkologiya/bariatrichna-operacziya-2'
    ],
    [
        'from' => '/ua/pediatriya/otolaringologiya/',
        'to'   => '/ua/pediatriya-dityacha/otolaringologiyadityacha'
    ],
    [
        'from' => '/pediatriya/otolaringologiya/',
        'to'   => '/pediatriya-dityacha/otolaringologiyadityacha'
    ],
    [
        'from' => '/ua/onkologiya/',
        'to'   => '/ua/vzroslym/onkologiya'
    ],
    [
        'from' => '/onkologiya/',
        'to'   => '/vzroslym/onkologiya'
    ],
    [
        'from' => '/ua/pediatriya/',
        'to'   => '/ua/pediatriya-dityacha'
    ],
    [
        'from' => '/pediatriya/',
        'to'   => '/pediatriya-dityacha'
    ],
    [
        'from' => '/ua/vzroslym/35229-2/',
        'to'   => '/ua/hirurgiya/zagalna-hirurgiya/hirurgichne-likuvannya-mehanichnoyi-zhovtyanici'
    ],
///// 151-170

    [
        'from' => '/vzroslym/35229-2/',
        'to' => '/hirurgiya/zagalna-hirurgiya/hirurgichne-likuvannya-mehanichnoyi-zhovtyanici'
    ],
    [
        'from' => '/magnitoterapiya/',
        'to' => '/aparatna-fizioterapiya/magnitoterapiya'
    ],
    [
        'from' => '/ua/magnitoterapiya/',
        'to' => '/ua/aparatna-fizioterapiya/magnitoterapiya'
    ],
    [
        'from' => '/ua/akczii/',
        'to' => '/ua/akczii-i-speczialnye-predlozheniya'
    ],
    [
        'from' => '/akczii/',
        'to' => '/akczii-i-speczialnye-predlozheniya'
    ],
    [
        'from' => '/ua/detskij-massazh/',
        'to' => '/ua/pediatriya-dityacha/detskij-massazh'
    ],
    [
        'from' => '/detskij-massazh/',
        'to' => '/pediatriya-dityacha/detskij-massazh'
    ],
    [
        'from' => '/ua/reabilitacziya/superindukczijna-sistema-btl/',
        'to' => '/ua/reabilitacziya/spinalna-travma'
    ],
    [
        'from' => '/reabilitacziya/superindukczijna-sistema-btl/',
        'to' => '/reabilitacziya/spinalna-travma'
    ],
    [
        'from' => '/ua/dietolog-2/',
        'to' => '/ua/vzroslym/ginekologiya'
    ],
    [
        'from' => '/dietolog-2/',
        'to' => '/vzroslym/ginekologiya'
    ],
    [
        'from' => '/ua/pressoterapiya/',
        'to' => '/ua/aparatna-fizioterapiya/pressoterapiya'
    ],
    [
        'from' => '/pressoterapiya/',
        'to' => '/aparatna-fizioterapiya/pressoterapiya'
    ],
    [
        'from' => '/ua/vzroslym/rak-shijki-matki/',
        'to' => '/ua/vzroslym/onkoginekologiya/rak-shijki-matki'
    ],
    [
        'from' => '/ua/czentr-semejnogo-zdorovya-i-reabilitaczii-gelios/',
        'to' => '/ua/reabilitacziya'
    ],
    [
        'from' => '/czentr-semejnogo-zdorovya-i-reabilitaczii-gelios/',
        'to' => '/reabilitacziya'
    ],
    [
        'from' => '/ua/vzroslym/speckle-tracking-ehokardiografiya/',
        'to' => '/ua/funkcionalna-diagnostika/ekg-i-ehokg'
    ],
    [
        'from' => '/vzroslym/speckle-tracking-ehokardiografiya/',
        'to' => '/funkcionalna-diagnostika/ekg-i-ehokg'
    ],
    [
        'from' => '/ua/uzt/',
        'to' => '/ua/aparatna-fizioterapiya/uzt'
    ],
    [
        'from' => '/uzt/',
        'to' => '/aparatna-fizioterapiya/uzt'
    ],
/// 171-190
    [
        'from' => '/ua/uzi-tazobedrennyh-sustavov/',
        'to' => '/ua/ultrazvukova-diagnostika/ultrazvukovaya-diagnostika-detej/uzi-tazobedrennyh-sustavov'
    ],
    [
        'from' => '/uzi-tazobedrennyh-sustavov/',
        'to' => '/ultrazvukova-diagnostika/ultrazvukovaya-diagnostika-detej/uzi-tazobedrennyh-sustavov'
    ],
    [
        'from' => '/ua/insult/',
        'to' => '/ua/reabilitacziya/insult'
    ],
    [
        'from' => '/ua/gelios-novomskovsk/semejnaya-mediczina-novomoskovsk/',
        'to' => '/ua/semejnaya-mediczina'
    ],
    [
        'from' => '/gelios-novomskovsk/semejnaya-mediczina-novomoskovsk/',
        'to' => '/semejnaya-mediczina'
    ],
    [
        'from' => '/ua/glavnaya-2/',
        'to' => '/ua/reabilitacziya'
    ],
    [
        'from' => '/glavnaya-2/',
        'to' => '/reabilitacziya'
    ],
    [
        'from' => '/ua/berezen/',
        'to' => '/ua/akczii-i-speczialnye-predlozheniya'
    ],
    [
        'from' => '/berezen/',
        'to' => '/akczii-i-speczialnye-predlozheniya'
    ],
    [
        'from' => '/ua/category/akczii/',
        'to' => '/ua/akczii-i-speczialnye-predlozheniya'
    ],
    [
        'from' => '/category/akczii/',
        'to' => '/akczii-i-speczialnye-predlozheniya'
    ],
    [
        'from' => '/ua/gelios-novomskovsk/nashi-vrachi/',
        'to' => '/ua/nashi-speczialisty'
    ],
    [
        'from' => '/gelios-novomskovsk/nashi-vrachi/',
        'to' => '/nashi-speczialisty'
    ],
    [
        'from' => '/analizy-2/',
        'to' => '/laboratornaya-diagnostika'
    ],
    [
        'from' => '/ua/analizy-2/',
        'to' => '/ua/laboratornaya-diagnostika'
    ],
    [
        'from' => '/ua/gelios-novomskovsk/ehokg/',
        'to' => '/ua/funkcionalna-diagnostika/ekg-i-ehokg'
    ],
    [
        'from' => '/gelios-novomskovsk/ehokg/',
        'to' => '/funkcionalna-diagnostika/ekg-i-ehokg'
    ],
    [
        'from' => '/ua/gelios-novomskovsk/helios-nm/',
        'to' => '/ua'
    ],
    [
        'from' => '/gelios-novomskovsk/helios-nm/',
        'to' => '/'
    ],
    [
        'from' => '/ua/gelios-novomskovsk/uzi/',
        'to' => '/ua/ultrazvukova-diagnostika/uzi-s-elastografiej'
    ],
///// 191-210
    [
        'from' => '/team-member/polevich/',
        'to' => '/ua/team-member/polevich'
    ],
    [
        'from' => '/ua/gelios-novomskovsk/ekg/',
        'to' => '/ua/funkcionalna-diagnostika/ekg-i-ehokg'
    ],
    [
        'from' => '/gelios-novomskovsk/uzi/',
        'to' => '/ultrazvukova-diagnostika'
    ],
    [
        'from' => '/nefrologiya/',
        'to' => '/vzroslym/nefrologiya'
    ],
    [
        'from' => '/vzroslym/vidalennya-analnoї-trishhini/',
        'to' => '/hirurgiya/proktologichn-hirurgiya/vidalennya-analnoyi-trishhini'
    ],
    [
        'from' => '/gematologiya/',
        'to' => '/vzroslym/gematologiya'
    ],
    [
        'from' => '/gelios-novomskovsk/ekg/',
        'to' => '/funkcionalna-diagnostika/ekg-i-ehokg'
    ],
    [
        'from' => '/ua/golovna/',
        'to' => '/ua'
    ],
    [
        'from' => '/ua/gematologiya/',
        'to' => '/ua/vzroslym/gematologiya'
    ],
    [
        'from' => '/ua/vzroslym/operacziyi-pri-spajkovij-hvorobi-2/',
        'to' => '/ua/hirurgiya/hirurgiya-v-mamologiyi/operacziyi-pri-spajkovij-hvorobi-2'
    ],
    [
        'from' => '/ua/nefrologiya/',
        'to' => '/ua/vzroslym/nefrologiya'
    ],
    [
        'from' => '/ua/vzroslym/hirurgichne-likuvannya-mehanichnoyi-zhovtyaniczi-v-dnipri-2/',
        'to' => '/ua/hirurgiya/zagalna-hirurgiya/ambulatorna-hirurgiya/hirurgichne-likuvannya-mehanichnoyi-zhovtyaniczi-v-dnipri'
    ],
    [
        'from' => '/ua/amplipulsterepiya/',
        'to' => '/ua/aparatna-fizioterapiya/amplipulsterapiya'
    ],
    [
        'from' => '/autizm/',
        'to' => '/reabilitacziya/autizm'
    ],
    [
        'from' => '/ua/autizm/',
        'to' => '/ua/reabilitacziya/autizm'
    ],
    [
        'from' => '/team-member/bojko-diana-sergiїvna/',
        'to' => '/team-member/bojko-diana-sergiyivna'
    ],
    [
        'from' => '/team-member/kravchenko-ruslana-andriїvna/',
        'to' => '/team-member/kravchenko-ruslana-andriyivna'
    ],
    [
        'from' => '/reabilitacziya/operovani-suglobi-abo-travmi-verhnoї-kinczivki/',
        'to' => '/reabilitacziya/operovani-suglobi-abo-travmi-verhnoyi-kinczivki'
    ],
    [
        'from' => '/ua/reabilitacziya/operovani-suglobi-abo-travmi-nizhnoї-kinczivki/',
        'to' => '/ua/reabilitacziya/operovani-suglobi-abo-travmi-nizhnoyi-kinczivki'
    ],
    [
        'from' => '/team-member/єmecz-marina-mikolaїvna/',
        'to' => '/team-member/yemecz-marina-mikolayivna'
    ],
/// 211-230

    [
        'from' => '/team-member/ignatyuk-єvgeniya-vasilivna/',
        'to' => '/team-member/ignatyuk-yevgeniya-vasilivna'
    ],
    [
        'from' => '/ua/vzroslym/operatyvne-likuvannya-dyvertykulyarnoyi-hvoroby-tovstoyi-kyshky/',
        'to' => '/ua/hirurgiya/zagalna-hirurgiya/operativne-likuvannya-divertikulyarnoyi-hvorobi-tovstoyi-kishki'
    ],
    [
        'from' => '/ua/vzroslym/operacziї-pri-spajkovij-hvorobi-2/',
        'to' => '/ua/hirurgiya/hirurgiya-v-mamologiyi/operacziyi-pri-spajkovij-hvorobi-2'
    ],
    [
        'from' => '/reabilitacziya/operovani-suglobi-abo-travmi-nizhnoї-kinczivki/',
        'to' => '/reabilitacziya/operovani-suglobi-abo-travmi-nizhnoyi-kinczivki'
    ],
    [
        'from' => '/team-member/sirenko-oksana-yuriїvna/',
        'to' => '/team-member/sirenko-oksana-yuriyivna'
    ],
    [
        'from' => '/vzroslym/operativne-likuvannya-divertikulyarno%d1%97-hvorobi-tovsto%d1%97-kishki/',
        'to' => '/hirurgiya/zagalna-hirurgiya/operativne-likuvannya-divertikulyarnoyi-hvorobi-tovstoyi-kishki'
    ],
    [
        'from' => '/ua/vzroslym/operacziї-pri-spajkovij-hvorobi/',
        'to' => '/ua/hirurgiya/zagalna-hirurgiya/operacziyi-pri-spajkovij-hvorobi'
    ],
    [
        'from' => '/team-member/kulєshova-marina-andriїvna/',
        'to' => '/team-member/kulyeshova-marina-andriyivna'
    ],
    [
        'from' => '/ua/reabilitacziya/operovani-suglobi-abo-travmi-verhnoї-kinczivki/',
        'to' => '/ua/reabilitacziya/operovani-suglobi-abo-travmi-verhnoyi-kinczivki'
    ],
    [
        'from' => '/team-member/minchuk-єvgeniya-anatoliїvna/',
        'to' => '/team-member/minchuk-yevgeniya-anatoliyivna'
    ],
    [
        'from' => '/ua/vzroslym/vidalennya-analnoї-trishhini/',
        'to' => '/ua/hirurgiya/proktologichn-hirurgiya/vidalennya-analnoyi-trishhini'
    ],
    [
        'from' => '/ua/vzroslym/hirurgichne-likuvannya-mehanichnoї-zhovtyaniczi-v-dnipri/',
        'to' => '/ua/hirurgiya/zagalna-hirurgiya/ambulatorna-hirurgiya/hirurgichne-likuvannya-mehanichnoyi-zhovtyaniczi-v-dnipri'
    ],
    [
        'from' => '/reabilitacziya/sistema-dekompresi%D1%97-hrebta/',
        'to' => '/reabilitacziya'
    ],
    [
        'from' => '/ua/reabilitacziya/sistema-dekompresiyi-hrebta/',
        'to' => '/ua/reabilitacziya'
    ],
    [
        'from' => '/ua/alergologiya/',
        'to' => '/ua/vzroslym/allergologiya'
    ],
    [
        'from' => '/ua/detskaya-gematologiya/',
        'to' => '/ua/pediatriya-dityacha'
    ],
    [
        'from' => '/ua/vzroslym/hirurgichne-likuvannya-vyrazky-shlunku-v-dnipri/',
        'to' => '/ua/hirurgiya/zagalna-hirurgiya/hirurgichne-likuvannya-virazki-shlunku-v-dnipri'
    ],
    [
        'from' => '/ua/vzroslym/vidalennya-analnoyi-trishhini/',
        'to' => '/ua/hirurgiya/proktologichn-hirurgiya/vidalennya-analnoyi-trishhini'
    ],
    [
        'from' => '/ua/vzroslym/hirurgichne-likuvannya-zhkb/',
        'to' => '/ua/hirurgiya/zagalna-hirurgiya/hirurgicheskoe-lechenie-zhkb'
    ],
    [
        'from' => '/team-member/postupinskij-sergej-sergeevich/',
        'to' => '/team-member/postupinskij-sergij-sergijovich'
    ],
    [
        'from' => '/ua/team-member/guzenko-nataliya-valeriyivna/',
        'to' => '/ua/team-member/guzenko-nataliya-valeriyivna'
    ],
    [
        'from' => '/ua/uzi-s-elastografiej/',
        'to' => '/ua/ultrazvukova-diagnostika/uzi-s-elastografiej'
    ],
    [
        'from' => '/uzi-s-elastografiej/',
        'to' => '/ultrazvukova-diagnostika/uzi-s-elastografiej'
    ],
    [
        'from' => '/ua/hymyoterapia/',
        'to' => '/ua/vzroslym/onkologiya/hymyoterapia'
    ],
    [
        'from' => '/hymyoterapia/',
        'to' => '/vzroslym/onkologiya/hymyoterapia'
    ],
    [
        'from' => '/dlya-paczientov/zapisatsya-na-priem-k-mammologu-onkologu/',
        'to' => '/vzroslym/mammologiya'
    ],
    [
        'from' => '/ua/dlya-paczientov/zapisatsya-na-priem-k-mammologu-onkologu/',
        'to' => '/ua/vzroslym/mammologiya'
    ],

//// 231-257
];

if (!empty($items)) {
    foreach ($items as $item) {
        Route::get($item['from'], function () use ($item) {
            return redirect()->away(config('app.url') . $item['to'], 301);
        })->withoutMiddleware('trimSlash');
    }
}
