<template>
  <button
    @click="transformF()"
    v-bind:class="[
      backgroundBtnCloseMenu,
      positionBtnCloseMenu,
      rotate,
      xPosition,
    ]"
    class="transition-colors transition-slide duration-700 absolute top-4 w-20 h-6 rounded-r-md row-start-2 z-10 transform"
    id="BtnCloseSlide"
  >
    <div
      v-bind:class="[arrow1BtnCloseMenu]"
      class="transition-all duration-700 absolute top-6px bg-white h-1 w-4 rounded-full transform right-5"
    ></div>
    <div
      v-bind:class="[arrow2BtnCloseMenu]"
      class="transition-all duration-700 absolute bottom-6px bg-white h-1 w-4 rounded-full transform right-5"
    ></div>
    <div
      v-bind:class="[arrow1BtnCloseMenu]"
      class="transition-all duration-700 absolute right-1 top-6px bg-white h-1 w-4 rounded-full transform"
    ></div>
    <div
      v-bind:class="[arrow2BtnCloseMenu]"
      class="transition-all duration-700 absolute right-1 bottom-6px bg-white h-1 w-4 rounded-full transform"
    ></div>
  </button>
</template>

<script>
export default {
  name: "BtnCloseSlide",
  components: {},
  props: {
    rotate: String,
    xPositionInitial: String,
    xPositionFinal: String,
    xPosition: String,
  },
  data() {
    return {
      backgroundBtnCloseMenu: "bg-red-400",
      positionBtnCloseMenu: this.xPositionInitial,
      arrow1BtnCloseMenu: "-rotate-45",
      arrow2BtnCloseMenu: "rotate-45",
    };
  },
  methods: {
    transformF() {
      if (this.backgroundBtnCloseMenu == "bg-red-400") {
        this.backgroundBtnCloseMenu = "bg-blue-400";
        this.positionBtnCloseMenu = this.xPositionFinal;
        this.arrow1BtnCloseMenu = "-rotate-135";
        this.arrow2BtnCloseMenu = "rotate-135";
      } else {
        this.backgroundBtnCloseMenu = "bg-red-400";
        this.positionBtnCloseMenu = this.xPositionInitial;
        this.arrow1BtnCloseMenu = "-rotate-45";
        this.arrow2BtnCloseMenu = "rotate-45";
      }
    },
  },
};
</script>

<style scoped>
:focus {
  outline: none;
}
</style>