# Hamtaro framework

- [About](#about)
- [Technologies](#technologies)
- [Front-end development](#front-end-development)
- [Components](#components)
- [Workflow scripts](#workflow-scripts)
- [Getting Started](#getting-started)

## About

With Hamtaro framework, create your modern and stable web application in a strict, simplified and organized environment using Php with Javascript.

## Technologies

[Php](https://www.php.net) | [Javascript](https://developer.mozilla.org/en/docs/Web/JavaScript)
| [Composer](https://getcomposer.org) | [Npm](https://www.npmjs.com) | [Node.js](https://nodejs.org)
| [Webpack](https://webpack.js.org) | [Babel](https://babeljs.io) | [Sass](https://sass-lang.com)
| [Twig](https://twig.symfony.com) | [Bootstrap](https://getbootstrap.com) | [jQuery](https://jquery.com)

## Front-end development

The [Npm package](https://www.npmjs.com/package/hamtaro.js) of Hamtaro framework contains a default webpack configuration
for bundle `.js` and `.sass`|`.scss`|`.css` files.
<br>Create your own Webpack configuration if you want to go further.

- `npm run assets` Build your assets ***public/main.min.js*** and ***public/main.min.css***.

- `npm run assets:dev` Your assets are monitored and built dynamically, just write bars and reload your browser to see the changes.

## Components

***Component*** means graphic item and extended [AbstractController](https://github.com/cejobelo/hamtaro/blob/33047d5bdd854db1773186279e5fd3711e145d58/src/Controller/AbstractController.php)
in your back-end.

A component is composed of 4 files :

- ***FooComponent.js -*** The front-end class of your component extending [AbstractComponent](https://github.com/cejobelo/hamtaro.js/blob/9b2183d12f7df2a51c45aa8614a74e097a71c82d/src/Abstract/AbstractComponent.js)

- ***FooComponent.php -*** The back-end class of your component extending [AbstractComponent](https://github.com/cejobelo/hamtaro/blob/fabe1b632ada57adf5440f18f437db7806fd6b70/src/Controller/Component/AbstractComponent.php)

- ***FooComponent.sass -*** The stylesheet of your component

- ***FooComponent.twig -*** The html of your component. [Pug support](https://phug-lang.com) is coming.

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

| Script    | Description                                            | Arguments                            | Example                               |
|-----------|--------------------------------------------------------|--------------------------------------|---------------------------------------|
| ajax      | Create a new ajax request to your Hamtaro project.     | #1 the ***Ctrl*** of your controller | `composer run ajax GetUsers`          |
| component | Create a new component to your Hamtaro project.        | #1 the ***Ctrl*** of your component  | `composer run component Header`       |
| form      | Create a new form to your Hamtaro project.             | #1 the ***Ctrl*** of your component  | `composer run form Login`             |
| modal     | Create a new modal to your Hamtaro project.            | #1 the ***Ctrl*** of your component  | `composer run modal Newsletter`       |
| page      | Create a new page to your Hamtaro project.             | #1 the ***Ctrl*** of your component  | `composer run page About`             |
| jsevent   | Create a new Javascript event to your Hamtaro project. | #1 the ***Ctrl*** of your event      | `composer run jsevent AddItemOnClick` |

> ***Ctrl*** means <ins>controller identifier</ins> inside your Hamtaro project.<br>We can identify the namespace and
> the filepath of the controller [with that](https://www.youtube.com/watch?v=cTGQrA5HHIU), very usefull.

## Getting Started

Using [`composer create-project`](https://getcomposer.org/doc/03-cli.md#create-project) with
[hamtaro-starter](https://github.com/cejobelo/hamtaro-starter), your work environment is already ready.

```shell
composer create-project cejobelo/hamtaro-starter my_project && cd my_project && composer install && npm install
```