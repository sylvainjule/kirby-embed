<?php
declare(strict_types = 1);

namespace Embed\Detectors;

use Embed\Extractor;

/**
 * @template TExtractor of Extractor
 */
abstract class Detector
{
    /** @var TExtractor */
    protected Extractor $extractor;
    /** @var array<string, mixed> */
    private array $cache = [];

    /**
     * @param TExtractor $extractor
     */
    public function __construct(Extractor $extractor)
    {
        $this->extractor = $extractor;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        if (!isset($this->cache['cached'])) {
            $this->cache = [
                'cached' => true,
                'value' => $this->detect(),
            ];
        }

        return $this->cache['value'];
    }

    /**
     * @return mixed
     */
    abstract public function detect();
}
