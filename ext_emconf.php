<?php

$EM_CONF[$_EXTKEY] = [
    'version'                       => '1.2.7',
    'title'                         => 'IwImmo',
    'description'                   => 'Immowelt Extension',
    'category'                      => 'plugin',
    'state'                         => 'stable',
    'author'                        => 'Immowelt AG',
    'author_email'                  => 'support@immowelt.de',
    'author_company'                => 'Immowelt AG',
    'constraints'                   => [
        'depends'   => [
            'typo3'        => '9.5.0-10.5.99',
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'IWAG\\IwImmo\\' => 'Classes',
        ],
    ],
];
