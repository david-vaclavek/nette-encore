<?php

namespace App\Components\Encore;

use Nette\Application\UI\Control;

interface IEncoreLoader
{
    /** @return EncoreLoader */
    public function create();
}