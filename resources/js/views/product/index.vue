

<template>
  <v-col cols="12">
    <!-- <v-text-field
      label="Search"
      append-icon="mdi-magnify"
      single-line
      hide-details
      v-model="search"
    ></v-text-field>
    <v-spacer></v-spacer> -->
    <v-data-table
      :headers="headers"
      :items="items"
      :search="search"
      class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Product</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
          ></v-text-field>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-btn class="mb-2" color="primary" dark>
            <v-icon>mdi-plus</v-icon>
          </v-btn>
        </v-toolbar>
      </template>
      <!-- <template slot="items" slot-scope="props"> -->
        <!-- <td class="text-xs-left">{{ props.item.id }}</td>
        <td class="text-xs-left">{{ props.item }}</td>
        <td class="text-xs-left">{{ props.item.category.name }}</td>
        <td class="text-xs-left">{{ props.item.website }}</td> -->
      <!-- </template> -->
      <template v-slot:item.action="{ item }">
        <v-btn color="warning" small dark @click="editItem(item)"
          ><v-icon small>mdi-pencil</v-icon></v-btn
        >
        <v-btn color="error" small dark @click="deleteItem(item)"
          ><v-icon small>mdi-delete</v-icon></v-btn
        >
      </template>
      <!-- <v-alert slot="no-results" :value="true" color="error" icon="warning">
        Your search for "{{ search }}" found no results.
      </v-alert> -->
      <td
        align="center"
        slot="no-results"
        :value="true"
        color="error"
        icon="warning"
      >
        Your search for "{{ search }}" found no results.
      </td>
    </v-data-table>
  </v-col>
</template>
<script>
export default {
  data() {
    return {
      search: "",
      loading:true,
      headers: [
        { text: "ID", value: "id" },
        { text: "Name", value: "name" },
        { text: "Email", value: "category.name" },
        { text: "Website", value: "description" },
        { text: "Action", value: "action", sortable: false },
      ],
      items: [],
    };
  },
  created: function () {
    this.getData();
  },
  methods: {
    getData() {
      // axios
      //   .get("https://jsonplaceholder.typicode.com/users")
      //   .then((response) => {
      //     //console.log(response.data);
      //     this.items = response.data;
      //   });
      this.$http({
        url: `product`,
        method: "GET",
      })
        .then(
          (response) => (
            (this.items = response.data)
          )
        )
        .catch((error) => {
          console.log('error');
        })
        .finally(() => (this.loading = false));
    },
  },
};
</script>
