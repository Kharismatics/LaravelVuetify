<template>
  <!-- <v-row>
    <h1>This is Product index page</h1>
    <br>
    <router-link :to="{ name: 'product.create' }" class="btn">Create</router-link>
    <br>
    <br>
    <p>It has sub components</p>
    <div id="nav">
      <router-link :to="{ name: 'product.edit', params: { id: '1' } }">edit 1</router-link> |
      <router-link :to="{ name: 'product.edit', params: { id: '2' } }">edit 2</router-link> |
      <router-link :to="{ name: 'product.edit', params: { id: '3' } }">edit 3</router-link> |
      <router-link :to="{ name: 'product.edit', params: { id: '4' } }">edit 4</router-link>
    </div>
    <router-view></router-view>
    <hr>
  </v-row>-->
  <!-- <v-container fluid> -->
  <!-- <v-row>
  <v-col cols="12">
    <v-row :align="alignment" :justify="justify" class="grey lighten-5" style="height: 300px;" >
      <v-card v-for="n in 3" :key="n" class="ma-3 pa-6" outlined tile >
        Column
      </v-card>
    </v-row>
  </v-col>
  <v-col cols="12">
    <v-row justify="center">
      <v-col cols="6" md="2" >
        <v-select v-model="alignment" :items="alignmentsAvailable" label="Align" ></v-select>
      </v-col>
      <v-col cols="6" md="2" >
        <v-select v-model="justify" :items="justifyAvailable" label="Justify"
        ></v-select>
      </v-col>
    </v-row>
  </v-col>
  </v-row>-->
  <!-- <v-row>
  Index
  <v-col cols="12">
    <v-row align="start" justify="start" class="grey lighten-5" style="height: 300px;">
        tes
        <v-sheet align="start" width="100" height="100" elevation="100" color="100" tile="100" >
        tes
        </v-sheet>
    </v-row>
  </v-col>
  </v-row>-->
  <!-- <v-row dense>
  <v-card class="d-inline-block mx-auto">
    <v-card-title>
      <span class="headline">User Profile</span>
    </v-card-title>
    <v-card-text>
      <v-container>
        <v-row>
          <v-col cols="12" sm="6" md="4">
            <v-text-field label="Legal first name*" required></v-text-field>
          </v-col>
          <v-col cols="12" sm="6" md="4">
            <v-text-field label="Legal middle name" hint="example of helper text only on focus"></v-text-field>
          </v-col>
          <v-col cols="12" sm="6" md="4">
            <v-text-field
              label="Legal last name*"
              hint="example of persistent helper text"
              persistent-hint
              required
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field label="Email*" required></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field label="Password*" type="password" required></v-text-field>
          </v-col>
          <v-col cols="12" sm="6">
            <v-select
              :items="['0-17', '18-29', '30-54', '54+']"
              label="Age*"
              required
            ></v-select>
          </v-col>
          <v-col cols="12" sm="6">
            <v-autocomplete
              :items="['Skiing', 'Ice hockey', 'Soccer', 'Basketball', 'Hockey', 'Reading', 'Writing', 'Coding', 'Basejump']"
              label="Interests"
              multiple
            ></v-autocomplete>
          </v-col>
        </v-row>
      </v-container>
      <small>*indicates required field</small>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
      <v-btn color="blue darken-1" text @click="dialog = false">Save</v-btn>
    </v-card-actions>
  </v-card>
  </v-row>-->
  <!-- <v-row dense>
        <v-col cols="12">
          <v-card color="blue darken-3" dark >
            <v-card-title class="headline">Unlimited music now</v-card-title>
            <v-card-subtitle>Listen to your favorite artists and albums whenever and wherever, online and offline.</v-card-subtitle>
            <v-card-actions>
              <v-btn text>Listen Now</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
  </v-row>-->

  <!-- ================= -->
  <!-- <v-row dense>
    <v-col cols="12">
      <v-card style="height: 520px;">
        <v-card-title class="headline">Product</v-card-title>
        <v-card-subtitle>Listen to your favorite artists and albums whenever and wherever, online and offline. 
          <router-link :to="{ name: 'product.create' }">
            <v-btn class="mx-2" fab dark color="indigo"> <v-icon dark>mdi-plus</v-icon> </v-btn>
          </router-link> 
        </v-card-subtitle>
  <router-view></router-view>-->
  <!-- <v-card-text>
        </v-card-text>
        <v-card-actions>
          <div class="my-2">
            <v-btn color="secondary" dark @click="close">Back</v-btn>
          </div>
          <v-btn color="blue darken-1" text @click="save">Save</v-btn>
  </v-card-actions>-->
  <!-- </v-card>
    </v-col>
  </v-row>-->
<!-- ================= -->
  <v-row dense>
    <v-col cols="12">
      <v-card style="height: 520px;">
        <v-card-title class="headline">Product</v-card-title>
        <v-card-subtitle>Listen to your favorite artists and albums whenever and wherever, online and offline. 
          <router-link :to="{ name: 'product.create' }">
            <v-btn class="mx-2" fab dark color="indigo"> <v-icon dark>mdi-plus</v-icon> </v-btn>
          </router-link> 
        </v-card-subtitle>
        <v-card-text>
        <v-data-table :headers="headers" :items="desserts" :items-per-page="5" class="elevation-1"></v-data-table>
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
    }
  },
  data() {
    return {
      headers: [
        {
          text: "Dessert (100g serving)",
          align: "start",
          sortable: false,
          value: "name"
        },
        { text: "Calories", value: "calories" },
        { text: "Fat (g)", value: "fat" },
        { text: "Carbs (g)", value: "carbs" },
        { text: "Protein (g)", value: "protein" },
        { text: "Iron (%)", value: "iron" }
      ],
      desserts: [
        {
          name: "Frozen Yogurt",
          calories: 159,
          fat: 6.0,
          carbs: 24,
          protein: 4.0,
          iron: "1%"
        },
        {
          name: "Ice cream sandwich",
          calories: 237,
          fat: 9.0,
          carbs: 37,
          protein: 4.3,
          iron: "1%"
        },
        {
          name: "Eclair",
          calories: 262,
          fat: 16.0,
          carbs: 23,
          protein: 6.0,
          iron: "7%"
        },
        {
          name: "Cupcake",
          calories: 305,
          fat: 3.7,
          carbs: 67,
          protein: 4.3,
          iron: "8%"
        },
        {
          name: "Gingerbread",
          calories: 356,
          fat: 16.0,
          carbs: 49,
          protein: 3.9,
          iron: "16%"
        },
        {
          name: "Jelly bean",
          calories: 375,
          fat: 0.0,
          carbs: 94,
          protein: 0.0,
          iron: "0%"
        },
        {
          name: "Lollipop",
          calories: 392,
          fat: 0.2,
          carbs: 98,
          protein: 0,
          iron: "2%"
        },
        {
          name: "Honeycomb",
          calories: 408,
          fat: 3.2,
          carbs: 87,
          protein: 6.5,
          iron: "45%"
        },
        {
          name: "Donut",
          calories: 452,
          fat: 25.0,
          carbs: 51,
          protein: 4.9,
          iron: "22%"
        },
        {
          name: "KitKat",
          calories: 518,
          fat: 26.0,
          carbs: 65,
          protein: 7,
          iron: "6%"
        }
      ]
    };
  }
};
</script>