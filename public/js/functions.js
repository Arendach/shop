function FormDataSet(a) {
    let res = new FormData();
    for (let it in a) res.set(it, a[it]);
    return res;
}

function implode(glue, pieces) {
    return ((pieces instanceof Array) ? pieces.join(glue) : pieces);
}

function ErrorResultPrepare(params) {
    let res = {};
    for (let field in params)
        res[field] = implode('<br>', params[field]);
    console.log(res)
    return res;
}
