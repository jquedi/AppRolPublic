<template>
  <div id="itemPapelera" class="h-content w-content flex-1 py-1 flex flex-col">
    <drag
      class="h-content w-content flex-1 flex flex-row"
      :transfer-data="pruebaF()"
    >
      <button
        class="h-content w-content mx-2 flex flex-row"
        @click="devolverF()"
      >
        <div class="border-2 border-black h-full rounded-lg ml-2">
          <div
            class="bg-white break-words px-2 font-mono italic font-bold text-sm underline text-left"
          >
            {{ objeto.name }}
          </div>
        </div>
      </button>
    </drag>
  </div>
</template>

<script>
export default {
  name: "itemPapelera",
  components: {},
  props: {
    objeto: Object,
    rutaPre: Object,
  },
  data() {
    return {
      ruta: "",
    };
  },
  watch: {
    rutaPre: function (val) {
      this.ruta = val;
      this.cargarRuta();
    },
    rutaDestino: function (val) {
      if (val == this.objeto) {
        this.$emit("resetRuta");
      }
    },
  },
  methods: {
    pruebaF() {
      var id = this.objeto["id"];
      var ruta = this.ruta;
      return {
        id,
        ruta,
      };
    },
    devolverF() {
      this.$emit("objetoInfoF", this.objeto);
    },
    cargarRuta() {
      this.ruta = this.rutaPre;
    },
  },
  created: function () {
    this.cargarRuta();
  },
};
</script>

<style scoped>
</style>