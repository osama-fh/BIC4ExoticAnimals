<template>
  <div class="container">
    <div class="columns is-multiline">
      <div :class="loading ? 'centered' : ''" class="card column is-half is-offset-one-quarter">
        <div v-if="loading" class="lds-dual-ring"></div>
        <div v-if="!loading" class="card-content">
          <header class="card-header">
            <h1 class="card-header-title">{{ specie.name }}</h1>
          </header>
          <div class="content">
            <div>
              <br />
              <div class="media-content">
                <strong>
                  <div>Description</div>
                </strong>
                <small>
                  <div class="content" v-text="specie.description"></div>
                </small>
              </div>
              <br />
              <div class="media-content">
                <strong>
                  <div>Created</div>
                </strong>
                <small>
                  <div
                    class="content"
                    v-text="moment(specie.created_at).fromNow()"
                  ></div>
                </small>
              </div>
              <br />
              <div class="media-content">
                <strong>
                  <div>Last Update</div>
                </strong>
                <small>
                  <div
                    class="content"
                    v-text="moment(specie.updated_at).fromNow()"
                  ></div>
                </small>
              </div>
              <br />
              <div>
                <button class="button is-primary" @click="editSpecies()">Edit</button>
                <button class="button is-primary" @click="deleteSpeciesPrompt()">Delete</button>
              </div>
              <br/>
              <div class="media-content">
                <strong>
                  <div>Animals with this species</div>
                </strong>
                <ul class="item-list">
                    <li @click="showAnimal(animal)" v-if="animal.species_id == specie.id" v-for="animal in animals">{{animal.name}}</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <confirmation-dialog ref="deleteDialog" @onYes="deleteSpecies()" @onNo="closeDeletePrompt()"/>
  </div>
</template>

<script>
import moment from "moment";

export default {
  data() {
    return {
      species: [],
      specie: {
        id: "",
        name: "",
        description: "",
        created_at: "",
        updated_at: "",
      },
      animals: [],
      animal: {
        species_id: "",
      },
    };
  },
  computed: {
    loading() {
      return !this.species || !this.animals.length;
    }
  },
  methods: {
    moment,
    editSpecies() {
      window.location.href = "/species/" + this.specie.slug + "/edit";
    },
    closeDeletePrompt() {
      this.$refs.deleteDialog.close();
    },
    deleteSpeciesPrompt() {
      this.$refs.deleteDialog.showYesNo(
        "Are you sure you want to delete this specie?\It cannot be restored."
      );
    },
    deleteSpecies() {
      axios
        .delete("/species/" + this.specie.slug)
        .then((response) => {
          window.location.href = "/species";
        })
        .catch((error) => {
          console.log(error);
        });
    },
    showAnimal(animal) {
      window.location.href = "/animal/" + animal.slug;
    },
  },
  created() {
    let url = window.location.pathname.split("/");
    let specie = url[2];

    axios
      .get("/list/species")
      .then((response) => {
        for (let i = 0; i < response.data.length; i++) {
          if (specie == response.data[i].slug) {
            this.specie = response.data[i];
          }
        }
      })
      .catch((error) => {
        console.log(error);
      });

    axios
      .get("/list/animal")
      .then((response) => {
        this.animals = response.data;
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>
