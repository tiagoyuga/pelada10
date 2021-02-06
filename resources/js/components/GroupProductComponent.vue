<template>

    <form @submit.prevent="submit">

        <div class="card mt-4" v-for="(groupProduct, indexGroupProduct) in fields.groupProducts">

            <div class="card-header">
                <button type="button" class="btn btn-default float-right" alt="Remover grupo?" title="Remover grupo?"
                        @click="removeGroup(indexGroupProduct)">
                    <i class="fa fa-trash"></i>
                </button>

                <h3>Grupo de produtos {{ indexGroupProduct + 1 }}</h3>

            </div>

            <div class="card-body">

                <div class="product_group">

                    <div class="form-row">
                        <div class="form-group col-md-12 ">
                            <label>Nome *</label>
                            <input type="text" class="form-control"
                                   v-model="fields.groupProducts[indexGroupProduct].name">
                            <div v-if="errors && errors['groupProducts.'+indexGroupProduct+'.name']"
                                 class="text-danger">{{
                                errors['groupProducts.'+indexGroupProduct+'.name'][0] }}
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div
                            class="form-group col-md-6 ">
                            <label>Mínimo *</label>
                            <input type="number" class="form-control"
                                   v-model="fields.groupProducts[indexGroupProduct].min">
                            <div v-if="errors && errors['groupProducts.'+indexGroupProduct+'.min']" class="text-danger">
                                {{
                                errors['groupProducts.'+indexGroupProduct+'.min'][0] }}
                            </div>
                        </div>

                        <div
                            class="form-group col-md-6 ">
                            <label>Máximo *</label>
                            <input type="number" class="form-control"
                                   v-model="fields.groupProducts[indexGroupProduct].max">
                            <div v-if="errors && errors['groupProducts.'+indexGroupProduct+'.max']" class="text-danger">
                                {{
                                errors['groupProducts.'+indexGroupProduct+'.max'][0] }}
                            </div>

                        </div>

                    </div>

                </div>

                <fieldset>

                    <hr>
                    <h3>Selecione os items</h3>

                    <div class="form-row" v-for="(item, indexItem) in groupProduct.items">
                        <div
                            class="form-group col-md-6 ">
                            <label>Item {{ indexItem + 1 }} *</label>

                            <v-select :options="itemOptions"
                                      :reduce="option => option.id"
                                      id="id"
                                      label="text"
                                      placeholder="Escolha um item"
                                      v-model="fields.groupProducts[indexGroupProduct].items[indexItem].product_id">
                            </v-select>

                            <!--<select class="form-control form-control-lg select2_ item-group" style="width: 100%"
                                    v-model="fields.groupProducts[indexGroupProduct].items[indexItem].product_id">
                                <option value="">Selecione...</option>
                                <option v-for="item in itemOptions"
                                    :value="item.id">{{ item.text }}
                                </option>
                            </select>-->

                            <div
                                v-if="errors && errors['groupProducts.'+indexGroupProduct+'.items.'+indexItem+'.product_id']"
                                class="text-danger">
                                {{ errors['groupProducts.'+indexGroupProduct+'.items.'+indexItem+'.product_id'][0] }}
                            </div>
                        </div>

                        <div
                            class="form-group col-md-5 ">
                            <label>Valor R$ *</label>
                            <money
                                class="form-control"
                                v-bind="money"
                                v-model="fields.groupProducts[indexGroupProduct].items[indexItem].price"></money>
                            <div
                                v-if="errors && errors['groupProducts.'+indexGroupProduct+'.items.'+indexItem+'.price']"
                                class="text-danger">
                                {{ errors['groupProducts.'+indexGroupProduct+'.items.'+indexItem+'.price'][0] }}
                            </div>
                        </div>

                        <div class="form-group col-md-1 ">

                            <label>Remover?</label>
                            <button type="button" class="btn btn-default form-control" alt="Remover grupo?"
                                    title="Remover grupo?"
                                    @click="removeItem(indexGroupProduct, indexItem)">
                                <i class="fa fa-trash"></i>
                            </button>

                        </div>

                    </div>

                </fieldset>

                <div class="form-row float-right">
                    <button @click="addItem(groupProduct)" class="btn btn-primary" type="button">
                        <i class="fa fa-plus"></i>
                        Adicionar item
                    </button>
                </div>
            </div>

        </div>

        <div class="row mt-5"></div>

        <div class="col-md-12">

            <div class="form-row float-right">
                <button type="button" class="btn btn-default" @click="addGroupProduct">
                    <i class="fa fa-plus"></i>
                    Adicionar grupo
                </button>
            </div>

            <div class="form-group">

                <button type="button" class="btn btn-primary" @click="submit">
                    <i class="fa fa-save"></i>
                    Salvar
                </button>

            </div>

        </div>

    </form>

