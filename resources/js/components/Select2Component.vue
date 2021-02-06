<template>
    <select>
        <slot></slot>
    </select>
</template>

<script>
    import 'select2/dist/js/select2.full';
    import 'select2/dist/css/select2.css';
    import '@ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.css';

    export default {
        name: "Select2Component",
        props: ['options', 'value'],
        mounted: function () {
            let vm = this;
            $(this.$el)
                // init select2
                .select2({
                    data: this.options,
                    containerCssClass: ':all:',
                    width: 'resolve',
                    theme: 'bootstrap4'
                })
                .val(this.value)
                .trigger('change')
                // emit event on change.
                .on('change', function () {
                    vm.$emit('input', this.value)
                })
        },
        watch: {
            value: function (value) {
                //console.info('SELECT 2 -- value: ', value);
                // update value
                $(this.$el)
                    .val(value)
                    .trigger('change')
            },
            options: function (options) {
                //console.info('SELECT 2 -- change options to: ', options);
                // update options
                //$(this.$el).empty().select2({data: options});
                $(this.$el).empty().select2({
                    data: this.options,
                    containerCssClass: ':all:',
                    width: 'resolve',
                    theme: 'bootstrap4'
                })
                    .trigger('change');
            }
        },
        destroyed: function () {
            //console.info('SELECT 2 -- destroy');
            $(this.$el).off().select2('destroy')
        },
    }
</script>

<style scoped>

</style>
