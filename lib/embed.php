<?php

namespace SylvainJule;

use Kirby\Toolkit\Dom;

class Embed {
    public static function applyPrivacy($html) {
        if(!is_string($html) || $html === '' || stripos($html, '<iframe') === false) {
            return $html;
        }

        $nocookie = option('sylvainjule.embed.nocookie', false);
        $dom      = new Dom($html);
        $modified = false;

        foreach($dom->query('//iframe[@src]') as $iframe) {
            $src = $iframe->getAttribute('src');
            $url = parse_url($src);

            if($url === false) { continue; }

            $host     = strtolower($url['host'] ?? '');
            $path     = $url['path'] ?? '';
            $fragment = isset($url['fragment']) ? '#' . $url['fragment'] : '';

            if($nocookie && in_array($host, ['youtube.com', 'www.youtube.com'], true) && str_starts_with($path, '/embed/')) {
                $newSrc = 'https://www.youtube-nocookie.com' . $path;

                if(isset($url['query'])) {
                    $newSrc .= '?' . $url['query'];
                }

                $iframe->setAttribute('src', $newSrc . $fragment);
                $modified = true;
            }
            if($host === 'player.vimeo.com' && str_starts_with($path, '/video/')) {
                if($iframe->getAttribute('referrerpolicy') !== 'strict-origin-when-cross-origin') {
                    $iframe->setAttribute('referrerpolicy', 'strict-origin-when-cross-origin');
                    $modified = true;
                }

                if($nocookie) {
                    parse_str($url['query'] ?? '', $params);

                    if(($params['dnt'] ?? null) !== '1') {
                        $params['dnt'] = '1';

                        $newSrc = 'https://player.vimeo.com' . $path;
                        $newSrc .= '?' . http_build_query($params, '', '&', PHP_QUERY_RFC3986);
                        $newSrc .= $fragment;

                        $iframe->setAttribute('src', $newSrc);
                        $modified = true;
                    }
                }
            }
        }

        return $modified ? $dom->toString() : $html;
    }
}
