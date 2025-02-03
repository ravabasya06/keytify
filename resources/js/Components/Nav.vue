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
    background-color: white;
    padding: 10px;
    z-index: 1;
}
.categories {
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.categories-list {
    display: flex;
    justify-content: center;
    flex-direction: column;
    border: solid 1px rgb(32, 32, 32);
    border-radius: 10px;
    margin: 15px;
}
.categories-title {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    background-color: rgb(32, 32, 32);
    font-weight: bold;
    text-align: center;
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
    color: rgb(208, 173, 240);
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
    color: black;
    font-size: 24px;
    cursor: pointer;
    border-radius: 20%;
}
.plus-button {
    color: white;
    font-size: 24px;
    cursor: pointer;
    border-radius: 20%;
}
.sidebar {
    height: 100%;
    position: fixed;
    width: 0;
    top: 0;
    left: 0;
    background-color: #000000;
    z-index: 10;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
    color: white;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
}

.sidebar ul li {
    text-align: center;
}

.sidebar ul li a {
    padding: 15px;
    color: white;
    text-decoration: none;
    display: block;
    transition: 0.3s;
}

.last-list a {
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}

.sidebar ul li a:hover {
    background-color: #460606;
}

.closebtn {
    position: absolute;
    top: 20px;
    left: 20px;
    text-align: left;
}
</style>
