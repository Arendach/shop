import Inputmask from "inputmask/lib/inputmask";

window.addEventListener('load', () => {
    Inputmask('999-999-99-99').mask(document.querySelectorAll('[data-mask="phone"]'))
})