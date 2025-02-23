<script setup>
import { ref } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import Layout from "../Components/Layout.vue";

defineProps(["user", "user_address"]);

const { user, user_address } = usePage().props;
const profileForm = ref({
    name: user.name || "",
    email: user.email || "",
});

const addressForm = ref({
    user_id: user.id,
    first_name: user_address?.first_name || "",
    last_name: user_address?.last_name || "",
    address: user_address?.address || "",
    city: user_address?.city || "",
    province: user_address?.province || "",
    island: user_address?.island || "",
    postal_code: user_address?.postal_code || "",
    phone_number: user_address?.phone_number || "",
});

const updateProfile = () => {
    router.put(route("profile.update"), profileForm.value);
};

const updateAddress = () => {
    if (!user_address || !user_address.user_address_id) {
        router.post(route("address.store"), addressForm.value);
    } else {
        router.put(
            route("address.update", { id: user_address.user_address_id }),
            addressForm.value,
        );
    }
};

const logout = () => {
    router.post(route("logout"));
};

const memberSince = (userDate) => {
    const registeredDate = new Date(userDate);
    const currentDate = new Date();

    const differenceInTime = currentDate - registeredDate;
    const differenceInDays = Math.floor(
        differenceInTime / (1000 * 60 * 60 * 24),
    );

    return `You've been our customer for ${differenceInDays} days!`;
};
</script>

<template>
    <Layout title="Profile">
        <div class="profile">
            <div class="profile-container">
                <h1>Profile Information</h1>
                <p style="color: var(--color-text-2)">
                    Update your account's username and email
                </p>
                <form @submit.prevent="updateProfile()">
                    <label>Username</label>
                    <input v-model="profileForm.name" type="text" required />

                    <label>Email</label>
                    <input v-model="profileForm.email" type="email" required />
                    <p style="margin-top: 15px">
                        {{ memberSince(user.created_at) }}
                    </p>
                    <div class="password-save-container">
                        <button class="password-change">
                            Want to change your password?
                        </button>
                        <button class="submit-btn" type="submit">Save</button>
                    </div>
                </form>
                <button @click="logout()" class="logout-btn">Logout</button>
            </div>
            <div class="profile-container">
                <h2>Shipping Address</h2>
                <p style="color: var(--color-text-2)">
                    Your shipping address for us to send the best keyboard
                    you'll ever experience!
                </p>
                <form @submit.prevent="updateAddress()">
                    <div class="name-container">
                        <div class="child-name-container">
                            <label>First Name</label>
                            <input
                                v-model="addressForm.first_name"
                                type="text"
                                required
                            />
                        </div>
                        <div class="child-name-container">
                            <label>Last Name</label>
                            <input
                                v-model="addressForm.last_name"
                                type="text"
                                required
                            />
                        </div>
                        <div class="child-name-container">
                            <label>Phone Number</label>
                            <input
                                v-model="addressForm.phone_number"
                                type="text"
                                required
                            />
                        </div>
                    </div>
                    <label>Address</label>
                    <textarea
                        v-model="addressForm.address"
                        type="text"
                        required
                    ></textarea>
                    <div class="name-container">
                        <div class="child-name-container">
                            <label>City</label>
                            <input
                                v-model="addressForm.city"
                                type="text"
                                required
                            />
                        </div>
                        <div class="child-name-container">
                            <label>Province</label>
                            <input
                                v-model="addressForm.province"
                                type="text"
                                required
                            />
                        </div>
                        <div class="child-name-container">
                            <label>Island</label>
                            <input
                                v-model="addressForm.island"
                                type="text"
                                required
                            />
                        </div>
                        <div class="child-name-container">
                            <label>Postal Code</label>
                            <input
                                v-model="addressForm.postal_code"
                                type="number"
                                required
                            />
                        </div>
                    </div>
                    <button
                        style="margin-top: 20px"
                        class="submit-btn"
                        type="submit"
                    >
                        Save
                    </button>
                </form>
            </div>
        </div>
    </Layout>
</template>

<style scoped>
.profile-container {
    margin: 30px;
    background-color: var(--color-background-mute);
    padding: 30px;
    border-radius: 10px;
    color: var(--color-text);
}
form {
    display: flex;
    flex-direction: column;
    /* width: 50%; */
}
label {
    display: block;
    margin: 10px 0 5px;
}
input,
textarea {
    padding: 10px;
    border: 1px solid var(--color-text-2);
    color: var(--color-text);
    background-color: var(--color-background-soft);
    border-radius: 3px;
    font-size: 16px;
}
.name-container {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    gap: 20px;
}
.child-name-container {
    display: flex;
    flex-direction: column;
    width: 100%;
}
.password-save-container {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
}
.password-change {
    font-size: 15px;
    padding: 0;
    background-color: var(--color-background-mute);
    border: none;
    color: var(--color-text);
    cursor: pointer;
}
.password-change:hover {
    color: var(--color-text-2);
}
.submit-btn {
    padding: 10px;
    background-color: var(--color-logo);
    color: var(--color-background-mute);
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.logout-btn {
    width: 100%;
    margin-top: 15px;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    background-color: red;
    color: var(--color-text);
}
.logout-btn:hover {
    background-color: darkred;
}
</style>
