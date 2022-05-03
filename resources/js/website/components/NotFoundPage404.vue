<template>
  <div class="wrapper">
    <!-- Started -->
    <div class="section started">
      <div class="centrize full-width">
        <div class="vertical-center">
          <div class="started-content">
            <div class="h-title glitch-effect" data-text="404"><span>404</span></div>
            <p style="margin:0px;">Page Not Found</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>
<script>
export default {
  mounted() {
    $('.typed-subtitle').typed({
      stringsElement: $('.typing-subtitle'),
      loop: true
    });
    this.mainLoader();
  }
};
</script>
