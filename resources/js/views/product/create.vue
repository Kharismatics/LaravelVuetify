<template>
  <v-row dense>
    <v-col cols="12">
      <v-card>
        <v-card-title class="headline">Add Product</v-card-title>
        <v-form ref="form" v-model="valid">
          <v-card-text>
            <v-text-field
              v-model="form.name"
              :counter="10"
              :rules="nameRules"
              label="Name"
              required
            ></v-text-field>
            <v-text-field v-model="form.email" :rules="emailRules" label="E-mail" required></v-text-field>
            <v-select
              v-model="form.select"
              :items="items"
              :rules="[v => !!v || 'Item is required']"
              label="Item"
              item-value="id"
              item-text="name"
              required
            ></v-select>
            <!-- <v-checkbox
              v-model="checkbox"
              :rules="[v => !!v || 'You must agree to continue!']"
              label="Do you agree?"
              required
            ></v-checkbox>-->
          </v-card-text>
          <v-card-actions>
            <v-btn :disabled="!valid" color="success" class="mr-4" @click="validate">Validate</v-btn>
            <v-btn color="error" class="mr-4" @click="reset">Reset Form</v-btn>
            <v-btn color="warning" @click="resetValidation">Reset Validation</v-btn>
            <v-btn color="info" @click="Routeback">Back</v-btn>
            <v-btn color="info" @click="Submit">Submit</v-btn>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-col>
  </v-row>
</template>
<script>
export default {
  data: () => ({
    valid: true,
    form: {
      name: "",
      email: "",
      select: null,
    },
    nameRules: [
      (v) => !!v || "Name is required",
      (v) => (v && v.length <= 10) || "Name must be less than 10 characters",
    ],
    emailRules: [
      (v) => !!v || "E-mail is required",
      (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
    ],
    items: [
      { id: "1", name: "tes" },
      // '1',
      // '2',
      // '3',
      // '4',
    ],
    checkbox: false,
  }),

  methods: {
    validate() {
      this.$refs.form.validate();
    },
    reset() {
      this.$refs.form.reset();
    },
    resetValidation() {
      this.$refs.form.resetValidation();
    },
    Routeback() {
      this.$router.back();
    },
    Submit() {
      const checked = this.$refs.form.validate();
      if (checked) {
        // axios({
        //   method: "post",
        //   url: "/api/category",
        //   data: {
        //     name: this.form.name,
        //     email: this.form.email,
        //     created_by: this.form.select,
        //   },
        //   // headers: {'Content-Type': 'multipart/form-data' }
        // })
        this.$http({
          url: `category`,
          method: "POST",
          data: {
            name: this.form.name,
            email: this.form.email,
            created_by: this.form.select,
          },
        })
          .then((response) => {
            console.log(response.data);
            if (response) {
              this.$router.back();
            }
          })
          .catch((response) => {
            console.log(response);
          });
      }
    },
  },
};
</script>
<style lang="scss">
.dialog {
  position: absolute;
  z-index: 10;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  background-color: rgba(#333, 0.3);
  display: flex;
  justify-content: center;
  align-items: center;

  &__inner {
    background-color: white;
    padding: 30px;
    width: 300px;
  }
}
</style>