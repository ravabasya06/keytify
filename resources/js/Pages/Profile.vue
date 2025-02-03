<script setup>
import { useForm } from "@inertiajs/vue3";
import Layout from "../Components/Layout.vue";
defineProps(["user"]);

// const props = defineProps({
//     spbu: {
//         type: Object,
//         default: null,
//     },
//     islands: {
//         type: Object,
//     },
//     provinces: {
//         type: Object,
//     },
// });

// const form = useForm({
//     name: props.spbu?.name ?? "",
//     road: props.spbu?.road ?? "",
//     city: props.spbu?.city ?? "",
//     province_id: props.spbu?.province_id ?? "",
//     island_id: props.spbu?.island_id ?? "",
//     latitude: props.spbu?.latitude ?? "",
//     longitude: props.spbu?.longitude ?? "",
// });

// const handleSubmit = () => {
//     if (isEditMode.value) {
//         form.put(`/spbu/${form.spbu_id}`);
//     } else {
//         form.post(route("spbu.store"), {
//             preserveScroll: true,
//             onSuccess: () => form.reset(),
//         });
//     }
// };

const logoutForm = useForm({});
const logout = () => {
    console.log("Logging out");
    logoutForm.post(route("logout"));
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

                <form @submit.prevent="logout">
                    <button type="submit">Logout</button>
                </form>
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
