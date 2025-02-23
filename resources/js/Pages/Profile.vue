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
    router.put(route("user_address.update"), addressForm.value);
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
                    <label>First Name</label>
                    <input
                        v-model="addressForm.first_name"
                        type="text"
                        required
                    />

                    <label>Last Name</label>
                    <input
                        v-model="addressForm.last_name"
                        type="text"
                        required
                    />

                    <label>Address</label>
                    <input v-model="addressForm.address" type="text" required />

                    <label>City</label>
                    <input v-model="addressForm.city" type="text" required />

                    <label>Province</label>
                    <input
                        v-model="addressForm.province"
                        type="text"
                        required
                    />

                    <label>Island</label>
                    <input v-model="addressForm.island" type="text" required />

                    <label>Postal Code</label>
                    <input
                        v-model="addressForm.postal_code"
                        type="text"
                        required
                    />

                    <label>Phone Number</label>
                    <input
                        v-model="addressForm.phone_number"
                        type="text"
                        required
                    />

                    <button class="submit-btn" type="submit">
                        Update Address
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
    width: 50%;
}
label {
    display: block;
    margin: 10px 0 5px;
}
input {
    padding: 10px;
    border: 1px solid var(--color-text-2);
    color: var(--color-text);
    background-color: var(--color-background-soft);
    border-radius: 3px;
    font-size: 16px;
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
