<?php
declare(strict_types = 1);

namespace Embed\Adapters\Twitter\Detectors;

use DateTime;
use Embed\Adapters\Twitter\Extractor;
use Embed\Detectors\PublishedTime as Detector;

/**
 * @extends Detector<\Embed\Adapters\Twitter\Extractor>
 */
class PublishedTime extends Detector
{
    public function detect(): ?DateTime
    {
        $api = $this->extractor->getApi();

        $result = $api->time('data', 'created_at');
        return $result !== null ? $result : parent::detect();
    }
}
