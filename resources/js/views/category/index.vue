<template>
  <v-col cols="12">
    <div v-if="alert">
      <v-alert
        :value="alert"
        dismissible
        transition="scale-transition"
        :type="alertType"
      >
        {{ alertMessage }}
      </v-alert>
    </div>
    <v-data-table
      :loading="loading"
      :headers="headers"
      :items="MyArrayData"
      sort-by="calories"
      class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Category</v-toolbar-title>
          <!-- <v-divider class="mx-4" inset vertical></v-divider> -->
          <v-spacer></v-spacer>
          
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
          ></v-text-field>
          <v-divider class="mx-4" inset vertical></v-divider>

          <v-dialog v-model="dialog" max-width="500px">
            <!-- one activator -->
            <!-- <template v-slot:activator="{ on, attrs }">
              <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on"
                ><v-icon>mdi-plus</v-icon></v-btn
              >
            </template> -->
            <!-- two activator -->
            <template v-slot:activator="{ on: dialog, attrs }">
              <v-tooltip left>
                <template v-slot:activator="{ on: tooltip }">
                  <v-btn
                    class="mb-2"
                    color="primary"
                    dark
                    v-bind="attrs"
                    v-on="{ ...tooltip, ...dialog }"
                  >
                    <v-icon>mdi-plus</v-icon>
                  </v-btn>
                </template>
                <span>New</span>
              </v-tooltip>
            </template>
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-form ref="form" v-model="valid">
                  <v-text-field
                    v-model="editedItem.name"
                    label="name"
                    :rules="validaterules.name"
                  ></v-text-field>
                  <v-text-field
                    v-model="editedItem.description"
                    label="description"
                    :rules="validaterules.description"
                  ></v-text-field>
                  <v-text-field
                    v-model="editedItem.created_by"
                    label="created_by"
                  ></v-text-field>
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
        <v-btn color="warning" small dark @click="editItem(item)"
          ><v-icon small>mdi-pencil</v-icon></v-btn
        >
        <v-btn color="error" small dark @click="deleteItem(item)"
          ><v-icon small>mdi-delete</v-icon></v-btn
        >
      </template>
    </v-data-table>
  </v-col>
</template>

<script>
export default {
  data: () => ({
    search: "",
    dialog: false,
    alert: false,
    alertMessage: "tes",
    alertType: "success",
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
    selectitems: [{ id: "1", name: "tes" }],
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
    validaterules: {},
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
    this.initialize();
  },

  methods: {
    initialize() {
      this.loading = true;
      this.$http({
        url: `category`,
        method: "GET",
      })
        .then(
          (response) => (
            (this.info = response.data), (this.MyArrayData = response.data)
          )
        )
        .catch((error) => {
          this.errored = true;
        })
        .finally(() => (this.loading = false));
    },

    editItem(item) {
      this.editedIndex = this.MyArrayData.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      swal({
        title: "Are you sure?",
        text:
          "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          this.$http({
            url: "category/" + item.id,
            method: "DELETE",
            data: {},
          })
            .then((response) => {
              if (response) {
                swal("Success", "Record deleted", "success", { button: false });
                this.initialize();
                setTimeout(() => swal.close(), 5000);
              }
            })
            .catch((response) => {
            });
        } else {
          // swal("Your imaginary file is safe!");
        }
      });
    },

    close() {
      this.validaterules = [];
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    validate() {
      // this.dialog = true;
      this.$refs.form.validate();
    },

    save() {
      if (this.editedIndex > -1) {
        this.$http({
          url: "category/" + this.editedItem.id,
          method: "PUT",
          data: this.editedItem,
        })
          .then((response) => {
            if (response) {
              this.close();
              swal("Success", "Record updated", "success", { button: false });
              this.initialize();
              setTimeout(() => swal.close(), 5000);
            }
          })
          .catch((error) => {
            const errors = error.response.data.errors;
            this.validaterules = errors;
            this.validate();
          });
      } else {
        this.$http({
          url: `category`,
          method: "POST",
          data: this.editedItem,
        })
          .then((response) => {
            if (response) {
              this.close();
              swal("Success", "Record added", "success", { button: false });
              this.initialize();
              setTimeout(() => swal.close(), 5000);
            }
          })
          .catch((error) => {
            const errors = error.response.data.errors;
            this.validaterules = errors;
            this.validate();
          });
      }
    },
  },
};
</script>