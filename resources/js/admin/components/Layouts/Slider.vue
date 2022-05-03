<template>
  <vs-sidebar class="uk-position-fixed" v-model="active" open style="width:260px">
    <div class="moboSliderCloseBtn uk-padding-small">
      <i class="bx bxs-chevron-left" style="font-size:24px"></i>
    </div>
    <template #logo>
      <vs-sidebar-item class="uk-text-primary logoSlider">
        <template #icon>
          CV.
        </template>
        Codeviews
      </vs-sidebar-item>
    </template>
    <vs-sidebar-item id="team" :disabled="active == 'team'" :to="{ name: 'team' }">
      <template #icon>
        <i class='bx bx-user'></i>
      </template>
      Team
    </vs-sidebar-item>

    <vs-sidebar-item id="category" :disabled="active == 'category'" :to="{ name: 'category' }">
      <template #icon>
        <i class='bx bxs-category'></i>
      </template>
      Category
    </vs-sidebar-item>

    <vs-sidebar-item id="portfolio" :disabled="active == 'portfolio'" :to="{ name: 'portfolio' }">
      <template #icon>
        <i class='bx bx-image'></i>
      </template>
      Portfolio
    </vs-sidebar-item>

    <vs-sidebar-item id="client" :disabled="active == 'client'" :to="{ name: 'client' }">
      <template #icon>
        <i class="bx bx-news"></i>
      </template>
      Client
    </vs-sidebar-item>

    <vs-sidebar-item id="review" :disabled="active == 'review'" :to="{ name: 'review' }">
      <template #icon>
        <i class='bx bx-star'></i>
      </template>
      Review
    </vs-sidebar-item>

    <vs-sidebar-item id="contact" :disabled="active == 'contact'" :to="{ name: 'contact' }">
      <template #icon>
        <i class='bx bxs-contact'></i>
      </template>
      Contact Form Data
    </vs-sidebar-item>

    <vs-sidebar-item id="socialLinks" :disabled="active == 'socialLinks'" :to="{ name: 'socialLinks' }">
      <template #icon>
        <i class='bx bx-link'></i>
      </template>
      Social Links
    </vs-sidebar-item>

    <vs-sidebar-item id="pageSeo" :disabled="active == 'pageSeo'" :to="{ name: 'pageSeo' }">
      <template #icon>
        <i class='bx bx-search-alt'></i>
      </template>
      Page SEO
    </vs-sidebar-item>

    <vs-sidebar-item id="user" :disabled="active == 'user'" :to="{ name: 'user' }">
      <template #icon>
        <i class='bx bxs-user-plus'></i>
      </template>
      Users
    </vs-sidebar-item>

    <vs-sidebar-item>
      <template #icon>
        <i class='bx bx-log-in-circle'></i>
      </template>
      <span @click="logout">Logout</span>
    </vs-sidebar-item>

  </vs-sidebar>
</template>
<script>
export default {
  data: () => ({
    active: null
  }),
  methods: {
    logout() {
      axios.post('/logout').then(res => {
        window.location.reload();
      });
    },
    currentRouteName() {
      this.active = this.$route.name;
    }
  },
  created() {
    this.currentRouteName();
  },
  mounted() {
    const mobsliderToggle = () => {
      var btn = document.querySelector('.moboSliderCloseBtn');
      btn.addEventListener('click', () => {
        var slider = document.querySelector('.vs-sidebar-content');
        slider.style.transform = 'translate(-100%)';
      });
    };
    mobsliderToggle();
    const sliderToggle = () => {
      var btn = document.querySelector('#slideBtn');
      btn.addEventListener('click', () => {
        var mainContainer = document.querySelector('.MainContainer');
        var slider = document.querySelector('.vs-sidebar-content');
        if (screen.width > 800) {
          mainContainer.classList.toggle('MainContainerChangeMainWidth');
          slider.classList.add('open');
          if (slider.style.width === '260px') {
            slider.classList.add('reduce');
            slider.style.width = '50px';
          } else {
            slider.classList.remove('reduce');
            slider.style.width = '260px';
          }
        } else {
          slider.style.transform = 'translate(0%)';
        }
      });
    };
    sliderToggle();
  }
};
</script>

<style lang="scss" scoped>
.logoSlider {
  padding-left: 0 !important;
  opacity: 1;
}

.vs-sidebar-content.open {
  transform: translate(0%);
}

.moboSliderCloseBtn {
  display: none;
}

@media screen and (max-width: 800px) {
  .logoSlider {
    margin-top: 14px;
  }
  .vs-sidebar-content.open {
    transform: translate(-100%);
  }
  .moboSliderCloseBtn {
    position: absolute;
    display: block;
    top: 0;
    right: 0;
  }
}
</style>
