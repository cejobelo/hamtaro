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
        event.preventDefault();
        event.stopImmediatePropagation();
        event.stopPropagation();

        Modals.closeCurrent();

        Modals.show(element.dataset.modal, event.currentTarget.dataset);
    }
}