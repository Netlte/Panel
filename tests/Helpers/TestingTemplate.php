<?php declare(strict_types = 1);

namespace Netlte\Panel\Tests\Helpers;


use Nette\Application\UI\Control;
use Nette\Application\UI\Template;
use Nette\Localization\Translator;

class TestingTemplate extends \stdClass implements Template {

	/** @var string[] */
	public array $flashes = [];
	public ?Control $control = null;
	private ?string $file = null;
	private ?Translator $translator = null;

	public function __construct(?Control $control = null) {
		$this->control = $control;
	}

	function render(): void {
		echo 'TestingTemplate';
	}

	function setTranslator(?Translator $translator = null): Template {
		$this->translator = $translator;
		return $this;
	}

	function getTranslator(): ?Translator {
		return $this->translator;
	}

	function setFile(string $file): Template {
		$this->file = $file;
		return $this;
	}

	function getFile(): ?string {
		return $this->file;
	}
}