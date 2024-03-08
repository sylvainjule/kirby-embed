<?php

return array(
    'embed' => array(
        'extends' => 'url',
        'props' => array(
            'provider' > function($provider = null) {
                return $provider;
            },
            'icons' > function($icons = false) {
                return $icons;
            },
        ),
        'computed' => array(
            'value' => function() {
                $yaml = Yaml::decode($this->value);
                return count($yaml) ? $yaml : $this->value;
            },
        ),
        'validations' => null
    )
);
