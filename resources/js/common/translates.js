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

window["translate"] = function (text) {
    if (!window["translates"].hasOwnProperty(text)) {
        window["registerTranslate"](text)

        return text
    }

    return window["translates"][text]
}