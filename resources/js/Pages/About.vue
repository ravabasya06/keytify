<script setup>
import Layout from "../Components/Layout.vue";
</script>
<template>
    <Layout title="About">
        <div class="about-top-container">
            <h1>What is Keytify?</h1>
        </div>
        <div class="about-container">
            <p>
                Keytify is your one-stop shop for all things keyboards. Whether
                you're a mechanical keyboard enthusiast, a gamer seeking the
                perfect switches, or a professional looking to elevate your
                typing experience, Keytify offers a curated selection of
                keyboards, switches, keycaps, and accessories. Our mission is to
                bring customization and quality to your fingertips, helping you
                create the keyboard of your dreams.
            </p>
        </div>
        <div class="about-mid-container">
            <h1>Why Keytify?</h1>
        </div>
        <div class="about-container">
            <p>
                At Keytify, we combine passion and expertise to bring you the
                best in the keyboard world. We offer carefully curated products,
                exceptional customer support, and resources to help you make
                informed decisions. With a commitment to quality and community,
                Keytify is where functionality meets personalization.
            </p>
        </div>
        <div class="about-bot-container">
            <h1>Your Journey Starts Here</h1>
        </div>
        <div class="about-container">
            <p>
                Building the perfect keyboard is more than just buying
                components—it's about creating a tool that reflects your style
                and enhances your workflow. At Keytify, we aim to make that
                journey seamless and enjoyable by providing high-quality
                products, tips, and inspiration for every step of the process.
            </p>
        </div>
    </Layout>
</template>
<style scoped>
.about-container {
    margin: 30px;
    color: var(--color-text);
}
.about-container p {
    font-size: 20px;
}
.about-top-container {
    font-size: xx-large;
    color: white;
    padding: 100px;
    display: flex;
    flex-direction: column;
    align-items: center;
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        url("https://www.alexotos.com/wp-content/uploads/2024/02/DSCF0951-1400x1050.jpg");
}
.about-mid-container {
    font-size: xx-large;
    color: white;
    padding: 100px;
    display: flex;
    flex-direction: column;
    align-items: center;
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        url("https://www.alexotos.com/wp-content/uploads/2023/04/DSCF0532-1400x933.jpg");
}
.about-bot-container {
    font-size: xx-large;
    color: white;
    padding: 100px;
    display: flex;
    flex-direction: column;
    align-items: center;
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        url("https://www.alexotos.com/wp-content/uploads/2024/02/KBDFANSMKIII_Thumb.jpg");
}
</style>
