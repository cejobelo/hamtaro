import {AbstractEvent, Modals} from 'hamtaro.js';

/**
 * Remove the Hamtaro backdrop when closing the modal.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
export default class HiddenBsModal extends AbstractEvent {
    /**
     * @inheritDoc
     * @see AbstractEvent.getEvent
     */
    getEvent() {
        return 'hidden.bs.modal';
    }

    /**
     * @inheritDoc
     * @see AbstractEvent.getSelector
     */
    getSelector() {
        return '.modal';
    }

    /**
     * @inheritDoc
     * @see AbstractEvent.handler
     */
    handler(event, element) {
        let backdrop = document.querySelector('#HamtaroModalBackdrop');
        if (backdrop) {
            backdrop.remove();
        }

        const Modal = Modals.get(element.dataset.ctrl);

        if (Modal) {
            Modal.hidden(event);

            if (Modal.isDestroyable()) {
                Modal.destroy();
            }
        } else {
            element.remove();
        }
    }
}