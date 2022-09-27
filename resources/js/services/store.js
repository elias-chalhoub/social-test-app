import Vuex from 'vuex'
import VuexPersist from 'vuex-persist'
import { getField, updateField } from 'vuex-map-fields';
import { merge } from 'lodash';

// Define original state
let store = {
  state: {
    user: {},
    posts: {},
    followers: {},
    followings: {},
  },
  mutations: {
    updateField,
    setUser(state, data){
      state.user = data;
    },
    setPosts(state, data){
      state.posts = data;
    },
    addPost(state, data){
      state.posts = [
        data,
        ...state.posts
      ];
    },
    setFollowers(state, data){
      state.followers = data;
    },
    setFollowings(state, data){
      state.followings = data;
    }
  },
  getters: {
    getField,
    getUser( state ){
      return state.user;
    },
    getPosts( state ){
      return state.posts;
    },
    getFollowers( state ){
      return state.followers;
    },
    getFollowings( state ){
      return state.followings;
    }
  },
  actions: {
    setUser( context, result) {
      context.commit("setUser", result);
    },
    async updatePosts( context ) {
      await axios.get("/api/user/followings/posts").then(res => {
            context.commit('setPosts', res.data)
      })
    },
    setPosts( context, result) {
      context.commit("setPosts", result);
    },
    addPost( context, result) {
      context.commit("addPost", result);
    },
    setFollowers( context, result) {
      context.commit("setFollowers", result);
    },
    setFollowings( context, result) {
      context.commit("setFollowings", result);
    }
  },
  plugins: []
}


const vuexPersist = new VuexPersist({
  key: 'timewave-data',
  storage: localStorage,
  reducer: state => {
    return {
      user: state.user,
    }
  },
  // eslint-disable-next-line
  filter: mutation => { return true; }
})
store.plugins.push(vuexPersist.plugin);

export default new Vuex.Store(store)
