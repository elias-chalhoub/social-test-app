<template>
  <div class="gedf-card card">
      <div class="card-body">
          <div class="h4">@{{this.user.name}}</div>
          <div class="h7">{{this.user.email}}</div>
      </div>
      <ul class="list-group list-group-flush">
          <li class="list-group-item">
              <div class="h6 text-muted">Followers</div>
              <div class="h5">{{this.followers.length}}</div>
          </li>
          <li class="list-group-item">
              <div class="h6 text-muted">Following</div>
              <div class="h5">{{this.followings.length}}</div>
          </li>
      </ul>
  </div>
</template>

<script>
import { mapFields } from 'vuex-map-fields';

export default {
    computed: {
      ...mapFields([
        'user',
        'posts',
        'followers',
        'followings',
      ])
    }
}
</script>
