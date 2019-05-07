# HTML DOM parser for PHP

[![Travis Status](https://travis-ci.com/zenthangplus/HTMLDomParser.svg?branch=master)](https://travis-ci.com/zenthangplus/HTMLDomParser)
[![CodeShip Status](https://app.codeship.com/projects/0bc12be0-4ff5-0137-3337-36ac3da8be85/status?branch=master)](https://app.codeship.com/projects/339848)
[![CircleCI](https://circleci.com/gh/zenthangplus/HTMLDomParser.svg?style=svg)](https://circleci.com/gh/zenthangplus/HTMLDomParser)

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
The following example is the simple usage of this package:

```php
<?php
$dom = \HTMLDomParser\DomFactory::load('<div class="container"><div class="anchor"><a href="#">Test</a></div></div>');
$a = $dom->findOne('.container a');
echo $a->text();
// Output: Test
```

### DOM
Dom is the root [Node](#node) of the HTML document.

You can load DOM from `string` or `file`.

```php
<?php
$dom = \HTMLDomParser\DomFactory::load('<div>Test</div>');
```

```php
<?php
$dom = \HTMLDomParser\DomFactory::loadFile('document.html');
```

### NODE
Node is simply an HTML element that described as an object.

You can also load any Node (similar to [Dom](#dom)):

```php
<?php
$node = \HTMLDomParser\NodeFactory::load('<div><a href="#">Test</a></div>');
```

```php
<?php
$node = \HTMLDomParser\NodeFactory::loadFile('document.html');
```

### Traversing the DOM
By using selectors like jQuery or CSS, you can traverse easy in the [Dom](#dom) or even in a [Node](#node).

Example:
```php
<?php
$dom = \HTMLDomParser\DomFactory::loadFile('document.html');
$dom->find('div');
$dom->find('#container');
$dom->find('#container .content ul>li a.external-link');
$dom->find('#container .content ul>li a[data-id=link-1]');
```

Similar to Dom, a Node also traversable:
```php
<?php
$dom = \HTMLDomParser\DomFactory::loadFile('document.html');
$node = $dom->findOne('#container .content ul>li');
$anchorNode = $node->findOne('a.external-link');

// Even traverse in a separate Node
$node = \HTMLDomParser\NodeFactory::load('<ul class="list"><li>Item 1</li><li>Item 2</li></ul>');
$node->find('ul.list li');
```

##### List of supported selectors:

| Selector example | Description |
| --- | --- |
| `div` | Find elements with the `div` tag |
| `#container` | Find elements with the `container` id |
| `.wrapper` | Find elements with the `wrapper` class |
| `[data-id]` | Find elements with the `data-id` attribute |
| `[data-id=12]` | Find elements with the attribute `data-id=12` |
| `a[data-id=12]` | Find anchor tags with the attribute `data-id=12` |
| `*[class]` | Find all elements with `class` attribute |
| `a, img` | Find all anchors and images |
| `a[title], img[title]` | Find all anchors and images with the `title` attribute |
| `#container ul` | By using `space` between selectors, you can find nested elements |
| `#container>ul` | By using `>` between selectors, you can find the closest children |
| `#container, #side` | By using `,` between selectors, you can find elements by multiple selectors in one query |
| `#container div.content ul>li, #side div[role=main] ul li` | You can combine selectors in one query |

##### List of function you can use with above selectors:

- [`find()` Find elements](docs/traverse.md#find-elements)
- [`findOne()` Find one element](docs/traverse.md#find-one-element)

##### Specific find functions:

- [`getElementById()` Get a element by ID](docs/traverse.md#get-element-by-id)
- [`getElementByTagName()` Get a element by tag name](docs/traverse.md#get-a-element-by-tag-name)
- [`getElementsByTagName()` Get elements by tag name](docs/traverse.md#get-elements-by-tag-name)

##### Traverse the DOM tree

- [`getChild()` Get child element](docs/traverse.md#get-child-element)
- [`getChildren()` Get child element](docs/traverse.md#get-all-children)
- [`getFirstChild()` Get first child](docs/traverse.md#get-first-child)
- [`getLastChild()` Get last child](docs/traverse.md#get-last-child)
- [`getNextSibling()` Get next sibling](docs/traverse.md#get-next-sibling)
- [`getPrevSibling()` Get previous sibling](docs/traverse.md#get-previous-sibling)
- [`findAncestorTag()` Find ancestor tag](docs/traverse.md#find-ancestor-tag)
