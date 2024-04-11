<template>
    <div class="shortener__container mt-120">

        <span class="title mb-44">Shortener</span>

        <form @submit.prevent class="form">

            <div class="mb-16 container input-box">
                <input
                    v-model.trim="v$.postData.url.$model"
                    autocomplete="off"
                    id="url"
                    type="text" >
                <label for="url">Url</label>
                <div class="input-errors" v-for="error of v$.postData.url.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                </div>
            </div>

            <button  type="button" id="submitData" class="button" @click="submitData">Send</button>

        </form>

        <div v-if="loading">
            <VuePreloader
                background-color="#091a28"
                color="#ffffff"
                transition-type="fade-up"
            ></VuePreloader>
        </div>

    </div>
</template>


<script>
    import { useVuelidate } from '@vuelidate/core'
    import { required, url } from '@vuelidate/validators'

    export default {

        setup: () => ({ v$: useVuelidate() }),

        data() {
            return {
                postData: {
                    url: null
                },
                loading: false
            }
        },

        validations() {
            return {
                postData: {
                    url: { required, url }
                }
            }
        },


        methods: {

            submitData() {

                this.v$.$touch();

                if (!this.v$.$invalid) {

                    this.loading = true;
                    let url = '/api/url-alias/save';
                    axios.post(url, this.postData)
                        .then(response => {
                            console.log(response);
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                html: response.data.urlAlias.hash,
                                confirmButtonText: 'Close'
                            });
                        })
                        .catch(error => {
                            if (error.response && error.response.data && error.response.data.exception) {
                                console.log(error.response.data.exception);
                                Swal.fire({
                                    icon: 'error',
                                    title: error.response.status,
                                    html: error.response.data.exception,
                                    confirmButtonText: 'Close'
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: error.response.status,
                                    html: 'Error',
                                    confirmButtonText: 'Close'
                                });
                            }
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                }
            },
        },
    }

</script>
