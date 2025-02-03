<script setup>
defineProps(["name", "desc", "star", "image"]);
</script>
<template>
    <div class="review-item">
        <div class="review-top-group">
            <div class="review-info">
                <img class="review-pfp" :src="image" alt="pfp" />
                <h2 class="review-name">{{ name }}</h2>
            </div>
            <div class="review-stars">
                <font-awesome-icon
                    class="star"
                    v-for="i in star"
                    icon="fa-solid fa-star"
                />
                <font-awesome-icon
                    class="star"
                    v-if="star < 5"
                    v-for="i in 5 - star"
                    icon="fa-regular fa-star"
                />
            </div>
        </div>
        <p class="review-desc">
            {{ desc }}
        </p>
    </div>
</template>
<style>
.review-info {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 20px;
}
.review-pfp {
    width: 50px;
    border-radius: 50%;
}
.review-item {
    display: flex;
    flex-direction: column;
    background-color: #eeeeee;
    padding: 20px;
    border-radius: 10px;
}
.review-top-group {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}
.review-stars {
    display: flex;
    align-items: center;
}
.review-name {
    color: black;
}
.review-desc {
    color: black;
}
.star {
    font-size: 30px;
    color: yellow;
}
</style>
