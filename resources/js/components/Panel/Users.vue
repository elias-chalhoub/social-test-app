<template>
  <User v-for="user in users" :key="user.id" :user="user" :following="following(user)" />
</template>
<script>
import { mapFields } from 'vuex-map-fields';
import { find } from 'lodash';
import User from './User.vue';

export default {
  data() {
      return {
        users: {}
      }
  },
  computed: {
    ...mapFields([
      'followers',
      'followings',
    ]),
  },
  async mounted() {

      if(!Object.keys(this.users).length){
        await axios.get("/api/user/all").then(res => {
              this.users = res.data;
        })
      }

      console.log('Users component mounted.');
  },
  methods: {
    following(user) { return find(this.followings, user) ? true : false; }
  },
  components: {
    User
  }
}
</script>
