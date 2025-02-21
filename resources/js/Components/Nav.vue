<script setup>
import { usePage } from "@inertiajs/vue3";

defineProps(["user", "cart_count"]);
const { user, cart_count } = usePage().props;
</script>

<template>
    <nav class="navbar">
        <div class="left-group">
            <Link href="/">
                <div class="logo-container">
                    <img class="logo-img" src="/public/logo.png" alt="Logo" />
                    <h1 class="logo-text">KEYTIFY</h1>
                </div>
            </Link>
        </div>
        <div class="right-group">
            <Link href="/">
                <div class="user-icon">Home</div>
            </Link>
            <Link href="/about">
                <div class="user-icon">About</div>
            </Link>
            <Link href="/shop">
                <div class="user-icon">Shop</div>
            </Link>
            <Link v-if="user && user.isAdmin" href="/dashboard">
                <div class="user-icon">Dashboard</div>
            </Link>
            <Link href="/cart">
                <div class="user-icon">
                    <font-awesome-icon icon="fa-solid fa-cart-shopping" />
                    <span
                        style="
                            position: absolute;
                            font-size: 14px;
                            margin-left: 3px;
                            color: var(--color-text);
                        "
                        >{{
                            cart_count < 1
                                ? ""
                                : cart_count && cart_count > 99
                                ? "99+"
                                : cart_count
                        }}
                    </span>
                </div>
            </Link>
            <Link href="/profile">
                <div class="user-icon">
                    <font-awesome-icon icon="fa-solid fa-user" />
                </div>
            </Link>
        </div>
    </nav>
</template>

<style scoped>
.navbar {
    position: sticky;
    top: 0;
    display: flex;
    z-index: 2;
    justify-content: space-between;
    background-color: var(--color-background-mute);
    padding: 10px;
}
.menu-icon {
    font-size: 24px;
    cursor: pointer;
}
.logo-container {
    display: flex;
    flex-direction: row;
    align-items: center;
}
.logo-text {
    font-size: 30px;
    margin: 0;
    padding: 5px;
    border-radius: 10%;
    color: var(--color-logo);
}

.logo-img {
    height: 40px;
    width: 40px;
    filter: var(--color-logo-img);
}

.right-group {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 25px;
    margin: 10px;
}

.left-group {
    display: flex;
    align-items: flex-start;
    justify-content: flex-start;
    gap: 25px;
    margin: 10px;
}

.user-icon {
    color: var(--color-text);
    font-size: 24px;
    cursor: pointer;
    border-radius: 20%;
}
.user-icon:hover {
    color: var(--color-text-2);
}
</style>
