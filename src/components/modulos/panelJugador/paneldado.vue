<template>
  <transition name="hidePanelDado">
    <div
      id="paneldado"
      v-if="!close"
      class="bg-green-500 h-full w-full rounded-2xl border-8 border-yellow-700"
      @click="focusF"
    >
      <div class="h-full w-full flex flex-col">
        <div class="w-full flex flex-warp rounded-t-lg">
          <button
            class="top-0 left-0 bg-red-500 w-5% min-w-1 rounded-tl-lg"
            @click="closeF()"
          >
            X
          </button>
          <button
            class="font-bold text-gray-1000 top-0 left-0 w-47.5% rounded-none"
            @click="HideHistorial = true"
          >
            Tablero
          </button>
          <button
            class="font-bold text-opacity-70 text-white bg-opacity-60 bg-black top-0 left-0 w-47.5% rounded-tr-lg"
            @click="HideHistorial = false"
          >
            Historial
          </button>
        </div>
        <div class="grid grid-cols-6 w-full h-full" v-if="HideHistorial">
          <selectDados class="col-start-6" />
        </div>

        <historialDados v-if="!HideHistorial" class="" />
      </div>
    </div>
  </transition>
</template>

<script>
import historialDados from "@/components/modulos/panelJugador/modulosDados/historialDados.vue";
import selectDados from "@/components/modulos/panelJugador/modulosDados/selectDados.vue";

export default {
  name: "paneldado",
  components: {
    historialDados,
    selectDados,
  },
  props: {
    close: Boolean,
  },
  data() {
    return {
      HideHistorial: true,
    };
  },
  methods: {
    focusF() {
      this.$emit("focusF", "dados");
    },
    closeF() {
      this.$emit("hideDaceFromChild", !this.close);
    },
  },
};
</script>

<style scoped>
.resizable-component {
  position: absolute;
}

.hidePanelDado-enter-active {
  animation: hidePanelDado-in 1s;
}
.hidePanelDado-leave-active {
  animation: hidePanelDado-in 1s reverse;
}
@keyframes hidePanelDado-in {
  0% {
    transform: scale(0);
    right: -10%;
    bottom: -10%;
    opacity: 0;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}
</style>