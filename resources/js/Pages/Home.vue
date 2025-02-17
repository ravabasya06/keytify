<script setup>
import Layout from "../Components/Layout.vue";
import ItemOverview from "../Components/ItemOverview.vue";
import ReviewItem from "../Components/ReviewItem.vue";

defineProps(["user", "reviews", "featured_items"]);

const formatPrice = (price) => new Intl.NumberFormat("id-ID").format(price);
</script>

<template>
    <Layout title="Home">
        <div class="top-container">
            <h1 class="home-title">KEYTIFY</h1>
            <h3 class="home-title-desc">
                Solution to all keyboard enthusiasts.
            </h3>
        </div>
        <div class="itemcontainer">
            <h1 class="title">Our Best Products</h1>
            <div class="item-itemcontainer">
                <ItemOverview
                    v-for="item in featured_items"
                    :title="item.name"
                    :desc="item.short_desc"
                    :price="`Rp${formatPrice(item.price)}`"
                    :image="item.image_url"
                    :slug="item.slug"
                />
            </div>
        </div>
        <div class="review-container">
            <h1 class="title">Most Helpful Reviews</h1>
            <div class="review-item-container">
                <ReviewItem
                    v-for="review in reviews"
                    :image="review.image_url"
                    :name="review.name"
                    :desc="review.desc"
                    :star="review.rating"
                />
            </div>
        </div>
    </Layout>
</template>

<style scoped>
.itemcontainer {
    margin: 50px;
}
.title {
    color: var(--color-text);
}
.top-container {
    display: flex;
    color: white;
    flex-direction: column;
    align-items: center;
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        url("../../../assets/keyboards/purplebomb.jpeg");
    width: 100%;
}
.home-title {
    font-size: 100px;
    font-weight: normal;
    margin-bottom: 0px;
}
.home-title-desc {
    margin: 100px;
}
.item-itemcontainer {
    display: flex;
    justify-content: space-between;
    flex-direction: row;
}
.review-container {
    margin: 50px;
}
.review-item-container {
    display: grid;
    flex-direction: row;
    gap: 20px;
    grid-template-columns: auto auto auto;
}
</style>
