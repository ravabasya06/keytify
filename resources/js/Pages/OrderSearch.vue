<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import Layout from "../Components/Layout.vue";

const searchInput = ref("");

const searchOrder = () => {
    if (searchInput.value.trim()) {
        router.visit(`/order/${searchInput.value}`);
    }
};
</script>

<template>
    <Layout title="Order Search">
        <div class="container">
            <div class="search-container">
                <h2 style="text-align: center">Search Order</h2>
                <form @submit.prevent="searchOrder()" class="search-form">
                    <label>Invoice ID</label>
                    <input
                        type="text"
                        id="invoice"
                        v-model="searchInput"
                        placeholder="Enter your invoice ID"
                    />
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>
    </Layout>
</template>

<style scoped>
.container {
    height: 30vw;
}
.search-container {
    max-width: 400px;
    margin: 40px auto;
    padding: 25px;
    background: var(--color-background-mute);
    border-radius: 10px;
}

.search-container h2 {
    margin-bottom: 15px;
    font-size: 22px;
}

.search-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

input {
    padding: 10px;
    background-color: var(--color-background-soft);
    color: var(--color-text);
    border: 1px solid var(--color-text-2);
    border-radius: 6px;
    font-size: 16px;
    width: 100%;
}

button {
    padding: 10px;
    background: var(--color-logo);
    color: var(--color-background-mute);
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}
</style>
