import {AbstractEvent, App, Modals} from 'hamtaro.js';

/**
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
export default class HideBsModal extends AbstractEvent {
    /**
     * @inheritDoc
     * @see AbstractEvent.getEvent
     */
    getEvent() {
        return 'hide.bs.modal';
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
        let eModal = document.querySelector('.modal.show');
        if (!eModal) {
            return;
        }

        let oModal = Modals.get(eModal.dataset.ctrl);

        if (oModal) {
            if (oModal.isClosable()) {
                oModal.hide(event);
            }
        }

        App.urlParam('modal', '');
    }
}