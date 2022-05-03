<template>
  <div>

    <Slider />

    <MainContainer />
  </div>
</template>
<script>
import MainContainer from "./components/Layouts/MainContainer";
import Slider from "./components/Layouts/Slider";
export default {
  components: {
    MainContainer,
    Slider
  },
  //   props: ["checklogin"],
  data: () => ({
    value: "",
    datas: null,
    isLoading: true,
    uploadPercentage: null
  }),

  methods: {
    loadApi() {
      // this.$Progress.start();
      axios
        .get("https://jsonplaceholder.typicode.com/todos")
        .then(res => {
          this.datas = res.data;
        })
        .catch(err => {});
    }
  },
  //   watch: {
  //     checklogin: function () {
  //       if (this.checklogin != "admin") {
  //         window.location.href = "/admin/login";
  //       }
  //     },
  //   },
  mounted() {
    // alert();
  },
  created() {}
};
</script>
