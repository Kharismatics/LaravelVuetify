<template>
  <!-- <v-container fluid>
    <v-card class="col-12">
      <v-card-title><v-switch v-model="$vuetify.theme.dark" primary label="Dark Mode"></v-switch></v-card-title>
      <v-row align="center" justify="center">
        <v-switch v-model="$vuetify.theme.dark" primary label="Dark Mode"></v-switch>
      </v-row>
    </v-card>
  </v-container> -->
  <v-container fluid>
    <v-card class="col-12">
      <v-card-text>
        <v-row align="center" justify="center">
          <v-switch
            v-model="$vuetify.theme.dark"
            primary
            label="Dark Mode"
          ></v-switch>
        </v-row>
        <v-text-field
          ref="address"
          label="Profile Name"
          counter="25"
          solo-inverted
        ></v-text-field>
        <v-autocomplete
          ref="country"
          :items="countries"
          label="Language"
          solo-inverted
        ></v-autocomplete>
      </v-card-text>
      <!-- <v-divider class="mt-5"></v-divider> -->
    </v-card>
  </v-container>
</template>
<script>
export default {
  data: () => ({
    countries: ["ID", "EN"],
  }),

  computed: {
  },

  watch: {
  },

  methods: {
  },
};
</script>