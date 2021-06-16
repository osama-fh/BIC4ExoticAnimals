<template>
  <div class="container">
    <div class="columns is-multiline">
      <div class="card column">
        <header class="card-header">
          <h1 class="card-header-title">Species</h1>
        </header>
        <div class="table-container">
          <div v-if="loading" class="lds-dual-ring"></div>
          <div v-if="!loading" class="content overflow-table">
            <table>
              <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Created</th>
                <th>Updated</th>
              </thead>
              <tr v-for="item in species" :key="item.id" class="card-content">
                <td><a @click="showSpecies(item)">{{ item.id }}</a></td>
                <td><a @click="showSpecies(item)">{{ item.name }}</a></td>
                <td>{{ item.description }}</td>
                <td>{{ item.created_at | formatDate }}</td>
                <td>{{ item.updated_at | formatDate }}</td>
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
      species: [],
    };
  },
  created() {
    axios.get("/list/species").then((res) => {
      this.species = res.data;
    });
  },
  methods: {
    showSpecies(species) {
      window.location.href = "/species/" + species.slug;
    },
  },
  computed: {
    loading() {
      return !this.species.length;
    },
  },
};
</script>
