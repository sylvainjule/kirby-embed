<?php

require_once __DIR__ . '/vendor/autoload.php';

Kirby::plugin('sylvainjule/oembed', [
	'fields' => array(
		'oembed' => require_once __DIR__ . '/lib/oembed.php',
	),
    'api' => array(
        'routes' => function ($kirby) {
            return [
                [
                    'pattern' => 'kirby-oembed/get-data',
                    'action' => function() {
                        $response = [];

                        try {
                            $url = get('url');
                            $essence = new Essence\Essence();
                            $data = $essence->extract($url);

                            $response['status'] = 'success';
                            $response['data']   = $data;
                        }
                        catch (Exception $e) {
                            $response['status'] = 'error';
                            $response['error']  = $e->getMessage();
                        }

                        return $response;
                    }
                ],
            ];
        }
    )
]);
