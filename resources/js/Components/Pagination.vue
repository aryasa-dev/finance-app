<script setup>
import { Link } from "@inertiajs/vue3";
import Button from "./Button.vue";

const props = defineProps({
  meta: {
    type: Object,
  },
});
console.log(props.meta.links)
console.log(props.meta.links[props.meta.links.length - 1])

</script>

<template>
  <nav class="mt-7 space-x-2 flex justify-center">
    <Link :href="meta.links[1].url">
      <Button variant="secondary" :isDisabled="meta.current_page === 1">First</Button>
    </Link>
    <Link v-for="(link, index) in meta.links" :key="index" :href="link.url">
      <Button :isDisabled="!link.url" v-html="link.label" :variant="link.active ? 'primary' : 'secondary'" />
    </Link>
    <Link :href="meta.links[meta.links.length - 2].url">
      <Button variant="secondary" :isDisabled="meta.current_page === meta.last_page">Last</Button>
    </Link>
  </nav>
</template>
