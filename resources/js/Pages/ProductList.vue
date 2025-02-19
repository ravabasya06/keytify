<script setup>
import { ref } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import AdminLayout from "../Components/AdminLayout.vue";
defineProps(["items", "categories"]);

const query = ref("");
const search = () => {
    const form = useForm({
        search_query: query.value,
    });

    if (query.value) {
        form.get(route("search.product"));
    } else {
        router.visit("/product-list");
    }
};

const formatPrice = (price) => new Intl.NumberFormat("id-ID").format(price);
</script>

<template>
    <AdminLayout title="Products">
        <div>
            <button><p>All</p></button>
            <button><p>Featured</p></button>
        </div>
        <div class="table-container">
            <div class="table-controls">
                <form class="search-container" @submit.prevent="search">
                    <input
                        v-model="query"
                        class="search-input"
                        type="text"
                        name="search_query"
                        placeholder="Search items.."
                        autocomplete="off"
                    />
                    <button
                        class="page-btn"
                        style="width: 40px; height: 40px"
                        type="submit"
                    >
                        <font-awesome-icon
                            icon="fa-solid fa-magnifying-glass"
                        />
                    </button>
                </form>
                <div class="filter-add-container">
                    <select class="filter-select">
                        <option value="">All Categories</option>
                        <option
                            v-for="category in categories"
                            :value="category.slug"
                        >
                            {{ category.name }}
                        </option>
                    </select>
                    <button class="page-btn" style="width: 40px; height: 40px">
                        <font-awesome-icon icon="fa-solid fa-plus" />
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Type</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Short Desc</th>
                            <th>Desc</th>
                            <th>Image URL</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in items.data">
                            <td>{{ item.item_id }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.slug }}</td>
                            <td>{{ item.category.name }}</td>
                            <td>{{ item.brand && item.brand.name }}</td>
                            <td>{{ item.type }}</td>
                            <td>{{ item.stock }}</td>
                            <td>{{ `Rp${formatPrice(item.price)}` }}</td>
                            <td class="ellipsis">
                                {{ item.short_desc }}
                            </td>
                            <td class="ellipsis">
                                {{ item.desc ? item.desc : "No" }}
                            </td>
                            <td class="ellipsis">{{ item.image_url }}</td>
                            <td>{{ item.status ? "Yes" : "No" }}</td>
                            <td>
                                <button class="edit-btn">Edit</button>
                                <button class="delete-btn">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination">
            <div class="pagination-button">
                <Link
                    v-if="items.links"
                    v-for="link in items.links"
                    :href="link.url"
                    class="page-btn"
                >
                    <span v-html="link.label"></span>
                </Link>
            </div>
            <span class="page-info"
                >Page {{ items.current_page }} of {{ items.last_page }}</span
            >
        </div>
    </AdminLayout>
</template>

<style scoped>
/* Container */
.table-container {
    width: auto;
    padding: 20px;
    overflow-x: auto; /* Enables horizontal scrolling */
}

/* Controls */
.table-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.search-input,
.filter-select {
    padding: 10px;
    border: 1px solid var(--color-text-2);
    color: var(--color-text);
    background-color: var(--color-background-mute);
    border-radius: 3px;
    font-size: 16px;
}
.search-container {
    display: flex;
    align-items: center;
    gap: 5px;
}
.filter-add-container {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 5px;
}

/* Make table fully stretch to the container */
.table-wrapper {
    width: 70vw;
    overflow-x: auto; /* Allows scrolling if needed */
}

/* Table styling */
table {
    width: max-content; /* Ensures it doesn't shrink */
    min-width: 100%; /* Prevents it from being too small */
    border-collapse: collapse;
    background-color: var(--color-background-soft);
    white-space: nowrap; /* Prevents text from wrapping */
}

/* Table Header */
th {
    background-color: var(--color-background-mute);
    color: var(--color-text);
    padding: 10px;
    text-align: left;
    position: sticky;
    top: 0;
}

/* Table Body */
td {
    padding: 10px;
    border-bottom: 1px solid var(--color-text-2);
}

/* Enable scrolling on smaller screens */
@media (max-width: 768px) {
    .table-wrapper {
        overflow-x: auto;
    }
}

/* Make image URL cells fixed width and scrollable */
td.ellipsis {
    max-width: 150px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    cursor: pointer;
}

/* Show full URL on hover */
/* td.ellipsis:hover {
    overflow: visible;
    white-space: normal;
    word-wrap: break-word;
    background: rgba(0, 0, 0, 0.8);
    border-radius: 7px;
    color: white;
    position: absolute;
    z-index: 10;
    max-width: 300px;
} */

/* Buttons */
.edit-btn,
.delete-btn {
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.edit-btn {
    background-color: #4caf50;
    color: var(--color-background);
}

.delete-btn {
    background-color: #f44336;
    color: var(--color-background);
    margin-left: 5px;
}

/* Responsive */
@media (max-width: 768px) {
    .table-controls {
        flex-direction: column;
        gap: 10px;
    }

    .search-input,
    .filter-select {
        width: 100%;
    }
}
.pagination {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.pagination-button {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-bottom: 15px;
}
.page-btn {
    padding: 8px 12px;
    background-color: var(--color-logo);
    color: var(--color-background);
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

.page-info {
    font-size: 16px;
}
</style>
