<?php
declare(strict_types = 1);

namespace Embed\Adapters\Gist\Detectors;

use DateTime;
use Embed\Detectors\PublishedTime as Detector;

/**
 * @extends Detector<\Embed\Adapters\Gist\Extractor>
 */
class PublishedTime extends Detector
{
    public function detect(): ?DateTime
    {
        $api = $this->extractor->getApi();

        $result = $api->time('created_at');
        return $result !== null ? $result : parent::detect();
    }
}
