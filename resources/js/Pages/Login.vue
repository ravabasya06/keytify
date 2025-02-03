<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    email: "",
    password: "",
});

const submit = () => {
    form.post(route("login"));
};
</script>

<template>
    <div class="login">
        <div class="login-container">
            <h2>Masuk</h2>
            <form @submit.prevent="submit">
                <div>
                    <label for="email">Email</label>
                    <input
                        v-model="form.email"
                        id="email"
                        type="text"
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
</template>

<style scoped>
.login {
    color: white;
    height: 85vh;
    align-content: center;
}
.login-container {
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
