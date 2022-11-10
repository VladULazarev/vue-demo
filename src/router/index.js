import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import PostsView from '../views/PostsView.vue'
import ContactView from '../views/ContactView.vue'
import ShowMessagesView from '../views/ShowMessagesView.vue'
import SinglePostView from '../views/SinglePostView.vue'
import UpdateContactView from '../views/UpdateContactView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/posts',
    name: 'posts',
    component: PostsView
  },
  {
    path: '/contact',
    name: 'contact',
    component: ContactView
  },
  {
    path: '/show-messages',
    name: 'show-messages',
    component: ShowMessagesView
  },
  {
    path: '/posts/:id',
    name: 'single-post',
    component: SinglePostView
  },
  {
    path: '/message/:id/edit',
    name: 'update-contact',
    component: UpdateContactView
  }

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
