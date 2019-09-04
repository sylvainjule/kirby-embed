<?php

use Kirby\Cms\Content;

return array(
    'toEmbed' => function($field) {
        // allows if($embed = $page->myfield()->toEmbed()) { echo $embed->code() }
        if($field->isEmpty() || !count(Yaml::decode($field->value)) || empty($field->yaml()['media'])) {
            return null;
        }
        $content = new Content($field->yaml()['media'], $field->parent());
        return $content;
    },
);
