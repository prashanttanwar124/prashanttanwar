import VueRouter from "vue-router";
import Index from "./components/Index";
import Resume from "./components/Resume";
import Portfolio from "./components/Portfolio";
import Contact from "./components/Contact";

import NotFoundPage404 from "./components/NotFoundPage404";

const routes = [
    { path: "/", component: Index, name: "index" },
    { path: "/resume", component: Resume, name: "resume" },
    { path: "/portfolio", component: Portfolio, name: "portfolio" },
    { path: "/contact", component: Contact, name: "contact" },

    { path: "*", component: NotFoundPage404 }
];

const router = new VueRouter({
    mode: "history",
    routes
});

export default router;
