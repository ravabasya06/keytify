<script setup>
import { ref, watch, computed } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import AdminLayout from "../Components/AdminLayout.vue";
import ReviewListModal from "../Components/ReviewListModal.vue";
const props = defineProps(["reviews", "slug"]);

const query = ref("");
const category = ref("");
const sortColumn = ref(""); // Column being sorted
const sortOrder = ref("asc"); // Sorting order (asc/desc)

category.value = props.slug ?? "";

const search = () => {
    const form = useForm({
        search_query: query.value,
    });

    if (query.value) {
        form.get(route("reviewlist.search"));
    } else {
        router.visit("/review-list");
    }
};

watch(category, (newCategory) => {
    if (newCategory) {
        router.visit(`/review-list/${newCategory}`);
    } else {
        router.visit("/review-list");
    }
});

const sortBy = (column) => {
    if (sortColumn.value === column) {
        sortOrder.value = sortOrder.value === "asc" ? "desc" : "asc";
    } else {
        sortColumn.value = column;
        sortOrder.value = "asc";
    }
};

const sortedReviews = computed(() => {
    if (!sortColumn.value) {
        return props.reviews.data; // Return original if no sorting is selected
    }

    return [...props.reviews.data].sort((a, b) => {
        let valueA = a[sortColumn.value];
        let valueB = b[sortColumn.value];

        // Handle null values
        if (valueA == null) valueA = "";
        if (valueB == null) valueB = "";

        // Convert to lowercase for case-insensitive sorting
        if (typeof valueA === "string") valueA = valueA.toLowerCase();
        if (typeof valueB === "string") valueB = valueB.toLowerCase();

        if (valueA < valueB) return sortOrder.value === "asc" ? -1 : 1;
        if (valueA > valueB) return sortOrder.value === "asc" ? 1 : -1;
        return 0;
    });
});

const isModalOpen = ref(false);
const selectedReview = ref(null);

const openModal = (review = null) => {
    selectedReview.value = review;
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
};

const handleSave = (formData) => {
    if (selectedReview.value) {
        // Edit existing category
        router.put(
            route("reviewlist.update", selectedReview.value.review_id),
            formData,
            {
                onSuccess: () => closeModal(),
            },
        );
    } else {
        // Add new category
        router.post(route("reviewlist.store"), formData, {
            onSuccess: () => closeModal(),
        });
    }
};

const handleDelete = (id) => {
    if (confirm("Are you sure you want to delete this review?")) {
        router.delete(route("reviewlist.destroy", id));
    }
};
</script>

<template>
    <AdminLayout title="Reviews">
        <div class="table-container">
            <div class="table-controls">
                <form class="search-container" @submit.prevent="search">
                    <input
                        v-model="query"
                        class="search-input"
                        type="text"
                        name="search_query"
                        placeholder="Search reviews.."
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
                    <select v-model="category" class="filter-select">
                        <option value="">Default</option>
                        <option value="alphabet-ascending">
                            Alphabet: Ascending
                        </option>
                        <option value="alphabet-descending">
                            Alphabet: Descending
                        </option>
                    </select>
                    <button
                        @click="openModal()"
                        class="page-btn"
                        style="width: 40px; height: 40px"
                    >
                        <font-awesome-icon icon="fa-solid fa-plus" />
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr class="table-head-container">
                            <th @click="sortBy('review_id')">
                                ID <font-awesome-icon icon="fa-solid fa-sort" />
                            </th>
                            <th @click="sortBy('name')">
                                Name
                                <font-awesome-icon icon="fa-solid fa-sort" />
                            </th>
                            <th @click="sortBy('desc')">
                                Description
                                <font-awesome-icon icon="fa-solid fa-sort" />
                            </th>
                            <th @click="sortBy('image_url')">
                                Image URL
                                <font-awesome-icon icon="fa-solid fa-sort" />
                            </th>
                            <th @click="sortBy('rating')">
                                Rating
                                <font-awesome-icon icon="fa-solid fa-sort" />
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="table-body-container"
                            v-for="review in sortedReviews"
                        >
                            <td>{{ review.review_id }}</td>
                            <td>{{ review.name }}</td>
                            <td class="ellipsis">{{ review.desc }}</td>
                            <td class="ellipsis">{{ review.image_url }}</td>
                            <td>{{ review.rating }}</td>
                            <td>
                                <button
                                    @click="openModal(review)"
                                    class="edit-btn"
                                >
                                    Edit
                                </button>
                                <button
                                    @click="handleDelete(review.review_id)"
                                    class="delete-btn"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination">
            <div class="pagination-button">
                <Link
                    v-if="props.reviews.links"
                    v-for="link in props.reviews.links"
                    :href="link.url ? link.url : ''"
                    class="page-btn"
                >
                    <span v-html="link.label"></span>
                </Link>
            </div>
            <span class="page-info"
                >Page {{ props.reviews.current_page }} of
                {{ props.reviews.last_page }}</span
            >
        </div>
    </AdminLayout>
    <ReviewListModal
        :isOpen="isModalOpen"
        :review="selectedReview"
        @close="closeModal"
        @save="handleSave"
    />
</template>

<style scoped>
/* Container */
.table-container {
    width: auto;
    margin: 20px;
    overflow-x: auto; /* Enables horizontal scrolling */
}

/* Controls */
.table-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    margin-top: 10px;
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
.table-head-container th:hover {
    background-color: var(--color-background-soft);
}
.table-body-container td:hover {
    background-color: var(--color-background-mute);
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
