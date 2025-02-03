<script setup>
defineProps(["title", "desc", "price", "image", "slug"]);
</script>
<template>
    <div class="item">
        <Link :href="`/item/${slug}`">
            <img class="itemimg" :src="image" alt="Item" />
        </Link>
        <div class="overview-desc">
            <div>
                <Link :href="`/item/${slug}`">
                    <p class="title">{{ title }}</p>
                </Link>
                <p class="desc">{{ desc }}</p>
            </div>
            <div class="overview-add-item">
                <p class="price">{{ price }}</p>
                <Link href="">
                    <font-awesome-icon
                        class="overview-icon"
                        icon="fa-solid fa-cart-plus"
                    />
                </Link>
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
    font-size: 20px;
    color: black;
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
    color: black;
    max-width: 300px;
}
.itemimg {
    object-fit: cover;
    border-radius: 10px;
    width: 300px;
    height: 266.56px;
}
.title {
    color: black;
    font-weight: bold;
    font-size: larger;
    margin: 0;
}
.desc {
    margin: 0;
    color: #333;
}
</style>
