<template>
  <div
    class="text-left relative overflow-auto scrollbar-thin text-opacity-70 bottom-0 h-full w-full"
    id="selectDados"
  >
    <BtnCloseSlide2 direccion="right" @CerrarLista="CerrarLista" />
    <transition name="hideSelectDados">
      <div
        class="pt-4 h-full w-full bg-gray-500 absolute z-10 overflow-auto scrollbar-thin"
        v-if="!HideSelectDados"
      >
        <div v-for="(dado, index) in dados" v-bind:key="index">
          <button class="mt-4 w-full">
            <div class="bg-blue-400 h-20 w-full"></div>
            <span class="text-xs font-bold text-gray-200"
              >D{{ dado["caras"] }}</span
            >
          </button>
        </div>
        <button class="mt-4 w-full">
          <div class="bg-blue-400 h-20 w-full"></div>
          <span class="text-xs font-bold text-gray-200">D</span>
          <input
            class="text-xs w-2/4 font-bold text-white bg-gray-100 bg-opacity-30"
            type="number"
            min="1"
            max="100"
          />
        </button>
      </div>
    </transition>
  </div>
</template>

<script>
import BtnCloseSlide2 from "@/components/otros/BtnCloseSlide2.vue";
export default {
  name: "selectDados",
  components: {
    BtnCloseSlide2,
  },
  props: {},
  data() {
    return {
      arrow1BtnCloseMenu: "-rotate-135",
      arrow2BtnCloseMenu: "rotate-135",
      arrowDesplazar1: "right-1/4",
      arrowDesplazar2: "right-2/4",
      arrowDesplazar3: "right-3/4",
      CloseBtnWidth: "w-full",

      HideSelectDados: false,

      dados: {
        0: {
          caras: 20,
        },
        1: {
          caras: 10,
        },
        2: {
          caras: 100,
        },
        3: {
          caras: 2,
        },
        4: {
          caras: 12,
        },
        5: {
          caras: 6,
        },
      },
    };
  },
  methods: {
    CerrarLista(val) {
      this.HideSelectDados = val;
    },
  },
};
</script>

<style scoped>
:focus {
  outline: none;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input[type="number"] {
  -moz-appearance: textfield;
}

.hideSelectDados-leave-active {
  transition: all 0.7s;
}
.hideSelectDados-enter-active {
  transition: all 0.7s;
}
.hideSelectDados-enter,
.hideSelectDados-leave-to {
  transform: translateX(100%);
}
</style>