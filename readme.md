# Nette Encore
Macros and components for integration of Encore into Nette project. 

## Install
```
Download the code from a repository and place it in /app folder. 
```
## Usage
1 . Register extension as a service and define the properties.
 
```config
services:
...

#Encore
	- App\Components\Encore\IEncoreLoader
	- App\Components\Encore\EncoreService(%wwwDir%/assets/)
```

2 . Add inject service into BasePresenter.

```php
<?php

namespace App\Presenters;

use vavo\EncoreLoader\EncoreLoaderTrait;
use Nette;

class BasePresenter extends Nette\Application\UI\Presenter
{
	/** @var IEncoreLoader @inject */
    public $encoreLoaderComponent;
    ...
    public function createComponentEncore()
    {
        return $this->encoreLoaderComponent->create();
    }
```

3 . Add control into @layout.latte. You can specify what file should be included.
```
    {control encore-css}
    {control encore-css, [filename]}
    ...
    {control encore-js, index}
```

4 . Use asset latte macro still NEEDS to be implemented.
```
<img src="{asset "build/images/logo.svg"}" />
```

5 . Use relative path to your image in css
 ```
 background-image: url('../images/background.jpg')
 ```
