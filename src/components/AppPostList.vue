<template>
  <div v-if="posts.length > 0" class="row blog-posts">

    <transition-group name="post-list">
      <app-post
        v-for="post in posts"
        :post="post"
        :key="post.id"
        @remove="$emit('remove', post)"
      />
    </transition-group>

  </div>
  <h2 v-else class="text-center">No posts found</h2>
</template>

<script>
import AppPost from '@/components/AppPost';

export default {
  components: { AppPost },
  props: {
    posts: {
      type: Array,
      required: true
    }
  }
}
</script>

<style scoped>
/* transition-group style */
.post-list-item {
  display: inline-block;
  margin-right: 10px;
}
.post-list-enter-active,
.post-list-leave-active {
  transition: all 0.4s ease;
}
.post-list-enter-from,
.post-list-leave-to {
  opacity: 0;
  transform: translateY(30px);
}
.post-list-move {
  transition: transform 0.4s ease;
}
</style>
