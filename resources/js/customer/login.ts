import axios from 'axios'
import * as toastr from "toastr"
import * as $ from 'jquery'
import '../common/form-validation';
import FormValidation from "../common/form-validation";

class Customer {
    constructor() {
        $(document).on('input', '.form-control', function () {
            $(this).removeClass('is-invalid')
            $(this).siblings().css('display', 'none')
        })
    }

    async submitLogin(form: any) {
        await axios({
            method: form.method,
            url: form.action,
            data: new FormData(form)
        }).then(() => {
            let url = new URL(window.location.href)
            let redirect = url.searchParams.get('redirect')
            if (redirect) {
                window.location.href = redirect
            } else {
                window.location.href = '/'
            }
        }).catch(errors => {
            new FormValidation(form).showErrors(errors.response.data.errors ?? {})
        })
    }

    async submitRegister(form) {
        await axios({
            method: form.method,
            url: form.action,
            data: new FormData(form)
        }).then(response => {
            window.location.href = '/'
        }).catch((errors) => {
            new FormValidation(form).showErrors(errors.response.data.errors ?? {})

            toastr.error('Помилка')
        })
    }

    events() {

    }
}

(<any>window).Customer = new Customer()