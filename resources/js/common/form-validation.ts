import * as $ from 'jquery'

export default class FormValidation {
    private form: any;

    constructor(form) {
        this.form = form
    }

    public showErrors(errors: object) {
        $.each(errors ?? {}, (name: string, err: Array<string>) => {
            let input = $(this.form).find(`[name=${name}]`)

            input.addClass('is-invalid')
            input.siblings().css('color', 'red').css('display', 'block').text(err.join(','))
        })
    }
}