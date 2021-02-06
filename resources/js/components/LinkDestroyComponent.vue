<template>
    <a class="dropdown-item" @click.prevent="destroy" :href="link">Remover</a>
</template>

<script>
    export default {
        name: "LinkDestroyComponent",
        props: {
            link: {
                type: String,
                required: true
            },
            lineId: {
                type: String,
                required: false
            }
        },
        methods: {
            destroy() {

                let lineId = this.lineId;
                let link = this.link;
                console.log("this.link = " + link);
                console.log("this.lineId = " + lineId);

                if (confirm('Confirma a remoção desse registro?')) {

                    axios.delete(link)
                        .then(function (response) {

                            console.log(response);
                            if (lineId) {
                                showMessage('s', 'Removido com sucesso');
                                $('#' + lineId).remove();
                            } else {

                                document.location.reload(true);
                            }

                        })
                        .catch(function (error) {
                            showMessage('w', 'Não foi possível realizar a remoção');
                            console.error(error);
                        });
                }
            }
        }
    }
</script>

<style scoped>

</style>
