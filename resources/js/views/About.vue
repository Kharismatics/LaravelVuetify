<template>
  <v-row align="center" justify="center">
    <h1>This is an About page</h1>
    {{ info }}
  </v-row>
</template>
<script>
export default {
  data () {
    return {
      info: null
    }
  },
  mounted () {
    // axios
    //   .get('https://api.coindesk.com/v1/bpi/currentprice.json')
    //   .then(response => (this.info = response))
      axios
      .get('api/person', {
        headers: { 
          "Access-Control-Allow-Origin": "*"
        },
      responseType: 'json',
      })
      .then(response => (this.info = response))
  }
};
</script>