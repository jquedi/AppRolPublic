<template>
  <div
    id="subItem2"
    class="h-content w-content flex-1 py-1 flex flex-col relative z-20"
  >
    <drag
      class="h-content w-content flex-1 flex flex-row"
      :transfer-data="pruebaF()"
    >
      <button
        class="h-content w-content mx-2 flex flex-row"
        @click="devolverF()"
      >
        <div
          class="w-10 max-w-10 min-w-10 my-auto border-2 border-black rounded-lg overflow-hidden"
        >
          <img class="" v-bind:src="objeto.image" alt="" />
        </div>
        <div
          class="bg-white border-2 border-black h-full rounded-lg ml-2"
          v-bind:class="classBorderSubItemOpen"
        >
          <div
            class="bg-white break-words px-2 font-mono italic font-bold text-lg underline text-left flex flex-row"
          >
            <p>{{ objeto.name }}</p>
            <p v-if="objeto.equiped > 0  && objeto.equipedOrigen == inventario" class="text-red-600 ml-2">E</p>
          </div>
        </div>
      </button>
      <button
        @click="abrirSubItem(1)"
        v-if="objeto['type'] == 'Container'"
        v-bind:style="classFlechaSubItem"
        class="bg-white h-full border-2 border-black h-full rounded-lg ml-2 px-2 transition-all duration-700"
      >
        /\
      </button>
      <button
        @click="abrirNota(objeto)"
        v-if="objeto['type'] == 'Note'"
        class="bg-white h-full border-2 border-black h-full rounded-lg ml-2 px-2"
      >
        I
      </button>
      <button
        @click="abrirMapa(objeto['id'])"
        v-if="objeto['type'] == 'Map'"
        class="bg-white h-full border-2 border-black h-full rounded-lg ml-2 px-2"
      >
        O
      </button>
    </drag>

    <div
      v-bind:class="classAbierto"
      class="relative bg-red-200 h-contain w-full mx-2 m-min-content border-t-0 border-2 border-black ml-14 rounded pb-6"
    >
      <drop @drop="handleDrop" class="h-full w-full left-0 top-0 absolute z-10">
      </drop>
      <div v-for="(objeto2, index2) in objetos" v-bind:key="index2">
        <subItem2
          v-if="estaItem(objeto2, objeto.name)"
          v-bind:objeto="objeto2"
          v-bind:objetos="objetos"
          :inventario="objeto.name"
          :id2="id2"
          :origen="origen"
          :destino="destino"
          @resetRuta="resetRuta"
          @moverItem2="moverItem2"
          @objetoInfoF="objetoInfoF"
          @abrirMapa="abrirMapa"
          @abrirNota="abrirNota"
        />
      </div>
      <!-- Peso y monedas -->

      <div
        class="w-content h-6 bottom-0 right-0 absolute mb-1 flex flex-row-reverse border-t border-l border-black z-20"
      >
        <div
          class="h-full flex flex-row"
          @mouseover="hover = 'weight'"
          @mouseleave="hover = ''"
        >
          <p class="font-bold oldstyle-nums text-lg">
            {{ weight.toFixed(2) }}
          </p>
          <img
            class="h-full mr-6 ml-2"
            src="https://d1nhio0ox7pgb.cloudfront.net/_img/o_collection_png/green_dark_grey/512x512/plain/weight.png"
            alt=""
          />
        </div>
        <div class="h-full flex flex-row mr-6 ml-2">
          <span
            :class="classPinCapacidadMax"
            class="font-bold oldstyle-nums text-lg"
          >
            {{ cantidadObjetos }}/{{ objeto["capacity"] }}
          </span>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import subItem2 from "@/components/modulos/modulosObjetos/modulosCarpeta/modulosItem/subItem2.vue";

