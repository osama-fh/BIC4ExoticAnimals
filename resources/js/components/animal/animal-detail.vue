<template>
  <div class="container">
    <div class="columns is-multiline">
      <div :class="loading ? 'centered' : ''" class="card column is-half is-offset-one-quarter">
        <div v-if="loading" class="lds-dual-ring"></div>
        <div v-if="!loading" class="card-content">
          <div>
            <header class="card-header">
              <h1 class="card-header-title">
                {{ animal.name }}
              </h1>
            </header>
          </div>
          <div class="content">
            <div>
              <br />
              <div class="media-content">
                <strong>
                  <div>Description</div>
                </strong>
                <small>
                  <div class="content">
                    {{ animal.description }}
                  </div>
                </small>
              </div>
              <br />
              <div class="media-content">
                <strong>
                  <div>Species</div>
                </strong>
                <small>
                  <div class="content">
                    <a @click="showSpecies(animal.species_id)">{{
                      getSpeciesName(animal.species_id)
                    }}</a>
                  </div>
                </small>
              </div>
              <br />
              <div class="media-content">
                <strong>
                  <div>Created</div>
                </strong>
                <small>
                  <div class="content">
                    {{ animal.updated_at | formatDate }}
                  </div>
                </small>
              </div>
              <br />
              <div class="media-content">
                <strong>
                  <div>Last Update</div>
                </strong>
                <small>
                  <div class="content">
                    {{ animal.updated_at | formatDate }}
                  </div>
                </small>
              </div>
              <br />
              <div>
                <button class="button is-primary" @click="editAnimal()">
                  Edit
                </button>
                <button class="button is-primary" @click="deleteAnimalPrompt()">
                  Delete
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <confirmation-dialog ref="deleteDialog" @onYes="deleteAnimal()" @onNo="closeDeletePrompt()" />
  </div>
</template>

<script>
import moment from "moment";

export default {
  data() {
    return {
      animal: {
        name: "",
        description: "",
        species_id: "",
        created_at: "",
        updated_at: "",
      },
      species: [],
    };
  },

  computed: {
    loading() {
        return !this.animal || !this.species.length;
    }
  },

  methods: {
    moment,

    editAnimal() {
      window.location.href = "/animal/" + this.animal.slug + "/edit";
    },
    closeDeletePrompt() {
        this.$refs.deleteDialog.close();
    },
    deleteAnimalPrompt() {
        this.$refs.deleteDialog.showYesNo("Are you sure you want to delete this animal?\nIt cannot be restored.");
    },
    deleteAnimal() {
        axios
          .delete("/animal/" + this.animal.slug)
          .then((response) => {
            window.location.href = "/animal";
          })
          .catch((error) => {
            console.log(error);
          });
    },

    showSpecies(speciesId) {
        var specieSlug = this.species.filter(s => s.id == speciesId)[0]?.slug;
        window.location.href = "/species/" + specieSlug;
    },
    getSpeciesName(speciesId) {
      if (speciesId === undefined) {
        return "";
      }

      return this.species.filter((k) => k.id == speciesId)[0]?.name;
    },
  },

  created() {
    let url = window.location.pathname.split("/");
    let animal = url[2];

    axios
      .get("/list/animal")
      .then((response) => {
        for (let i = 0; i < response.data.length; i++) {
          if (animal == response.data[i].slug) {
            this.animal = response.data[i];
          }
        }
      })
      .catch((error) => {
        console.log(error);
      });

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
