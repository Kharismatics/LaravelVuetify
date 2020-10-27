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
      <!-- <v-card-title><v-switch v-model="$vuetify.theme.dark" primary label="Dark Mode"></v-switch></v-card-title> -->
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
    // errorMessages: [],
    // name: null,
    // address: null,
    // city: null,
    // state: null,
    // zip: null,
    // country: null,
    // formHasErrors: false,
  }),

  computed: {
    // form () {
    //   return {
    //     name: this.name,
    //     address: this.address,
    //     city: this.city,
    //     state: this.state,
    //     zip: this.zip,
    //     country: this.country
    //   };
    // },
  },

  watch: {
    // name () {
    //   this.errorMessages = []
    // }
  },

  methods: {
    // addressCheck () {
    //   this.errorMessages = this.address && !this.name
    //     ? ['Hey! I\'m required']
    //     : []
    //   return true
    // },
    // resetForm () {
    //   this.errorMessages = []
    //   this.formHasErrors = false
    //   Object.keys(this.form).forEach(f => {
    //     this.$refs[f].reset()
    //   })
    // },
    // submit () {
    //   this.formHasErrors = false
    //   Object.keys(this.form).forEach(f => {
    //     if (!this.form[f]) this.formHasErrors = true
    //     this.$refs[f].validate(true)
    //   })
    // },
    // updateError() {
    //   console.log('error');
    // }
  },
};
</script>