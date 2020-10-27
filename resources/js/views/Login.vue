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
                <!-- <v-tooltip bottom>
                  <template v-slot:activator="{ on }">
                    <v-btn :href="source" icon large target="_blank" v-on="on">
                      <v-avatar size="100px" item>
                        <v-img
                          src="https://cdn.vuetifyjs.com/images/logos/logo.svg"
                          alt="Vuetify"
                        ></v-img>
                      </v-avatar>
                    </v-btn>
                  </template>
                  <span>Source</span>
                </v-tooltip> -->
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
                <!-- <router-link to="/" class="btn"><v-btn color="primary">Login</v-btn></router-link> -->
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
    console.log("ni " + this.$auth.check());
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
      // get the redirect object
      var redirect = this.$auth.redirect();
      var app = this;
      // this.$auth.login({
      //   params: this.user,
      //   success: function (response) {
      //     console.log(response);
      //     // this.$auth.user(response.data)
      //     // // // handle redirection
      //     // // const redirectTo = "home";
      //     // // this.$router.push({ name: redirectTo });
      //     // // // console.log(
      //     // // //   JSON.stringify({ data: this.$auth.user() })
      //     // // // );
      //   },
      //   error: function (response) {
      //     app.has_error = true;
      //     console.log('tesssssss1');
      //     console.log(response.response.data);
      //   },
      //   catch: function (response) {
      //     // app.has_error = true;
      //     console.log(response.response.data);
      //     console.log('tesssssss2');
      //   },
      //   callback:function (param) {
      //     console.log(param);

      //   },
      //   rememberMe: true,
      //   fetchUser: false,
      // });
      this.$auth.login({
          data: this.user,
          rememberMe: true,
          fetchUser: false,
        }).then((res) => {
          this.success = true;
          console.log(res);
        }, (res) => {
            console.log(res);
        });
    },
    validate() {
      // this.dialog = true;
      this.$refs.form.validate();
    },
  },
};
</script>