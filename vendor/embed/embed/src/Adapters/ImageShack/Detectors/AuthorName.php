<?php
declare(strict_types = 1);

namespace Embed\Adapters\ImageShack\Detectors;

use Embed\Adapters\ImageShack\Extractor;
use Embed\Detectors\AuthorName as Detector;

/**
 * @extends Detector<\Embed\Adapters\ImageShack\Extractor>
 */
class AuthorName extends Detector
{
    public function detect(): ?string
    {
        $api = $this->extractor->getApi();

        $result = $api->str('owner', 'username');
        return (is_string($result) && trim($result) !== '') ? $result : parent::detect();
    }
}
