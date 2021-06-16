<template>
    <div class="container">
        <div  class="columns is-multiline">
            <div  class="card column">
                <header class="card-header">
                    <h1 class="card-header-title">
                        Animals title
                    </h1>
                </header>
                <div class="table-container">
                    <div v-if="loading" class="lds-dual-ring"></div>
                    <div v-if="!loading" class="content overflow-table">
                        <table>
                            <thead>
                                <th>ID</th>
                                <th>Species</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created</th>
                                <th>Updated</th>
                            </thead>
                            <tr  v-for="animal in animals" :key="animal.id" class="card-content">
                                <td><a @click="showAnimal(animal)">{{animal.id}}</a></td>
                                <td><a @click="showSpecies(animal.species_id)">{{ getSpeciesName(animal.species_id) }}</a></td>
                                <td><a @click="showAnimal(animal)">{{animal.name}}</a></td>
                                <td>{{animal.description}}</td>
                                <td>{{animal.created_at | formatDate }}</td>
                                <td>{{animal.updated_at | formatDate }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            animals: [],
            species: []
        }
    },
    created() {
        axios.get('/list/animal').then((res) => {
            this.animals = res.data;
        });

        axios.get('/list/species').then((res) => {
            this.species = res.data;
        }).catch(error => {
            console.log(error)
        });
    },
    methods: {
        showAnimal(animal) {
            window.location.href = '/animal/' + animal.slug;
        },
        showSpecies(speciesId) {
            window.location.href = '/species/' + this.getSpeciesSlug(speciesId);
        },
        getSpeciesName(speciesId) {
            if (speciesId === undefined) {
                return '';
            }

            return this.species.filter(k => k.id == speciesId)[0]?.name;
        },
        getSpeciesSlug(speciesId) {
            if (speciesId === undefined) {
                return '';
            }

            return this.species.filter(k => k.id == speciesId)[0]?.slug;
        }
    },
    computed: {
        loading() {
            return !this.animals.length || !this.species.length;
        }
    }
}
</script>
