<template>
  <div class="container py-4">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Login</div>
                  <div class="card-body">
                    <div class="row mt-4">
                        <div class="col-6 offset-3">
                            <form action="#" @submit.prevent="handleLogin">
                                <div class="form-row">
                                    <input type="email" name="email" v-model="formData.email" class="form-control" v-bind:class="{ 'is-invalid': formErrors.email }" placeholder="Email" required />
                                    <div class="invalid-feedback" v-if="formErrors.email">
                                        {{ formErrors.email[0] }}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <input type="password" name="password" v-model="formData.password" class="form-control" v-bind:class="{ 'is-invalid': formErrors.password }" placeholder="Password" />
                                    <div class="invalid-feedback" v-if="formErrors.password">
                                        {{ formErrors.password[0] }}
                                    </div>
                                </div>
                                <div class="form-row flex-row justify-content-between">
                                    <button type="submit" class="btn btn-primary float-start">Login</button>
                                    <router-link to="register" class="btn btn-secondary float-end">Register</router-link>
                                </div>
                            </form>
                        </div>
                    </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            formData: {
                email: '',
                password: ''
            },
            formErrors: {}
        }
    },
    methods: {
      async handleLogin() {
        this.formErrors = {};
        await axios
            .get("/sanctum/csrf-cookie", {
                redirects: 0
            })
            .then(() => {
                return axios.post("/api/login", this.formData);
            })
            .then(() => {
                return axios.get("/api/user");
            })
            .then(res => {
                if(res.data.user.email) {
                  this.$store.dispatch('setUser', res.data.user)
                  this.$router.push({ path: '/dashboard/create-post' })
                }
            })
            .catch((e) => {
                this.formErrors = e.response.data.errors;
            });
      }
    }
}
</script>

<style>
.form-row {
    margin-bottom: 15px;
}
</style>
