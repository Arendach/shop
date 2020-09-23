class Url {
    constructor() {
        this.query = new URLSearchParams(window.location.search)
    }

    getParam(param, arrKey) {
        let paramArray

        if (typeof arrKey !== 'undefined') {
            paramArray = this.query.getAll(`${param}[${arrKey}][]`)
        } else {
            paramArray = this.query.getAll(param + '[]')
        }
        let paramString = this.query.get(param)

        if (paramArray.length) {
            return paramArray
        } else {
            return paramString
        }
    }

    stringify(data) {
        let result = []
        data.forEach((value, key) => {
            if (!value) {
                return
            }
            result.push(`${key}=${value}`)
        })

        return result.join('&')
    }

    paramsFromFormData(element) {
        let data = new FormData(element)

        return this.stringify(data)
    }

    changeQueryString(query) {
        window.location.search = query
    }
}

export default Url