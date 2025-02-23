<script setup>
import Layout from "../Components/Layout.vue";
defineProps(["order", "items", "address"]);

const formatPrice = (price) =>
    "Rp" + new Intl.NumberFormat("id-ID").format(price) + ",00";
</script>

<template>
    <Layout title="Order Details">
        <div class="next-container">
            <div class="name-container">
                <h1>Order Details</h1>
                <p style="background: var(--color-logo)">{{ order.status }}</p>
            </div>
            <p>
                Invoice ID: {{ order.invoice_id }} (STORE AND KEEP SAFE, DO NOT
                SHARE)
            </p>
            <p>{{ new Date(order.created_at) }}</p>

            <div>
                <h2>Shipping Address</h2>
                <div>
                    <p>
                        Name: {{ address.first_name }}
                        {{ address.last_name }}
                    </p>
                    <p>Phone: {{ address.phone_number }}</p>
                    <p>
                        Address: {{ address.address }}, {{ address.city }},
                        {{ address.province }}, {{ address.island }},
                        {{ address.postal_code }}
                    </p>
                </div>
            </div>

            <div>
                <h2>Order Items</h2>
                <table class="order-items">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in items">
                            <td>{{ item.item.name }}</td>
                            <td>{{ item.quantity }}</td>
                            <td>
                                {{ formatPrice(item.price * item.quantity) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h3>
                Total:
                {{
                    formatPrice(
                        items.reduce(
                            (total, item) => total + item.price * item.quantity,
                            0,
                        ),
                    )
                }}
            </h3>

            <div class="button-group">
                <Link href="/order" class="back-btn">Back</Link>
            </div>
        </div>
    </Layout>
</template>

<style scoped>
.next-container {
    display: flex;
    flex-direction: column;
    gap: 25px;
    margin: 30px;
    background: var(--color-background-mute);
    padding: 20px;
    border-radius: 10px;
    color: var(--color-text);
}
.name-container {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
}
.name-container p {
    padding: 10px;
    border-radius: 5px;
    color: var(--color-background-mute);
}
.order-items {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.order-items th,
.order-items td {
    border: 1px solid var(--color-text-2);
    padding: 8px;
    text-align: left;
}

.order-items th {
    background-color: var(--color-background-soft);
}

.button-group {
    display: flex;
    justify-content: flex-start;
    margin-top: 15px;
}

.back-btn {
    background: var(--color-logo);
    color: var(--color-background-mute);
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
</style>
