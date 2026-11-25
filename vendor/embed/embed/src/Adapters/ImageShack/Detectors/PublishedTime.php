<?php
declare(strict_types = 1);

namespace Embed\Adapters\ImageShack\Detectors;

use DateTime;
use Embed\Adapters\ImageShack\Extractor;
use Embed\Detectors\PublishedTime as Detector;

/**
 * @extends Detector<\Embed\Adapters\ImageShack\Extractor>
 */
class PublishedTime extends Detector
{
    public function detect(): ?DateTime
    {
        $api = $this->extractor->getApi();

        $result = $api->time('creation_date');
        return $result !== null ? $result : parent::detect();
    }
}
