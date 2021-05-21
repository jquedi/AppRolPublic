<template>
  <div
    id="notasJugador"
    class="h-full w-full border-2 border-black bg-gray-200"
    @click="focusF"
  >
    <div
      @click="toggleElement"
      class="absolute top-0 right-0 bg-red-400 cursor-pointer z-60"
    >
      X
    </div>
    <div
      class="w-full py-6 px-4 bg-gray-400 absolute h-full right-0 transition-all duration-700 delay-0"
    >
      <div
        class="h-full w-full bg-white border-2 border-red-400 rounded-3xl py-6 px-4 text-left"
      >
        <textarea
          @keyup="reescribir()"
          class="h-full w-full resize-none"
          v-model="notaInfo"
        >
        </textarea>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "notasJugador",
  components: {},
  props: {
    nota: Object,
  },
  data() {
    return {
      hideLista: false,
      width: "w-3/4",
      notaInfo: "",
      seleccionado: 0,
      editar: -1,
      rename: -1,
    };
  },
  watch: {
    nota: function () {
      this.abrirNota();
    },
  },
  methods: {
    toggleElement() {
      this.$emit("toggleElement", "notes2");
    },
    focusF() {
      this.$emit("focusF", "notas");
    },
    abrirNota() {
      this.notaInfo = this.nota.letter;
    },
    reescribir() {
      this.nota["letter"] = this.notaInfo;
    },
  },
  created: function () {
    this.abrirNota();
  },
};
</script>

<style scoped>
:focus {
  outline: none;
}
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