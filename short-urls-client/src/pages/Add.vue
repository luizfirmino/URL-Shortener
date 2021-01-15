<template>
  <q-page class="flex-top">

    <q-banner inline-actions class="text-white bg-red" v-show="networkError">
      You have lost connection to the internet or the server ({{this.$API_URL}}) is offline.
    </q-banner>

    <q-form @submit="onSubmit" class="q-gutter-md">
    <div class="q-pa-md" style="max-width: 350px">
      <q-input
        v-model="form.url"
        filled
        autogrow
        type="textarea"
        label="Past here your long URL"
        placeholder="http://"
        required
      />
      <q-btn label="Create a short link" type="submit" color="primary" class="q-mt-md" :loading="submitting">
        <template v-slot:loading>
          <q-spinner-facebook />
        </template>
      </q-btn>

      <div class="q-mt-md">
        <q-list bordered separator v-bind:key="error.error" v-for="error in errorMessages">
          <q-item-label header>Whooops, looks like something went wrong</q-item-label>
          <q-item>
            <q-item-section avatar>
              <q-icon color="secondary" name="warning" />
            </q-item-section>
            <q-item-section>{{error}}</q-item-section>
          </q-item>
        </q-list>
      </div>
    </div>
    </q-form>
    <q-separator />
    <div class="q-pa-md q-mt-md" style="max-width: 350px">
      <q-list bordered separator v-bind:key="i.id" v-for="i in url">
        <q-item clickable v-ripple active active-class="bg-teal-1 text-grey-8" @click="openShortUrl(i.shortUrl)">
          <q-item-section avatar>
            <q-icon color="secondary" name="public" />
          </q-item-section>
          <q-item-section>{{host}}{{i.shortUrl}}</q-item-section>
        </q-item>
        <q-item>
          <q-item-section avatar>
            <q-icon color="secondary" name="description" />
          </q-item-section>
          <q-item-section>
            <q-item-label>{{i.longUrl}}</q-item-label>
            <q-item-label caption>Created at: {{i.created_at}}</q-item-label>
            <q-item-label caption>Updated at: {{i.updated_at}}</q-item-label>
            <q-item-label caption>Hits: {{i.hits}}</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
    </div>
  </q-page>
</template>

<script>
export default {
  name: 'PageAdd',
  data () {
    return {
      host: process.env.APP_URL,
      form: {
        url: ''
      },
      submitting: false,
      url: [],
      errorMessages: [],
      networkError: false
    }
  },
  methods: {
    onSubmit () {
      this.submitting = true
      this.url = null
      this.errorMessages = null
      this.networkError = false
      this.axios.post(this.$API_URL + '/api/longUrl', this.form)
        .then((response) => {
          this.url = response.data
        })
        .catch((error) => {
          if (error.response) {
            this.errorMessages = error.response.data.errors
          } else {
            this.networkError = true
          }
        })
        .finally(() => {
          this.submitting = false
        })
    },
    openShortUrl: function (shortUrl) {
      window.open(this.host + shortUrl, '_blank')
    }
  }
}
</script>
