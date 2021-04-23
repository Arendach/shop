<template>
    <span>{{ field.value }}</span>
</template>

<script>
    export default {
        props: ['resourceName', 'field'],
        mounted() {
            if (this.field.value.length) {
                let value = JSON.parse(this.field.value)
                this.field.value = value.join(' / ')
            }
        }
    }

</script>
