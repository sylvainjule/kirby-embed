<?php

return array(
    'routes' => function ($kirby) {
        return array(
            array(
                'pattern' => 'kirby-embed/get-data',
                'action' => function () {
                    return kirby()->site()->getEmbedData(get('url'));
                }
            ),
        );
    },
);
