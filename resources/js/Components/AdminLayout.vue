<script setup>
import { watch } from "vue";
import Notification from "./Notification.vue";
import AdminNav from "./AdminNav.vue";

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
        <header>
            <AdminNav />
        </header>
        <div>
            <Notification />
            <article>
                <slot />
            </article>
        </div>
    </main>
</template>

<style scoped>
main {
    display: flex;
    flex-direction: row;
}
article {
    display: flex;
    flex-direction: column;
    min-height: calc(100vh);
}
header {
    background-color: var(--color-background-mute);
}
</style>
