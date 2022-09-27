<template>
  <User v-for="user in followings" :key="user.id" :user="user" :following="following(user)" />
  <div class="border rounded-3 p-2" v-if="!followings.length">
    <h2>No Followings!</h2>
    <h5>Go to `users` tab and follow someone :)</h5>
  </div>
</template>

<script>
import { mapFields } from 'vuex-map-fields';
import { find } from 'lodash';
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
    console.log('Followings component mounted.');
  },
  methods: {
    following(user) { return find(this.followings, user) ? true : false; }
  },
  components: {
    User
  }
}
</script>
