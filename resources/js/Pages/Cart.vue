<script setup>
import { router } from "@inertiajs/vue3";

import Layout from "../Components/Layout.vue";
defineProps(["cart_items", "total_price"]);

const handleDelete = (id) => {
    if (confirm("Are you sure you want to delete this item?")) {
        router.delete(route("cart.destroy", id));
    }
};

const formatPrice = (price) => new Intl.NumberFormat("id-ID").format(price);
</script>
<template>
    <Layout title="Cart">
        <h1 class="cart-title">Cart</h1>
        <div v-if="cart_items.length > 0" class="cart-container">
            <div class="products-container">
                <table>
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="cart in cart_items">
                            <td>
                                <button
                                    @click="handleDelete(cart.cart_id)"
                                    class="remove-button"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-circle-xmark"
                                    />
                                </button>
                            </td>
                            <td>
                                <img
                                    class="item-image"
                                    :src="cart.item.image_url"
                                    alt="Image"
                                />
                            </td>
                            <td>
                                <Link
                                    :href="`/item/${cart.item.slug}`"
                                    class="item-name"
                                    >{{ cart.item.name }}</Link
                                >
                            </td>
                            <td>Rp{{ formatPrice(cart.item.price) }}</td>
                            <td>{{ cart.quantity }}</td>
                            <td>
                                Rp{{
                                    formatPrice(cart.item.price * cart.quantity)
                                }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="checkout-container">
                <div class="total-container">
                    <h1>Total</h1>
                    <h1>Rp{{ formatPrice(total_price) }}</h1>
                </div>
                <button class="checkout-button">Proceed to Checkout</button>
            </div>
        </div>
        <div style="margin-left: 50px; height: 20vw" v-else>
            <p>
                No item is in your cart.
                <Link href="/shop" class="shopnow-button">Shop Now!</Link>
            </p>
        </div>
    </Layout>
</template>
<style scoped>
table {
    width: max-content; /* Ensures it doesn't shrink */
    min-width: 100%; /* Prevents it from being too small */
    border-collapse: collapse;
    font-size: 18px;
    background-color: var(--color-background-soft);
    white-space: nowrap; /* Prevents text from wrapping */
}

/* Table Header */
th {
    background-color: var(--color-background-mute);
    color: var(--color-text);
    padding: 10px;
    text-align: left;
    position: sticky;
    top: 0;
}

/* Table Body */
td {
    padding: 10px;
    border-bottom: 1px solid var(--color-text-2);
}
.shopnow-button {
    padding: 10px;
    background-color: var(--color-logo);
    color: var(--color-background);
    border: none;
    border-radius: 3px;
    cursor: pointer;
}
.checkout-button {
    padding: 30px;
    font-size: 20px;
    background-color: var(--color-logo);
    color: var(--color-background);
    border: none;
    transition: transform 0.2s;
    border-radius: 3px;
    cursor: pointer;
}
.checkout-button:hover {
    color: var(--color-text);
    transform: scale(1.02);
}
.total-container {
    display: flex;
    flex-direction: row;
    gap: 20px;
    justify-content: flex-end;
}
.checkout-container {
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    gap: 30px;
    margin-top: 30px;
    margin-bottom: 30px;
}
.cart-container {
    display: flex;
    flex-direction: column;
    margin-left: 50px;
    margin-right: 50px;
}
.item-image {
    object-fit: cover;
    min-width: 75px;
    width: 75px;
    min-height: 75px;
    height: 75px;
    border-radius: 5px;
}
.item-name {
    color: var(--color-text);
}
.item-name:hover {
    color: var(--color-text-2);
}
.remove-button {
    background-color: var(--color-background-soft);
    color: var(--color-text);
    border: none;
    font-size: 30px;
}
.remove-button:hover {
    color: var(--color-text-2);
}
.cart-title {
    margin-top: 30px;
    margin-left: 50px;
    font-size: 50px;
}
</style>
