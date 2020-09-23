const tokenTag = document.querySelector('meta[name=csrf-token]')
const _token = tokenTag ? tokenTag.content : null
const headers = {
    "Content-Type": "application/json charset=UTF-8",
    "X-CSRF-TOKEN": _token,
    "X-Requested-With": 'XMLHttpRequest',
    "Content-Language": window.lang || 'uk',
}
const defaultOptions = {
    headers,
    mode: 'cors',
    credentials: 'include'
}

class Request {
    constructor(url, opt = {}) {
        this.url = url
        this.opt = Object.assign({}, defaultOptions, opt)
        this.setHeaders()
    }

    setHeaders() {
    }

    send() {
        return fetch(this.url, this.opt).then((response) => {
            if (!response.ok) {
                return response.json().then(json => {
                    return Promise.reject({
                        status: response.status,
                        ok: false,
                        statusText: response.statusText,
                        body: json
                    })
                })
            }
            
            return this.returnResponseType(response)
        })
    }

    returnResponseType(response) {
        return response.json()
    }
}

class Get extends Request {
    setHeaders() {
        this.opt.method = 'GET'
    }
}

class GetHTML extends Request {
    setHeaders() {
        this.opt.headers["Content-Type"] = 'text/html charset=UTF-8'
        this.opt.method = 'GET'
    }

    returnResponseType(response) {
        return response.text()
    }
}

class Post extends Request {
    setHeaders() {
        this.opt.method = 'POST'
        this.opt.body = JSON.stringify(this.opt.body)
    }
}

class PostFormData extends Request {
    constructor(url, formData) {
        super(url, formData)
        this.url = url
        this.opt.body = formData
        this.opt.method = 'POST'
    }
}

const Api = {
    get(url, opt = {}) {
        const request = new Get(url, opt)
        return request.send()
    },
    getHtml(url, opt = {}) {
        const request = new GetHTML(url, opt)
        return request.send()
    },

    post(url, body = {}, opt = {}) {
        //body._token = _token
        const request = new Post(url, Object.assign({}, {body}, opt))
        return request.send()
    },
    postFormData(url, formData) {
        const request = new PostFormData(url, formData)
        return request.send()
    },
}

export default Api
