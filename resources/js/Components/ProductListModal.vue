<script setup>
import { ref, defineProps, defineEmits, watch } from "vue";

const props = defineProps({
    isOpen: Boolean,
    item: Object, // New prop for editing
    brands: Object,
    categories: Object,
});

const emit = defineEmits(["close", "save"]);

const form = ref({
    name: props.item?.name || "",
    slug: props.item?.slug || "",
    category_id: props.item?.category_id || "",
    brand_id: props.item?.brand_id || "",
    type: props.item?.type || "",
    stock: props.item?.stock || "",
    price: props.item?.price || "",
    featured: props.item?.featured || false,
    short_desc: props.item?.short_desc || "",
    desc: props.item?.desc || "",
    image_url: props.item?.image_url || "",
    status: props.item?.status || false,
});

watch(
    () => props.item,
    (newItem) => {
        form.value = {
            name: newItem?.name || "",
            slug: newItem?.slug || "",
            category_id: newItem?.category_id || "",
            brand_id: newItem?.brand_id || "",
            type: newItem?.type || "",
            stock: newItem?.stock || "",
            price: newItem?.price || "",
            featured: newItem?.featured || false,
            short_desc: newItem?.short_desc || "",
            desc: newItem?.desc || "",
            image_url: newItem?.image_url || "",
            status: newItem?.status || false,
        };
    },
    { immediate: true },
);

const closeModal = () => {
    emit("close");
};

const save = () => {
    emit("save", { ...form.value });
    closeModal();
};
</script>

<template>
    <Teleport to="body">
        <div v-if="isOpen" class="modal-overlay">
            <div class="modal-container">
                <h2 class="modal-title">
                    {{ props.item ? "Edit Product" : "Add New Product" }}
                </h2>

                <form @submit.prevent="save" id="save">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                            id="name"
                            v-model="form.name"
                            type="text"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input
                            id="slug"
                            v-model="form.slug"
                            type="text"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select
                            v-model="form.category_id"
                            class="filter-select"
                            id="category"
                        >
                            <option
                                v-for="category in props.categories"
                                :value="category.category_id"
                            >
                                {{ category.name }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <select
                            v-model="form.brand_id"
                            class="filter-select"
                            id="brand"
                        >
                            <option value="">None</option>
                            <option
                                v-for="brand in props.brands"
                                :value="brand.brand_id"
                            >
                                {{ brand.name }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="type">Type</label>
                        <input
                            id="type"
                            v-model="form.type"
                            type="text"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input
                            id="stock"
                            v-model="form.stock"
                            type="number"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input
                            id="price"
                            v-model="form.price"
                            type="number"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <label for="featured">Featured</label>
                        <select
                            v-model="form.featured"
                            class="filter-select"
                            id="featured"
                        >
                            <option :value="0">No</option>
                            <option :value="1">Yes</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="short_desc">Short Description</label>
                        <textarea
                            id="short_desc"
                            v-model="form.short_desc"
                            required
                        ></textarea>
                    </div>

                    <div class="form-group">
                        <label for="desc">Description</label>
                        <textarea
                            id="desc"
                            v-model="form.desc"
                            required
                        ></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Image URL</label>
                        <input
                            id="image"
                            v-model="form.image_url"
                            type="text"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <label for="status">Active</label>
                        <select
                            v-model="form.status"
                            class="filter-select"
                            id="status"
                        >
                            <option :value="0">No</option>
                            <option :value="1">Yes</option>
                        </select>
                    </div>

                    <div class="button-group">
                        <button
                            type="button"
                            @click="closeModal"
                            class="btn btn-cancel"
                        >
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-save">
                            {{ props.item ? "Update" : "Save" }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </Teleport>
</template>
<style scoped>
/* Modal Overlay */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Modal Container */
.modal-container {
    background: var(--color-background);
    padding: 20px;
    border-radius: 8px;
    width: 600px;
    height: 600px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    overflow-y: auto;
}

/* Modal Title */
.modal-title {
    font-size: 20px;
    margin-bottom: 15px;
}

/* Form Group */
.form-group {
    margin-bottom: 10px;
}

.form-group label {
    display: block;
    font-size: 14px;
    margin-bottom: 5px;
}

.form-group input,
.form-group textarea {
    background-color: var(--color-background-mute);
    color: var(--color-text);
    width: 100%;
    padding: 8px;
    border: 1px solid var(--color-text-2);
    border-radius: 4px;
}

/* Button Group */
.button-group {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 15px;
}

/* Buttons */
.btn {
    padding: 8px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-cancel {
    background: var(--color-background-mute);
    color: var(--color-text);
}

.btn-save {
    background: var(--color-logo);
    color: var(--color-background);
}
</style>
