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
                <v-btn icon large>
                  <v-avatar size="100px" item>
                    <v-img
                      src="https://cdn.vuetifyjs.com/images/logos/logo.svg"
                      alt="Vuetify"
                    ></v-img>
                  </v-avatar>
                </v-btn>
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
                <v-btn type="submit" depressed color="primary" @click="login()">
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
  mounted() {
  },
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
      this.validaterules = [];
      // =====
      this.$auth
        .login({
          data: this.user,
          rememberMe: true,
          fetchUser: false,
        })
        .then(
          (res) => {
          },
          (res) => {
            const error = res.response.data.error;
            const errors = res.response.data.errors;
            console.log(error);
            if (errors) {
              this.validaterules = errors;
              this.validate();
            }
            if (error) {
              console.log("wkwk");
              swal({
                title: "Failed",
                text: "These credentials do not match our records.",
                icon: "error",
                confirmButtonColor:'#00d1b2'
              });
            }
          }
        );
      // ======
      // this.$auth
      //   .login({
      //     data: this.user,
      //     rememberMe: true,
      //     fetchUser: false,
      //   })
      //   .then(
      //     (response) => (
      //       ( console.log(response) )
      //     )
      //   )
      //   .catch((error) => {
      //     console.log(error.response);

      //   })
      //   .finally((res) => (console.log(res)));
    },
    validate() {
      this.$refs.form.validate();
    },
  },
};
</script>