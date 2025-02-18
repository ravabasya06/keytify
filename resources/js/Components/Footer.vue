<template>
    <div class="footer">
        <div class="footer-container">
            <div class="left-group">
                <Link href="/">
                    <div class="logo-container">
                        <img
                            class="logo-img"
                            src="/public/logo.png"
                            alt="logo"
                        />
                        <h1 class="logo-text">KEYTIFY</h1>
                    </div>
                </Link>
                <p>Solution to all keyboard enthusiasts.</p>
            </div>
            <div class="right-group">
                <div class="footer-socials">
                    <Link href="">
                        <div class="socials">
                            <font-awesome-icon
                                class="socials-icon"
                                icon="fa-brands fa-instagram"
                            />
                            <p>@keytify_official</p>
                        </div>
                    </Link>
                    <Link href="">
                        <div class="socials">
                            <font-awesome-icon
                                class="socials-icon"
                                icon="fa-brands fa-x-twitter"
                            />
                            <p>@keytify_official</p>
                        </div>
                    </Link>
                    <Link href="">
                        <div class="socials">
                            <font-awesome-icon
                                class="socials-icon"
                                icon="fa-regular fa-envelope"
                            />
                            <p>keytify@gmail.com</p>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
        <p>Copyright © 2025 Keytify</p>
    </div>
</template>
<style scoped>
.footer {
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: var(--color-background-mute);
}
.footer-socials {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 15px;
    margin: 20px;
}
.footer-socials a {
    color: var(--color-text);
}
.footer-container {
    display: flex;
    align-items: center;
    justify-content: space-around;
    flex-direction: row;
    gap: 30px;
    padding: 20px;
}
.left-group {
    display: flex;
    flex-direction: column;
    align-items: center;
}
.right-group {
    display: flex;
    flex-direction: column;
    align-items: center;
}
.logo-img {
    height: 40px;
    width: 40px;
    filter: var(--color-logo-img);
}
.logo-container {
    display: flex;
    flex-direction: row;
    align-items: center;
}
.logo-text {
    font-size: 30px;
    margin: 0;
    padding: 5px;
    border-radius: 10%;
    color: var(--color-logo);
}
.socials {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 5px;
}
.socials-icon {
    font-size: 20px;
}
</style>
