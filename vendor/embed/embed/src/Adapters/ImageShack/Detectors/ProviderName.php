<?php
declare(strict_types = 1);

namespace Embed\Adapters\ImageShack\Detectors;

use Embed\Detectors\ProviderName as Detector;

/**
 * @extends Detector<\Embed\Adapters\ImageShack\Extractor>
 */
class ProviderName extends Detector
{
    public function detect(): string
    {
        return 'ImageShack';
    }
}
