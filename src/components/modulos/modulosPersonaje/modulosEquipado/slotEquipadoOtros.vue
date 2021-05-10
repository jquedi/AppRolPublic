<template>
  <div
    id="slotEquipadoOtros"
    class="bg-white border border-black h-full justify-self-center max-h-78px relative"
  >
    <img class="h-full" :src="fondo" alt="" />
    <drop
      @drop="handleDrop"
      @dragover="handleDragover(...arguments)"
      class="h-full w-full left-0 top-0 absolute z-10"
    >
      <div
        v-if="Object.keys(equipados).length >= 1"
        @click="infoItem()"
        class="h-full w-full absolute cursor-pointer"
      >
        <div class="w-full h-full bg-white text-3xl font-bold">
          + {{ Object.keys(this.equipados).length }}
        </div>
      </div>
    </drop>
  </div>
</template>

<script>
export default {
  name: "slotEquipadoOtros",
  components: {},
  props: {
    objetos: Object,
    fondo: String,
    info: Object,
    reserOtros: Number,
  },
  data() {
    return {
      equipados: {},
    };
  },
  watch: {
    reserOtros: function (val) {
      if (val == 1) {
        this.itemsEquipadosOtrosF();
        this.$emit("resetOtrosF", 0);
      }
    },
  },
  methods: {
    handleDrop(val) {
      var aux = [-1, val.id, this.info.valor, val.origen];

      this.$emit("equipNew", aux);
      this.itemsEquipadosOtrosF();
    },
    handleDragover(data, event) {
      for (var i = 0; i < Object.keys(this.objetos).length; i++) {
        if (this.objetos[i].id == data.id) {
          var objetoS = this.objetos[i];
        }
      }

      if (!this.info.type.includes(objetoS.type) || objetoS.equiped > 0) {
        event.dataTransfer.dropEffect = "none";
      }
    },
    infoItem() {
      var aux = this.info.valor;
      this.$emit("infoItem", aux);
    },
    itemsEquipadosOtrosF() {
      this.equipados = {};
      for (var i = 0; i < Object.keys(this.objetos).length; i++) {
        if (this.objetos[i].equiped == 9) {
          this.equipados[Object.keys(this.equipados).length] = this.objetos[i];
        }
      }
      this.$emit("guardarOtros", this.equipados);
    },
  },
  created: function () {
    this.itemsEquipadosOtrosF();
  },
};
</script>
