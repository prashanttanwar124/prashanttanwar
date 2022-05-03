<template>
  <div class="MainContainer uk-position-fixed uk-position-right uk-width-1-1 uk-height-1-1">
    <Header />
    <div class="uk-position-relative mainInner uk-margin-auto">
      <div class="uk-margin-medium-top">
        <router-view></router-view>
      </div>
      <Footer />
    </div>
  </div>
</template>

<script>
import Header from "./Header";
import Footer from "./Footer";

export default {
  components: {
    Header,
    Footer
  },
  data: () => ({
    progress: 0
  }),
  methods: {}
};
</script>

<style lang="scss">
.headerMain {
  position: sticky;
  border-radius: 6px;
  padding-top: 12px;
  padding-bottom: 12px;
  max-width: 1400px;
  margin: auto;
}

.MainContainer {
  width: calc(100% - 260px);
  padding: 40px 40px;
  overflow-y: scroll;
  overflow-x: hidden;
  padding-top: 0px;
  background-color: #f4f7f8;
  transition: all 0.25s ease-in-out;

  @media screen and (max-width: 800px) {
    width: 100%;
    padding: 0px 0px;
  }

  .mainInner {
    max-width: 1400px;
    @media screen and (max-width: 800px) {
      width: 90%;
    }
  }
}

.MainContainerChangeMainWidth {
  width: calc(100% - 50px);
  transition: all 0.25s ease-in-out;
}

.vs-sidebar-content {
  transition: all 0.25s ease-in-out !important;
  border-radius: 0px !important;

  //   @media screen and (max-width: 801px) {
  //     transform: translate(0%);
  //   }
}
</style>
