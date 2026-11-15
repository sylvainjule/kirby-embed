<?php

use Kirby\Content\Content;
use Kirby\Data\Yaml;
use SylvainJule\Embed as EmbedHelper;

return [
    'toEmbed' => function ($field) {
        if($field->isEmpty()) {
            return null;
        }

        try {
            $data = Yaml::decode($field->value());
        } 
        catch (\Throwable $error) {
            return null;
        }

        if(empty($data['media']) || !is_array($data['media'])) {
            return null;
        }

        $media = $data['media'];

        if(array_key_exists('code', $media)) {
            $media['code'] = EmbedHelper::applyPrivacy($media['code']);
        }

        return new Content($media, $field->parent());
    },
];
