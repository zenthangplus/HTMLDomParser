# Accessing the Node
You can access to the Node's data such as: contents, attributes by using bellow functions.

##### Accessing the node's data:

- [`text()` Get the text contents](#get-the-text-contents)
- [`getAttributes()` Get attributes](#get-all-attributes)
- [`getAttribute()` Get a attribute](#get-a-attribute)
- [`hasAttribute()` Check element has a attribute](#check-element-has-a-attribute)
- [`hasChild()` Check element has child](#check-element-has-child)
- [`innerHtml()` Get inner HTML](#get-inner-html)
- [`outerHtml()` Get outer HTML](#get-outer-html)
- [`innerXml()` Get inner XML](#get-inner-xml)
- [Get node's HTML](#get-nodes-html)

##### Modifying the Node's data
- [`setAttribute()` Set a attribute](#set-a-attribute)
- [`removeAttribute()` Remove a attribute](#remove-a-attribute)
- [`appendChild()` Append child](#append-child)
- [`save()` Save DOM or even a node](#save-dom-or-even-a-node)

##### Traversing the Node tree

- [`getChild()` Get child element](#get-child-element)
- [`getChildren()` Get child element](#get-all-children)
- [`getFirstChild()` Get first child](#get-first-child)
- [`getLastChild()` Get last child](#get-last-child)
- [`getNextSibling()` Get next sibling](#get-next-sibling)
- [`getPrevSibling()` Get previous sibling](#get-previous-sibling)
- [`findAncestorTag()` Find ancestor tag](#find-ancestor-tag)

## Accessing the Node's data
### Get the text contents

The `text()` method returns the element's text contents.

```php
function text(): string
```

### Get all attributes

The `getAttributes()` method returns all element's attributes.

```php
function getAttributes(): array
```

### Get a attribute

The `getAttribute()` method returns the element's attribute by name.

```php
function getAttribute(string $name): string
```

### Check element has a attribute

The `hasAttribute()` method will check current element has a attribute or not?

```php
function hasAttribute(string $name): boolean
```

### Check element has child

The `hasChild()` method will check current element has a child or not?

```php
function hasChild(): boolean
```

### Get inner HTML

The `innerHtml()` method returns the element's inner HTML.

```php
function innerHtml(): string
```

### Get outer HTML

The `outerHtml()` method returns element's outer HTML.

```php
function outerHtml(): string
```

### Get inner XML

The `innerHtml()` method returns the element's inner XML.

```php
function innerXml(): string
```

### Get node's HTML

A Node can be converted to HTML by using casting functions or print it directly.

Example:
```php
echo $node;
$html = (string)$node;
```


## Modifying the Node's data
### Set a attribute

The `setAttribute()` method will set value for a attribute by name.

```php
function setAttribute(string $name, mixed $value): void
```

### Remove a attribute

The `removeAttribute()` method will remove a attribute from current element by name.

```php
function removeAttribute(string $name): void
```

### Set parent

The `setParent()` method will set parent for current element.

```php
function setParent(NodeContract $node): void
```

### Append child

The `appendChild()` method will append a Node as a child of current element.

```php
function appendChild(NodeContract $node): void
```

### Save DOM or even a node

The `save()` method returns the current DOM (or element) as HTML then save it to a file if you provide a file path.

```php
function save(string $filePath): string
```


## Traversing the Node tree
### Get child element
The `getChild()` method returns the Nth child element.

```php
function getChild(int $idx): NodeContract|null
```

### Get all children
The `getChildren()` method returns a list of children elements.

```php
function getChildren(): []NodeContract
```

### Get first child
The `getFirstChild()` method returns the first child element.

```php
function getFirstChild(): NodeContract|null
```

### Get last child
The `getLastChild()` method returns the last child element.

```php
function getLastChild(): NodeContract|null
```

### Get next sibling
The `getNextSibling()` method returns the next sibling element.

```php
function getNextSibling(): NodeContract|null
```

### Get previous sibling
The `getPrevSibling()` method returns the previous sibling element.

```php
function getPrevSibling(): NodeContract|null
```

### Find ancestor tag 
The `findAncestorTag()` method returns the first ancestor tag.

```php
function findAncestorTag(string $tag): NodeContract|null
```
