<?php

namespace App\Components\Encore;

class EncoreService
{

    /** @var string */
    private $outDir;

    /** @var string */
    private $defaultEntry;

    public function __construct($outDir, $defaultEntry = 'index')
    {
        $this->outDir = $outDir;
        $this->defaultEntry = $defaultEntry;

    }

    public function getDefaultEntry() {
        return $this->defaultEntry;
    }

    public function getOutDir() {
        return $this->outDir;
    }
}