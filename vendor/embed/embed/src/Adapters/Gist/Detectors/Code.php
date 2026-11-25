<?php
declare(strict_types = 1);

namespace Embed\Adapters\Gist\Detectors;

use Embed\Detectors\Code as Detector;
use Embed\EmbedCode;
use function Embed\html;

/**
 * @extends Detector<\Embed\Adapters\Gist\Extractor>
 */
class Code extends Detector
{
    public function detect(): ?EmbedCode
    {
        $parentResult = parent::detect();
        return $parentResult !== null ? $parentResult : $this->fallback();
    }

    private function fallback(): ?EmbedCode
    {
        $api = $this->extractor->getApi();

        $code = $api->html('div');
        $stylesheet = $api->str('stylesheet');

        if ($code !== null && $stylesheet !== null) {
            return new EmbedCode(
                html('link', ['rel' => 'stylesheet', 'href' => $stylesheet]).$code
            );
        }

        return null;
    }
}
