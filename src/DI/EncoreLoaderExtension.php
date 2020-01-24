<?php
namespace vavo\EncoreLoader;

use Nette\DI\Helpers;
use Nette\PhpGenerator\PhpLiteral;
use vavo\EncoreLoader\macro\AssetMacroSet;

class EncoreLoaderExtension extends \Nette\DI\CompilerExtension
{
	private $defaults = [
		'outDir' => "\build",
		'defaultEntry' => 'index'
	];

	public function beforeCompile()
	{
		parent::beforeCompile(); // TODO: Change the autogenerated stub
		$builder = $this->getContainerBuilder();
		$builder->getDefinition($builder->getByType(Latte\Engine::class) ?? 'nette.latteFactory')
			->getResultDefinition()
			->addSetup('?->onCompile[] = function ($engine) { ?::install( $engine->getCompiler()); }', [
				'@self',
				new PhpLiteral(AssetMacroSet::class)
			]);
	}

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig(Helpers::expand($this->defaults, $this->getContainerBuilder()->parameters));

		$builder->addDefinition($this->prefix('encoreLoader'))
			->setFactory(\vavo\EncoreLoader\EncoreLoaderFactory::class, ["config" => $config]);
	}
}
