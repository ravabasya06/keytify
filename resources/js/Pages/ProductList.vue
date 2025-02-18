<script setup>
import AdminLayout from "../Components/AdminLayout.vue";
defineProps(["items"]);
</script>
<template>
    <AdminLayout>
        <div class="table">
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
                        <th>Status</th>
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
                        <td>{{ item.price }}</td>
                        <td>{{ item.short_desc ? "Yes" : "No" }}</td>
                        <td>{{ item.desc ? "Yes" : "No" }}</td>
                        <td>{{ item.image_url }}</td>
                        <td>{{ item.status }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>
<style scoped>
.table {
    display: block;
    margin: 50px;
    overflow-x: scroll;
    width: 900px;
}
th {
    padding: 5px;
    border: 1px solid black;
}
td {
    padding: 5px;
    border: 1px solid black;
}
</style>
