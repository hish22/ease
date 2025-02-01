# Ease PHP Template Engine

<p align="center">
  <img src="assets/ease_0.1logo.png" alt="Alt Text" width="300"/>
</p>

![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)

> [!NOTE]
> ease TE is currently in its alpha version.

## Description

Ease is a lightweight, flexible template engine built with PHP, designed to streamline and enhance the development of dynamic PHP applications. It offers a modular architecture centered around fundamental components called "eases," where each ease represents a distinct element or factor within the page structure. This approach promotes clean separation of concerns, enabling developers to manage layout, logic, and content more efficiently.

Templates created with Ease use the .ease.php file extension, clearly distinguishing them from standard PHP files and ensuring better organization within your project structure.

### Example of an ease

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    ~HEAD // Example of an ease
    ~PUT // Another ease
    <h1>Welcome Brother</h1>
</body>
</html>
```

### Render of an ease file

```php
use function Engine\Render\Render;

include_once "start-ease-engine.php";
// home will be mapped from home.ease.php to home.php (<filename>.ease.php -> <filename>.php)
render("home");
```
