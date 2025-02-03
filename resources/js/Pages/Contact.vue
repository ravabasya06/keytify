<script setup>
import Layout from "../Components/Layout.vue";
</script>
<template>
    <Layout title="Contact">
        <div class="contact-container">
            <div class="contact-top-container">
                <h1>Contact Us</h1>
            </div>
            <div class="contact-mid-container">
                <p>
                    You can easily get in touch with us from our social medias!
                </p>
                <div class="social-list">
                    <div class="social-list-items">
                        <font-awesome-icon
                            class="faicon"
                            icon="fa-brands fa-instagram"
                        />
                        <p>@keytify_official</p>
                    </div>
                    <div class="social-list-items">
                        <font-awesome-icon
                            class="faicon"
                            icon="fa-brands fa-x-twitter"
                        />

                        <p>@keytify_keyboards</p>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
<style scoped>
.faicon {
    font-size: 35px;
}
.social-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.social-list-items {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 20px;
}
.contact-container {
    color: black;
}
.contact-container p {
    font-size: 20px;
}
.contact-top-container {
    color: white;
    font-size: xx-large;
    padding: 100px;
    display: flex;
    flex-direction: column;
    align-items: center;
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        url("https://www.alexotos.com/wp-content/uploads/2024/04/B0000051-Edit-1536x2048.jpg");
}
.contact-mid-container {
    margin: 30px;
}
</style>
