<template>
  <div>
    <div class="preloader">
      <div class="centrize full-width">
        <div class="vertical-center">
          <div class="pre-inner">
            <div class="load typing-load">
              <p>loading...</p>
            </div>
            <span class="typed-load"></span>
          </div>
        </div>
      </div>
    </div>
    <MainContainer />
  </div>
</template>
<script>
import MainContainer from './components/Layouts/MainContainer';
export default {
  components: {
    MainContainer
  },

  data: () => ({}),

  methods: {},

  mounted() {},
  created() {}
};
</script>
