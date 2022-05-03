<template>
  <vs-navbar class="headerMain" shadow center-collapsed v-model="active">
    <template #left>
      <vs-button id="slideBtn" flat icon>
        <i class="bx bx-menu"></i>
      </vs-button>
    </template>
    <template #right>
      <div class="uk-grid-divider uk-grid-small uk-text-center" uk-grid>
        <div>
          <div>
            <vs-button v-if="fullscreenTrue" icon transparent @click="openFullscreen"><i class="bx bx-fullscreen" style="font-size: 1.4rem;"></i></vs-button>
            <vs-button v-if="fullscreenFalse" icon flat @click="closeFullscreen"><i class="bx bx-exit-fullscreen" style="font-size: 1.4rem;"></i></vs-button>
          </div>
        </div>
      </div>
    </template>
  </vs-navbar>
</template>
<script>
export default {
  data: () => ({
    active: "home",
    fullscreenTrue: true,
    fullscreenFalse: false
  }),
  methods: {
    openFullscreen() {
      this.fullscreenTrue = false;
      this.fullscreenFalse = true;
      var elem = document.documentElement;
      if (elem.requestFullscreen) {
        elem.requestFullscreen();
      } else if (elem.mozRequestFullScreen) {
        elem.mozRequestFullScreen();
      } else if (elem.webkitRequestFullscreen) {
        elem.webkitRequestFullscreen();
      } else if (elem.msRequestFullscreen) {
        elem.msRequestFullscreen();
      }
    },
    closeFullscreen() {
      this.fullscreenTrue = true;
      this.fullscreenFalse = false;
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
      } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
      } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
      }
    }
  }
};
</script>

