<template>
  <v-row dense>
    <v-col cols="12">
      <v-card>
        <v-card-title class="headline">Add Product</v-card-title>
        <v-card-text>
          <v-col cols="12" sm="6" md="4">
            <v-text-field label="Legal first name*" required></v-text-field>
          </v-col>
        </v-card-text>
        <v-card-actions>
          <v-row dense justify="end">
            <div class="my-2"> <v-btn color="warning" dark @click="close">Back</v-btn> </div>
            <div class="my-2"> <v-btn color="success" dark @click="save">Save</v-btn> </div>
          </v-row>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>
<script>
export default {
  methods: {
    close () {
      this.$router.back()
    }
  }
}
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