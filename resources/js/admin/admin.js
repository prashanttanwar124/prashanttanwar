require("../bootstrap");

// window.Vue = Vue;
window.Vue = require("vue").default;

import VueRouter from "vue-router";
Vue.use(VueRouter);

//Vuesax Styles
import Vuesax from "vuesax";
Vue.use(Vuesax);

//Vue Form Helper
import { Form, HasError, AlertError } from "vform";
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

//Processbar Axios
import { loadProgressBar } from "axios-progress-bar";
loadProgressBar();

//Uikit JS
window.UIkit = window.UIkit = require("UIkit");

//Moment Js
import moment from "moment";
Vue.filter("formatDate", value => {
    return moment(value).format("LL");
});

//Slug Component

import slugify from "slugify";
// Vue.use(slugify);
window.slugify = slugify;

// Editor //
import VueQuillEditor from "vue-quill-editor";
// import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";
// import "quill/dist/quill.bubble.css";
Vue.use(VueQuillEditor);

//Import Compnents
import Routes from "./routes";
import Index from "./Index";

const app = new Vue({
    el: "#app",
    router: Routes,
    components: {
        index: Index
    }
});
