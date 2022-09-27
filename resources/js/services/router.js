import * as Router from 'vue-router';

// Components
import Login from '../components/Auth/Login.vue';
import Register from '../components/Auth/Register.vue';
import Dashboard from '../components/Dashboard.vue';

// Panel child components.
import CreatePost from '../components/Panel/CreatePost.vue';
import Followers from '../components/Panel/Followers.vue';
import Followings from '../components/Panel/Followings.vue';
import Users from '../components/Panel/Users.vue';


export default new Router.createRouter({
    base: 'http://localhost',
    history: Router.createWebHashHistory(),
    linkExactActiveClass: "active",
    routes: [{
            path: '/dashboard',
            name: 'dashboard',
            components: {
                main: Dashboard
            },
            children: [
              {
                path: 'create-post',
                name: 'create-post',
                components: {
                    panel: CreatePost
                }
              },
              {
                path: 'users',
                name: 'users',
                components: {
                    panel: Users
                }
              },
              {
                path: 'followers',
                name: 'followers',
                components: {
                    panel: Followers
                }
              },
              {
                path: 'followings',
                name: 'followings',
                components: {
                    panel: Followings
                }
              }
            ]
        },
        {
            path: '/login',
            name: 'login',
            components: {
                main: Login,
            }
        },
        {
            path: '/register',
            name: 'register',
            components: {
                main: Register,
            }
        }
    ]
});