</template>

<script>

    import {Money} from "v-money";
    import vSelect from 'vue-select';
    import 'vue-select/dist/vue-select.css';
    import GroupModel from "../models/GroupModel";
    import GroupItemModel from "../models/GroupItemModel";

    export default {
        name: "GroupProductComponent",
        components: {Money, vSelect},
        props: {
            baseUrl: {
                type: String,
                required: true
            },
            product_id: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                loaded: true,
                errors: {},
                success: false,
                fields: {
                    groupProducts: [new GroupModel()],
                },
                itemOptions: [],
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
            submit() {
                return this.save();
            },
            save() {

                if (this.loaded) {

                    this.loaded = false;
                    this.success = false;
                    this.errors = {};

                    let url = this.baseUrl + "/panel/products-store-group/" + this.product_id;

                    axios.post(url, this.fields)
                        .then(() => {
                            this.success = true;

                            this.loadGroupProducts();

                            showMessage('s', 'Salvo com sucesso');
                        })
                        .catch(error => {

                            if (error.response.status === 500) {
                                showMessage('e', 'Não foi possível completar requisição');
                            }

                            if (error.response.status === 401) {
                                showMessage('w', error.response.data.server_error);
                            }

                            if (error.response.status === 400) {
                                this.errors = error.response.data.errors || {};
                                showMessage('w', 'Preencha todos os campos obrigatórios.');
                            }
                        })
                        .finally(() => this.loaded = true)
                }
            },
            removeGroup(groupKey) {

                if (this.fields.groupProducts[groupKey].id > 0) {

                    if (confirm('Deseja remover grupo?')) {
                        this.$delete(this.fields.groupProducts, groupKey);
                        this.submit();
                    }
                } else {

                    this.$delete(this.fields.groupProducts, groupKey);
                }
            },
            removeItem(groupKey, itemKey) {

                if (this.fields.groupProducts[groupKey].items[itemKey].id > 0) {

                    if (confirm('Deseja remover item?')) {
                        this.$delete(this.fields.groupProducts[groupKey].items, itemKey);
                        this.submit();
                    }
                } else {

                    this.$delete(this.fields.groupProducts[groupKey].items, itemKey);
                }
            },
            addItem(groupProduct) {

                groupProduct.items.push(new GroupItemModel());
            },
            addGroupProduct() {

                this.fields.groupProducts.push(new GroupModel());
            },
            loadItemOptions() {
                axios.get(this.baseUrl + "/panel/products-list")
                    .then((response) => {
                        this.itemOptions = response.data.data.map(function (item) {

                            return {
                                'id': item.id,
                                'text': item.name
                            };
                        });
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            async loadItemOptions2() {
                await axios.get(this.baseUrl + "/panel/products-list")
                    .then((response) => {
                        this.itemOptions = response.data.data.map(function (item) {

                            return {
                                'id': item.id,
                                'text': item.name
                            };
                        });
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            loadGroupProducts() {

                axios.get(this.baseUrl + "/panel/products-group-list/" + this.product_id)
                    .then((response) => {
                        this.fields.groupProducts = [];
                        let data = response.data.data;
                        let vm = this;

                        data.map(function (group) {

                            let groupModel = new GroupModel();
                            groupModel.id = group.id;
                            groupModel.name = group.name;
                            groupModel.min = group.min;
                            groupModel.max = group.max;
                            groupModel.items = null;
                            groupModel.items = [];

                            group.items.map(function (item) {

                                let groupItemModel = new GroupItemModel();
                                groupItemModel.id = item.id;
                                groupItemModel.product_id = item.product_id;
                                groupItemModel.price = item.price;
                                groupItemModel.quantity = item.quantity;

                                groupModel.items.push(groupItemModel);
                            });

                            vm.fields.groupProducts.push(groupModel);
                        });
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
        },
        beforeCreate() {
        },
        created() {
            this.loadItemOptions();
            this.loadGroupProducts();
        },
        beforeMount() {
        },
        mounted() {
        }
    }

</script>

<style scoped>

</style>
