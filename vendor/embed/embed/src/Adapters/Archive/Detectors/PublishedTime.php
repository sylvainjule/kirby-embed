<?php
declare(strict_types = 1);

namespace Embed\Adapters\Archive\Detectors;

use DateTime;
use Embed\Detectors\PublishedTime as Detector;

/**
 * @extends Detector<\Embed\Adapters\Archive\Extractor>
 */
class PublishedTime extends Detector
{
    public function detect(): ?DateTime
    {
        $api = $this->extractor->getApi();

        $fields = ['publicdate', 'addeddate', 'date'];
        foreach ($fields as $field) {
            $result = $api->time('metadata', $field);
            if ($result !== null) {
                return $result;
            }
        }

        return parent::detect();
    }
}
