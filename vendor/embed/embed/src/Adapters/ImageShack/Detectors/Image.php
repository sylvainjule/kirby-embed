<?php
declare(strict_types = 1);

namespace Embed\Adapters\ImageShack\Detectors;

use Embed\Detectors\Image as Detector;
use Psr\Http\Message\UriInterface;

/**
 * @extends Detector<\Embed\Adapters\ImageShack\Extractor>
 */
class Image extends Detector
{
    public function detect(): ?UriInterface
    {
        $api = $this->extractor->getApi();

        $result = $api->url('direct_link');
        return $result !== null ? $result : parent::detect();
    }
}
