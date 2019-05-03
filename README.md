# HTML DOM parser for PHP

A Simple HTML DOM parser written in PHP let you manipulate HTML in a easy way with selectors just like CSS or jQuery.

> This is modern version of [Simple HTML DOM](https://simplehtmldom.sourceforge.io/). 
You can install by using [Composer](https://getcomposer.org/) and import to your project as a package.

### Features

- Parse and modify HTML document.
- Find tags (elements) on HTML with selectors just like jQuery.
- Extract contents from HTML in a single line.
- Export elements or a special node to a single file.
- Supports HTML document with invalid structure.

## Installation

You can use [Composer](https://getcomposer.org/) to install this package to your project by running following command:

```bash
composer require zenthangplus/html-dom-parser
```

**The minimum PHP version requirement is 5.6**. If you are using PHP < 5.6, please use [the original version](https://simplehtmldom.sourceforge.io/).

## Usage

The following example is a fast and simple usage of the package:

```php
<?php
require "vendor/autoload.php";
use HTMLDomParser\DomFactory;

$dom = DomFactory::load('<div class="container"><div class="anchor"><a href="#">Test</a></div></div>');
$a = $dom->findOne('.container a');
echo $a->text();
// Output: Test
```

### Create DOM
```php
<?php
require "vendor/autoload.php";
use HTMLDomParser\DomFactory;
$dom = DomFactory::loadFile("document.html");
```
