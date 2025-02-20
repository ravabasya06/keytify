<script setup>
import { router } from "@inertiajs/vue3";
import Layout from "../Components/Layout.vue";
import ItemOverview from "../Components/ItemOverview.vue";

defineProps(["item", "related_items"]);

const addToCart = (id) => {
    router.post(route("cart.store", id), { quantity: 1 });
};

const formatPrice = (price) => new Intl.NumberFormat("id-ID").format(price);
</script>
<template>
    <Layout :title="item.name">
        <div class="item-top-container">
            <img class="details-image" :src="item.image_url" alt="" />
            <div class="details-container">
                <div class="details-top-container">
                    <div class="details-top-category-container">
                        <Link :href="`/shop/${item.category.slug}`">
                            <p class="item-category">
                                {{ item.category.name }}
                            </p>
                        </Link>
                        <p v-if="item.brand">/</p>
                        <Link
                            v-if="item.brand"
                            :href="`/shop/${item.brand.slug}`"
                        >
                            <p class="item-brand">
                                {{ item.brand.name }}
                            </p>
                        </Link>
                        <p v-if="item.type">/</p>
                        <Link
                            v-if="item.type"
                            :href="`/shop?search_query=${item.type}`"
                        >
                            <p class="item-brand">{{ item.type }}</p>
                        </Link>
                    </div>
                    <div class="details-top-name-container">
                        <p class="item-name">{{ item.name }}</p>
                        <div class="details-top-featured-container">
                            <Link href="">
                                <p v-if="item.featured" class="item-featured">
                                    Recommended
                                </p>
                            </Link>
                        </div>
                    </div>
                    <p v-if="item.brand" class="item-brand-name">
                        by
                        <Link :href="`/brand/${item.brand.slug}`">
                            {{ item.brand.name }}
                        </Link>
                    </p>
                    <hr />
                    <div class="details-top-price-container">
                        <p class="item-price">
                            Rp{{ formatPrice(item.price) }}
                        </p>
                    </div>
                    <div>
                        <p class="item-stock">
                            Available Stock : {{ item.stock }}
                        </p>
                    </div>
                    <p class="item-short-desc">{{ item.short_desc }}</p>
                </div>
                <div class="details-bottom-container">
                    <button
                        @click="addToCart(item.item_id)"
                        class="add-to-cart"
                    >
                        ADD TO CART
                    </button>
                </div>
            </div>
        </div>
        <div class="item-middle-container">
            <hr />
            <h1>Description</h1>
            <p>{{ item.desc }}</p>
        </div>
        <div class="item-bottom-container">
            <hr />
            <h1>Related Items</h1>
            <div class="related-items-container">
                <ItemOverview v-for="item in related_items" :item="item" />
            </div>
        </div>
    </Layout>
</template>
<style scoped>
.item-top-container {
    display: flex;
    margin: 50px;
    flex-direction: row;
    gap: 50px;
}
.item-middle-container {
    margin: 50px;
    color: var(--color-text);
}
.item-bottom-container {
    margin: 50px;
    color: var(--color-text);
}
.details-image {
    object-fit: cover;
    min-width: 450px;
    width: 450px;
    min-height: 450px;
    height: 450px;
    border-radius: 10px;
}
.details-container {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    color: var(--color-text);
    width: 100%;
}
.details-top-category-container {
    display: flex;
    flex-direction: row;
    gap: 20px;
    align-items: center;
}
.details-top-featured-container {
    display: flex;
    flex-direction: row;
    gap: 20px;
}
.details-top-name-container {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
}
.details-top-price-container {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
}
.item-name {
    font-size: 35px;
    margin: 0;
}
.item-featured {
    background-color: var(--color-logo);
    padding: 10px;
    margin: 0;
    border-radius: 10px;
    color: var(--color-background);
}
.item-stock {
    margin: 0;
}
.item-price {
    font-size: 30px;
    color: var(--color-text-2);
    font-weight: bold;
    margin: 0;
}
.item-brand {
    color: var(--color-logo);
    margin: 0;
}
.item-brand-name {
    margin-top: 0;
}
.item-brand-name a {
    color: var(--color-text);
}
.item-category {
    margin: 0;
    color: var(--color-logo);
}
.item-short-desc {
    font-size: 18px;
}
.add-to-cart {
    font-size: 15px;
    background-color: var(--color-logo);
    border: none;
    color: var(--color-background);
    border-radius: 5px;
    padding: 10px;
    letter-spacing: 5px;
}
.add-to-cart:hover {
    background-color: rgb(145, 120, 168);
}
.related-items-container {
    display: flex;
    flex-direction: row;
    gap: 75px;
}
</style>
