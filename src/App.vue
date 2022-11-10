<template>
  <div class="nav-bar">
    <div class="logo">
      <router-link to="/"><img alt="Vue logo" src="@/assets/logo.png"></router-link>
    </div>
    <nav>
      <router-link to="/">home</router-link>
      <router-link to="/posts">posts</router-link>
      <router-link to="/contact">contact</router-link>
      <router-link to="/show-messages">Show Messages</router-link>
    </nav>
  </div>
  <div class="container">
    <router-view/>
  </div>
  <app-footer/>
</template>

<script>
import AppFooter from '@/components/AppFooter';

export default {
  components: {
    AppFooter
  },
  watch: {
    // Show 'search' field only on 'POSTS' page
    $route(to, from) {
      if (window.location.pathname == '/posts') {
        $(".search-input").css({"visibility" : "visible"})
      } else {
        $(".search-input").css({"visibility" : "hidden"})
      }
    }
  }
}

</script>

<style>
.content {
  visibility: visible;
  opacity: 0;
}
</style>

