<script setup>
import { ref, computed } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import Layout from "../Components/Layout.vue";
import ItemOverview from "../Components/ItemOverview.vue";

const props = defineProps([
    "items",
    "current_query",
    "categories",
    "category_title",
]);

const selectedSort = ref("default");
const query = ref("");

const search = () => {
    const form = useForm({
        search_query: query.value,
    });

    if (query.value) {
        form.get(route("search"));
    } else {
        router.visit("/shop");
    }
};

const sortedItems = computed(() => {
    return [...props.items].sort((a, b) => {
        if (selectedSort.value === "default") {
            return 0;
        } else if (selectedSort.value === "latest") {
            return (
                new Date(b.created_at).getTime() -
                new Date(a.created_at).getTime()
            );
        } else if (selectedSort.value === "price_low") {
            return a.price - b.price;
        } else if (selectedSort.value === "price_high") {
            return b.price - a.price;
        }
    });
});

const formatPrice = (price) => new Intl.NumberFormat("id-ID").format(price);
</script>
<template>
    <Layout title="Shop">
        <div class="shop-container">
            <div class="left-container">
                <form class="search-container" @submit.prevent="search">
                    <input
                        v-model="query"
                        class="search-input"
                        type="text"
                        name="search_query"
                        placeholder="Search items.."
                        autocomplete="off"
                    />
                    <button class="search-button" type="submit">
                        <font-awesome-icon
                            icon="fa-solid fa-magnifying-glass"
                        />
                    </button>
                </form>
                <div class="category-container">
                    <h1>Categories</h1>
                    <div class="category-items-container">
                        <Link href="/shop/featured">
                            <p>Recommended Items</p>
                        </Link>
                        <Link
                            v-for="category in categories"
                            :href="`/shop/${category.slug}`"
                        >
                            <p>{{ category.name }} ({{ category.count }})</p>
                        </Link>
                    </div>
                </div>
            </div>
            <hr />
            <div class="right-container">
                <div class="right-top-container">
                    <h1 class="shop-title">
                        {{
                            current_query
                                ? `Search results for "${current_query}"`
                                : category_title
                        }}
                    </h1>
                    <div class="sort-container">
                        <p>
                            Showing all {{ Object.keys(items).length }} results
                        </p>
                        <select
                            v-model="selectedSort"
                            class="select-input"
                            name=""
                            id=""
                        >
                            <option value="default">Default</option>
                            <option value="latest">Latest</option>
                            <option value="price_low">
                                Price: Low to High
                            </option>
                            <option value="price_high">
                                Price: High to Low
                            </option>
                        </select>
                    </div>
                </div>
                <div class="item-container">
                    <p v-if="Object.keys(items).length == 0">No match found</p>
                    <ItemOverview
                        v-for="item in sortedItems"
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
.shop-container {
    display: flex;
    flex-direction: row;
    margin: 50px;
    gap: 30px;
}
.right-container {
    display: flex;
    flex-direction: column;
    color: var(--color-text);
    width: 100%;
    gap: 35px;
}
.category-container {
    color: var(--color-text);
}
.category-container p {
    margin: 0;
}
.category-items-container {
    display: flex;
    flex-direction: column;
    color: var(--color-logo);
    margin: 15px;
}
.category-items-container p {
    color: var(--color-logo);
}
.search-container {
    display: flex;
    flex-direction: row;
    gap: 10px;
}
.sort-container {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    padding: 0;
}
.sort-container p {
    display: flex;
    flex-direction: row;
    align-items: center;
    margin: 0;
}
.item-container {
    display: grid;
    grid-template-columns: auto auto auto;
    gap: 30px;
}
.select-input {
    font-size: 15px;
    padding: 10px;
    border-radius: 5px;
    border: solid 1px var(--color-text);
    background-color: var(--color-background-mute);
    color: var(--color-text);
}
.search-input {
    font-size: 15px;
    padding: 10px;
    border-radius: 5px;
    border: solid 1px var(--color-text);
    background-color: var(--color-background-mute);
    color: var(--color-text);
}
.search-button {
    background-color: var(--color-logo);
    border: solid 1px var(--color-logo);
    border-radius: 5px;
    width: 40px;
    height: 40px;
}
.shop-title {
    margin: 0;
    font-size: 50px;
}
</style>
