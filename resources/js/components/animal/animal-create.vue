<template>
    <div class="container">
        <div class="columns is-multiline">
            <div class="card column is-half is-offset-one-quarter">
                <header class="card-header">
                    <h1 class="card-header-title">
                        Create Animal
                    </h1>
                </header>
                <div class="card-content">
                    <div class="content">
                    <form class="vue-form" @submit.prevent="submit">
                        <div class="field">
                            <label class="label" for="name">Name</label>
                            <div class="control">
                                <input type="text" class="input" name="name" id="name" required="" v-model="form.name">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="description">Description</label>
                            <div class="control">
                                <textarea class="textarea" name="description" id="description" required="" v-model="form.description"></textarea>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="species_id">Species ID</label>
                            <div class="control">
                                <div class="select is-fullwidth" :class="loading ? 'is-loading' : ''">
                                <select id="species_id" :disabled="loading" v-model="form.species_id">
                                    <option v-if="loading" :value="this.form.species_id">Loading...</option>
                                    <option v-for="specie in species" v-if="!loading" v-text="specie.name" :value="specie.id"></option>
                                </select>
                                </div>
                            </div>
                            <p v-if="noSpeciesID" class="help is-warning">Add a species to create animals!</p>
                        </div>
                        <div>
                            <input type="submit" class="button is-primary" value="Create">
                        </div>
                    </form>
                    <div class="query-message-container">
                        <query-messages ref="msg"></query-messages>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let form = new Form({
        'name': '',
        'description': '',
        'species_id': '',
    });

    import QueryMessage from '../base/QueryMessage'

    export default {

        components: {
            'query-messages': QueryMessage
        },

        data: function () {
            return {
                form: form,
                species: [],
                noSpeciesID: false
            };
        },

        methods: {
            // submit form handler
            submit() {
                this.form.post('/animal').then((response) => {
                    this.$refs.msg.showSuccessMessage('Animal successfully created.', 5000);

                    this.form.name = '';
                    this.form.description = '';
                    this.form.species_id = '';
                }).catch(error => {
                    this.$refs.msg.showErrorMessage('Animal already exists.', 5000);
                    console.log(error);
                });
            }
        },

        created() {
            axios.get('/list/species').then((response) => {
                this.species = response.data;

                if(this.loading)
                    this.noSpeciesID = true;
            }).catch(error => {
                console.log(error)
            });
        },

        computed: {
            loading() {
                return !this.species.length;
            }
        },

        watch: {
            species() {
                if (!this.loading && this.form.species_id === '') {
                    this.form.species_id = _.first(this.species).id;
                }
            }
        }
    }
</script>
