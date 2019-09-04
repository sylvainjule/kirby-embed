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
                            $dispatcher = new Embed\Http\CurlDispatcher();
                            $options = \Embed\Embed::$default_config;
                            $options['min_image_width']         = option('sylvainjule.embed.min_image_width');
                            $options['min_image_height']        = option('sylvainjule.embed.min_image_height');
                            $options['html']['max_images']      = option('sylvainjule.embed.max_images');
                            $options['html']['external_images'] = option('sylvainjule.embed.external_images');

                            $media = Embed\Embed::create($url, $options, $dispatcher);

                            $response['status'] = 'success';
                            $response['data']   = array(
                                'title'         => $media->title,
                                'description'   => $media->description,
                                'url'           => $media->url,
                                'type'          => $media->type,
                                'tags'          => $media->tags,
                                'image'         => $media->image,
                                'imageWidth'    => $media->imageWidth,
                                'imageHeight'   => $media->imageHeight,
                                'images'        => $media->images,
                                'code'          => $media->code,
                                'feeds'         => $media->feeds,
                                'width'         => $media->width,
                                'height'        => $media->height,
                                'aspectRatio'   => $media->aspectRatio,
                                'authorName'    => $media->authorName,
                                'authorUrl'     => $media->authorUrl,
                                'providerIcon'  => $media->providerIcon,
                                'providerIcons' => $media->providerIcons,
                                'providerName'  => $media->providerName,
                                'providerUrl'   => $media->providerUrl,
                                'publishedTime' => $media->publishedTime,
                                'license'       => $media->license,
                            );
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
