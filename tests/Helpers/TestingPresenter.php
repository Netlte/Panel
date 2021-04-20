<?php declare(strict_types = 1);

namespace Netlte\Panel\Tests\Helpers;

use Netlte\Panel\Header;
use Nette\Application\UI\Presenter;

final class TestingPresenter extends Presenter {

	protected function createComponentPanel(): TestingPanel {
		return new TestingPanel();
	}

	protected function createComponentHeader(): Header {
		return new Header();
	}
}