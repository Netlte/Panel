<?php declare(strict_types = 1);

namespace Netlte\Panel\Tests\Helpers;

use Nette\Application\PresenterFactory as ApplicationPresenterFactory;
use Nette\Application\UI\Presenter;
use Nette\Http\Request;
use Nette\Http\Response;
use Nette\Http\Session;
use Nette\Http\UrlScript;

/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/navigation
 * @copyright    Copyright © 2021, Tomáš Holan [www.holan.dev]
 */
class PresenterFactory {

	public function create(string $presenterName = 'Testing'): Presenter {
		$presenterFactory = new ApplicationPresenterFactory();
		$presenterFactory->setMapping(['*' => 'Netlte\Panel\Tests\Helpers\*Presenter']);

		/** @var TestingPresenter $presenter */
		$presenter = $presenterFactory->createPresenter($presenterName);

		$url = new UrlScript('http://localhost');
		$request = new Request($url);
		$response = new Response;
		$session = new Session($request, $response);

		$presenter->injectPrimary(null, null, null, $request, $response, $session, null, new TestingTemplateFactory());
		return $presenter;
	}
}