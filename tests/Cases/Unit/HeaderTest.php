<?php declare(strict_types = 1);

namespace Netlte\Panel\Tests\Cases\Unit;

use Netlte\ActionBar\ActionBar;
use Netlte\BreadCrumbs\Bread;
use Netlte\Panel\Header;
use Netlte\Panel\Tests\Helpers\PresenterFactory;
use Netlte\Panel\Tests\Helpers\TestingTemplateFactory;
use Nette\ComponentModel\IComponent;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../../bootstrap.php';

class HeaderTest extends TestCase {

	/** @var Header|IComponent|null */
	private $header;

	public function setUp(): void {
		$factory = new PresenterFactory();
		$presenter = $factory->create();
		$this->header = $presenter->getComponent('header');
	}

	public function testRender(): void {
		/** @var Header $header */
		$header = $this->header;

		$header->setTemplateFactory(new TestingTemplateFactory());

		\ob_start();
		$header->render();
		$result = \ob_get_clean();

		Assert::equal('TestingTemplate', $result);
	}

	public function testProperties(): void {
		/** @var Header $header */
		$header = $this->header;

		$header->setHeading('Testing');
		$header->setSubheading('header');

		Assert::equal('Testing', $header->getHeading());
		Assert::equal('header', $header->getSubheading());

		Assert::type(ActionBar::class, $header->getActionBar());
		Assert::type(Bread::class, $header->getBread());
	}

}

(new HeaderTest())->run();