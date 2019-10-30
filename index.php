<?php

@include_once __DIR__ . '/vendor/autoload.php';

Kirby::plugin('sylvainjule/embed', [
    'options' => array(
        'min_image_width'  => 60,
        'min_image_height' => 60,
        'max_images'       => 10,
        'external_images'  => false,
    ),
	'fields'       => require_once __DIR__ . '/lib/fields.php',
    'fieldMethods' => require_once __DIR__ . '/lib/fieldMethods.php',
    'api'          => require_once __DIR__ . '/lib/api.php',
    'translations' => array(
        'en' => require_once __DIR__ . '/lib/languages/en.php',
        'fr' => require_once __DIR__ . '/lib/languages/fr.php',
    ),
]);
