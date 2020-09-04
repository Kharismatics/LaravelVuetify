<template>
  <v-row dense>
    <v-col cols="12">
      <v-card style="height: 520px;">
        <v-card-title class="headline">Product</v-card-title>
        <v-card-subtitle>
          Listen to your favorite artists and albums whenever and wherever, online and offline.
          <router-link :to="{ name: 'product.create' }">
            <v-btn class="mx-2" fab dark color="indigo">
              <v-icon dark>mdi-plus</v-icon>
            </v-btn>
          </router-link>
        </v-card-subtitle>
        <v-card-text>
          <div v-if="loading">Loading...</div>
          <v-data-table
            :headers="headers"
            :items="desserts"
            :items-per-page="5"
            class="elevation-1"
            :loading="loading" 
            loading-text="Loading..."
          ></v-data-table>
          <!-- {{ info }} -->
          <!-- <v-simple-table>
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-left">Name</th>
                  <th class="text-left">Calories</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in info" :key="item.name">
                  <td>{{ item.name }}</td>
                  <td>{{ item.description }}</td>
                </tr>
              </tbody>
            </template>
          </v-simple-table> -->
        </v-card-text>
      </v-card>
    </v-col>
  </v-row>
</template>
<script>
export default {
  name: "ProductIndex",
  methods: {
    close() {
      this.$router.back();
    },
  },
  data() {
    return {
      headers: [
        {
          text: "Dessert (100g serving)",
          align: "start",
          sortable: false,
          value: "name",
        },
        { text: "Calories", value: "description" },
      ],
      // desserts: [
      //   {
      //     name: "Frozen Yogurt",
      //     description: 159,
      //   },
      //   {
      //     name: "Ice cream sandwich",
      //     description: 237,
      //   },
      // ],
      desserts: [],
      info: null,
      loading: true,
      errored: false,
    };
  },
  mounted() {
    axios
      .get("api/category")
      .then(
        (response) => (
          (this.info = response.data), (this.desserts = response.data)
        )
      )
      .catch((error) => {
        console.log(error);
        this.errored = true;
      })
      .finally(() => (this.loading = false));
  },
};
</script>