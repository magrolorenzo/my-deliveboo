<?php

return [
    'restaurantsArray' => [
        1 => [
            'name' => 'Osteria Canaiolo',
            'address' => 'Via Pesciatina, 192',
            'piva' => '33646480567',
            'img_cover' => 'osteria-canaiolo.jpg',
            'categories_id' => [1, 7],
            'dishes' => [
                [
                    'name' => 'Polpo e patate',
                    'ingredients' => 'polpo, patate, olio di oliva, prezzemolo',
                    'description' => 'Gustoso antipasto di mare con polpo verace a doppia cottura su crema di patate condita con citronette al prezzemolo.',
                    'unit_price' => 10,
                    'visible' => 1,
                    'img_cover' => 'polpo-e-patate.jpg'
                ],
                [
                    'name' => 'Salmone al nero di seppia',
                    'ingredients' => 'salmone, nero di seppia, prezzemolo, ravanello',
                    'description' => 'Gustoso antipasto di mare con salmone al nero di seppia su salsa al prezzemolo e ravanelli.',
                    'unit_price' => 10,
                    'visible' => 1,
                    'img_cover' => 'salmone-al-nero-di-seppia.jpg'
                ],
                [
                    'name' => 'Tonno tataki emulsione allo ravanello e erbette',
                    'ingredients' => 'tonno, sesamo, ravanello, erbette, aceto, soia, miele, zenzero',
                    'description' => 'Il tataki di tonno è una ricetta di origine giapponese, che consiste in tonno al sesamo marinato in una salsa creata con aceto, salsa di soia, miele, zenzero e wasabi.
                    Il tonno viene cotto velocemente in padella e accompagnato con la salsa ed un emulsione di ravanello ed erbette di campo.',
                    'unit_price' => 15,
                    'visible' => 1,
                    'img_cover' => 'tataki-di-tonno.jpg'
                ],
                [
                    'name' => 'Tartar di manzo, carciofo alla romana e tuorlo confit',
                    'ingredients' => 'carne di manzo, carciofi, uovo',
                    'description' => 'Carne di manzo freschissima, scamone o lombata, tagliata al coltello servita con tuorlo d\'uovo marinato ed accompagnata con carciofo alla romana.',
                    'unit_price' => 15,
                    'visible' => 1,
                    'img_cover' => 'tartare-uovo-confit.jpg'
                ],
                [
                    'name' => 'Mousse alla castagna',
                    'ingredients' => 'castagne, uova, latte, zucchero, panna',
                    'description' => 'Dolce al cucchiaio soffice e spumoso a base di castagne.',
                    'unit_price' => 5,
                    'visible' => 1,
                    'img_cover' => 'mousse-di-castagne.jpg'
                ],
            ]
        ],
        2 => [
            'name' => 'Ristorante Greco Delogo',
            'address' => 'Via Giovanna Zaccherini Alvisi 19/d',
            'piva' => '10400430061',
            'img_cover' => 'ristorante-greco-delogo.jpg',
            'categories_id' => [9],
            'dishes' => [
                [
                    'name' => 'Tzatziki',
                    'ingredients' => 'yogurt, cetrioli, aglio, olio',
                    'description' => 'Salsa a base di yogurt.',
                    'unit_price' => 3.5,
                    'visible' => 1,
                    'img_cover' => 'Tzatziki.jpg'
                ],
                [
                    'name' => 'Gemista',
                    'ingredients' => 'pomodori, peperoni, melanzane riso e spezie',
                    'description' => 'Verdure varie (pomodori, peperoni, melanzane e zucchini) ripieni di riso e spezie.',
                    'unit_price' => 8,
                    'visible' => 1,
                    'img_cover' => 'gemista.jpg'
                ],
                [
                    'name' => 'Moussakà',
                    'ingredients' => 'melanzane, carne macinata, patate e besciamella',
                    'description' => 'La moussakà è un piatto tipico della cucina greca, balcanica e medio-orientale affine alla parmigiana di melanzane. Si tratta di uno sformato a base di melanzane, patate e carne tritata in diversi strati, cotto in forno, guarnito con una spessa copertura di besciamella.',
                    'unit_price' => 9,
                    'visible' => 1,
                    'img_cover' => 'moussaka.jpg'
                ],
                [
                    'name' => 'Souvlaki',
                    'ingredients' => 'carne di maiale e di pollo',
                    'description' => 'Il souvlaki è un popolare fast food greco costituito da carne e, a volte, verdura, grigliate su di uno spiedino. Viene servito sullo spiedino o come panino in una pita.
                    Il piatto viene accompagnato da salsa tzatziki.',
                    'unit_price' => 9,
                    'visible' => 1,
                    'img_cover' => 'souvlaki.jpg'
                ],
                [
                    'name' => 'Xifias suvlaki',
                    'ingredients' => 'pesce',
                    'description' => 'Il souvlaki è un popolare fast food greco costituito da carne e, a volte, verdura, grigliate su di uno spiedino. In questa versione viene utilizzato il pesce spada marinato e cotto alla griglia. Viene servito sullo spiedino o come panino in una pita.
                    Il piatto viene accompagnato da salsa tzatziki.',
                    'unit_price' => 13,
                    'visible' => 1,
                    'img_cover' => 'Xifias-souvlaki.jpg'
                ],
            ]
        ],
        3 => [
            'name' => 'Siam Thai Restaurant',
            'address' => 'Via Del Palazzo dei Diavoli 53/B',
            'piva' => '78430250692',
            'img_cover' => 'siam-thai.jpg',
            'categories_id' => [2, 5, 10],
            'dishes' => [
                [
                    'name' => 'Tzatziki',
                    'ingredients' => 'yogurt, cetrioli, aglio, olio',
                    'description' => 'Salsa a base di yogurt.',
                    'unit_price' => 3.5,
                    'visible' => 1,
                    'img_cover' => 'Tzatziki.jpg'
                ],
            ]
        ],
        4 => [
            'name' => 'Anatolia Kebap da Hasan',
            'address' => 'Via Giosue Carducci 49 A',
            'piva' => '39285210744',
            'img_cover' => 'kebab-anatolia.jpg',
            'categories_id' => [6, 7, 8],
            'dishes' => [

            ]
        ],
        5 => [
            'name' => 'Serendepico',
            'address' => 'Via della Chiesa di Gragnano 36',
            'piva' => '56720810052',
            'img_cover' => 'serendepico.jpg',
            'categories_id' => [1, 3, 5],
            'dishes' => [

            ]
        ],
        6 => [
            'name' => 'Nishiki Koi Sushi & Fusion',
            'address' => 'Via Volturno 23',
            'piva' => '36122200540',
            'img_cover' => 'nishiki-koi.webp',
            'categories_id' => [2, 3, 5, 10],
            'dishes' => [

            ]
        ],
        7 => [
            'name' => 'Haveli Indian Restaurant',
            'address' => 'Viale Fratelli Rosselli 31/33r',
            'piva' => '75145730828',
            'img_cover' => 'haveli-indian.jpg',
            'categories_id' => [4, 5, 10],
            'dishes' => [

            ]
        ],
        8 => [
            'name' => 'Il Boccale',
            'address' => 'Via Pesciatina 173',
            'piva' => '78260200510',
            'img_cover' => 'il-boccale.jpg',
            'categories_id' => [1, 5, 6],
            'dishes' => [

            ]
        ],
        9 => [
            'name' => 'Il Boccale',
            'address' => 'Borgo Santi Apostoli 33/R',
            'piva' => '64790870824',
            'img_cover' => 'il-boccale-firenze.jpg',
            'categories_id' => [1, 6, 7],
            'dishes' => [

            ]
        ],
        10 => [
            'name' => 'Carpe Diem',
            'address' => 'Via D\'Azeglio 69',
            'piva' => '40412420735',
            'img_cover' => 'carpe-diem.jpg',
            'categories_id' => [5, 6, 7, 8],
            'dishes' => [

            ]
        ],
        11 => [
            'name' => 'Alas le Delizie Greche',
            'address' => 'Via Camillo Benso Cavour 32',
            'piva' => '13355740054',
            'img_cover' => 'alas-le-delizie-greche.jpg',
            'categories_id' => [9],
            'dishes' => [

            ]
        ],
        12 => [
            'name' => 'Dioniso',
            'address' => 'Via San Gallo 16/r',
            'piva' => '56892280266',
            'img_cover' => 'ristorante-greco-dioniso.jpg',
            'categories_id' => [6, 9],
            'dishes' => [

            ]
        ],
        13 => [
            'name' => 'Pizzeria - Trattoria da Benito',
            'address' => 'Via Mart. Libertà, 2',
            'piva' => '58575120595',
            'img_cover' => 'da-benito.jpg',
            'categories_id' => [1, 7],
            'dishes' => [

            ]
        ],
        14 => [
            'name' => 'Oishi',
            'address' => 'Via del Fonditore 239',
            'piva' => '58616390595',
            'img_cover' => 'oishi-ristorante-follonica.jpg',
            'categories_id' => [2, 3, 5, 10],
            'dishes' => [

            ]
        ],
    ],
];
