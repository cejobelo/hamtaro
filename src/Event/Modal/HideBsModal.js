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
        return '.modal';
    }

    /**
     * @inheritDoc
     * @see AbstractEvent.handler
     */
    handler(event, element) {
        let eModal = document.querySelector('.modal.show'),
            eDialog = document.querySelector('.modal.show .modal-dialog');

        if ($(element).hasClass('.modal')) {
            element.dispatchEvent(oShownEvent);
        } else {
            $(element).parents('.modal')[0].dispatchEvent(oShownEvent);
        }

        if (eModal) {
            let oEvent = new Event('hide.modal'),
                oModal = Modals.get(eModal.dataset.filepath);

            if (oModal) {
                if (oModal.isClosable()) {
                    oModal.hide(oEvent);
                    eModal.dispatchEvent(oEvent);
                    eDialog.classList.add('fadeOut');
                    eDialog.classList.remove('slideInDown');
                }
            } else {
                eModal.dispatchEvent(oEvent);
                eDialog.classList.add('fadeOut');
                eDialog.classList.remove('slideInDown');
            }

            App.urlParam('modal', '');
        }
    }
}