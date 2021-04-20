<?php declare(strict_types = 1);

namespace Netlte\Panel\Tests\Cases\Unit;

use Netlte\ActionBar\ActionBar;
use Netlte\BreadCrumbs\Bread;
use Netlte\Panel\Header;
use Netlte\Panel\Tests\Helpers\PresenterFactory;
use Netlte\Panel\Tests\Helpers\TestingPanel;
use Netlte\Panel\Tests\Helpers\TestingTemplateFactory;
use Nette\ComponentModel\IComponent;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../../bootstrap.php';

class PanelTest extends TestCase {

	/** @var TestingPanel|IComponent|null */
	private $panel;

	public function setUp(): void {
		$factory = new PresenterFactory();
		$presenter = $factory->create();
		$this->panel = $presenter->getComponent('panel');
	}

	public function testRender(): void {
		/** @var TestingPanel $panel */
		$panel = $this->panel;

		$panel->setTemplateFactory(new TestingTemplateFactory());

		\ob_start();
		$panel->render();
		$result = \ob_get_clean();

		Assert::equal('TestingTemplate', $result);
	}

	public function testProperties(): void {
		/** @var TestingPanel $panel */
		$panel = $this->panel;

		Assert::type(Header::class, $panel->getHeader());
		Assert::type(ActionBar::class, $panel->getActionBar());
		Assert::type(Bread::class, $panel->getBread());

		Assert::false($panel->isInitialized());
	}

	public function testInitialization(): void {
		/** @var TestingPanel $panel */
		$panel = clone $this->panel;

		Assert::false($panel->isInitialized());
		$panel->getComponent('header');
		Assert::type(Header::class, $panel->getHeader());
		Assert::true($panel->isInitialized());

		/** @var TestingPanel $panel */
		$panel = clone $this->panel;

		Assert::false($panel->isInitialized());
		$panel->addComponent(new ActionBar(), 'test');
		Assert::true($panel->isInitialized());

		/** @var TestingPanel $panel */
		$panel = clone $this->panel;

		Assert::false($panel->isInitialized());
		$panel->getComponent('undefined_component', false);
		Assert::true($panel->isInitialized());
	}

}

(new PanelTest())->run();