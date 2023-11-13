<?php

@include_once __DIR__ . '/vendor/autoload.php';

Kirby::plugin('sylvainjule/embed', [
	'fields'       => require_once __DIR__ . '/lib/fields.php',
    'fieldMethods' => require_once __DIR__ . '/lib/fieldMethods.php',
    'siteMethods'  => require_once __DIR__ . '/lib/siteMethods.php',
    'api'          => require_once __DIR__ . '/lib/api.php',
    'translations' => array(
        'en' => require_once __DIR__ . '/lib/languages/en.php',
        'fr' => require_once __DIR__ . '/lib/languages/fr.php',
    ),
]);