export default {
  name: "subItem2",
  components: {
    subItem2,
  },
  props: {
    objeto: Object,
    objetos: Object,
    inventario: String,
    destino: String,
    origen: String,
    id2: Number,
  },
  data() {
    return {
      ruta: "",
      cantidad: 1,
      abiertoSubItem: false,
      classFlechaSubItem: "transform: rotateX(0deg);",
      classBorderSubItemOpen: "",
      subObjetos: {},
      rutaPre2: {},
      classAbierto: "hidden",
      classPinCapacidadMax: "",
      weight: 0,
      cantidadObjetos: 0,
    };
  },
  watch: {
    objeto: function () {
      this.abrirSubItem(2);
    },
    destino: function (val) {
      if (val == this.objeto["name"]) {
        this.$emit("resetRuta", 0);
        this.abrirSubItem(2);
      }
    },
    origen: function (val) {
      if (val == this.objeto["name"]) {
        this.$emit("resetRuta", 1);
        this.abrirSubItem(2);
      }
    },
  },

  methods: {
    recalcularItem() {
      this.calcularWeight();
      this.cantidadF();
      this.$emit("resetRuta", 2);
    },

    resetRuta(val) {
      this.$emit("resetRuta", val);
    },

    moverItem2(val) {
      this.$emit("moverItem2", val);
    },
    handleDrop(val) {
      var inventarios = [this.objeto["name"]];
      var exist = false;

      var objetos = this.objetosEnInventario(inventarios);
      for (var i = 0; i < Object.keys(objetos).length; i++) {
        if (objetos[i]["id"] == val.id) {
          exist = true;
        }
      }

      if (
        this.cantidadObjetos < this.objeto["capacity"] ||
        (exist && this.cantidadObjetos >= this.objeto["capacity"])
      ) {
        var aux = {
          id: val.id,
          origen: val.origen,
          destino: this.objeto.name,
          action: val.action,
        };

        this.$emit("moverItem2", aux);
      } else {
        this.classPinCapacidadMax = "animate-pulse text-red-800";
        setTimeout(this.pauseAnimation, 4000);
      }
    },
    pauseAnimation() {
      this.classPinCapacidadMax = "";
    },
    objetoInfoF(val) {
      this.$emit("objetoInfoF", val);
    },
    abrirSubItem(val) {
      this.recalcularItem();
      this.cantidadObjetosF();
      if (this.objeto["type"] == "Container" && val == 2) {
        if (this.abiertoSubItem) {
          this.abiertoSubItem = true;
        }
      } else {
        if (this.objeto["type"] != "Container") {
          this.abiertoSubItem = false;
        }
      }
      if (this.objeto["type"] == "Container" && val == 1) {
        this.abiertoSubItem = !this.abiertoSubItem;
      }

      if (this.abiertoSubItem) {
        this.classAbierto = "block";
        this.classFlechaSubItem = "transform: rotateX(180deg);";
        this.classBorderSubItemOpen = "border-b-0 rounded-b-none";
      } else {
        this.classAbierto = "hidden";
        this.classFlechaSubItem = "transform: rotateX(0deg);";
        this.classBorderSubItemOpen = "";
      }
    },
    pruebaF() {
      var id = this.objeto["id"];
      var origen = this.inventario;
      var destino = "";
      var action = "move";
      return {
        id,
        destino,
        origen,
        action,
      };
    },

    cantidadF() {
      if (this.objeto["list"] == "") {
        for (
          var j = 0;
          j < Object.keys(this.objeto["distribucion"]).length;
          j++
        ) {
          if (this.objeto["distribucion"][j][0] == this.inventario) {
            this.cantidad = this.objeto["distribucion"][j][1];
          }
        }
      } else {
        this.cantidad = this.objeto["cant"];
      }
    },

    objetosEnInventario(inventarios) {
      var objetos = {};
      for (var i = 0; i < Object.keys(this.objetos).length; i++) {
        if (this.objetos[i]["list"] == "") {
          for (
            var j = 0;
            j < Object.keys(this.objetos[i]["distribucion"]).length;
            j++
          ) {
            if (inventarios.includes(this.objetos[i]["distribucion"][j][0])) {
              objetos[Object.keys(objetos).length] = this.objetos[i];
            }
          }
        } else {
          if (inventarios.includes(this.objetos[i]["list"])) {
            objetos[Object.keys(objetos).length] = this.objetos[i];
          }
        }
      }
      return objetos;
    },

    cantidadObjetosF() {
      var inventarios = [this.objeto["name"]];

      var objetos = this.objetosEnInventario(inventarios);

      this.cantidadObjetos = Object.keys(objetos).length;
    },

    subInventarios(inventario) {
      var aux = [];
      for (var i = 0; i < Object.keys(this.objetos).length; i++) {
        if (
          this.objetos[i]["list"] == inventario &&
          this.objetos[i]["type"] == "Container"
        ) {
          aux.push(this.objetos[i]["name"]);
          aux = aux.concat(this.subInventarios(this.objetos[i]["name"]));
        }
      }
      return aux;
    },

    calcularWeight() {
      this.weight = 0;
      var inventarios = this.subInventarios(this.objeto["name"]);
      inventarios.push(this.objeto["name"]);

      for (var i = 0; i < Object.keys(this.objetos).length; i++) {
        if (this.objetos[i]["list"] == "") {
          for (
            var j = 0;
            j < Object.keys(this.objetos[i]["distribucion"]).length;
            j++
          ) {
            if (inventarios.includes(this.objetos[i]["distribucion"][j][0])) {
              this.weight +=
                this.objetos[i]["weight"] *
                this.objetos[i]["distribucion"][j][1];
            }
          }
        } else {
          if (inventarios.includes(this.objetos[i]["list"])) {
            this.weight += this.objetos[i]["weight"] * this.objetos[i]["cant"];
          }
        }
      }
    },
    estaItem(item, inventario) {
      var aux = false;
      if (item["list"] == "") {
        for (var i = 0; i < Object.keys(item["distribucion"]).length; i++) {
          if (item["distribucion"][i][0] == inventario) {
            aux = true;
          }
        }
      } else {
        if (item["list"] == inventario) {
          aux = true;
        }
      }
      return aux;
    },
    devolverF() {
      this.recalcularItem();
      var aux = [this.objeto.id, this.cantidad];
      this.$emit("objetoInfoF", aux);
    },

    abrirMapa(id) {
      this.$emit("abrirMapa", id);
    },
    abrirNota(val) {
      this.$emit("abrirNota", val);
    },
  },
  created: function () {
    this.abrirSubItem(2);
  },
};
</script>

<style scoped>
</style>