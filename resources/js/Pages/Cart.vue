<script setup>
import { router } from "@inertiajs/vue3";

import Layout from "../Components/Layout.vue";
defineProps(["cart_items", "total_price"]);

const updateQuantity = (cart, newQuantity) => {
    if (newQuantity < 1) return;
    if (newQuantity > 999) return;
    router.put(route("cart.update", cart.cart_id), {
        quantity: newQuantity,
    });
};

const handleDelete = (id) => {
    router.delete(route("cart.destroy", id));
};

const deleteAll = () => {
    if (confirm("Are you sure you want to delete all items?")) {
        router.delete(route("cart.purge"));
    }
};

const formatPrice = (price) =>
    "Rp" + new Intl.NumberFormat("id-ID").format(price) + ",00";
</script>
<template>
    <Layout title="Cart">
        <div class="title-container">
            <h1 class="cart-title">Cart</h1>
            <p
                v-if="cart_items.length > 0"
                @click="deleteAll()"
                class="delete-all-button"
            >
                Delete All
            </p>
        </div>
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
                            <td>{{ formatPrice(cart.item.price) }}</td>
                            <td class="quantity-column">
                                <button
                                    @click="
                                        updateQuantity(cart, cart.quantity - 1)
                                    "
                                    class="quantity-btn"
                                >
                                    −
                                </button>
                                <input
                                    v-model="cart.quantity"
                                    type="number"
                                    name="quantity"
                                    id="quantity"
                                    style="text-align: center"
                                    class="quantity"
                                    min="1"
                                    max="999"
                                    @keyup.enter="
                                        updateQuantity(cart, cart.quantity)
                                    "
                                />
                                <button
                                    @click="
                                        updateQuantity(cart, cart.quantity + 1)
                                    "
                                    class="quantity-btn"
                                >
                                    +
                                </button>
                            </td>
                            <td>
                                {{
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
                    <h1>{{ formatPrice(total_price) }}</h1>
                </div>
                <Link
                    style="text-align: center"
                    href="/checkout"
                    class="checkout-button"
                    >Proceed to Checkout</Link
                >
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
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

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
.title-container {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    margin-top: 30px;
    margin-left: 50px;
    margin-right: 50px;
}
.delete-all-button {
    font-size: 18px;
    cursor: pointer;
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
    transition: 0.2s;
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
    font-size: 50px;
}
.quantity {
    margin: 5px;
    background-color: var(--color-background-soft);
    border: none;
    color: var(--color-text);
    width: 50px;
    font-size: 15px;
}
.quantity-btn {
    background-color: var(--color-logo);
    color: var(--color-background);
    border: none;
    padding: 5px 10px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 3px;
    transition: 0.2s;
}

.quantity-btn:hover {
    background-color: var(--color-text-2);
}
</style>
