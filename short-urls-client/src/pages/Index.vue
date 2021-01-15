<template>
    <q-page class="flex-top">
    <q-banner inline-actions class="text-white bg-red" v-show="networkError">
      You have lost connection to the internet or the server ({{this.$API_URL}}) is offline.
    </q-banner>
    <div class="q-pa-md">
      <div v-if="redirecting == true">
        Redirecting to: {{url.longUrl}}
      </div>
    </div>
  </q-page>
</template>

<script>
export default {
  name: 'PageIndex',
  data () {
    return {
      url: [],
      errorMessage: '',
      redirecting: false,
      networkError: false
    }
  },
  mounted () {
    this.axios.get(this.$API_URL + '/api/shortUrl/' + this.$route.params.url).then(response => {
      window.location.href = response.data.longUrl
      this.url = response.data
      this.redirecting = true
    })
      .catch((error) => {
        if (error.response) {
          this.errorMessage = error.response.data
          this.$router.push({ path: '/error/404' })
        } else {
          this.networkError = true
        }
      })
  }
}
</script>
