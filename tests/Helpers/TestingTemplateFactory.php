<?php declare(strict_types = 1);

namespace Netlte\Panel\Tests\Helpers;

use Nette\Application\UI\Control;
use Nette\Application\UI\Template;
use Nette\Application\UI\TemplateFactory;

class TestingTemplateFactory implements TemplateFactory {

	public function createTemplate(?Control $control = null): Template {
		return new TestingTemplate($control);
	}

}