import { AbstractEvent, Modals } from 'hamtaro.js';
import $ from "jquery";

/**
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
export default class HideWhenClicked extends AbstractEvent {
    /**
     * @inheritDoc
     * @see AbstractEvent.getEvent
     */
    getEvent() {
        return 'shown.bs.modal';
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
        const Modal = Modals.get(element.dataset.ctrl);

        if (Modal) {
            Modal.shown(event);
        }
    }
}