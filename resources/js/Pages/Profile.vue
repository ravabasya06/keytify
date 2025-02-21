<script setup>
import { router } from "@inertiajs/vue3";
import Layout from "../Components/Layout.vue";
defineProps(["user"]);

const logout = () => {
    router.post(route("logout"));
};
</script>
<template>
    <Layout title="Profile">
        <div class="profile">
            <div class="profile-container">
                <h1 class="welcome">Welcome, {{ user.name }}</h1>
                <p>
                    Created At: {{ user.created_at }} <br />
                    Updated At: {{ user.updated_at }}
                </p>
                <p v-if="user.isAdmin">You're an Admin!</p>

                <button @click="logout()" type="submit">Logout</button>
            </div>
        </div>
    </Layout>
</template>
<style scoped>
.welcome {
    text-align: center;
}
.profile-container {
    color: black;
}
</style>
