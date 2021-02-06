<template>

    <form @submit.prevent="submit">

        <div class="card">

            <div class="card-header">
                <h3>Produto</h3>
            </div>

            <div class="card-body">

                <!--<div v-if="this.id > 0" id="div-product-images">-->
                <div id="div-product-images">

                    <!-- images -->
                    <div class="form-row">

                        <div v-for="(image,index) in this.images">

                            <div class="form-group col-md-2">
                                <label>
                                    <!--<strong>Título {{ index }}:</strong> {{ image.name }}-->
                                </label>
                                <br>
                                <img
                                    :src="image.image"
                                    class="img"
                                    width="220"
                                    @click="changeIndex(index)"
                                >

                            </div>

                            <div class="col">

                                <button type="button"
                                        class="btn btn-default "
                                        v-bind:class="{ 'bg-info': image.main }"
                                        alt="Definir como principal?"
                                        title="Definir como principal?"
                                        @click="markMainImage(image.id, index)"
                                >
                                    <i class="fa fa-star"></i>
                                </button>

                                <button type="button" class="btn btn-default"
                                        alt="Remover imagem?"
                                        title="Remover grupo?"
                                        @click="removeImage(image.id, index)"
                                >
                                    <i class="fa fa-trash"></i>
                                </button>

                                <button type="button"
                                        class="btn btn-default"
                                        alt="Recortar imagem?"
                                        title="Recortar imagem?"
                                        @click="cropImage(image.id)"
                                >
                                    <i class="fa fa-crop"></i>
                                </button>

                            </div>

                        </div>

                    </div>

                    <hr>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label>Nova imagem</label>
                            <input type="file" ref="files" id="files" class="form-control" multiple
                                   v-on:change="saveFileUploads()"
                            >
                            <small class="form-text text-muted">Para efetuar múltiplos uploads, selecione os arquivos
                                pressionando a tecla CTRL</small>
                            <div v-if="errors && errors.image" class="text-danger">{{ errors.image[0] }}</div>
                        </div>

                    </div>

                </div>

                <!-- category -->
                <div class="form-row">
                    <div
                        class="form-group col-md-6">
                        <label>Categoria *</label>

                        <select class="form-control form-control-lg select22" style="width: 100%"
                                v-model="fields.category_id"
                        >

                            <option disabled value="">Escolha um item</option>

                            <option v-for="category in categories"
                                    :value="category.id"
                                    v-bind:fields.category_id="category.id"
                            >
                                {{ category.name }}
                            </option>

                        </select>

                        <button class="btn btn-link btn-sm text-color float-right open-iframe" type="button"
                                @click="addCategory"
                        >
                            <i class="fa fa-plus"></i>
                            Cadastrar categoria
                        </button>

                        <div v-if="errors && errors.category_id" class="text-danger">{{ errors.category_id[0] }}</div>
                    </div>

                    <!-- price -->
                    <div class="form-group col-md-6">
                        <label>Valor R$ *</label>

                        <money
                            v-model="fields.price"
                            v-bind="money"
                            class="form-control"></money>

                        <div v-if="errors && errors.price" class="text-danger">{{ errors.price[0] }}</div>

                    </div>

                </div>

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
                    <div
                        class="form-group col-md-12">
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
                        {{ this.id > 0 ? 'Salvar edição' : 'Avançar' }}
                    </span>
                </button>

                <button @click="saveAndNew()" class="btn btn-secondary" type="button"
                        v-if="!this.id > 0">
                    <i class="fa fa-save"></i>
                    <span>
                        Salvar e cadastrar novo
                    </span>
                </button>

            </div>

            <FsLightbox
                :toggler="toggler"
                :sources="imagesSrc"
                :key="imagesSrc.length"
                :sourceIndex="imageSourceIndex"
            />

        </div>

        <iframe class="embed-responsive-item" id="iframe" width="100%"
                height="100%" style="display: none;"></iframe>

    </form>

</template>

