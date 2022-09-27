<template>
<Nav />
<div class="container-fluid gedf-wrapper">
    <div class="row">
        <div class="col-md-3">
          <Profile />
        </div>
        <div class="col-md-6 gedf-main">
          <div class="card gedf-card">
              <div class="card-header">
                  <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/dashboard/create-post" role="tab">Posts</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/dashboard/followers" role="tab">Followers</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/dashboard/followings" role="tab">Followings</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/dashboard/users" role="tab">Users</router-link>
                    </li>
                  </ul>
              </div>

              <div class="card-body">
                <router-view name="panel"></router-view>
              </div>
          </div>

          <Post v-for="post in posts" v-bind:class="post.id" :key="post.id" :post="post" />

          <div class="border rounded-3 p-2" v-if="!posts.length">
            <h2>No posts yet!</h2>
            <h5>Post something or follow some users to see posts here :)</h5>
          </div>

        </div>
        <div class="col-md-3">
          <div class="card">
              <div class="card-header">Actions</div>
              <div class="card-body text-center">
                <div>
                    <button type="submit" @click.prevent="logoutUser" class="btn btn-danger m-3">Logout</button>
                </div>
              </div>
          </div>

        </div>
    </div>
</div>

</template>

<script>
import { mapFields } from 'vuex-map-fields';
import Nav from './Nav.vue';
import Profile from './Profile.vue';
import Post from './Post.vue';

export default {
  data() {
      return {

      }
  },
  computed: {
    ...mapFields([
      'user',
      'posts',
      'followers',
      'followings',
    ]),
  },
  async mounted() {
      if(!this.user.name){
        this.$router.push({ name: 'login' });
      }

      if(!Object.keys(this.followers).length){
        await axios.get("/api/user/followers").then(res => {
              this.$store.dispatch('setFollowers', res.data)
        })
      }

      if(!Object.keys(this.followings).length){
        await axios.get("/api/user/followings").then(res => {
              this.$store.dispatch('setFollowings', res.data)
        })
      }

      if(!Object.keys(this.posts).length){
        await axios.get("/api/user/followings/posts").then(res => {
              this.$store.dispatch('setPosts', res.data)
        })
      }

      console.log('Dashboard component mounted.');
  },
  methods: {
    getUser() {
        axios
            .get("/api/user")
            .then(res => {
                console.log(res.data);
                // this.$store.dispatch('setCurrentUser', res.data.user)
                // this.$store.dispatch('setAllPosts', res.data.followings_posts)
            })
            .catch((e) => {
                console.log(e.response.status);
            });
    },
    logoutUser() {
        axios
            .post("/api/logout")
            .then(res => {
                this.$store.dispatch('setUser', {});
                this.$store.dispatch('setPosts', {});
                this.$router.push({ name: 'login' });
                // console.log(res.data);
            })
            .catch((e) => {
                // console.log(e.response.status);
            });
    }
  },
  components: {
    Post,
    Nav,
    Profile
  }
}
</script>

<style>
.form-row {
    margin-bottom: 15px;
}
</style>
