<template>
  <div id="panelPersonaje" class="h-full w-full flex flex-col" @click="focusF">
    <div class="w-full flex flex-row">
      <button
        @click="selectedOption = 1"
        :style="selectedOptionStyleF(1)"
        class="min-w-content w-2/5 border-2 border-black border-b-0 rounded-t-lg"
      >
        Equipado
      </button>
      <button
        @click="selectedOption = 3"
        :style="selectedOptionStyleF(3)"
        class="min-w-content w-2/5 border-2 border-black border-b-0 rounded-t-lg -ml-4"
      >
        Estado
      </button>
      <button
        @click="selectedOption = 2"
        :style="selectedOptionStyleF(2)"
        class="min-w-content w-2/5 border-2 border-black border-b-0 rounded-t-lg -ml-4"
      >
        Trasfondo
      </button>
    </div>
    <div
      class="h-full w-full bg-blue-200 border-2 border-black rounded-lg relative"
    >
      <img class="w-full h-full absolute z-10" :src="personaje.image" alt="" />
      <div
        class="absolute bg-red-200 rounded-xl border-2 p-2 bottom-4 inset-x-0 w-content mx-auto border-black z-20"
      >
        <p class="text-2xl">{{ personaje.name }}</p>
        <p>{{ personaje.title }}</p>
      </div>
      <div v-if="selectedOption == 3" class="w-full h-full z-30 absolute">
        <efectos :objetos="objetos" />
      </div>
      <div
        v-if="selectedOption == 2"
        class="w-full h-full bg-gray-800 text-white p-4 text-lg bg-opacity-90 z-30 absolute overflow-y-auto"
      >
        {{ personaje.background }}
      </div>
      <div v-if="selectedOption == 1" class="w-full h-full z-30 absolute">
        <equipado
          :objetos="objetos"
          :opacidadPadre="opacidadPadre"
          @cambioOpacidad="cambioOpacidad"
          @resetStats="resetStats"
          @resetHabilities="resetHabilities"
        />
      </div>
    </div>
  </div>
</template>

<script>
import equipado from "@/components/modulos/panelJugador/modulosPersonaje/equipado.vue";
import efectos from "@/components/modulos/panelJugador/modulosPersonaje/efectos.vue";

export default {
  name: "panelPersonaje",
  components: {
    equipado,
    efectos,
  },
  props: {
    personaje: Object,
    objetos: Object,
  },
  data() {
    return {
      selectedOption: 1,
      opacidadPadre: 90,
    };
  },
  methods: {
    focusF() {
      this.$emit("focusF", "personaje");
    },
    resetStats(val) {
      this.$emit("resetStats", val);
    },
    resetHabilities(val) {
      this.$emit("resetHabilities", val);
    },
    selectedOptionStyleF(val) {
      if (val == this.selectedOption) {
        var aux = "background: yellow; z-index: 50;";
      } else {
        aux =
          "background: gray; z-index: " +
          (10 + (val - this.selectedOption)) +
          ";";
      }
      return aux;
    },
    cambioOpacidad(val) {
      this.opacidadPadre = parseInt(val);
    },
  },
};
</script>
<style scoped>
::-webkit-scrollbar {
  width: 5px;
  height: 5px;
}
::-webkit-scrollbar-thumb {
  background: linear-gradient(0deg, #969696 14%, #6e7399 51%);
  border-radius: 15px;
}
::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(13deg, #6e7399 14%, #969696 51%);
}
::-webkit-scrollbar-track {
  background: #d6c9c9;
  border-radius: 15px;
  box-shadow: inset 7px 0px 30px #f0f0f0;
}
</style>
