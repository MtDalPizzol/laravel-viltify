<template>
  <v-container class="fill-height">

    <Head title="Reset your password" />
    <v-row justify="center">
      <v-col
        cols="12"
        sm="8"
        lg="6"
        xl="4"
      >
        <form @submit.prevent="submit">
          <v-card
            flat
            color="transparent"
          >
            <v-card-title class="text-h4 mb-8">
              Reset your password
            </v-card-title>
            <v-card-text>
              <v-text-field
                v-model="form.email"
                label="Email"
                :error-messages="errors.email"
                outlined
              ></v-text-field>
              <v-text-field
                v-model="form.password"
                label="Password"
                outlined
                :type="showPassword ? 'text' : 'password'"
                :append-icon="showPassword ? icons.mdiEye : icons.mdiEyeOff"
                :error-messages="errors.password"
                @click:append="showPassword = !showPassword"
              ></v-text-field>
              <v-text-field
                v-model="form.password_confirmation"
                label="Password confirmation"
                outlined
                :type="showPassword ? 'text' : 'password'"
                :append-icon="showPassword ? icons.mdiEye : icons.mdiEyeOff"
                :error-messages="errors.password_confirmation"
                @click:append="showPassword = !showPassword"
              ></v-text-field>
            </v-card-text>
            <v-card-actions class="py-0 px-4 d-block-xs d-flex-md">
              <v-spacer />
              <v-btn
                :loading="loading"
                color="primary"
                type="submit"
                depressed
                x-large
                dark
              >Reset password</v-btn>
            </v-card-actions>
          </v-card>
        </form>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import GuestLayout from '@/layouts/GuestLayout'
import {
  mdiEye,
  mdiEyeOff
} from '@mdi/js'

export default {
  layout: GuestLayout,
  props: {
    email: String,
    errors: Object,
    token: String
  },
  data () {
    return {
      form: this.$inertia.form({
        token: this.token,
        email: this.email,
        password: '',
        password_confirmation: ''
      }),
      icons: {
        mdiEye,
        mdiEyeOff
      },
      loading: false,
      showPassword: false
    }
  },
  methods: {
    submit () {
      if (this.loading) return

      this.loading = true

      this.form.post(this.route('password.update'), {
        onFinish: () => {
          this.loading = false
        }
      })
    }
  }
}
</script>

<style>
</style>
