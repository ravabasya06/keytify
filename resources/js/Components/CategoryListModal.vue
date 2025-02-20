<script setup>
import { ref, defineProps, defineEmits, watch } from "vue";

const props = defineProps({
    isOpen: Boolean,
    category: Object, // New prop for editing
});

const emit = defineEmits(["close", "save"]);

const form = ref({
    name: props.category?.name || "",
    slug: props.category?.slug || "",
    desc: props.category?.desc || "",
    image_url: props.category?.image_url || "",
});

// Watch for category changes and populate the form when editing
watch(
    () => props.category,
    (newCategory) => {
        form.value = {
            name: newCategory?.name || "",
            slug: newCategory?.slug || "",
            desc: newCategory?.desc || "",
            image_url: newCategory?.image_url || "",
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
                    {{ props.category ? "Edit Category" : "Add New Category" }}
                </h2>

                <form @submit.prevent="save">
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

                    <div class="button-group">
                        <button
                            type="button"
                            @click="closeModal"
                            class="btn btn-cancel"
                        >
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-save">
                            {{ props.category ? "Update" : "Save" }}
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
    width: 400px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
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
