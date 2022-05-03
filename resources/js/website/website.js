require("../bootstrap");

require("./js/typed.js");
require("./js/magnific-popup.js");
require("./js/imagesloaded.pkgd.js");
require("./js/isotope.pkgd.js");
require("./js/glitche-scripts.js");
window.Vue = require("vue").default;

import VueMeta from "vue-meta";
Vue.use(VueMeta);

Vue.mixin({
    methods: {
        mainLoader() {
            setTimeout(() => {
                $(".preloader .pre-inner").fadeOut(800, function() {
                    /* Preload hide */
                    $(".preloader").fadeOut();
                    $("body").addClass("loaded");

                    /* Typed breadcrumbs */
                    $(".typed-bread").typed({
                        stringsElement: $(".typing-bread"),
                        showCursor: false
                    });

                    /* One Page Nav */
                    var url_hash = location.hash;
                    var sectionElem = $(url_hash);
                    if (
                        url_hash.indexOf("#section-") == 0 &&
                        sectionElem.length
                    ) {
                        $("body, html").animate(
                            { scrollTop: $(url_hash).offset().top - 70 },
                            400
                        );
                    }
                });

                var height = $(window).height();
                $(".section.started").css({ height: height - 60 });
            }, 100);
        }
        // titleLinkHeight() {}
    }
});

import VueRouter from "vue-router";
Vue.use(VueRouter);

//Vue Form Helper
import { Form, HasError, AlertError } from "vform";
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

//Moment Js
import moment from "moment";
Vue.filter("formatDate", value => {
    return moment(value).format("LL");
});

// require("./js/jquery.validate.js");
// require("./js/jquery.min.js");

//Import Compnents
import Routes from "./routes";
import Index from "./Index";

// Routes.beforeEach((to, from, next) => {
//     // Scroll page to top on every route change
//     setTimeout(() => {
//         window.scrollTo(0, 0);
//     }, 100);
// });

const app = new Vue({
    el: "#app",
    router: Routes,
    components: {
        index: Index
    },
    watch: {
        $route(to, from) {
            this.getMetaTags();
        }
    },
    methods: {
        getMetaTags() {
            axios
                .post(`/website-data/meta-tags`, {
                    path: this.$route.path
                })
                .then(res => {
                    $("title").remove();
                    $("meta[property='og:title']").remove();
                    $("meta[name='twitter:title']").remove();
                    $("meta[name='description']").remove();
                    $("meta[property='og:description']").remove();
                    $("meta[name='twitter:description']").remove();
                    $("meta[name='image']").remove();
                    $("meta[property='og:image']").remove();
                    $("meta[name='twitter:image']").remove();

                    if (res.data) {
                        var metaTags = JSON.parse(res.data.metaTags);

                        $("head").append(
                            `<title>${metaTags.title}</title><meta property="og:title" content="${metaTags.title}"><meta name="twitter:title" content="${metaTags.title}">`
                        );

                        if (metaTags.description) {
                            $("head").append(
                                `<meta name="description" content="${metaTags.description}"><meta property="og:description" content="${metaTags.description}"><meta name="twitter:description" content="${metaTags.description}">`
                            );
                        }

                        if (metaTags.image) {
                            $("head").append(
                                `<meta name="image" content="${metaTags.image}"><meta property="og:image" content="${metaTags.image}"><meta name="twitter:image" content="${metaTags.image}"></meta>`
                            );
                        }
                    }

                    // <title>Home</title><meta property="og:title" content="Home"><meta name="twitter:title" content="Home"><meta name="description" content="tthth"><meta property="og:description" content="tthth"><meta name="twitter:description" content="tthth"><meta name="image" content="y"><meta property="og:image" content="y"><meta name="twitter:image" content="y"></meta>
                });
        }
    },
    created() {
        // axios
        //     .get("/website-data/social-link")
        //     .then(res => {
        //         window.info = res.data;
        //     })
        //     .finally(() => {
        //         this.mainLoader();
        //     });
        this.getMetaTags();
    }
});
