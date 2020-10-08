<template>
  <v-app id="inspire">
    <v-main>
      <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="4">
            <v-card class="elevation-12">
              <v-toolbar color="primary" dark flat>
                <v-toolbar-title>Login form</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-tooltip bottom>
                  <template v-slot:activator="{ on }">
                    <v-btn :href="source" icon large target="_blank" v-on="on">
                      <v-icon>mdi-code-tags</v-icon>
                    </v-btn>
                  </template>
                  <span>Source</span>
                </v-tooltip>
              </v-toolbar>
              <v-card-text>
                <v-form ref="form" v-model="valid">
                  <v-text-field
                    label="Email"
                    prepend-icon="mdi-account"
                    v-model="user.email"
                    :rules="validaterules.email"
                  ></v-text-field>

                  <v-text-field
                    label="Password"
                    prepend-icon="mdi-lock"
                    type="password"
                    v-model="user.password"
                    :rules="validaterules.password"
                  ></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <!-- <router-link to="/" class="btn"><v-btn color="primary">Login</v-btn></router-link> -->
                <v-btn depressed color="primary" @click="login()">
                  Login
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
export default {
  props: {
    source: String,
  },
  data: () => ({
    user: {},
    valid: true,
    validaterules: {},
  }),
  methods: {
    login() {
      axios
        .get("http://127.0.0.1:8000/api/sanctum/csrf-cookie")
        .then((response) => {
          //debug cookie
          // console.log(response);
          axios({
            method: "post",
            url: "/api/login",
            data: this.user,
          })
            .then((result) => {
              console.log("successss");
              console.log(result.data);
              if (response) {
                localStorage.setItem("api_token", result.data.token.plainTextToken)
                swal("Success", "Welcome!", "success", { button: false });
                // this.close();
                return this.$router.push({ name: 'home' })
                setTimeout(() => swal.close(), 5000);
                // this.initialize();
              }
              // this.validate()
              // this.$refs.form.resetValidation()
            })
            .catch((error) => {
              if (error.response.statusText == "Unauthorized") {
                this.$refs.form.resetValidation()   
                swal("Error", "Wrong Combination", "error", { button: false });
                setTimeout(() => swal.close(), 5000);             
              } else {
                const errors = error.response.data.errors;
                this.validaterules = errors;
                this.validate();
              }
            });
        });
    },
    validate() {
      // this.dialog = true;
      this.$refs.form.validate();
    },
  },
};
</script>