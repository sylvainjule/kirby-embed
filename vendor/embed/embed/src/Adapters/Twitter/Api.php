<?php
declare(strict_types = 1);

namespace Embed\Adapters\Twitter;

use function Embed\getDirectory;
use Embed\HttpApiTrait;

class Api
{
    use HttpApiTrait;

    protected function fetchData(): array
    {
        $token = $this->extractor->getSetting('twitter:token');

        if (!$token) {
            return [];
        }
        
        $uri = $this->extractor->getUri();

        $id = getDirectory($uri->getPath(), 2);

        if (empty($id)) {
            return [];
        }

        $this->extractor->getCrawler()->addDefaultHeaders(array('Authorization' => "Bearer $token"));
        $this->endpoint = $this->extractor->getCrawler()->createUri("https://api.twitter.com/2/tweets/{$id}?expansions=author_id,attachments.media_keys&tweet.fields=created_at&media.fields=preview_image_url,url&user.fields=id,name");

        return $this->fetchJSON($this->endpoint);
    }
}
