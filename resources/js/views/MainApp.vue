<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      :clipped="$vuetify.breakpoint.lgAndUp"
      app
    >
      <v-sheet class="pa-4 text-center">
        <v-avatar class="mb-4" color="grey darken-1" size="100"></v-avatar>

        <div>{{ this.$store.getters["auth/user"].name }}</div>
      </v-sheet>

      <!-- <v-divider></v-divider> -->

      <v-list dense>
        <template v-for="item in items">
          <v-row v-if="item.heading" :key="item.heading" align="center">
            <v-col cols="6">
              <v-subheader v-if="item.heading">{{ item.heading }}</v-subheader>
            </v-col>
            <v-col cols="6" class="text-center">
              <a href="#!" class="body-2 black--text">EDIT</a>
            </v-col>
          </v-row>
          <v-list-group
            v-else-if="item.children"
            :key="item.text"
            v-model="item.model"
            :prepend-icon="item.model ? item.icon : item['icon-alt']"
            append-icon
          >
            <template v-slot:activator>
              <v-list-item-content>
                <v-list-item-title>{{ item.text }}</v-list-item-title>
              </v-list-item-content>
            </template>
            <v-list-item
              v-for="(child, i) in item.children"
              :key="i"
              link
              :to="child.url"
            >
              <v-list-item-action v-if="child.icon">
                <v-icon>{{ child.icon }}</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>{{ child.text }}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-group>

          <v-list-item v-else :key="item.text" link :to="item.url">
            <v-list-item-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>{{ item.text }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </template>
      </v-list>
    </v-navigation-drawer>

    <!-- <v-app-bar
      :clipped-left="$vuetify.breakpoint.lgAndUp"
      app
      color="blue darken-3"
      dark
    > -->
    <v-app-bar
      :clipped-left="$vuetify.breakpoint.lgAndUp"
      app
      color="primary"
      dark
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title style="width: 300px" class="ml-0 pl-4">
        <span class="hidden-sm-and-down">My App</span>
      </v-toolbar-title>
      <!-- <v-text-field
        flat
        solo-inverted
        hide-details
        prepend-inner-icon="mdi-magnify"
        label="Search"
        class="hidden-sm-and-down"
      ></v-text-field> -->
      <!-- <v-btn
        solo-inverted icon large @click="$auth.logout()">
        <v-avatar size="32px" item>
          <v-img
            src="https://cdn.vuetifyjs.com/images/logos/logo.svg"
            alt="Vuetify"
          ></v-img>
        </v-avatar>
      </v-btn> -->
      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-bell</v-icon>
      </v-btn>
      <v-menu bottom left transition="slide-y-transition" offset-y>
        <template v-slot:activator="{ on, attrs }">
          <v-btn dark icon v-bind="attrs" v-on="on">
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </template>
        <v-list>
          <v-list-item to="setting">
            Setting
            <div class="btn">
              <v-btn icon>
                <v-icon>mdi-cog</v-icon>
              </v-btn>
            </div>
          </v-list-item>
          <v-list-item to="#" @click="$auth.logout()">
            Logout
            <div class="btn">
              <v-btn icon>
                <v-icon>mdi-logout</v-icon>
              </v-btn>
            </div>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>
    <v-main>
      <v-container class="fill-height" fluid>
        <router-view />
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
export default {
  props: {
    source: String,
  },
  mounted() {
    this.$auth.fetch().then((response) => {
      // console.log(response.data);
      this.$auth.user(response.data);
      // console.log(this.$auth.user());
      // do something
    });
  },
  data: () => ({
    dialog: false,
    drawer: null,
    items: [
      { icon: "mdi-apps", text: "Home", url: "/" },
      { icon: "mdi-history", text: "About", url: "/about" },
      {
        icon: "mdi-chevron-up",
        "icon-alt": "mdi-chevron-down",
        text: "Master",
        // model: true,
        children: [
          { icon: "mdi-contacts", text: "Users", url: "/user" },
          { icon: "mdi-contacts", text: "Products", url: "/product" },
          { icon: "mdi-contacts", text: "Category", url: "/category" },
        ],
      },
    ],
  }),
};
</script>