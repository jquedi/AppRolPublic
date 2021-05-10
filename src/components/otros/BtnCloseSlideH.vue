<template>
  <button
    @click="transformF()"
    v-bind:class="[
      backgroundBtnCloseMenu,
      XpositionBtnCloseMenu,
      YpositionBtnCloseMenu,
      rotate,
      xPosition,
      yPosition,
      position,
      size,
    ]"
    class="transition-colors transition-slide duration-700 top-0 rounded-r-md -z-1 transform flex"
    id="BtnCloseSlideH"
  >
    <div
      class="absolute bg-white h-5/6 w-0.5 rounded-full right-1 inset-y-0 my-auto"
    ></div>
    <div
      class="absolute bg-white h-5/6 w-0.5 rounded-full right-2.5 inset-y-0 my-auto"
    ></div>
  </button>
</template>

<script>
export default {
  name: "BtnCloseSlideH",
  components: {},
  props: {
    rotate: String,
    xPositionInitial: String,
    xPositionFinal: String,
    xPosition: String,
    yPositionInitial: String,
    yPositionFinal: String,
    yPosition: String,
    position: String,
    size: String,
    hide: Boolean,
  },
  data() {
    return {
      backgroundBtnCloseMenu: "bg-red-400",
      XpositionBtnCloseMenu: this.xPositionInitial,
      YpositionBtnCloseMenu: this.yPositionInitial,
    };
  },
  methods: {
    transformF() {
      this.$emit("toggleElement", "Group");
    },
  },
};
</script>

<style scoped>
:focus {
  outline: none;
}
</style>