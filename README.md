# Netlte > Panel

[![Build Status](https://badgen.net/travis/netlte/panel)](https://travis-ci.com/Netlte/Panel)
[![Licence](https://badgen.net/packagist/license/netlte/panel)](https://packagist.org/packages/Netlte/Panel)
[![Latest stable](https://badgen.net/packagist/v/netlte/panel)](https://packagist.org/packages/Netlte/Panel)
[![Downloads this Month](https://badgen.net/packagist/dm/netlte/panel)](https://packagist.org/packages/Netlte/Panel)
[![Downloads total](https://badgen.net/packagist/dt/netlte/panel)](https://packagist.org/packages/Netlte/Panel)
[![PHPStan](https://badgen.net/badge/PHPStan/enabled/green)](https://github.com/phpstan/phpstan)

## Credits

Feel free to use. Your contributions are very welcome. Feel free to publish pull requests.

## Overview

Nette request action components factory. Idea of this package is to wrap all content components into one big panel which runs as nette servis. So your system modules, can reach any page component or add own component into panel no matter if page is actually requested.

As part of this is GUI Header component which is inside panel and define page's heading, subheading, [ActionBar](https://github.com/Netlte/ActionBar) and [BreadCrumbs](https://github.com/Netlte/BreadCrumbs/) navigation. 

## Install

```
composer require netlte/panel
```
## Documentation
You can find more info in [.docs](.docs/) folder.

## Versions

| State       | AdminLTE | Version | Branch   | PHP      |
|-------------|----------|---------|----------|----------|
| stable      |   `2.0`  | `^1.0`  |  `main`  | `>= 7.4` |
| NoN         |   `3.0`  | `^2.0`  |  `main`  | `>= 8.0` |


## Tests

Check code quality and run tests
```
composer build
```

or separately

```
composer cs
composer analyse
composer tests
```

## Authors

| [Tomáš Holan](https://github.com/holantomas)                             |
|--------------------------------------------------------------------------|
| ![Avatar](https://avatars3.githubusercontent.com/u/5030499?s=100)        |


