import "./bootstrap";
import { createApp, h } from "vue";
import { createInertiaApp, Head, Link } from "@inertiajs/vue3";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import VueSplide from "@splidejs/vue-splide";
import "@splidejs/vue-splide/css";

import { faInstagram } from "@fortawesome/free-brands-svg-icons";
import { faXTwitter } from "@fortawesome/free-brands-svg-icons";
import {
    faEnvelope,
    faStar as faStarRegular,
} from "@fortawesome/free-regular-svg-icons";
import {
    faCartPlus,
    faCartShopping,
    faUser,
    faStar as faStarSolid,
    faMagnifyingGlass,
} from "@fortawesome/free-solid-svg-icons";

library.add(
    faInstagram,
    faXTwitter,
    faEnvelope,
    faCartShopping,
    faUser,
    faCartPlus,
    faStarSolid,
    faStarRegular,
    faMagnifyingGlass,
);

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(VueSplide)
            .component("Head", Head)
            .component("Link", Link)
            .component("font-awesome-icon", FontAwesomeIcon)
            .mount(el);
    },
});
