<script setup>
import { usePage } from "@inertiajs/vue3";
defineProps(["user"]);

const { user } = usePage().props;
</script>

<template>
    <nav class="navbar">
        <div class="left-group">
            <Link href="/">
                <h1 class="logo">KEYTIFY</h1>
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
            <Link href="/cart">
                <div class="user-icon">
                    <font-awesome-icon icon="fa-solid fa-cart-shopping" />
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
    display: flex;
    justify-content: space-between;
    position: sticky;
    background-color: var(--color-background-mute);
    padding: 10px;
    z-index: 1;
}
.menu-icon {
    font-size: 24px;
    cursor: pointer;
}

.logo {
    font-size: 30px;
    margin: 0;
    padding: 5px;
    border-radius: 10%;
    color: var(--color-logo);
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
</style>
