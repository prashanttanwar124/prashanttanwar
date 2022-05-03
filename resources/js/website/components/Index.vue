<template>
  <div class="wrapper">
    <!-- Started -->
    <div class="section started">
      <div class="centrize full-width">
        <div class="vertical-center">
          <div class="started-content">
            <div class="h-title glitch-effect" data-text="I'm Prashant">I'm <span>Prashant</span></div>
            <div class="h-subtitle typing-subtitle">
              <p>UX/UI Designer and Front-end Director.</p>
              <p>Based in India.</p>
            </div>
            <span class="typed-subtitle"></span>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>
<script>
export default {
  mounted() {
    // this.titleLinkHeight();
    $('.typed-subtitle').typed({
      stringsElement: $('.typing-subtitle'),
      loop: true
    });
    this.mainLoader();
  }
};
</script>
