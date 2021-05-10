<template>
  <div
    id="slotEquipado"
    class="bg-white border border-black h-full justify-self-center max-h-78px relative"
  >
    <img class="h-full" :src="fondo" alt="" />
    <drop
      @drop="handleDrop"
      @dragover="handleDragover(...arguments)"
      class="h-full w-full left-0 top-0 absolute z-10"
    >
      <div v-if="Object.keys(objeto).length >= 1" class="h-full absolute">
        <img
          draggable="false"
          @click="infoItem()"
          class="cursor-pointer"
          :src="objeto.image"
          alt=""
        />
        <button
          class="absolute text-red-900 font-bold top-0 right-0 bg-white border border-black"
          @click="unEquip()"
        >
          X
        </button>
      </div>
    </drop>
  </div>
</template>

<script>
export default {
  name: "slotEquipado",
  components: {},
  props: {
    objetos: Object,
    objeto: Object,
    fondo: String,
    info: Object,
  },
  data() {
    return {};
  },
  watch: {},
  methods: {
    handleDrop(val) {
      var aux = [-1, val.id, this.info.valor, val.origen];

      if (Object.keys(this.objeto).length >= 1) {
        aux[0] = this.objeto.id;
      }

      this.$emit("equipNew", aux);
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
    unEquip() {
      var aux = this.objeto.id;
      this.$emit("unEquip", aux);
    },
    infoItem() {
      var aux = this.info.valor;
      this.$emit("infoItem", aux);
    },
  },
  created: function () {},
};
</script>
