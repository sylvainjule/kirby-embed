<?php

return array(
    'routes' => function ($kirby) {
        return array(
            array(
                'pattern' => 'kirby-embed/get-data',
                'action' => function() {
                    $response = [];
                    $url = get('url');

                    if(!V::url($url)) {
                        $response['status'] = 'error';
                        $response['error']  = 'The $url variable is not an url';
                    }
                    else {
                        try {
                            $client = new Embed\Http\CurlClient();
                            $options = [];
                            $options['min_image_width']         = option('sylvainjule.embed.min_image_width');
                            $options['min_image_height']        = option('sylvainjule.embed.min_image_height');
                            $options['html']['max_images']      = option('sylvainjule.embed.max_images');
                            $options['html']['external_images'] = option('sylvainjule.embed.external_images');

                            $embed = new Embed\Embed();
                            $embed->setSettings($options);
                            $media = $embed->get($url)->getOEmbed();

                            $response['status'] = 'success';
                            $response['data']   = $media->all();

                        }
                        catch (Exception $e) {
                            $response['status'] = 'error';
                            $response['error']  = $e->getMessage();
                        }
                    }

                    return $response;
                }
            ),
        );
    }
);
