<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <span class="w-1/3">
                <input
                        class="form-control form-input form-input-bordered"
                        :class="errorClasses"
                        :placeholder="placeholderFirst"
                        v-model="firstRow"
                />
            </span>

            <span class="w-1/3">
                <input
                        class="form-control form-input form-input-bordered"
                        :class="errorClasses"
                        :placeholder="placeholderSecond"
                        v-model="secondRow"
                />
            </span>

            <span class="w-1/3">
                <input
                        class="form-control form-input form-input-bordered"
                        :class="errorClasses"
                        :placeholder="placeholderLast"
                        v-model="lastRow"
                />
            </span>
        </template>
    </default-field>
</template>

<script>
    import {FormField, HandlesValidationErrors} from 'laravel-nova'

    export default {
        mixins: [FormField, HandlesValidationErrors],

        props: ['resourceName', 'resourceId', 'field'],

        data() {
            return {
                firstRow: '',
                secondRow: '',
                lastRow: '',
                placeholderFirst: '',
                placeholderSecond: '',
                placeholderLast: ''
            }
        },

        methods: {
            setInitialValue() {
                this.value = this.field.value || ''
            },

            fill(formData) {
                formData.append(this.field.attribute, JSON.stringify([
                    this.firstRow,
                    this.secondRow,
                    this.lastRow
                ]))
            },

            handleChange(value) {
                this.value = value
            },
        },
        mounted() {
            if (this.value.length) {
                let value = JSON.parse(this.value)
                this.firstRow = value[0]
                this.secondRow = value[1]
                this.lastRow = value[2]
            } else {
                this.firstRow = ''
                this.secondRow = ''
                this.lastRow = ''
            }

            if (this.field.placeholders.length){
                let placeholders = this.field.placeholders

                this.placeholderFirst = placeholders[0]
                this.placeholderSecond = placeholders[1]
                this.placeholderLast = placeholders[2]
            }
        }
    }
</script>
