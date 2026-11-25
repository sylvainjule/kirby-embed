<?php
declare(strict_types = 1);

namespace Embed\Adapters\Archive\Detectors;

use Embed\Detectors\Description as Detector;

/**
 * @extends Detector<\Embed\Adapters\Archive\Extractor>
 */
class Description extends Detector
{
    public function detect(): ?string
    {
        $api = $this->extractor->getApi();

        $result = $api->str('metadata', 'extract');
        return (is_string($result) && trim($result) !== '') ? $result : parent::detect();
    }
}
