Array.prototype.sum = function (callback) {
    let sum = 0

    for (let i = 0; i < this.length; i++) {
        let value = this[i]

        if (typeof callback == 'function') {
            value = callback(value)
        }

        sum += parseFloat(value)
    }

    return sum
}

FormData.prototype.toObject = function () {
    let data = {}

    this.forEach((value, key) => {
        data[key] = value
    })

    return data
}