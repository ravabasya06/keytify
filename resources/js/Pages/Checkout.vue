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
            <h2 v-if="!isSummary">Shipping Details</h2>
            <h2 v-else>Order Summary</h2>

            <p style="color: var(--color-text-2)">
                Please
                {{ props.user_address ? "review" : "add" }} your shipping
                information before proceeding.
            </p>

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
                            />
                        </div>
                        <div class="child-name-container">
                            <label>Last Name</label>
                            <input
                                type="text"
                                v-model="form.last_name"
                                :disabled="!!props.user_address"
                            />
                        </div>
                    </div>

                    <label>Phone Number</label>
                    <input
                        type="text"
                        v-model="form.phone_number"
                        :disabled="!!props.user_address"
                    />

                    <label>Address</label>
                    <input
                        type="text"
                        v-model="form.address"
                        :disabled="!!props.user_address"
                    />

                    <div class="name-container">
                        <div class="child-name-container">
                            <label>City</label>
                            <input
                                type="text"
                                v-model="form.city"
                                :disabled="!!props.user_address"
                            />
                        </div>
                        <div class="child-name-container">
                            <label>Province</label>
                            <input
                                type="text"
                                v-model="form.province"
                                :disabled="!!props.user_address"
                            />
                        </div>
                        <div class="child-name-container">
                            <label>Island</label>
                            <input
                                type="text"
                                v-model="form.island"
                                :disabled="!!props.user_address"
                            />
                        </div>
                        <div class="child-name-container">
                            <label>Postal Code</label>
                            <input
                                type="text"
                                v-model="form.postal_code"
                                :disabled="!!props.user_address"
                            />
                        </div>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="confirm-btn">Next</button>
                </div>
            </form>

            <!-- ORDER SUMMARY -->
            <div v-else>
                <h3>Shipping Address</h3>
                <p>
                    {{ form.first_name }} {{ form.last_name }}<br />
                    {{ form.address }}, {{ form.city }}, {{ form.province
                    }}<br />
                    {{ form.island }}, {{ form.postal_code }}<br />
                    Phone: {{ form.phone_number }}
                </p>

                <h3>Order Items</h3>
                <div class="order-items">
                    <div
                        class="order-item"
                        v-for="cart in props.cart_items"
                        :key="cart.cart_id"
                    >
                        <span
                            >{{ cart.item.name }} x{{ cart.quantity }}
                            {{
                                formatPrice(cart.item.price * cart.quantity)
                            }}</span
                        >
                    </div>
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
    margin: 30px;
    background: var(--color-background-mute);
    padding: 20px;
    border-radius: 10px;
    color: var(--color-text);
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
