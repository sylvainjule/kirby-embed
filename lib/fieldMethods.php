<?php

use Kirby\Cms\Content;
use SylvainJule\Embed as EmbedHelper;

return array(
    'toEmbed' => function($field) {
        // allows if($embed = $page->myfield()->toEmbed()) { echo $embed->code() }
        if($field->isEmpty() || !count(Yaml::decode($field->value)) || empty($field->yaml()['media'])) {
            return null;
        }

        $media = $field->yaml()['media'];
        if(array_key_exists('code', $media)) {
            $media['code'] = EmbedHelper::applyPrivacy($media['code']);
        }

        return new Content($media, $field->parent());
    },
);
