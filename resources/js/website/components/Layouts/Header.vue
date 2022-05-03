<template>

  <header>
    <div class="head-top">
      <a href="#" class="menu-btn"><span></span></a>
      <div class="top-menu">
        <ul>
          <li @click="closeMenu" :class="$route.name == 'index' ? 'active' : ''">
            <router-link to="/" class="lnk">Home</router-link>
          </li>
          <li @click="closeMenu" :class="$route.name == 'resume' ? 'active' : ''">
            <router-link to="/resume" class="lnk">Resume</router-link>
          </li>
          <li @click="closeMenu" :class="$route.name == 'portfolio' ? 'active' : ''">
            <router-link to="/portfolio" class="lnk">Portfolio</router-link>
          </li>
          <li @click="closeMenu" :class="$route.name == 'contact' ? 'active' : ''">
            <router-link to="/contact" class="btn">Contact</router-link>
          </li>

        </ul>
      </div>
    </div>
  </header>

</template>

<script>
export default {
  methods: {
    closeMenu() {
      $('header').removeClass('active');
      //   $('body').addClass('loaded');
      $('.preloader').css('display', 'block');
      $('body').removeClass('loaded');
      $('.preloader .pre-inner').css('display', 'block');
    }
  }
  //   mounted() {}
};
</script>
