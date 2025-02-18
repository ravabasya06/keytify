<script setup>
import { watch } from "vue";
import Nav from "./Nav.vue";
import Notification from "./Notification.vue";
import FooterTemplate from "./Footer.vue";

const props = defineProps(["title"]);

watch(
    () => props.title,
    (newTitle) => {
        document.title = "Keytify - " + newTitle;
    },
    { immediate: true },
);
</script>

<template>
    <main>
        <Nav />
        <Notification />
        <article>
            <slot />
        </article>
        <FooterTemplate />
    </main>
</template>

<style scoped></style>
