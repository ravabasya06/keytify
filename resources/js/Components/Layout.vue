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
        <header v-if="title !== 'Login'">
            <Nav />
        </header>
        <Notification />
        <article>
            <slot />
        </article>
        <footer>
            <FooterTemplate />
        </footer>
    </main>
</template>

<style scoped>
article {
    display: flex;
    flex-direction: column;
    min-height: calc(100vh);
}
</style>
