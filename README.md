# Hamtaro framework

Create a web application in a strict, simplified and organized environment.

- [Technologies](#technologies)
- [Getting Started](#getting-started)
- [Workflow scripts](#workflow-scripts)

## Technologies

[Php](https://www.php.net) | [Javascript](https://developer.mozilla.org/en/docs/Web/JavaScript)
| [Composer](https://getcomposer.org) | [Npm](https://www.npmjs.com) | [Node.js](https://nodejs.org)
| [Webpack](https://webpack.js.org) | [Sass](https://sass-lang.com) | [Twig](https://twig.symfony.com)
| [Bootstrap](https://getbootstrap.com) | [Babel](https://babeljs.io)

## Getting Started

Using [composer create-project](https://getcomposer.org/doc/03-cli.md#create-project) you will have a folder containing
everything you need to start a Hamtaro project.

```shell
composer create-project cejobelo/hamtaro-starter my_project && cd my_project && composer install && npm install
```

## Workflow scripts

Using [composer scripts](https://getcomposer.org/doc/articles/scripts.md), the Hamtaro framework provides you with
scripts to improve your workflow and save you considerable time during development.

```json
{
    "scripts": {
        "ajax": "Hamtaro\\Script\\Workflow\\CreateAjaxRequest::run",
        "component": "Hamtaro\\Script\\Workflow\\CreateComponent::run",
        "form": "Hamtaro\\Script\\Workflow\\CreateForm::run",
        "modal": "Hamtaro\\Script\\Workflow\\CreateModal::run",
        "page": "Hamtaro\\Script\\Workflow\\CreatePage::run",
        "jsevent": "Hamtaro\\Script\\Workflow\\CreateJavascriptEvent::run"
    }
}
```

| Script    | Usefulness                                            | Argument #1    |
|-----------|-------------------------------------------------------|----------------|
| ajax      | Create a new ajax request to the Hamtaro project.     | N/A            |
| component | Create a new component to the Hamtaro project.        | ControllerName |
| form      | Create a new form to the Hamtaro project.             | ControllerName |
| modal     | Create a new modal to the Hamtaro project.            | ControllerName |
| page      | Create a new page to the Hamtaro project.             | ControllerName |
| jsevent   | Create a new Javascript event to the Hamtaro project. | ControllerName |

For example, I create a new about page to my application with :

```shell
composer run page About
```