# Traversing the DOM
By using selectors like jQuery or CSS, you can traverse easy in the Dom or even in a Node.

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

- [Find elements](#find-elements)
- [Find one element](#find-one-element)

##### Special functions:

- [Get a element by ID](#get-element-by-id)
- [Get elements by tag name](#get-elements-by-tag-name)
- [Get a element by tag name](#get-a-element-by-tag-name)

## Find elements
The `find()` method returns a collection of an element's child elements by [selectors](#list-of-supported-selectors).

```php
find(string $selector, int $index): []NodeContract
```

Example:
```php
<?php
$dom = \HTMLDomParser\DomFactory::loadFile("document.html");
$elements = $dom->find('#container a');
foreach ($elements as $element) {
    echo $element->text();
}
```

## Find one element
The `findOne()` method returns only 1 child element by selectors and an index.

```php
findOne(string $selector, int $index): NodeContract
```

Example:
```php
<?php
$dom = \HTMLDomParser\DomFactory::loadFile("document.html");
$anchor = $dom->findOne('#container a');// Return the first anchor tag (with index=0) inside #container
$anchor = $dom->findOne('#container a', 1);// Return the anchor tag with index=1 inside #container
$anchor = $dom->findOne('#container a', 2);// Return the anchor tag with index=2 inside #container
$anchor = $dom->findOne('#container a', -1);// Reverse search, return the last anchor tag inside #container
```

## Get element by ID
The `getElementById()` method returns an element's child element by ID.

```php
getElementById(string $id): NodeContract
```

Example:
```php
<?php
$dom = \HTMLDomParser\DomFactory::loadFile("document.html");
$container = $dom->getElementById('container');
echo $container->innerHtml();
```

## Get elements by tag name
The `getElementsByTagName()` method returns a collection of an element's child elements with the specified tag name.

```php
getElementsByTagName(string $tagName): []NodeContract
```

Example:
```php
<?php
$dom = \HTMLDomParser\DomFactory::loadFile("document.html");
$paragraphs = $dom->getElementsByTagName('p');
foreach ($paragraphs as $paragraph) {
    echo $paragraph->text();
}
```

## Get a element by tag name
The `getElementByTagName()` method returns only 1 child element with the specified tag name and an index.

```php
getElementByTagName(string $tagName): NodeContract
```

Example:
```php
<?php
$dom = \HTMLDomParser\DomFactory::loadFile("document.html");
$paragraph = $dom->getElementByTagName('p');// Return the first paragraph (with index=0)
$paragraph = $dom->getElementByTagName('p', 1);// Return the paragraph with index=1
$paragraph = $dom->getElementByTagName('p', 2);// Return the paragraph with index=2
$paragraph = $dom->getElementByTagName('p', -1);// Reverse search, return the last paragraph
```
