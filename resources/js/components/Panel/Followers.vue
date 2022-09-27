<template>
  <User v-for="user in followers" :key="user.id" :user="user" :following="following(user)" />
  <div class="border rounded-3 p-2" v-if="!followers.length">
    <h2>No Followers!</h2>
    <h5>Getting followers is the dream of 2022! do something :)</h5>
  </div>
</template>

<script>
import { mapFields } from 'vuex-map-fields';
import { toRaw } from 'vue';
import User from './User.vue';

export default {
  data() {
      return {}
  },
  computed: {
    ...mapFields([
      'followers',
      'followings',
    ]),
  },
  mounted() {
      console.log('Followers component mounted.');
  },
  methods: {
    following(user) {
      return !!toRaw(this.followings).filter(x => x.id === user.id).length;
    }
  },
  components: {
    User
  }
}
</script>
