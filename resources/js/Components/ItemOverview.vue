<script setup>
defineProps(["title", "item"]);

const noImage =
    "https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg";

const formatPrice = (price) => new Intl.NumberFormat("id-ID").format(price);
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
                <p class="price">{{ `Rp${formatPrice(item.price)}` }}</p>
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
    color: var(--color-logo);
    font-size: 20px;
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
