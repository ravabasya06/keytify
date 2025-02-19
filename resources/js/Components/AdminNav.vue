<script setup></script>
<template>
    <div class="navbar">
        <Link class="nav-list" href="/">
            <img class="logo-img" src="/public/logo.png" alt="logo" />
            <h1>KEYTIFY</h1>
        </Link>
        <p class="nav-category">Menu</p>
        <Link class="nav-list" href="/dashboard">
            <font-awesome-icon icon="fa-solid fa-bars" />
            <p>Dashboard</p>
        </Link>
        <Link class="nav-list" href="/review-list">
            <font-awesome-icon icon="fa-solid fa-star" />
            <p>Reviews</p>
        </Link>
        <p class="nav-category">Management</p>
        <Link class="nav-list" href="/order-list">
            <font-awesome-icon icon="fa-solid fa-cart-shopping" />
            <p>Orders</p>
        </Link>
        <Link class="nav-list" href="/user-list">
            <font-awesome-icon icon="fa-solid fa-user-group" />
            <p>Users</p>
        </Link>
        <Link class="nav-list" href="/product-list">
            <font-awesome-icon icon="fa-solid fa-keyboard" />
            <p>Products</p>
        </Link>
        <Link class="nav-list" href="/brand-list">
            <font-awesome-icon icon="fa-solid fa-tag" />
            <p>Brands</p>
        </Link>
        <Link class="nav-list" href="/category-list">
            <font-awesome-icon icon="fa-solid fa-list" />
            <p>Categories</p>
        </Link>
    </div>
</template>
<style scoped>
.navbar {
    display: flex;
    flex-direction: column;
    position: sticky;
    top: 0;
    z-index: 2;
}
.nav-category {
    align-self: center;
}
.nav-list {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 10px;
    font-size: 20px;
    padding: 15px;
    padding-left: 50px;
    padding-right: 50px;
    color: var(--color-text-2);
}
.nav-list:hover {
    color: var(--color-text);
}
.nav-list h1 {
    color: var(--color-logo);
}
.logo-img {
    height: 40px;
    width: 40px;
    filter: var(--color-logo-img);
}
</style>
