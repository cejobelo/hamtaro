import { AbstractEvent, Modals } from 'hamtaro.js';
import $ from "jquery";

/**
 * Close the modal when clicking on the Hamtaro backdrop.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
export default class HideWhenClicked extends AbstractEvent {
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
        return '.hamtaro-modal';
    }

    /**
     * @inheritDoc
     * @see AbstractEvent.handler
     */
    handler(event, element) {
        if (!$(event.target).parents('.modal-content').length) {
            Modals.closeCurrent();
        }
    }
}