import { Modals, AbstractEvent } from 'hamtaro.js';

/**
 * This event allows the display of a modal when clicked.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
export default class Show extends AbstractEvent {
    /**
     * @inheritDoc
     * @see AbstractEvent.getEvent
     */
    getEvent() {
        return 'click';
    }

    /**
     * @inheritDoc
     * @see AbstractEvent.getSelector
     */
    getSelector() {
        return '[data-modal]';
    }

    /**
     * @inheritDoc
     * @see AbstractEvent.handler
     */
    handler(event, element) {
        console.log('handled');
        event.preventDefault();
        event.stopImmediatePropagation();
        event.stopPropagation();

        Modals.closeCurrent();

        console.log('event.currentTarget.dataset', event.currentTarget.dataset);

        Modals.show(element.dataset.modal, event.currentTarget.dataset);
    }
}