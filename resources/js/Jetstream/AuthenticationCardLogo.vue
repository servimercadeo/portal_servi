<template>
  <Link :href="'/'" class="d-flex justify-content-center mb-4">
      <img src="imgs/servimercadeo_logo.png" alt="">
  </Link>
</template>

<script>
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
  components: {
    Link,
  },
})
</script>