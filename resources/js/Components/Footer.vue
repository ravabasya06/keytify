<template>
    <div>
        <div class="footer-container">
            <div>
                <Link href="/">
                    <h1 class="footer-title">KEYTIFY</h1>
                </Link>
                <p class="footer-desc">Solution to all keyboard enthusiasts.</p>
                <div class="footer-socials">
                    <Link href="">
                        <font-awesome-icon icon="fa-brands fa-instagram" />
                    </Link>
                    <Link href="">
                        <font-awesome-icon icon="fa-brands fa-x-twitter" />
                    </Link>
                    <Link href="">
                        <font-awesome-icon icon="fa-regular fa-envelope" />
                    </Link>
                </div>
            </div>
            <p class="copyright">Copyright © 2025 Keytify</p>
        </div>
    </div>
</template>
<style scoped>
.footer-socials {
    display: flex;
    justify-content: center;
    gap: 15px;
    font-size: 35px;
    margin: 20px;
}
.footer-socials a {
    color: var(--color-text);
}
.footer-container {
    display: flex;
    background-color: var(--color-background-mute);
    flex-direction: column;
    gap: 50px;
}
.footer-title {
    text-align: center;
    margin: 0;
    color: var(--color-logo);
}
.footer-desc {
    margin: 0;
    text-align: center;
}
.copyright {
    margin: 0;
    text-align: center;
}
</style>
