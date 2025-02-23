<script setup>
import { ref, watch } from "vue";
import { useForm, router } from "@inertiajs/vue3";

import Layout from "../Components/Layout.vue";

const props = defineProps(["user_address", "cart_items"]);

const isSummary = ref(false);

const form = useForm({
    first_name: props.user_address?.first_name || "",
    last_name: props.user_address?.last_name || "",
    phone_number: props.user_address?.phone_number || "",
    address: props.user_address?.address || "",
    city: props.user_address?.city || "",
    province: props.user_address?.province || "",
    island: props.user_address?.island || "",
    postal_code: props.user_address?.postal_code || "",
});

watch(
    () => props.user_address,
    (newAddress) => {
        form.first_name = newAddress?.first_name || "";
        form.last_name = newAddress?.last_name || "";
        form.phone_number = newAddress?.phone_number || "";
        form.address = newAddress?.address || "";
        form.city = newAddress?.city || "";
        form.province = newAddress?.province || "";
        form.island = newAddress?.island || "";
        form.postal_code = newAddress?.postal_code || "";
    },
    { immediate: true },
);

const confirmCheckout = () => {
    router.post(route("checkout.store"), form.data());
};

const formatPrice = (price) =>
    "Rp" + new Intl.NumberFormat("id-ID").format(price) + ",00";
</script>

<template>
    <Layout title="Checkout">
        <div class="checkout-container">
            <div>
                <h1 v-if="!isSummary">Shipping Details</h1>
                <h1 v-else>Order Summary</h1>

                <p style="color: var(--color-text-2)">
                    Please
                    {{ props.user_address ? "review" : "add" }} your shipping
                    information before proceeding.
                </p>
            </div>

            <!-- SHIPPING DETAILS FORM -->
            <form v-if="!isSummary" @submit.prevent="isSummary = true">
                <div class="address-details-container">
                    <div class="name-container">
                        <div class="child-name-container">
                            <label>First Name</label>
                            <input
                                type="text"
                                v-model="form.first_name"
                                :disabled="!!props.user_address"
                                required
                            />
                        </div>
                        <div class="child-name-container">
                            <label>Last Name</label>
                            <input
                                type="text"
                                v-model="form.last_name"
                                :disabled="!!props.user_address"
                                required
                            />
                        </div>
                    </div>

                    <label>Phone Number</label>
                    <input
                        type="text"
                        v-model="form.phone_number"
                        :disabled="!!props.user_address"
                        required
                    />

                    <label>Address</label>
                    <input
                        type="text"
                        v-model="form.address"
                        :disabled="!!props.user_address"
                        required
                    />

                    <div class="name-container">
                        <div class="child-name-container">
                            <label>City</label>
                            <input
                                type="text"
                                v-model="form.city"
                                :disabled="!!props.user_address"
                                required
                            />
                        </div>
                        <div class="child-name-container">
                            <label>Province</label>
                            <input
                                type="text"
                                v-model="form.province"
                                :disabled="!!props.user_address"
                                required
                            />
                        </div>
                        <div class="child-name-container">
                            <label>Island</label>
                            <input
                                type="text"
                                v-model="form.island"
                                :disabled="!!props.user_address"
                                required
                            />
                        </div>
                        <div class="child-name-container">
                            <label>Postal Code</label>
                            <input
                                type="text"
                                v-model="form.postal_code"
                                :disabled="!!props.user_address"
                                required
                            />
                        </div>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="confirm-btn">Next</button>
                </div>
            </form>

            <div class="next-container" v-else>
                <div>
                    <h2>Shipping Address</h2>
                    <div>
                        <p>Name : {{ form.first_name }} {{ form.last_name }}</p>
                        <p>Phone : {{ form.phone_number }}</p>
                        <p>
                            Address : {{ form.address }}, {{ form.city }},
                            {{ form.province }}, {{ form.island }},
                            {{ form.postal_code }}
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
                            <tr
                                v-for="cart in props.cart_items"
                                :key="cart.cart_id"
                            >
                                <td>{{ cart.item.name }}</td>
                                <td>{{ cart.quantity }}</td>
                                <td>
                                    {{
                                        formatPrice(
                                            cart.item.price * cart.quantity,
                                        )
                                    }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h3>
                    Total:
                    {{
                        formatPrice(
                            props.cart_items.reduce(
                                (total, cart) =>
                                    total + cart.item.price * cart.quantity,
                                0,
                            ),
                        )
                    }}
                </h3>

                <div class="button-group">
                    <button @click="isSummary = false" class="back-btn">
                        Back
                    </button>
                    <button @click="confirmCheckout" class="confirm-btn">
                        Confirm Order
                    </button>
                </div>
            </div>
        </div>
    </Layout>
</template>

<style scoped>
.checkout-container {
    display: flex;
    flex-direction: column;
    gap: 25px;
    margin: 30px;
    background: var(--color-background-mute);
    padding: 20px;
    border-radius: 10px;
    color: var(--color-text);
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

.address-details-container {
    display: flex;
    flex-direction: column;
}

.name-container {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    gap: 20px;
}

.next-container {
    display: flex;
    flex-direction: column;
    gap: 30px;
}
.child-name-container {
    display: flex;
    flex-direction: column;
    width: 100%;
}

label {
    margin-top: 10px;
}

input {
    padding: 8px;
    border: 1px solid var(--color-text-2);
    color: var(--color-text);
    background-color: var(--color-background-soft);
    border-radius: 3px;
    font-size: 16px;
    width: 100%;
}

input:disabled {
    color: var(--color-text-2);
}

.button-group {
    display: flex;
    justify-content: space-between;
    margin-top: 15px;
}

.back-btn,
.confirm-btn {
    background: var(--color-logo);
    color: var(--color-background-mute);
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
</style>