<script>

    import {Money} from 'v-money';

    import FsLightbox from "fslightbox-vue";

    export default {

        components: {FsLightbox, Money},

        name: "ProductMain",
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

                toggler: false,

                loaded: true,
                errors: {},
                success: false,
                fields: {
                    available: true,
                    price: 0,
                },
                method: 'POST',

                categories: {},
                files: '',
                formData: new FormData(),

                images: [],
                imagesSrc: [],
                imageSourceIndex: 0,

                money: {
                    decimal: ',',
                    thousands: '.',
                    prefix: '',
                    suffix: '',
                    precision: 2,
                    masked: false
                }
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
            cropImage(image_id) {

                let url = this.baseUrl + '/panel/images/crop/' + image_id;

                $('#iframe').attr('src', url + '?iframe=true');

                showIframeBlock('#iframe');

                let instanceVue = this;

                window.addEventListener('message', function (e) {

                    if (e.data.event === 'return-iframe-success') {

                        instanceVue.onCloseIframe(e);
                        instanceVue.loadProductImages();
                    }
                });
            },
            onCloseIframe(e) {
                unBlock();
            },
            markMainImageClass(image_id, index) {

                $.each(this.images, function (key, value) {
                    value.main = (image_id == value.id) ? 1 : 0;
                });
            },
            markMainImage(image_id, index) {

                if (confirm('Deseja marcar esta imagem como principal?')) {

                    axios.put(this.baseUrl + "/panel/products-images-main/" + this.id + "/" + image_id)
                        .then((response) => {

                            console.log(image_id, index);
                            showMessage('s', 'Sucesso');

                            this.markMainImageClass(image_id, index);
                        })
                        .catch(err => {
                            console.log(err);
                            showMessage('w', 'Não foi possível concluir ação');
                        });
                }
            },
            removeImage(image_id, index) {

                if (confirm('Deseja realmente remover imagem?')) {

                    axios.delete(this.baseUrl + "/panel/products-images-delete/" + this.id + "/" + image_id)
                        .then((response) => {

                            console.log(image_id, index);

                            this.$delete(this.images, index);

                            this.imageSourceIndex = Number(0);

                            this.loadProductImages();

                            showMessage('s', 'Imagem removida com sucesso');
                        })
                        .catch(err => {
                            console.log(err);
                            showMessage('w', 'Não foi possível remover imagem');
                        });
                }
            },
            changeIndex(index) {
                this.imageSourceIndex = Number(index);
                this.toggler = !this.toggler;
            },
            saveFileUploads() {

                this.files = this.$refs.files.files;

                for (var i = 0; i < this.files.length; i++) {
                    let file = this.files[i];
                    this.formData.append('files[' + i + ']', file);
                }

                this.makeUpload();
                this.formData = new FormData();
            },
            makeUpload() {

                if (this.id > 0 && this.files.length > 0) {

                    let url = this.baseUrl + "/panel/products-store-image/" + this.id;

                    //upload image
                    axios.post(url,
                        this.formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            },
                            method: 'POST'
                        }
                    )
                        .then((response) => {
                            this.formData = new FormData();

                            this.images = {...response.data.data};
                            showMessage('s', 'Imagem adicionada com sucesso.');

                            this.loadImagesSrc();
                        })
                        .catch(error => {

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

                        });
                }
            },
            submit() {
                return this.save();
            },
            mountUrl() {

                let url = this.baseUrl + "/panel/products-store";

                this.$set(this.fields, '_method', 'POST');

                if (this.id > 0) {
                    url = this.baseUrl + "/panel/products/" + this.id;
                    this.$set(this.fields, '_method', 'PUT');

                    this.method = 'PUT';
                }

                return url;
            },
            loadImagesSrc() {

                let arrayImages = [];

                $.each(this.images, function (key, value) {

                    let image = value.image + '?time=' + Date.now();
                    value.image = image;

                    arrayImages.push(image);
                });

                this.imagesSrc = arrayImages;
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

                            this.id = response.data.data.id;

                            this.makeUpload();

                            if (saveAndRedirect) {
                                window.location.href = this.baseUrl + "/panel/products/" + response.data.data.id + "/edit";
                                //window.location.href = this.baseUrl + "/panel/products";
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

                this.loadProductImages();

            },
            loadProductImages() {

                axios.get(this.baseUrl + "/panel/products-images-list/" + this.id)
                    .then((response) => {
                        this.images = response.data.data;
                        this.loadImagesSrc();
                    })
                    .catch(err => {
                        console.log(err);
                        //showMessage('w', 'Erro ao recuperar informações');
                    });
            },
        },
        mounted() {

            this.loadCategories();

            //edit
            if (this.id > 0) {

                this.loadProduct();
            }
        }
    }

</script>

<style scoped>

</style>
