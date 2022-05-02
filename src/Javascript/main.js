// Main sass file
import '../../../../../src/Stylesheet/main.sass';
import { Events } from 'hamtaro.js';

// Will contain event instances
window.EVENTS = [];

// Will contain form instances
window.FORMS = {};

// Will contain modal instances
window.MODALS = {};

// Initialization of events
let aEventsInstances = [],
    aHamtaroEvents = require.context('./Event', true, /\.js$/).keys(),
    aProjectEvents = require.context('../../../../../src/Javascript/Event', true, /\.js$/).keys();

for (let i = 0; i < aHamtaroEvents.length; i++) {
    let found = aHamtaroEvents[i].match(/\.\/(.+\.js)/),
        path = found[1] || '',
        EventClass = require('./Event/' + path).default;
    aEventsInstances.push(new EventClass);
}

for (let i = 0; i < aProjectEvents.length; i++) {
    let found = aProjectEvents[i].match(/\.\/(.+\.js)/),
        path = found[1] || '',
        EventClass = require('../../../../../src/Javascript/Event/' + path).default;
    aEventsInstances.push(new EventClass);
}

Events.addEventHandlers(aEventsInstances).bindEventHandlers();

// Initialization of forms
window.FORMS = {};
let aForms = require.context('../../../../../src/Controller/Form', true, /\.js$/).keys();
for (let i = 0; i < aForms.length; i++) {
    let found = aForms[i].match(/\.\/(.+\.js)/),
        path = found[1] || '',
        FormClass = require('../../../../../src/Controller/Form/' + path).default,
        FormInstance = new FormClass;

    window.FORMS[FormInstance.getCtrl()] = FormInstance;
}

// Initialization of modals
window.MODALS = {};
let aModals = require.context('../../../../../src/Controller/Modal', true, /\.js$/).keys();
for (let i = 0; i < aModals.length; i++) {
    let found = aModals[i].match(/\.\/(.+\.js)/),
        path = found[1] || '',
        ModalClass = require('../../../../../src/Controller/Modal/' + path).default,
        ModalInstance = new ModalClass;

    window.MODALS[ModalInstance.getCtrl()] = ModalInstance;
}