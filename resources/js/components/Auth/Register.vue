<template>
  <div class="container py-4">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Register</div>
                  <div class="card-body">
                    <div class="row mt-4">
                        <div class="col-6 offset-3">
                            <form action="#" @submit.prevent="handleRegister">
                                <div class="form-row">
                                    <input type="name" name="name" v-model="formData.name" class="form-control" v-bind:class="{ 'is-invalid': formErrors.name }" placeholder="Name" />
                                    <div class="invalid-feedback" v-if="formErrors.name">
                                        {{ formErrors.name[0] }}
                                    </div>
                                </div>

                                <div class="form-row">
                                    <input type="email" name="email" v-model="formData.email" class="form-control" v-bind:class="{ 'is-invalid': formErrors.email }" placeholder="Email" />
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
                                <div class="form-row">
                                    <input type="password" name="password_confirmation" v-model="formData.password_confirmation" class="form-control" v-bind:class="{ 'is-invalid': formErrors.password }" placeholder="Password" />
                                    <div class="invalid-feedback" v-if="formErrors.password">
                                        {{ formErrors.password[0] }}
                                    </div>
                                </div>
                                <div class="form-row flex-row justify-content-between">
                                    <button type="submit" class="btn btn-primary float-start">Register</button>
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
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            formErrors: {}
        }
    },
    methods: {
      async handleRegister() {
        this.formErrors = {};
        await axios
            .get("/sanctum/csrf-cookie", {
                redirects: 0
            })
            .then(() => {
                return axios.post("/api/register", this.formData);
            })
            .then(() => {
                return axios.get("/api/user");
            })
            .then(res => {
                if(res.data.user.email) {
                  this.$store.dispatch('setUser', res.data.user)
                  this.$router.push({ path: '/dashboard/create-post' });
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
