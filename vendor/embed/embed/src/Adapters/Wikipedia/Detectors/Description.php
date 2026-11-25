<?php
declare(strict_types = 1);

namespace Embed\Adapters\Wikipedia\Detectors;

use Embed\Detectors\Description as Detector;

/**
 * @extends Detector<\Embed\Adapters\Wikipedia\Extractor>
 */
class Description extends Detector
{
    public function detect(): ?string
    {
        $api = $this->extractor->getApi();

        $result = $api->str('extract');
        return (is_string($result) && trim($result) !== '') ? $result : parent::detect();
    }
}
