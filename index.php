<?php

@include_once __DIR__ . '/vendor/autoload.php';

if(!class_exists('SylvainJule\Embed')) {
    require_once __DIR__ . '/lib/embed.php';
}
if(!class_exists('SylvainJule\EmbedField')) {
    require_once __DIR__ . '/lib/embedField.php';
}

Kirby::plugin('sylvainjule/embed', [
    'options' => [
        'nocookie' => false,
    ],
	'fields'       => require_once __DIR__ . '/lib/fields.php',
    'fieldMethods' => require_once __DIR__ . '/lib/fieldMethods.php',
    'siteMethods'  => require_once __DIR__ . '/lib/siteMethods.php',
    'api'          => require_once __DIR__ . '/lib/api.php',
    'translations' => array(
        'en' => require_once __DIR__ . '/lib/languages/en.php',
        'fr' => require_once __DIR__ . '/lib/languages/fr.php',
    ),
]);
