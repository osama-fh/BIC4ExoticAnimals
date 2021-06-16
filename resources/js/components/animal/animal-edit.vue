<template>
    <div class="container">
        <div class="columns is-multiline">
            <div class="card column is-half is-offset-one-quarter">
                <header class="card-header">
                    <h1 class="card-header-title">
                        Edit animal
                    </h1>
                </header>
                <div class="card-content">
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
                            <p class="help is-danger" v-if="form.errors.has('species_id')"
                               v-text="form.errors.get('species_id')"/>
                            <p v-if="noSpeciesID" class="help is-warning">Add a species to edit animals!</p>
                        </div>
                        <br/>
                        <div>
                            <input type="submit" class="button is-primary" value="Update">
                        </div>
                    </form>
                    <div class="query-message-container">
                        <query-messages ref="msg"></query-messages>
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
        'noReset': ['species_id']
    });

    export default {

        components: {
            'query-messages': QueryMessage
        },

        methods: {
            submit() {
                this.form.put('/animal/' + this.animal.slug).then((response) => {
                    this.$refs.msg.showSuccessMessage('Animal successfully updated.', 5000);
                }).catch(error => {
                    console.log(error),
                    this.$refs.msg.showSuccessMessage('An error occured while trying to update animal.', 5000);
                });
            }
        },

        data() {
            return {
                form: form,
                species: [],
                animals: [],
                animal: {
                    slug: '',
                },
                noSpeciesID: false
            }
        },

        created() {
            let url  =  window.location.pathname.split('/');
            let animal = url[2];

            axios.get('/list/animal').then(response => {
                for (let i = 0; i < response.data.length; i++) {
                    if (animal == response.data[i].slug){
                        this.animal.slug = response.data[i].slug;
                        this.form.name = response.data[i].name;
                        this.form.description = response.data[i].description;
                        this.form.species_id = response.data[i].species_id;
                        this.form.noReset = ['name', 'description', 'species_id'];
                    }
                }
            }).catch(error => {
                console.log(error)
            });

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
                return !this.species.length
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
