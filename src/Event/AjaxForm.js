import { Ajax, Form, AbstractEvent } from 'hamtaro.js';

/**
 * Ajax Form.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
export default class AjaxForm extends AbstractEvent {
    /**
     * @inheritDoc
     * @see AbstractPage.getEvent
     */
    getEvent() {
        return 'submit';
    }

    /**
     * @inheritDoc
     * @see AbstractPage.getSelector
     */
    getSelector() {
        return '.hamtaro-form';
    }

    /**
     * @inheritDoc
     * @see AbstractPage.handler
     */
    handler(event, element) {
        event.preventDefault();
        let $this = $(this);

        $this.find('[data-fielderror]').html('');
        $this.find('input, select, textarea').removeClass('error');
        $this.find('.form-error-msg').html('');

        $this.addClass('loading');

        const FormContext = Form.get(this.dataset.ctrl);

        FormContext.beforeSubmit();

        let aData = $this.serializeArray(),
            oData = {};
        for (let i = 0; i < aData.length; i++) {
            let oField = aData[i];
            oData[oField['name']] = oField['value']
        }

        Ajax.submitForm(this.dataset.ctrl, oData).then((AxiosResponse) => {
            $this.removeClass('loading');

            if (AxiosResponse['data']['success']) {
                FormContext.success(AxiosResponse.data);
            } else {
                FormContext.error(AxiosResponse.data);
            }

            FormContext.afterSubmit();
        });
    }
}