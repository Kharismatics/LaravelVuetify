<template>
  <v-col cols="12">
    <v-data-table :loading="loading" :headers="headers" :items="desserts"   sort-by="calories" class="elevation-1">
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Category</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>

          <v-dialog v-model="dialog" max-width="500px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on"><v-icon>mdi-plus</v-icon></v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.name" label="name"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.description" label="description"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.created_by" label="created_by"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-select
                        v-model="editedItem.created_by"
                        :items="selectitems"
                        :rules="[v => !!v || 'Item is required']"
                        label="Item"
                        item-value="id"
                        item-text="name"
                        required
                      ></v-select>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                <v-btn color="blue darken-1" text @click="save">Save</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
          
        </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <!-- <v-icon color="orange darken-1" fab class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
        <v-icon color="red" fab @click="deleteItem(item)">mdi-delete</v-icon> -->
        <v-btn color="orange darken-1" small dark  @click="editItem(item)"><v-icon small>mdi-pencil</v-icon></v-btn>
        <v-btn color="red" small dark  @click="deleteItem(item)"><v-icon small>mdi-delete</v-icon></v-btn>
      </template>
      <!-- <template v-slot:no-data>
        <v-btn color="primary" @click="initialize">Reset</v-btn>
      </template> -->
    </v-data-table>
  </v-col>
</template>

<script>
export default {
  data: () => ({
    dialog: false,
    loading: true,
    headers: [
      {
        text: "Dessert (100g serving)",
        align: "start",
        sortable: false,
        value: "name",
      },
      { text: "name", value: "name" },
      { text: "description (g)", value: "description" },
      { text: "created_by (g)", value: "created_by" },
      { text: "Actions", align: "center", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    selectitems: [
      { id: "1", name: "tes" },
      // '1',
      // '2',
      // '3',
      // '4',
    ],
    editedItem: {
      name: "",
      description: 0,
      created_by: 0,
    },
    defaultItem: {
      name: "",
      description: 0,
      created_by: 0,
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
  },

  created() {
    this.initialize()
    // console.log("this.initialize()");
    // console.log(this.initialize());
    
    // if (this.initialize()) {
      
    //   this.loading = false      
    // }
  },

  methods: {
    initialize() {
      // this.desserts = [
      //   {
      //     name: "Frozen Yogurt",
      //     description: 159,
      //     created_by: 6.0,
      //   },
      //   {
      //     name: "Ice cream sandwich",
      //     description: 237,
      //     created_by: 9.0,
      //   },
      // ];
      this.loading = true;
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

    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;

      // console.log('edit mode');
      // axios({
      //   method: "GET",
      //   url: "api/category/"+item.id,
      //   data: {},
      //   // headers: {'Content-Type': 'multipart/form-data' }
      // })
      // .then((response) => {
      //   console.log(response.data);
      //   if (response) {
      //     this.initialize()
      //   }
      // })
      // .catch((response) => {
      //   console.log(response);
      // });
    },

    deleteItem(item) {
      // const index = this.desserts.indexOf(item);
      // confirm("Are you sure you want to delete this item?") &&
      //   this.desserts.splice(index, 1);
      console.log(item.id);
      confirm("Are you sure you want to delete this item?") &&
      axios({
        method: "DELETE",
        url: "api/category/"+item.id,
        data: {},
        // headers: {'Content-Type': 'multipart/form-data' }
      })
      .then((response) => {
        console.log(response.data);
        if (response) {
          this.initialize()
        }
      })
      .catch((response) => {
        console.log(response);
      });
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        console.log('edit data');
        // Object.assign(this.desserts[this.editedIndex], this.editedItem);
        console.log(this.editedItem.id);
        axios({
          method: "PUT",
          url: "api/category/"+this.editedItem.id,
          data: this.editedItem,
          // headers: {'Content-Type': 'multipart/form-data' }
        })
        .then((response) => {
          console.log(response.data);
          if (response) {
            this.initialize()
          }
        })
        .catch((response) => {
          console.log(response);
        });
      } else {
        console.log('add data');
        // this.desserts.push(this.editedItem);
        axios({
          method: "post",
          url: "/api/category",
          data: this.editedItem,
          // headers: {'Content-Type': 'multipart/form-data' }
        })
        .then((response) => {
          console.log(response.data);
          if (response) {
            this.initialize()
          }
        })
        .catch((response) => {
          console.log(response);
        });
      }
      this.close();
    },
  },
};
</script>