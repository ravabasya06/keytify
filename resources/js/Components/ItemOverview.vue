<script setup>
import { router } from "@inertiajs/vue3";
defineProps(["title", "item"]);

const noImage =
    "https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg";

const addToCart = (id) => {
    router.post(route("cart.store", id), { quantity: 1 });
};

const formatPrice = (price) =>
    "Rp" + new Intl.NumberFormat("id-ID").format(price) + ",00";
</script>
<template>
    <div class="item">
        <Link :href="`/item/${item.slug}`">
            <img
                class="itemimg"
                :src="item.image_url ? item.image_url : noImage"
                alt="Item"
            />
        </Link>
        <div class="overview-desc">
            <div>
                <Link :href="`/item/${item.slug}`">
                    <p class="title">{{ item.name }}</p>
                </Link>
                <p class="desc">{{ item.short_desc }}</p>
            </div>
            <div class="overview-add-item">
                <p class="price">{{ formatPrice(item.price) }}</p>
                <button @click="addToCart(item.item_id)" class="cart-button">
                    <font-awesome-icon
                        class="overview-icon"
                        icon="fa-solid fa-cart-plus"
                    />
                </button>
            </div>
        </div>
    </div>
</template>
<style scoped>
.overview-desc {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.overview-icon {
    color: var(--color-logo);
    font-size: 20px;
    transition: 0.2s;
}
.overview-icon:hover {
    transform: scale(1.5);
}
.overview-add-item {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
}
.item {
    display: flex;
    flex-direction: column;
    max-width: 275px;
    border-radius: 5px;
}
.cart-button {
    background-color: var(--color-background);
    border: none;
}
.item:hover {
    color: var(--color-logo);
}
.item:hover {
    color: var(--color-logo);
}
.itemimg {
    object-fit: cover;
    border-radius: 10px;
    width: 275px;
    height: 275px;
    transition: transform 0.2s;
    margin-top: 5px;
    margin-bottom: 5px;
}
.itemimg:hover {
    transform: scale(1.05);
}
.title {
    font-weight: bold;
    color: var(--color-text);
    font-size: larger;
    margin: 0;
}
.desc {
    margin: 0;
    color: var(--color-text-2);
}
</style>
