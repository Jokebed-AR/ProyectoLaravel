<template>
  <div class="flex">
    <lottie
            :options="defaultOptions"
            v-on:animCreated="handleAnimation"
            v-if="Object.keys(defaultOptions).length > 0"
    />
  </div>
</template>

<script>

  import Lottie from './Lottie.vue'

  export default {
    name: 'app',
    props: {
      path: {
        type: String,
        required: true
      }
    },
    components: {
      'lottie': Lottie
    },
    data() {
      return {
        defaultOptions: {},
        animationSpeed: 1
      }
    },
    async mounted() {
      const animationData = await import(`../lottie/${this.path}.json`)
      this.defaultOptions = { animationData: animationData.default }
    },
    methods: {
      handleAnimation: function (anim) {
        this.anim = anim;
      },
      stop: function () {
        this.anim.stop();
      },
      play: function () {
        this.anim.play();
      },
      pause: function () {
        this.anim.pause();
      },
      onSpeedChange: function () {
        this.anim.setSpeed(this.animationSpeed);
      }
    }
  }
</script>
