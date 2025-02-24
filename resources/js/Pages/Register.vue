<script setup>
import { useForm } from "@inertiajs/vue3";
import Layout from "../Components/Layout.vue";

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
    <Layout title="Register">
        <div class="auth">
            <div class="auth-container">
                <h2>Register an Account</h2>
                <form class="form-container" @submit.prevent="submit">
                    <div>
                        <label for="name">Name</label>
                        <input
                            id="name"
                            v-model="form.name"
                            type="text"
                            autocomplete="off"
                            autofocus
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
                            autofocus
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
                            autofocus
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
                            >Password Confirmation</label
                        >
                        <input
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            required
                            autocomplete="off"
                            autofocus
                        />
                        <span
                            v-if="form.errors.password_confirmation"
                            style="color: red; text-align: center"
                            >{{ form.errors.password_confirmation }}</span
                        >
                    </div>
                    <button type="submit">Register</button>
                </form>
                <Link href="/login">Already have an account?</Link>
            </div>
        </div>
    </Layout>
</template>

<style scoped>
.auth {
    color: var(--color-text);
    height: 85vh;
    align-content: center;
}
.auth-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 5px;
    background-color: var(--color-background-mute);
}
.auth-container a {
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
</style>
