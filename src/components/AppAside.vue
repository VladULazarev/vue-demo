<template>
    <div class="sidebar">
        <div class="row">
            <div class="col-lg-12">
                <div class="sidebar-item recent-posts">
                    <ul>
                        <li>
                            <a :href="'/posts/' + post.id">
                            <h5>{{ post.title }}</h5>
                            </a>
                            <span>{{ post.created_at }}</span>
                        </li>
                    </ul>
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