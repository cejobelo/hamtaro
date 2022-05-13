# Hamtaro framework

- [About](#about)
- [Technologies](#technologies)
- [Commands](#commands)
- [Components](#components)
- [Front-end development](#front-end-development)
- [Getting Started](#getting-started)

## About

Create your modern and stable web application in a strict, simplified and organized environment.

Do yourself a favor : use Hamtaro framework.

## Technologies

[Php](https://www.php.net) | [Javascript](https://developer.mozilla.org/en/docs/Web/JavaScript)
| [Composer](https://getcomposer.org) | [Npm](https://www.npmjs.com) | [Node.js](https://nodejs.org)
| [Webpack](https://webpack.js.org) | [Babel](https://babeljs.io) | [Sass](https://sass-lang.com)
| [Twig](https://twig.symfony.com) | [Bootstrap](https://getbootstrap.com) | [jQuery](https://jquery.com)
| [Json](https://www.json.org/json-en.html)

## Commands

Using [composer scripts](https://getcomposer.org/doc/articles/scripts.md), improve your workflow and save you
considerable time during development.

| Command                     | Description                    | Arguments                        |
|-----------------------------|--------------------------------|----------------------------------|
| ***CreateAjaxRequest***     | Create a new ajax request.     | #1 ***Ctrl*** of your controller |
| ***CreateComponent***       | Create a new component.        | #1 ***Ctrl*** of your component  |
| ***CreateForm***            | Create a new form.             | #1 ***Ctrl*** of your form       |
| ***CreateModal***           | Create a new modal.            | #1 ***Ctrl*** of your modal      |
| ***CreatePage***            | Create a new page.             | #1 ***Ctrl*** of your page       |
| ***CreateJavascriptEvent*** | Create a new Javascript event. | #1 the event's name.             |

> ***Ctrl*** means <ins>controller identifier</ins> inside your Hamtaro application.<br>You can identify the namespace and
> the filepath of the controller, very usefull.

## Components

***Component*** means graphic item inside your Hamtaro application.

A component is composed of 4 files :

- ***FooComponent.js -*** Front-end class of your component extending [AbstractComponent](https://github.com/cejobelo/hamtaro.js/blob/b30518b6b42796a8d53465fd5bb4e4f28bca1acb/src/Abstract/AbstractComponent.js) | [AbstractForm](https://github.com/cejobelo/hamtaro.js/blob/b30518b6b42796a8d53465fd5bb4e4f28bca1acb/src/Abstract/AbstractForm.js) | [AbstractModal](https://github.com/cejobelo/hamtaro.js/blob/b30518b6b42796a8d53465fd5bb4e4f28bca1acb/src/Abstract/AbstractModal.js) | [AbstractPage](https://github.com/cejobelo/hamtaro.js/blob/b30518b6b42796a8d53465fd5bb4e4f28bca1acb/src/Abstract/AbstractPage.js)

- ***FooComponent.php -*** Back-end class of your component extending [AbstractComponent](https://github.com/cejobelo/hamtaro/blob/fabe1b632ada57adf5440f18f437db7806fd6b70/src/Controller/Component/AbstractComponent.php) | [AbstractForm](https://github.com/cejobelo/hamtaro/blob/fabe1b632ada57adf5440f18f437db7806fd6b70/src/Controller/Form/AbstractForm.php) | [AbstractModal](https://github.com/cejobelo/hamtaro/blob/fabe1b632ada57adf5440f18f437db7806fd6b70/src/Controller/Modal/AbstractModal.php) | [AbstractPage](https://github.com/cejobelo/hamtaro/blob/fabe1b632ada57adf5440f18f437db7806fd6b70/src/Controller/Page/AbstractPage.php).

- ***FooComponent.sass -*** Stylesheet of your component

- ***FooComponent.twig -*** Html of your component. [Pug support](https://phug-lang.com) is coming.

Identify your components in the DOM with these types of selectors :

- `.hamtaro-component[data-ctrl="Header"]`
- `.hamtaro-form[data-ctrl="Identification/Reset"]`
- `.hamtaro-modal[data-ctrl="Newsletter"]`
- `.hamtaro-page[data-ctrl="About"]`

## Front-end development

Use [hamtaro.js](https://www.npmjs.com/package/hamtaro.js) for your front-end development.

The [webpack configuration](https://github.com/cejobelo/hamtaro.js/blob/b30518b6b42796a8d53465fd5bb4e4f28bca1acb/webpack.js) supporting the following assets :

[`.js`](https://www.npmjs.com/package/babel-loader) [`.sass` `.scss` `.css`](https://www.npmjs.com/package/sass-loader)

- `npm run assets` Build your assets ***public/main.min.js*** and ***public/main.min.css***.

- `npm run assets:dev` Your assets are monitored and built dynamically, just write bars and reload your browser to see the changes.

> Create your own Webpack configuration if you want to go further.

## Getting started

Your work environment is already ready.

```shell
composer create-project cejobelo/hamtaro-starter my_project && cd my_project && composer install && npm install
```

Enjoy. 🐹