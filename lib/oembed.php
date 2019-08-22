<?php

return [
    'extends' => 'url',
    'computed' => [
        'value' => function() {
            $yaml = Yaml::decode($this->value);
            return count($yaml) ? $yaml : $this->value;
        }
    ]
];
