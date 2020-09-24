window["registerTranslate"] = function (text) {
    fetch('/assets/register_translate', {
        body: JSON.stringify({text}),
        headers: {'Content-Type': 'application/json'},
        method: 'post'
    }).then((response) => {
        return response.json()
    }).then((response) => {
        response.result
    })
}

window["translate"] = function (text, fields) {
    let result = ''

    if (!window["translates"].hasOwnProperty(text)) {
        window["registerTranslate"](text)

        result = text
    } else {
        result = window["translates"][text]
    }

    if (typeof fields == "object") {
        for (let key in fields) {
            result = result.replace(key, fields[key])
        }
    }

    return result
}