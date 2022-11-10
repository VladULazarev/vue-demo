<template>
    <div class="posts content">
        <div class="error-messages"></div>
        <div class="search-wrapper mb-5">
            <app-input
                v-model="searchQuery"
                type="text"
                placeholder="Search by title..."
            />
        </div>
        <div class="row">
            <div class="col-md-8">
                <app-post-list
                    :posts="searchedPosts"
                    @remove="removePost"
                    v-if="!isPostLoading"
                />
                <div v-else>
                    <div class="modal no-bg">
                        <div class="modal-dialog modal-confirm load-img-container">
                            <img class="load-img" :src='require(`@/assets/loader/preloader.gif`)' alt="Loading image" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="sidebar-heading"><h2 class="ms-4 px-1">Recent Posts</h2></div>
                <app-aside
                    v-for="post in posts.slice(0, 3)"
                    :post="post"
                    :key="post.id"
                />
            </div>
        </div>

      <div
        v-intersection="loadMorePosts"
        class="observer"
        v-if="observerVisible"
      ></div>
    </div>
  </template>

<script>

import AppPostList from '@/components/AppPostList';
import AppAside from '@/components/AppAside';
import axios from 'axios';

export default {
    components: {
      AppPostList, AppAside
    },
    data() {
        return {
            posts: [],
            observerVisible: false,
            isPostLoading: false,
            page: 0,
            limit: 4,
            searchQuery: ''
        }
    },
    methods: {
        removePost(post) {
            this.posts = this.posts.filter(p => p.id !== post.id);
        },
        async fetchPosts() {

             try {
                this.isPostLoading = true;

                const response = await axios.post('https://getyoursite.info/vue-demo/vue-actions.php', {
                //const response = await axios.post('vue-actions.php', {
                    action: 'fetchposts',
                    tableName: 'blog',
                    page: this.page,
                    limit: this.limit
                });

                this.posts = response.data;
                this.isPostLoading = false;
                this.observerVisible = true;

            } catch (e) {
                this.isPostLoading = false;
                $(".error-messages").append('<h3>Connection lost. Please, reload the page!</h3>');
                //console.log(e);
            }
        },
        async loadMorePosts() {
            try {

                this.page += 4;

                const response = await axios.post('https://getyoursite.info/vue-demo/vue-actions.php', {
                //const response = await axios.post('vue-actions.php', {
                    action: 'fetchposts',
                    tableName: 'blog',
                    page: this.page,
                    limit: this.limit
                });

                // Set timeout for smooth show up of thr next posts
                setTimeout( async () => {
                    if ( response.data.length ) {
                        // Add next posts to existing array
                        this.posts =[...this.posts, ...response.data];
                        //console.log(response.data.length);
                    } else {
                        this.observerVisible = false;
                    }
                }, 100);

            } catch (e) {
                $(".error-messages").append('<h3>Connection lost. Please, reload the page!</h3>');
            }
        }
    },
    mounted() {
        this.fetchPosts();
        $(".content").fadeTo(500, 1);
    },
    computed: {
        searchedPosts() {
            return this.posts.filter(post => post.title.toLowerCase().includes(this.searchQuery.toLowerCase()));
        }
    }
}
</script>

<style scoped>
.posts {
  margin-bottom: 10rem;
}
.modal {
  display: block;
}
.search-wrapper {
    text-align: end;
}
</style>