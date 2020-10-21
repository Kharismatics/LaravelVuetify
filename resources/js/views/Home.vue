<template>
  <v-card class="mx-auto" max-width="344">
    <v-card-text>
      <div>Word of the Day</div>
      <p class="display-1 text--primary">be•nev•o•lent</p>
      <p>adjective</p>
      <div class="text--primary">
        getCounter {{ counter }}<br />
        getUser "a benevolent smile"
      </div>
    </v-card-text>
    <v-card-actions>
      <v-btn
        text
        color="deep-purple accent-4"
        @click="$store.commit('increment')"
      >
        increment
      </v-btn>
      <v-btn text color="deep-purple accent-4" @click="decrement">
        decrement
      </v-btn>
    </v-card-actions>
  </v-card>
</template>
<script>
export default {
  mounted() {
    this.$auth
    .fetch()
    .then((response) => {
      // console.log(response.data);
      this.$auth.user(response.data)
      console.log(this.$auth.user());
        // do something
    });
  },
  methods: {
    decrement() {
      this.$store.commit("decrement");
    },
  },
  computed: {
    counter() {
      return this.$store.getters.getCounter;
    },
  },
};
</script>