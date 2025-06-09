# Ease PHP Template Engine

<p align="center">
  <img src="assets/ease_logo.png" alt="Alt Text" width="300"/>
</p>

![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)

> [!NOTE]
> ease TE is currently in its alpha version.

## Description

Ease is a lightweight, flexible template engine built with PHP, designed to streamline and enhance the development of dynamic PHP applications. It offers a modular architecture centered around fundamental components called "eases," where each ease represents a distinct element or factor within the page structure. This approach promotes clean separation of concerns, enabling developers to manage layout, logic, and content more efficiently.

Templates created with Ease use the .ease.php file extension, clearly distinguishing them from standard PHP files and ensuring better organization within your project structure.

## prerequisites

`Ease needs at least PHP 8.x.x to work.`

## Engine Architecture

The core of the Ease Template Engine is its main component: the Engine. The Engine itself is composed of several subcomponents, with the most critical being the Summon entity.

<p align="left">
  <img src="assets/diagrams/Engine_Components.png" alt="Alt Text" width="500"/>
</p>

**Summon**

The Summon entity serves as the central entry point and orchestrator of the engine's functionality. It is comprised of three primary classes:

1. **Entry**
   Acts as the main entry point of the engine. It is responsible for locating and opening the view folder to access .ease.php template files.

2. **Fetcher**
   Handles the process of reading and fetching the lines of code from the Ease template files. It prepares the content for transformation into the appropriate PHP script.

3. **Extractor**
   Extracts the necessary logic and script from the parsed Ease templates. This component interprets the logic within the templates and ensures it integrates correctly with the resulting PHP output.

**Construction**

After completing its operations, the Entry class triggers the ConstructPHP process, which belongs to the Construction component of the engine. This step initiates the construction of the final PHP file based on the extracted logic and structure.

<p align="left">
  <img src="assets/diagrams/Summon_Activity_diagram.png" alt="Alt Text" width="500"/>
</p>

**Buffer**

The Buffer component is responsible for storing the parsed content of the Ease file. It acts as temporary memory during processing, allowing the engine to manipulate and structure the content before rendering.

**Render**

The Render component provides the core rendering functionality of the engine. It is tasked with displaying the final parsed and processed content stored PHP file, outputting it as a valid PHP response.

**Optimize**

Optimize is the component responsible for detecting changes in content using the MD5 hash technique. It helps prevent unnecessary parsing by skipping processing if the content has not changed.

<p align="left">
  <img src="assets/diagrams/Optimize_logic.png" alt="Alt Text" width="300"/>
</p>

## Documentation

### Example Usage of the Ease Template Engine

Below is a simple example demonstrating how an Ease template file might look:

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    ~print('Hello world') // This is a sample of printing data.
</body>
</html>
```

In this example, the ~print('Hello world') line represents a directive processed by the Ease Template Engine. During rendering, the engine will interpret this line and output:

```
Hello world
```

### Configuration

Each Ease template project includes a configuration file that defines how the engine should behave. Below is an example configuration file in JSON format:

```json
{
  "main": {
    "Producation": false,
    "ParseType": "full"
  },
  "error": {
    "formatPHP": true
  },
  "location": {
    "views": "views"
  }
}
```

- Main Section

  This section controls core behavior of the engine:

  **Production:** When set to true, the engine disables parsing to improve performance in a production environment. If false, parsing is enabled for development.

  **ParseType:** Defines the scope of parsing:

  `"full"`: Parses all .ease.php files in the views directory.

  `"partial"`: Parses only the selected file and any included Ease files.

  `"single"`: Parses only a specific file, giving the developer full control.

- Error Section

  Handles error formatting options:

  **formatPHP:** When true, any PHP errors that occur during parsing or rendering will be formatted and displayed in a more readable form, improving debugging during development.

- Location Section

  Specifies the directory structure:

  **views:** Defines the path to the folder containing the .ease.php view templates.

### Error handling

The Ease Template Engine provides a structured error handling mechanism designed to assist developers in identifying and resolving issues during parsing and rendering. It supports two types of error detection:

1. Block-Type Errors

Block-type error handling scans the entire template file to detect structural issues, especially those related to the use of opening and closing tags (e.g., unbalanced or missing control structures). This type is ideal for catching errors that affect the overall integrity of the document.

2. Line-Type Errors

Line-type error handling focuses on detecting issues that occur within a single line. These are usually syntax-related or caused by misuse of template directives.

- **Common Exceptions and Error Messages**

The following are predefined exceptions handled by the engine:

- Duplicated Inclusion
  `Invalid include of same file!`
  Triggered when the same Ease file is included more than once improperly.

- Invalid Parameters
  `Regular eases can't have arguments!`
  Raised when a regular Ease template is passed arguments, which is not allowed.

- Null Arguments
  `Null argument value provided!`
  Occurs when a directive receives an argument with a null value.

- Null Parameters
  `Null file location provided!`
  Thrown when an include or reference is made to a file without a valid path.

- Unset Parentheses
  `Can't print empty parentheses`
  Happens when a print or logic directive is called without any expression inside the parentheses.

- Wrong Inclusion
  `No such ease file!`
  Raised when the engine cannot locate the referenced Ease file.
