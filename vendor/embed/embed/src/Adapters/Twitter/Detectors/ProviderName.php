<?php
declare(strict_types = 1);

namespace Embed\Adapters\Twitter\Detectors;

use Embed\Detectors\ProviderName as Detector;

/**
 * @extends Detector<\Embed\Adapters\Twitter\Extractor>
 */
class ProviderName extends Detector
{
    public function detect(): string
    {
        return 'Twitter';
    }
}
