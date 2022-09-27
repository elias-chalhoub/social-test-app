<template>
  <div class="card gedf-card">
      <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex justify-content-between align-items-center">
                  <div class="me-2">
                      <img class="rounded-circle" width="45" v-bind:src="'https://ui-avatars.com/api/?background=random&bold=true&name=' + post.user.name" alt="">
                  </div>
                  <div class="ms-2">
                      <div class="h5 m-0">{{post.user.name}}</div>
                      <div class="h7 text-muted">{{post.user.email}}</div>
                  </div>
              </div>
          </div>
      </div>
      <div class="card-body">
          <p class="card-text">
              {{ post.post }}
          </p>
      </div>
      <div class="card-footer">
          <div class="text-muted h7 me-2">{{post.created_at_diff}}</div>
      </div>
  </div>
</template>
<script>
export default {
    props: {
        post: Object
    }
}
</script>
