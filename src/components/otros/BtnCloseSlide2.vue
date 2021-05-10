<template>
  <button
    @click="toggleAbrirF()"
    v-bind:class="[CloseBtnWidth]"
    class="transition-all duration-700 absolute bg-gray-700 h-4 overflow-hidden z-20"
    id="BtnCloseSlide2"
  >
    <div
      v-bind:class="[arrow1BtnCloseMenu, arrowDesplazar1]"
      class="transition-all duration-700 absolute top-5px bg-white h-2px w-2 rounded-full transform"
    ></div>
    <div
      v-bind:class="[arrow2BtnCloseMenu, arrowDesplazar1]"
      class="transition-all duration-700 absolute bottom-5px bg-white h-2px w-2 rounded-full transform"
    ></div>
    <div
      v-bind:class="[arrow1BtnCloseMenu, arrowDesplazar2]"
      class="transition-all duration-700 absolute top-5px bg-white h-2px w-2 rounded-full transform"
    ></div>
    <div
      v-bind:class="[arrow2BtnCloseMenu, arrowDesplazar2]"
      class="transition-all duration-700 absolute bottom-5px bg-white h-2px w-2 rounded-full transform"
    ></div>
    <div
      v-bind:class="[arrow1BtnCloseMenu, arrowDesplazar3]"
      class="transition-all duration-700 absolute top-5px bg-white h-2px w-2 rounded-full transform"
    ></div>
    <div
      v-bind:class="[arrow2BtnCloseMenu, arrowDesplazar3]"
      class="transition-all duration-700 absolute bottom-5px bg-white h-2px w-2 rounded-full transform"
    ></div>
  </button>
</template>

<script>
export default {
  name: "BtnCloseSlide2",
  components: {},
  props: {
    direccion: String,
  },
  data() {
    return {
      arrow1BtnCloseMenu: "-rotate-135",
      arrow2BtnCloseMenu: "rotate-135",
      arrowDesplazar1: "right-1/4",
      arrowDesplazar2: "right-2/4",
      arrowDesplazar3: "right-3/4",
      CloseBtnWidth: "w-full right-0",
    };
  },
  methods: {
    toggleAbrirF() {
      if (this.direccion == "left") {
        if (this.arrow1BtnCloseMenu == "-rotate-45") {
          this.arrow1BtnCloseMenu = "-rotate-135";
          this.arrow2BtnCloseMenu = "rotate-135";

          this.arrowDesplazar1 = "left-1";
          this.arrowDesplazar2 = "left-1";
          this.arrowDesplazar3 = "left-1";

          this.CloseBtnWidth = "w-4 left-0";
          this.emitir(true);
        } else {
          this.arrow1BtnCloseMenu = "-rotate-45";
          this.arrow2BtnCloseMenu = "rotate-45";

          this.arrowDesplazar1 = "left-1/4";
          this.arrowDesplazar2 = "left-2/4";
          this.arrowDesplazar3 = "left-3/4";

          this.CloseBtnWidth = "w-full left-0";
          this.emitir(false);
        }
      } else {
        if (this.arrow1BtnCloseMenu == "-rotate-135") {
          this.arrow1BtnCloseMenu = "-rotate-45";
          this.arrow2BtnCloseMenu = "rotate-45";

          this.arrowDesplazar1 = "right-1";
          this.arrowDesplazar2 = "right-1";
          this.arrowDesplazar3 = "right-1";

          this.CloseBtnWidth = "w-4 right-0";
          this.emitir(true);
        } else {
          this.arrow1BtnCloseMenu = "-rotate-135";
          this.arrow2BtnCloseMenu = "rotate-135";

          this.arrowDesplazar1 = "right-1/4";
          this.arrowDesplazar2 = "right-2/4";
          this.arrowDesplazar3 = "right-3/4";

          this.CloseBtnWidth = "w-full right-0";
          this.emitir(false);
        }
      }
    },
    valorInicial() {
      if (this.direccion == "left") {
        this.arrow1BtnCloseMenu = "-rotate-45";
        this.arrow2BtnCloseMenu = "rotate-45";

        this.CloseBtnWidth = "w-full left-0";
      }
    },
    emitir(val) {
      this.$emit("CerrarLista", val);
    },
  },
  created: function () {
    this.valorInicial();
  },
};
</script>

<style scoped>
:focus {
  outline: none;
}
</style>