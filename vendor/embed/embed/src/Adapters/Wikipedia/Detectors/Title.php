<?php
declare(strict_types = 1);

namespace Embed\Adapters\Wikipedia\Detectors;

use Embed\Adapters\Wikipedia\Extractor;
use Embed\Detectors\Title as Detector;

/**
 * @extends Detector<\Embed\Adapters\Wikipedia\Extractor>
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
