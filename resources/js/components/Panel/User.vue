<template>
  <div class="border rounded-3 p-2 mt-3">
      <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex justify-content-between align-items-center">
              <div class="me-2">
                  <!--<div class="gavatar">{{user.gavatar}}</div>-->
                  <img class="rounded-circle" width="45" v-bind:src="'https://ui-avatars.com/api/?background=random&bold=true&name=' + user.name" alt="">
              </div>
              <div class="ms-2">
                  <div class="h5 m-0">{{user.name}}</div>
                  <div class="h7 text-muted">{{user.email}}</div>
              </div>
          </div>
          <button class="btn btn-primary" v-if="!following" @click.prevent="handleFollow(user.id)">Follow</button>
          <button class="btn btn-secondary" v-if="following" @click.prevent="handleUnFollow(user.id)">Unfollow</button>
      </div>
  </div>
</template>

<script>
export default {
  props: {
    user: Object,
    following: Boolean
  },
  methods: {
    async handleFollow(id) {
      await axios
            .post("/api/user/follow/"+id)
            .then(res => {
                this.$store.dispatch('setFollowings', res.data);
                this.$store.dispatch('updatePosts');
            })
            .catch((e) => {
                // console.log(e.response.status);
            });
    },
    async handleUnFollow(id) {
      await axios
            .delete("/api/user/unfollow/"+id)
            .then(res => {
                this.$store.dispatch('setFollowings', res.data);
                this.$store.dispatch('updatePosts');
            })
            .catch((e) => {
                // console.log(e.response.status);
            });
    },
  }
}
</script>
