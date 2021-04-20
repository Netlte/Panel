<?php declare(strict_types = 1);

namespace Netlte\Panel;

use Netlte\ActionBar\ActionBar;
use Netlte\BreadCrumbs\Bread;
use Netlte\UI\AbstractControl;

/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/panel
 * @copyright    Copyright © 2021, Tomáš Holan [www.holan.dev]
 */
class Header extends AbstractControl {

	public const DEFAULT_TEMPLATE = __DIR__ . \DIRECTORY_SEPARATOR . 'templates' . \DIRECTORY_SEPARATOR . 'header.latte';

	public static string $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	private ActionBar $bar;
	private Bread $bread;
	private ?string $heading = null;
	private ?string $subheading = null;

	public function __construct() {
		$this->bar = new ActionBar();
		$this->bread = new Bread();
	}

	public function getActionBar(): ActionBar {
		return $this->bar;
	}

	public function getBread(): Bread {
		return $this->bread;
	}

	public function getHeading(): ?string {
		return $this->heading;
	}

	public function getSubheading(): ?string {
		return $this->subheading;
	}

	public function setHeading(?string $heading = null): self {
		$this->heading = $heading;
		return $this;
	}

	public function setSubheading(?string $subheading = null): self {
		$this->subheading = $subheading;
		return $this;
	}

	public function render(): void {
		$this->getActionBar()->setTranslator($this->getActionBar()->getTranslator() ?? $this->getTranslator());
		$this->getBread()->setTranslator($this->getBread()->getTranslator() ?? $this->getTranslator());

		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile() ?? self::$DEFAULT_TEMPLATE);
		$this->getTemplate()->render();
	}

	protected function createComponentBreadcrumbs(): Bread {
		return $this->getBread();
	}

	protected function createComponentActionbar(): ActionBar {
		return $this->getActionBar();
	}

}