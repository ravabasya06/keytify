<script setup>
import Layout from "../Components/Layout.vue";
defineProps(["cart_items"]);
</script>
<template>
    <Layout title="Cart">
        <h1 class="cart-title">Cart</h1>
        <div class="cart-container">
            <div class="products-container">
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="cart in cart_items">
                            <td>x</td>
                            <td>
                                <img
                                    class="item-image"
                                    :src="cart.item.image_url"
                                    alt="Image"
                                />
                            </td>
                            <td>{{ cart.item.name }}</td>
                            <td>{{ cart.item.price }}</td>
                            <td>{{ cart.quantity }}</td>
                            <td>{{ cart.item.price * cart.quantity }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="checkout-container">
                <h1></h1>
                <table>
                    <tbody>
                        <tr>
                            <th>Subtotal</th>
                            <th>Rp1.999.999</th>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <th>Rp3.999.999</th>
                        </tr>
                    </tbody>
                </table>
                <button class="checkout-button">Checkout</button>
            </div>
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
.checkout-button {
    margin: 20px;
    padding: 10px 28px;
    background-color: var(--color-logo);
    color: var(--color-background);
    border: none;
    border-radius: 3px;
    cursor: pointer;
}
.cart-container {
    display: flex;
    flex-direction: column;
    margin-left: 50px;
}
.item-image {
    width: 75px;
}
.cart-title {
    margin-top: 30px;
    margin-left: 50px;
    font-size: 50px;
}
</style>
