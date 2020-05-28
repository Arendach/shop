<span contenteditable="true"
     data-model="{{ get_class($model) }}"
     data-id="{{ $model->id }}"
     data-field="{{ $field }}"
     onkeyup="contentUpdate(this)">
    {!! $model->$field !!}
</span>

@pushonce('js:contentEditable')
<script>
    function contentUpdate(context) {
        let model = context.getAttribute('data-model')
        let id = context.getAttribute('data-id')
        let field = context.getAttribute('data-field')
        let value = context.innerText

        fetch('/assets/content-editable', {
            body: JSON.stringify({
                model, id, field, value
            }),
            method: 'post',
            headers: {'Content-Type': 'application/json'},
        })
    }
</script>
@endpushonce