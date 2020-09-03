<template>
    <router-view></router-view>
</template>
<script>
export default {
  name: 'ProductIndex',
  methods: {
    close () {
      this.$router.back()
    }
  },
  data () {
      return {
        alignmentsAvailable: [
          'start',
          'center',
          'end',
          'baseline',
          'stretch',
        ],
        alignment: 'center',
        dense: false,
        justifyAvailable: [
          'start',
          'center',
          'end',
          'space-around',
          'space-between',
        ],
        justify: 'center',
      }
    },
}
</script>