<?php

namespace App\Components\Encore;

use App\Forms\SignIn;
use Nette\Application\UI\Control;

class EncoreLoader extends Control
{
    /** @var EncoreService */
    private $encoreService;

    public function __construct(EncoreService $encoreService)
    {
        $this->encoreService = $encoreService;
    }

    public function renderCss($entry = null) {
        $this->template->files = $this->getFiles('css', $entry);
        $this->template->setFile(__DIR__ . '/css.latte');
        $this->template->render();
    }

    public function renderJs($entry = null)
    {
        $this->template->files = $this->getFiles('js', $entry);
        $this->template->setFile(__DIR__ . '/js.latte');
        $this->template->render();
    }

    private function getEntryPoints()
    {
        $path = $this->encoreService->getOutDir().'entrypoints.json';
        if (file_exists($path)) {
            $content = json_decode(file_get_contents($path), true);
            if (!isset($content['entrypoints'])) {
                return [];
            }
            return $content['entrypoints'];
        }
        return [];
    }

    private function getFiles(string $type, $entry = null)
    {
        $entryPoints = self::getEntryPoints();

        if ($entry == null) {
            $entry = $this->encoreService->getDefaultEntry();
        }


        if (!isset($entryPoints[$entry][$type])) {
            return [];
        }


        return $entryPoints[$entry][$type];
    }

}