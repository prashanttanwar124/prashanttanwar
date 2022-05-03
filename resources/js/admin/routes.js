import VueRouter from "vue-router";
import Dashboard from "./components/Dashboard";
import Team from "./components/Team";
import SocialLinks from "./components/SocialLinks";
import Contact from "./components/Contact";
import Review from "./components/Review";
import PageSeo from "./components/PageSeo";
import Client from "./components/Client";
import Category from "./components/Category";
import Portfolio from "./components/Portfolio";
import User from "./components/User";
import NotFoundPage404 from "./components/NotFoundPage404";

const routes = [
    //Redirect Path
    { path: "/admin", redirect: "/admin/team" },
    { path: "/admin/page-seo", component: PageSeo, name: "pageSeo" },
    { path: "/admin/dashboard", component: Dashboard, name: "dashboard" },
    { path: "/admin/client", component: Client, name: "client" },
    { path: "/admin/review", component: Review, name: "review" },
    { path: "/admin/team", component: Team, name: "team" },
    { path: "/admin/category", component: Category, name: "category" },
    { path: "/admin/portfolio", component: Portfolio, name: "portfolio" },
    { path: "/admin/contact", component: Contact, name: "contact" },
    { path: "/admin/users", component: User, name: "user" },
    {
        path: "/admin/social-links",
        component: SocialLinks,
        name: "socialLinks"
    },
    { path: "*", component: NotFoundPage404 }
];

const router = new VueRouter({
    mode: "history",
    routes
});

export default router;
