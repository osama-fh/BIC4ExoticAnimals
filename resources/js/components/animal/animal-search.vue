<template>
  <div class="container">
    <div class="columns is-multiline">
      <div class="card column">
        <header class="card-header">
          <h1 class="card-header-title">Search for Animals</h1>
        </header>
        <div class="card-content">
          <div class="media-content">
            <label class="label"
              >Name, species of description of the animal:</label
            >
            <div class="content">
              <input
                class="input"
                type="text"
                placeholder="e.g. name, species or description"
                v-model="userInput"
              />
            </div>
          </div>
        </div>
        <div
          v-if="userInput && userInput.length >= 3"
          class="overflow-search-table"
        >
          <table class="table is-fullwidth">
            <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Species</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="animal in animals">
                <td>
                  <a @click="showAnimal(animal)">{{ animal.name }}</a>
                </td>
                <td>{{ animal.description }}</td>
                <td>
                  <a @click="showSpecies(animal.species_id)">{{
                    getSpeciesName(animal.species_id)
                  }}</a>
                </td>
              </tr>
            </tbody>
          </table>
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
      animal: {
        name: "",
        description: "",
        species_id: "",
      },
      species: [],
      userInput: null,
    };
  },

  watch: {
    userInput: function () {
      if (this.userInput.length >= 3) {
        this.search();
      } else {
        this.animals = [];
      }
    },
  },

  methods: {
    search() {
      axios
        .post("/search/animal?q=" + this.userInput)
        .then((response) => {
          this.animals = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    showAnimal(animal) {
      window.location.href = "/animal/" + animal.slug;
    },

    editAnimal(animal) {
      window.location.href = "/animal/" + animal.slug + "/edit";
    },

    showSpecies(speciesId) {
      window.location.href = "/species/" + this.getSpeciesSlug(speciesId);
    },

    getSpeciesName(speciesId) {
      if (speciesId === undefined) {
        return "";
      }

      return this.species.filter((k) => k.id == speciesId)[0]?.name;
    },
    getSpeciesSlug(speciesId) {
      if (speciesId === undefined) {
        return "";
      }

      return this.species.filter((k) => k.id == speciesId)[0]?.slug;
    },
  },

  created() {
    axios
      .get("/list/species")
      .then((response) => {
        this.species = response.data;
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>
