<template>

    <form @submit.prevent="submit">

        <div class="card">

            <div class="card-header">
                <h3>Produto</h3>
            </div>

            <div class="card-body">

                <!-- name -->
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Nome *</label>

                        <input class="form-control"
                               v-model="fields.name"
                        >
                        <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
                    </div>
                </div>

                <!-- description-->
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Descrição</label>
                        <textarea type="textarea"
                                  class="form-control"
                                  v-model="fields.description"></textarea>
                        <div v-if="errors && errors.description" class="text-danger">{{ errors.description[0] }}</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label><input class="form-group" type="checkbox" v-model="fields.available"> Disponível?</label>
                        <br>
                        <div v-if="errors && errors.available" class="text-danger">{{ errors.available[0] }}</div>

                    </div>
                </div>

                <button class="btn btn-primary" id="bt_salvar" type="submit">
                    <i class="fa fa-save"></i>
                    <span>
                        Salvar
                    </span>
                </button>

                <button class="btn btn-secondary" id="" type="button" v-if="!this.id > 0"
                        @click="saveAndNew()"
                >
                    <i class="fa fa-save"></i>
                    <span>
                        Salvar e cadastrar novo
                    </span>
                </button>

            </div>

        </div>

        <iframe class="embed-responsive-item" id="iframe" width="100%"
                height="100%" style="display: none;"></iframe>

    </form>

</template>

<script>

    export default {

        name: "ProductItem",
        props: {
            baseUrl: {
                type: String,
                required: true
            },
            id: {
                type: String,
                required: false
            },
        },
        data() {
            return {

                loaded: true,
                errors: {},
                success: false,
                fields: {
                    available: true
                },
                method: 'POST',

                categories: {},
            }
        },
        methods: {
            changeAvailable() {
                this.fields.available = Number(this.fields.available);
            },
            addCategory() {

                let url = this.baseUrl + '/panel/categories/create';

                $('#iframe').attr('src', url + '?iframe=true');

                showIframeBlock('#iframe');

                let instanceVue = this;

                window.addEventListener('message', function (e) {

                    if (e.data.event === 'return-iframe-success') {

                        //add array object
                        instanceVue.categories.push({
                            id: e.data.data.table_id,
                            name: e.data.data.table_text_data,
                            parent: [],
                        });

                        instanceVue.fields.category_id = e.data.data.table_id;

                        instanceVue.onCloseIframe(e);
                    }
                });
            },
            onCloseIframe(e) {
                unBlock();
            },
            submit() {
                return this.save();
            },
            mountUrl() {

                let url = this.baseUrl + "/panel/products-item-store";

                this.$set(this.fields, '_method', 'POST');

                if (this.id > 0) {
                    url = this.baseUrl + "/panel/products/" + this.id;
                    this.$set(this.fields, '_method', 'PUT');

                    this.method = 'PUT';
                }

                return url;
            },
            saveAndNew() {
                this.save(false);
            },
            save(saveAndRedirect = true) {

                if (this.loaded) {

                    this.loaded = false;
                    this.success = false;
                    this.errors = {};

                    this.changeAvailable();

                    axios.request(this.mountUrl(), {
                        method: this.method,
                        params: this.fields,
                    })
                        .then((response) => {

                            showMessage('s', 'Adicionado com sucesso');

                            this.fields = {}; //Clear input fields.
                            this.loaded = true;
                            this.success = true;

                            if (saveAndRedirect) {
                                window.location.href = this.baseUrl + "/panel/products";
                            } else {
                                //window.location.href = this.baseUrl + "/panel/product-item/create?type=item";
                            }

                        })
                        .catch(error => {

                            this.loaded = true;

                            //400 500 401
                            if (error.response.status === 500) {
                                showMessage('e', 'Não foi possível completar requisição');
                                console.log(error.response.data.server_error);
                            }

                            if (error.response.status === 401) {
                                showMessage('w', 'A' + error.response.data.server_error);
                            }

                            if (error.response.status === 400) {
                                this.errors = error.response.data.errors || {};
                                showMessage('w', 'Preencha todos os campos obrigatórios.');
                            }

                        })
                }
            },
            loadCategories() {

                axios.get(this.baseUrl + "/panel/categories-list")
                    .then((response) => {
                        //console.log(response.data.data);

                        this.categories = response.data.data;
                        //showMessage('s', 'Sucesso');
                    })
                    .catch(err => {
                        console.log(err);
                        //showMessage('w', 'Erro ao recuperar informações');
                    });
            },
            loadProduct() {

                axios.get(this.baseUrl + "/panel/products/" + this.id)
                    .then((response) => {

                        this.fields = {...response.data.data};
                        //showMessage('s', 'Sucesso');
                    })
                    .catch(err => {
                        console.log(err);
                        //showMessage('w', 'Erro ao recuperar informações');
                    });
            },
        },
        mounted() {
            this.loadCategories();

            if (this.id > 0) {

                this.loadProduct();
            }
        }
    }

</script>

<style scoped>

</style>
