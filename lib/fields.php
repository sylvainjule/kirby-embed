<?php

return array(
    'embed' => array(
        'extends' => 'url',
        'computed' => array(
            'value' => function() {
                $yaml = Yaml::decode($this->value);
                return count($yaml) ? $yaml : $this->value;
            },
        )
    )
);
