<script setup>
import Layout from "../Components/Layout.vue";
import ItemOverview from "../Components/ItemOverview.vue";

defineProps(["brand", "items", "recommended_items"]);

const formatPrice = (price) => new Intl.NumberFormat("id-ID").format(price);
</script>
<template>
    <Layout title="Brand">
        <div class="brand-container">
            <div class="brand-profile-container">
                <img
                    class="brand-image"
                    :src="brand.image_url"
                    alt="Brand Image"
                />
                <div class="brand-details-container">
                    <h1 class="brand-name">{{ brand.name }}</h1>
                    <p class="brand-desc">{{ brand.desc }}</p>
                </div>
            </div>
            <hr />
            <div>
                <h1>Recommended</h1>
                <div class="items-container">
                    <ItemOverview
                        v-for="item in recommended_items"
                        :title="item.name"
                        :desc="item.short_desc"
                        :price="`Rp${formatPrice(item.price)}`"
                        :image="item.image_url"
                        :slug="item.slug"
                    />
                </div>
                <div class="brand-name-container">
                    <h1>All Products by {{ brand.name }}</h1>
                    <Link :href="`/shop/${brand.slug}`">
                        <p class="see-all-products">See All Products</p>
                    </Link>
                </div>
                <div class="items-container">
                    <ItemOverview
                        v-for="item in items"
                        :title="item.name"
                        :desc="item.short_desc"
                        :price="`Rp${formatPrice(item.price)}`"
                        :image="item.image_url"
                        :slug="item.slug"
                    />
                </div>
            </div>
        </div>
    </Layout>
</template>
<style scoped>
.brand-container {
    margin: 50px;
    color: var(--color-text);
}
.brand-profile-container {
    display: flex;
    flex-direction: row;
    gap: 30px;
}
.brand-details-container {
    display: flex;
    flex-direction: column;
}
.items-container {
    display: flex;
    flex-direction: row;
    gap: 30px;
}
.brand-name-container {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
}
.brand-image {
    width: 200px;
}
.see-all-products {
    background-color: var(--color-logo);
    padding: 10px;
    margin: 0;
    border-radius: 10px;
    color: var(--color-background);
}
</style>
