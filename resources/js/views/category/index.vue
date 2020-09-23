<template>
  <v-col cols="12">
    <div v-if="alert">
      <v-alert :value="alert" dismissible transition="scale-transition" :type="alertType">
        {{ alertMessage }}
      </v-alert>
    </div>
    <v-data-table :loading="loading" :headers="headers" :items="MyArrayData"   sort-by="calories" class="elevation-1">
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
                <v-form ref="form" v-model="valid">
                  <v-text-field v-model="editedItem.name" label="name" :rules="validaterules.name"></v-text-field>
                  <v-text-field v-model="editedItem.description" label="description" :rules="validaterules.description"></v-text-field>
                  <v-text-field v-model="editedItem.created_by" label="created_by"></v-text-field>
                  <v-select
                    v-model="editedItem.created_by"
                    :items="selectitems"
                    :rules="validaterules.select"
                    label="Item"
                    item-value="id"
                    item-text="name"
                    required
                  ></v-select>
                </v-form>
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
        <v-btn color="orange darken-1" small dark  @click="editItem(item)"><v-icon small>mdi-pencil</v-icon></v-btn>
        <v-btn color="red" small dark  @click="deleteItem(item)"><v-icon small>mdi-delete</v-icon></v-btn>
      </template>
    </v-data-table>
  </v-col>
</template>

<script>
export default {
  data: () => ({
    dialog: false,
    alert: false,
    alertMessage: 'tes',
    alertType: 'success',
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
    MyArrayData: [],
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
    valid: true,
    validaterules:{
      // name:[],
      // description: [
      //   (v) => !!v || "Description is required",
      //   (v) => (v && v.length <= 10) || "must be less than 10 characters",
      // ],
      // select: [
      //   (v) => !!v || "Select is required",
      // ],
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },

  watch: {
    dialog(val) {
    console.log('watccccch');
      val || this.close();
    console.log(val);
    },
  },

  created() {
    this.initialize()
  },

  methods: {
    initialize() {
      this.loading = true;
      axios
      .get("api/category")
      .then(
        (response) => (
          (this.info = response.data), (this.MyArrayData = response.data)
        )
      )
      .catch((error) => {
        console.log(error);
        this.errored = true;
      })
      .finally(() => (this.loading = false));
    },

    editItem(item) {      
      this.editedIndex = this.MyArrayData.indexOf(item);
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
      // // const index = this.MyArrayData.indexOf(item);
      // // confirm("Are you sure you want to delete this item?") &&
      // //   this.MyArrayData.splice(index, 1);
      // console.log(item.id);
      swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          axios({
            method: "DELETE",
            url: "api/category/"+item.id,
            data: {},
            // headers: {'Content-Type': 'multipart/form-data' }
          })
          .then((response) => {
            console.log(response.data);
            if (response) {
              swal("Success", "Record deleted", "success", { button: false });
              this.initialize()
              setTimeout(() => swal.close() , 5000);
            }
          })
          .catch((response) => {
            console.log(response);
          });          
        } else {
          // swal("Your imaginary file is safe!");
        }
      });
      // confirm("Are you sure you want to delete this item?") &&
      // axios({
      //   method: "DELETE",
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

    close() {
      this.validaterules = [];
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    validate(){
      // this.dialog = true;
      this.$refs.form.validate()
    },

    save() {
      if (this.editedIndex > -1) {
        // console.log('edit data');
        // Object.assign(this.MyArrayData[this.editedIndex], this.editedItem);
        axios({
          method: "PUT",
          url: "api/category/"+this.editedItem.id,
          data: this.editedItem,
          // headers: {'Content-Type': 'multipart/form-data' }
        })
        .then((response) => {
          console.log(response.data);
          if (response) {
            this.close();
            swal("Success", "Record updated", "success", { button: false });
            this.initialize()
            setTimeout(() => swal.close() , 5000);
          }
        })
        .catch((error) => {
          const errors = error.response.data.errors
          this.validaterules = errors;
          this.validate()
        });
      } else {
        // console.log('add data');
        // // this.MyArrayData.push(this.editedItem);
        axios({
          method: "post",
          url: "/api/category",
          data: this.editedItem,
          // headers: {'Content-Type': 'multipart/form-data' }
        })
        .then((response) => {
          console.log(response.data);
          if (response) {
            this.close();
            swal("Success", "Record added", "success", { button: false });
            this.initialize()
            setTimeout(() => swal.close() , 5000);
          }
        })
        .catch((error) => {
          const errors = error.response.data.errors
          this.validaterules = errors;
          this.validate()
        });
      }
      // this.close();
    },
  },
};
</script>