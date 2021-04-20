<?php declare(strict_types = 1);

namespace Netlte\Panel;

use Netlte\ActionBar\ActionBar;
use Netlte\BreadCrumbs\Bread;
use Netlte\UI\AbstractControl;
use Nette\ComponentModel\IComponent;


/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/panel
 * @copyright    Copyright © 2021, Tomáš Holan [www.holan.dev]
 *
 * @method onInitialize(self $sender)
 */
abstract class AbstractPanel extends AbstractControl {

	public const DEFAULT_TEMPLATE = __DIR__ . \DIRECTORY_SEPARATOR . 'templates' . \DIRECTORY_SEPARATOR . 'panel.latte';

	public static string $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	/** @var array|callable[] */
	public array $onInitialize = [];
	private Header $header;

	private bool $initializing = false;
	private bool $initialized = false;


	public function __construct() {
		$this->header = new Header();
	}

	abstract protected function startup(): void;

	public function getHeader(): Header {
		return $this->header;
	}

	public function getActionBar(): ActionBar {
		return $this->getHeader()->getActionBar();
	}

	public function getBread(): Bread {
		return $this->getHeader()->getBread();
	}

	public function isInitialized(): bool {
		return $this->initialized;
	}

	public function render(): void {
		$this->__initialize__();

		$this->getHeader()->setTranslator($this->getHeader()->getTranslator() ?? $this->getTranslator());
		$flashes = \array_merge($this->getTemplate()->flashes, $this->getPresenter()->getTemplate()->flashes);

		$this->getTemplate()->flashes = $flashes;

		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile() ?? self::$DEFAULT_TEMPLATE);
		$this->getTemplate()->render();
	}

	/***************************************************
	 *
	 *
	 * Component model
	 *
	 *
	 **************************************************/

	/**
	 * @return static
	 */
	public function addComponent(IComponent $component, ?string $name, ?string $insertBefore = null) {
		$this->__initialize__();
		return parent::addComponent($component, $name, $insertBefore);
	}

	protected function createComponent(string $name): ?IComponent {
		$this->__initialize__();
		return parent::createComponent($name);
	}

	protected function createComponentHeader(): Header {
		return $this->getHeader();
	}


	/**
	 * Initialization of all components inside of Agenda
	 */
	protected function __initialize__(): void {
		if ($this->initializing || $this->initialized ) return;

		$this->initializing = true;
		$this->startup();

		$this->initializing = false;
		$this->initialized = true;
		$this->onInitialize($this);
	}


	/**
	 * Clean from all components
	 */
	protected function clean(): void {
		foreach ($this->getComponents() as $component) {
			$this->removeComponent($component);
		}
	}

	/**
	 * Recreate all components
	 */
	public function reInitialize(): void {
		$this->clean();
		$this->__initialize__();
	}
}
