<template>
  <div>

    <footer>
      <div class="soc" v-if="info">
        <a v-if="info.instagram" target="_blank" :href="info.instagram"><span class="ion ion-social-instagram-outline"></span></a>
        <a v-if="info.facebook" target="_blank" :href="info.facebook"><span class="ion ion-social-facebook"></span></a>
        <a v-if="info.youtube" target="_blank" :href="info.youtube"><span class="ion ion-social-youtube"></span></a>
        <a v-if="info.whatsapp" target="_blank" :href="'https://wa.me/'+info.whatsapp"><span class="ion ion-social-whatsapp"></span></a>
      </div>
      <div class="copy">© 2016 Codeviews. All rights reserved.</div>
      <div class="clr"></div>
    </footer>

    <!-- Lines -->
    <div class="line top"></div>
    <div class="line bottom"></div>
    <div class="line left"></div>
    <div class="line right"></div>
  </div>

</template>


<script>
export default {
  data() {
    return {
      info: null
    };
  },
  methods: {
    getSocialDataLink() {
      axios.get('/website-data/social-link').then(res => {
        this.info = res.data;
      });
    }
  },
  created() {
    this.getSocialDataLink();
  }
};
</script>


<style lang="scss" scoped>
.footer {
  position: relative;
  top: 24px;
}
</style>
