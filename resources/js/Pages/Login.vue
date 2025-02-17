<script setup>
import { useForm } from "@inertiajs/vue3";
import Layout from "../Components/Layout.vue";

const form = useForm({
    email: "",
    password: "",
});

const submit = () => {
    form.post(route("login"));
};
</script>

<template>
    <Layout title="Login">
        <div class="login">
            <div class="login-container">
                <h2 class="logo">KEYTIFY</h2>
                <form class="form-container" @submit.prevent="submit">
                    <div>
                        <label for="email">Email</label>
                        <input
                            v-model="form.email"
                            id="email"
                            type="email"
                            required
                            autocomplete="off"
                            autofocus
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
                            v-model="form.password"
                            id="password"
                            type="password"
                            required
                            autocomplete="off"
                            autofocus
                        />
                        <span
                            v-if="form.errors.password"
                            style="color: red; text-align: center"
                            >{{ form.errors.password }}</span
                        >
                    </div>
                    <button type="submit">Masuk</button>
                </form>
                <Link href="/register">Belum punya akun?</Link>
            </div>
        </div>
    </Layout>
</template>

<style scoped>
.login {
    color: var(--color-text);
    height: 85vh;
    align-content: center;
}
.login-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 5px;
    background-color: var(--color-background-mute);
}
.login-container a {
    color: var(--color-logo);
}
.form-container {
    display: flex;
    flex-direction: column;
    gap: 3px;
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
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    background-color: var(--color-background);
    color: var(--color-text);
    border: 1px solid var(--color-text);
    border-radius: 4px;
}
button {
    background-color: var(--color-background);
    color: var(--color-text);
    border-radius: 4px;
    border: 1px solid var(--color-text);
    padding: 10px;
}

span {
    color: red;
    font-size: 0.9em;
}
input:focus {
    outline: none;
}
.logo {
    color: var(--color-logo);
}
</style>
