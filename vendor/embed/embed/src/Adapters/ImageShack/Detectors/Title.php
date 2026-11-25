<?php
declare(strict_types = 1);

namespace Embed\Adapters\ImageShack\Detectors;

use Embed\Detectors\Title as Detector;

/**
 * @extends Detector<\Embed\Adapters\ImageShack\Extractor>
 */
class Title extends Detector
{
    public function detect(): ?string
    {
        $api = $this->extractor->getApi();

        $result = $api->str('title');
        return (is_string($result) && trim($result) !== '') ? $result : parent::detect();
    }
}
