<template>

    <div class="col-lg-6">
        <div class="blog-post">

            <div class="blog-thumb" @click="$router.push('/posts/' + post.id)">
                <img :src='require(`@/assets/images/${post.thumb_img}`)' />
            </div>

            <div class="down-content">
                <a :href="'/posts/' + post.id"><h4>{{ post.title }}</h4></a>

                <ul class="post-info">
                    <li>{{ post.created_at }}</li>
                </ul>

                <p>{{ post.excerpt }}</p>

                <div class="post_btns">

                    <app-button
                    class="btn-dark-grey"
                    @click="$emit('remove', post)">Hide Post</app-button>

                </div>

            </div>

        </div>
    </div>

</template>

<script>
export default {
    props: {
        post: {
            type: Object,
            required: true
        }
    }
}
</script>