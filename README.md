# Hamtaro framework

- [About](#about)
- [Technologies](#technologies)
- [Controllers](#controllers)
- [Components](#components)
- [Commands](#commands)
- [Front-end development](#front-end-development)
- [Getting Started](#getting-started)

## About

Hamtaro is the new web framework for front-end / back-end development using Php and Javascript.
<br>Create your modern and stable web application in a strict, simplified and organized environment.

Do yourself a favor : use Hamtaro 🐹

## Technologies

[Php](https://www.php.net) | [Javascript](https://developer.mozilla.org/en/docs/Web/JavaScript)
| [Composer](https://getcomposer.org) | [Npm](https://www.npmjs.com) | [Node.js](https://nodejs.org)
| [Webpack](https://webpack.js.org) | [Babel](https://babeljs.io) | [Sass](https://sass-lang.com)
| [Twig](https://twig.symfony.com) | [Bootstrap](https://getbootstrap.com) | [jQuery](https://jquery.com)
| [Json](https://www.json.org/json-en.html)

## Controllers

***Ctrl*** means <ins>controller identifier</ins> inside your Hamtaro application, it helps to identify the namespace and
the filepath of your controller.

- [`AbstractAjaxRequest`](https://github.com/cejobelo/hamtaro/blob/5f72f7604fd32670f314e5184bdf9ecc2c8ed6a6/src/Controller/Ajax/AbstractAjaxRequest.php) is extended by your ajax requests.
- [`AbstractForm`](https://github.com/cejobelo/hamtaro/blob/5f72f7604fd32670f314e5184bdf9ecc2c8ed6a6/src/Controller/Form/AbstractForm.php) is extended by your forms.
- [`AbstractModal`](https://github.com/cejobelo/hamtaro/blob/5f72f7604fd32670f314e5184bdf9ecc2c8ed6a6/src/Controller/Modal/AbstractModal.php) is extended by your modals.
- [`AbstractPage`](https://github.com/cejobelo/hamtaro/blob/5f72f7604fd32670f314e5184bdf9ecc2c8ed6a6/src/Controller/Page/AbstractPage.php) is extended by your pages.

> All controllers allowed to be loaded must be defined in src/main.php with the `controllers` property.

## Components

***Component*** means graphic item inside your Hamtaro application.

> `AbstractForm`, `AbstractModal` and `AbstractPage` extending [AbstractComponent](https://github.com/cejobelo/hamtaro/blob/5f72f7604fd32670f314e5184bdf9ecc2c8ed6a6/src/Controller/Component/AbstractComponent.php),
> create your own component type doing the same.

A component is composed of 4 files and identified with its ***Ctrl***.

- ***Ctrl.js -*** Front-end configuration extending [AbstractForm](https://github.com/cejobelo/hamtaro.js/blob/b30518b6b42796a8d53465fd5bb4e4f28bca1acb/src/Abstract/AbstractForm.js), [AbstractModal](https://github.com/cejobelo/hamtaro.js/blob/b30518b6b42796a8d53465fd5bb4e4f28bca1acb/src/Abstract/AbstractModal.js), [AbstractPage](https://github.com/cejobelo/hamtaro.js/blob/b30518b6b42796a8d53465fd5bb4e4f28bca1acb/src/Abstract/AbstractPage.js) or [AbstractComponent](https://github.com/cejobelo/hamtaro.js/blob/b30518b6b42796a8d53465fd5bb4e4f28bca1acb/src/Abstract/AbstractComponent.js).

- ***Ctrl.php -*** Back-end configuration extending [AbstractForm](https://github.com/cejobelo/hamtaro/blob/fabe1b632ada57adf5440f18f437db7806fd6b70/src/Controller/Form/AbstractForm.php), [AbstractModal](https://github.com/cejobelo/hamtaro/blob/fabe1b632ada57adf5440f18f437db7806fd6b70/src/Controller/Modal/AbstractModal.php), [AbstractPage](https://github.com/cejobelo/hamtaro/blob/fabe1b632ada57adf5440f18f437db7806fd6b70/src/Controller/Page/AbstractPage.php) or [AbstractComponent](https://github.com/cejobelo/hamtaro/blob/fabe1b632ada57adf5440f18f437db7806fd6b70/src/Controller/Component/AbstractComponent.php).

- ***Ctrl.sass -*** Component's stylesheet

- ***Ctrl.twig -*** Component's view. [Pug support](https://phug-lang.com) is coming.

Hamtaro identifies your components in the DOM with these types of selectors :

- `.hamtaro-component[data-ctrl="Header"]`
- `.hamtaro-form[data-ctrl="Identification/Reset"]`
- `.hamtaro-modal[data-ctrl="Newsletter"]`
- `.hamtaro-page[data-ctrl="About"]`

## Commands

Using [composer scripts](https://getcomposer.org/doc/articles/scripts.md), improve your workflow and save  considerable
time during development.

- `CreateAjaxRequest` to create a new ajax request.
- `CreateComponent` to create a new component.
- `CreateForm` to create a new form.
- `CreateModal` to create a new modal.
- `CreatePage` to create a new page.
- `CreateEvent` to create a new javascript event.

## Front-end development

Use [hamtaro.js](https://www.npmjs.com/package/hamtaro.js) for your front-end development.

The default webpack configuration supporting the following assets :
`.js`|`.sass`|`.scss`|`.css`

- `npm run assets` Build your assets ***public/main.min.js*** and ***public/main.min.css***.

- `npm run assets:dev` Your assets are monitored and built dynamically, just write bars and reload your browser to see the changes.

## Getting started

Your work environment is already ready.

```shell
composer create-project cejobelo/hamtaro-starter my_project && cd my_project && composer install && npm install
```

Enjoy 🐹