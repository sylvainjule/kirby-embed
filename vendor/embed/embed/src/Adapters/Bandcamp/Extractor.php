<?php
declare(strict_types = 1);

namespace Embed\Adapters\Bandcamp;

use Embed\Extractor as Base;

/**
 * @template-extends Base<\Embed\Detectors\Detector<self>>
 */
class Extractor extends Base
{
    public function createCustomDetectors(): array
    {
        return [
            'providerName' => new Detectors\ProviderName($this),
        ];
    }
}
