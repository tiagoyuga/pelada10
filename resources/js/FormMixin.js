export default {

    data() {

        return {
            fields: {},
            errors: {},
            success: false,
            loaded: true,
            action: '',
        }
    },

    methods: {

        submit() {

            if (this.loaded) {

                this.loaded = false;
                this.success = false;
                this.errors = {};

                axios.post(this.action, this.fields).then(response => {

                    this.fields = {}; //Clear input fields.
                    this.loaded = true;
                    this.success = true;

                }).catch(error => {

                    this.loaded = true;

                    /*if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }*/

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

    },
}
