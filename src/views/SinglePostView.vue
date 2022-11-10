<template>
  <div class="blog-posts">
    <div class="row">
      <div class="col-md-8">
        <div class="blog-post">
          <div class="blog-thumb">
            <img :src='require(`@/assets/images/${allData.post_img}`)' />
          </div>

          <div class="down-content">
            <h4>{{ allData.title }}</h4>
            <ul class="post-info mb-3"><li>{{ allData.created_at}}</li></ul>
            <div>{{ allData.excerpt }}</div>
          </div>

        </div>
      </div>

      <div class="col-md-4">
        <div class="sidebar-heading"><h2 class="ms-4 px-1">Recent Posts</h2></div>
        <app-aside
          v-for="post in posts"
          :post="post"
          :key="post.id"
        />
      </div>

    </div>
    <div class="error-messages"></div>
  </div>
</template>

<script>

import axios from 'axios';
import AppAside from '@/components/AppAside';

export default {
  components: {
      AppAside
    },
    data() {
      return {
        allData: [],
        posts: [],
        id: ''
      }
    },
    methods: {

      // Get a current post
      async fetchAllData() {

        try {

          this.id = this.$route.params.id;

          const response = await axios.post('https://getyoursite.info/vue-demo/vue-actions.php', {
            action: 'getonerecord',
            tableName: 'blog',
            id: this.id
          });

          this.allData = response.data;

        } catch (e) {
            $(".error-messages").append('<h3>Connection lost. Please, reload the page!</h3>');
            // console.log(e);
        }
      },

      // Get the last 3 posts
      async fetchPosts() {
        try {

          setTimeout( async () => {

            const response = await axios.post('https://getyoursite.info/vue-demo/vue-actions.php', {
              action: 'fetchposts',
              tableName: 'blog',
              page: 0,
              limit: 3
            });

            this.posts = response.data;

          }, 1000)

        } catch (e) {
          $(".error-messages").append('<h3>Connection lost. Please, reload the page!</h3>');
          // console.log(e);
        }

      }
    },
    mounted() {
      this.fetchAllData();
      this.fetchPosts();
      $(".content").fadeTo(500, 1);
    }
}
</script>

<style scoped>
.row {
  margin-bottom: 10rem;
}

.note {
  margin: 1rem;
  font-size: .9rem;
  color: blueviolet;
}
</style>