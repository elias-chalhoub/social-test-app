<template>
  <form @submit.prevent="handleSharePost">
    <div class="form-group">
        <label class="sr-only" for="message">post</label>
        <textarea class="form-control" id="message" rows="3" v-model="formData.post" v-bind:class="{ 'is-invalid': formErrors.post }" placeholder="What are you thinking?"></textarea>
        <div class="invalid-feedback" v-if="formErrors.post">
            {{ formErrors.post[0] }}
        </div>
    </div>
    <div class="btn-toolbar justify-content-between">
        <div class="btn-group">
            <button type="submit" class="btn btn-primary">share</button>
        </div>
    </div>
  </form>
</template>

<script>
export default {
  data() {
      return {
          formData: {
              post: '',
          },
          formErrors: {}
      }
  },
  methods: {
    async handleSharePost() {
      this.formErrors = {};
      await axios
          .post("/api/post", this.formData)
          .then(res => {
              this.$store.dispatch('addPost', res.data);
              this.formData.post = '';
          })
          .catch((e) => {
              this.formErrors = e.response.data.errors;
          });
    }
  }
}
</script>
