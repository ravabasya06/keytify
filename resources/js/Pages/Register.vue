<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset("password", "password_confirmation");
            }
            if (form.errors.password_confirmation) {
                form.reset("password_confirmation");
            }
        },
    });
};
</script>

<template>
    <div class="auth">
        <div class="auth-container">
            <h2>Daftarkan Akun</h2>
            <form @submit.prevent="submit">
                <div>
                    <label for="name">Name</label>
                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        autocomplete="off"
                        required
                    />
                    <span
                        v-if="form.errors.name"
                        style="color: red; text-align: center"
                        >{{ form.errors.name }}</span
                    >
                </div>
                <div>
                    <label for="email">Email</label>
                    <input
                        id="email"
                        v-model="form.email"
                        type="email"
                        autocomplete="off"
                        required
                    />
                    <span
                        v-if="form.errors.email"
                        style="color: red; text-align: center"
                        >{{ form.errors.email }}</span
                    >
                </div>
                <div>
                    <label for="password">Password</label>
                    <input
                        id="password"
                        v-model="form.password"
                        type="password"
                        autocomplete="off"
                        required
                    />
                    <span
                        v-if="form.errors.password"
                        style="color: red; text-align: center"
                        >{{ form.errors.password }}</span
                    >
                </div>
                <div>
                    <label for="password_confirmation"
                        >Konfirmasi Password</label
                    >
                    <input
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        required
                    />
                    <span
                        v-if="form.errors.password_confirmation"
                        style="color: red; text-align: center"
                        >{{ form.errors.password_confirmation }}</span
                    >
                </div>
                <button type="submit">Daftar</button>
            </form>
            <Link href="/login">Sudah punya akun?</Link>
        </div>
    </div>
</template>

<style scoped>
.auth {
    color: white;
    height: 85vh;
    align-content: center;
}
.auth-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #111;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input {
    width: 95%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    width: 100%;
}

span {
    color: red;
    font-size: 0.9em;
}
input:focus {
    outline: none;
}
</style>
