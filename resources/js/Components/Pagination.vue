<template>
    <nav v-if="links.length > 3" aria-label="Page navigation example">
        <ul class="pagination">
            <li v-for="(link, k) in links" :key="k" class="page-item" :class="{ 'active': link.active }">
                <Link class="page-link" :href="link.url" v-html="link.label" />
            </li>
        </ul>
    </nav>
</template>
  
<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Link
    },
  props: {
    links: Array,
  },
}
</script> 