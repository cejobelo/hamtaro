// Main sass file
import '../../../../src/main.sass';

import { Events } from 'hamtaro.js';

import $ from 'jquery';

// Will contain event instances
window.EVENTS = [];

// Will contain form instances
window.FORMS = {};

// Will contain modal instances
window.MODALS = {};

// Initialization of events
let aEventsInstances = [],
    aHamtaroEvents = require.context('./Event', true, /\.js$/).keys(),
    aProjectEvents = require.context('../../../../src/Event', true, /\.js$/).keys();

for (let i = 0; i < aHamtaroEvents.length; i++) {
    let found = aHamtaroEvents[i].match(/\.\/(.+\.js)/),
        path = found[1] || '',
        EventClass = require('./Event/' + path).default;
    aEventsInstances.push(new EventClass);
}

for (let i = 0; i < aProjectEvents.length; i++) {
    let found = aProjectEvents[i].match(/\.\/(.+\.js)/),
        path = found[1] || '',
        EventClass = require('../../../../src/Event/' + path).default;
    aEventsInstances.push(new EventClass);
}

Events.addEventHandlers(aEventsInstances).bindEventHandlers();

// Initialization of forms
window.FORMS = {};
let aForms = require.context('../../../../src/Controller/Form', true, /\.js$/).keys();
for (let i = 0; i < aForms.length; i++) {
    let found = aForms[i].match(/\.\/(.+\.js)/),
        path = found[1] || '',
        FormClass = require('../../../../src/Controller/Form/' + path).default,
        FormInstance = new FormClass;

    window.FORMS[FormInstance.getCtrl()] = FormInstance;
}

// Initialization of modals
window.MODALS = {};
let aModals = require.context('../../../../src/Controller/Modal', true, /\.js$/).keys();
for (let i = 0; i < aModals.length; i++) {
    let found = aModals[i].match(/\.\/(.+\.js)/),
        path = found[1] || '',
        ModalClass = require('../../../../src/Controller/Modal/' + path).default,
        ModalInstance = new ModalClass;

    window.MODALS[ModalInstance.getCtrl()] = ModalInstance;
}

$(document).ready(() => {
    let aPages = require.context('../../../../src/Controller/Page', true, /\.js$/).keys();

    for (let i = 0; i < aPages.length; i++) {
        let found = aPages[i].match(/\.\/(.+\.js)/),
            path = found[1] || '';

        if (path) {
            let PageClass = require('../../../../src/Controller/Page/' + path).default,
                PageInstance = new PageClass;

            if (PageInstance.getCtrl() === 'string' && PageInstance.getRoute() === this_.ROUTE) {
                PageInstance.init();
            }
            else if (Array.isArray(page.getRoute())) {
                if (page.getRoute().indexOf(window.JS_DATA['ROUTE']) !== -1) {
                    page.init();
                }
            }

            // Initialisation des évènements de la page
            let events = page.events();
            if (events) {
                Events.addEventHandlers(events).bindEventHandlers();
            }
        }
    }
});

// The page is loaded
$(document).ready(() => {
    let paths = require.context('../../../../src/Controller/Page', true, /\.js$/).keys();

    for (let key in paths) {
        if (paths.hasOwnProperty(key)) {
            let found = paths[key].match(/\.\/(.+\.js)/),
                path = found[1] || '';

            if (path) {
                let page = require('Page/' + path).default;
                page = new page();

                console.log('App.ROUTE', this_.ROUTE);
                console.log('page.getRoute()', page.getRoute());

                // Exécution du script lié à la route
                if (typeof page.getRoute() === 'string' && page.getRoute() === this_.ROUTE) {
                    page.init();
                }
                else if (Array.isArray(page.getRoute())) {
                    if (page.getRoute().indexOf(window.JS_DATA['ROUTE']) !== -1) {
                        page.init();
                    }
                }

                // Initialisation des évènements de la page
                let events = page.events();
                if (events) {
                    Events.addEventHandlers(events).bindEventHandlers();
                }
            }
        }
    }
});