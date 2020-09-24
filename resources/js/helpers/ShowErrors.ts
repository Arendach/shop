class ShowErrors {
    form: HTMLElement = null
    errors: Object = null
    elementsToMethods = {
        input: {
            text: 'inputText',
            radio: 'inputRadio',
            checkbox: 'inputCheckbox',
            password: 'inputText',
            email: 'inputText'
        },
        select: 'select'
    }

    constructor(form: HTMLElement, errors: Object) {
        this.form = form
        this.errors = errors
    }

    init(): void {
        for (let name in this.errors) {
            let arrayErrors = this.errors[name]
            let errors = arrayErrors.join('<br>')
            let element = document.querySelector(`[name="${name}"]`)
            let tagName = element.tagName.toLowerCase()
            let type = element.getAttribute('type')

            if (tagName == 'input' && type == null) {
                type = 'text'
            }

            if (typeof this.elementsToMethods[tagName] === 'object') {
                this[this.elementsToMethods[tagName][type]](element, errors)
            } else {
                this[this.elementsToMethods[tagName]](element, errors)
            }

            this.events(element)
        }
    }


    inputText(element: Element, errors: String): void {
        let name = element.getAttribute('name')
        element.classList.add('is-invalid')

        if (!document.getElementById(`error-${name}`)) {
            element.insertAdjacentHTML('afterend', `<span id="error-${name}" class="text-danger">${errors}</span>`);
        }
    }

    select(element: Element, errors: String) {
        this.inputText(element, errors)
    }

    inputRadio(element: Element, errors: String) {

    }

    events(element: Element) {
        element.addEventListener('keyup', (event) => {
            let input = event.currentTarget as Element
            let name = input.getAttribute('name')
            let errorBlock = document.getElementById(`error-${name}`)

            if (input.classList.contains('is-invalid')) {
                input.classList.remove('is-invalid')
            }

            if (errorBlock) {
                errorBlock.remove()
            }
        })

        element.addEventListener('change', (event) => {
            let input = event.currentTarget as Element
            let name = input.getAttribute('name')
            let errorBlock = document.getElementById(`error-${name}`)

            if (input.classList.contains('is-invalid')) {
                input.classList.remove('is-invalid')
            }

            if (errorBlock) {
                errorBlock.remove()
            }
        })
    }
}

export default (form: HTMLElement, errors: Object): void => {
    return new ShowErrors(form, errors).init()
}