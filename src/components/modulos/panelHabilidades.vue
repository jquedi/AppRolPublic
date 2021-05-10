<template>
  <div id="panelHabilidades" class="h-full w-full" @click="focusF">
    <div class="w-5/6 min-w-content bg-red-200 grid grid-cols-2">
      <button
        class="border border-b-0 border-black"
        :style="styleclassSelectedF('Habilidades')"
        @click="selectClassF('Habilidades')"
      >
        Habilidades
      </button>
      <button
        class="border border-b-0 border-black"
        :style="styleclassSelectedF('Pasivas')"
        @click="selectClassF('Pasivas')"
      >
        Pasivas
      </button>
    </div>
    <div
      style="height: calc(100% - 16px)"
      class="w-full bg-gray-400 h-full border-2 border-black relative"
    >
      <div
        class="w-1/4 absolute text-left overflow-auto scrollbar-thin text-opacity-70 bottom-0 h-full"
      >
        <BtnCloseSlide2 direccion="left" @CerrarLista="CerrarLista" />
        <transition name="hideLista">
          <div
            class="px-2 py-6 border-r border-black h-full w-full bg-gray-500 absolute z-10 overflow-auto"
            v-if="!hideLista"
          >
            <button
              v-for="(tipo, index) in classSelectedA"
              :key="index"
              @click="typeSelected = tipo"
              :style="selectedTypeF(tipo)"
              class="bg-white border border-black rounded p-1 my-5 w-full"
            >
              {{ tipo }}
            </button>
          </div>
        </transition>
      </div>
      <div
        :class="width"
        class="py-6 px-4 bg-gray-400 absolute h-full right-0 transition-all duration-700 delay-0 overflow-y-auto"
      >
        <div class="absolute top-4 right-4">
          <select v-model="filtro" name="" id="">
            <option value="">Todas</option>
            <option
              v-for="(opcion, index) in filtros"
              :key="index"
              :value="opcion"
            >
              {{ opcion }}
            </option>
          </select>
        </div>
        <div
          v-for="(habilidad, index) in habilities"
          :key="index"
          class="flex flex-col w-full"
        >
          <div
            class="w-4/6 bg-white p-1 my-4 text-left flex flex-col relative"
            v-if="
              habilidad.type == typeSelected &&
              habilidad.class == classSelected &&
              (habilidad.atribute == filtro || filtro == '') &&
              habilidad.see == true
            "
          >
            <button
              @click="equiparHabilidad(habilidad.id)"
              :style="aplyStyleF(habilidad.equiped)"
              class="absolute top-0 right-0 h-4 w-4 rounded border-2 border-black"
            ></button>
            <button
              class="text-2xl text-left"
              @click="addOpenHabilitiesF(habilidad.id)"
            >
              {{ habilidad.name }}
            </button>
            <div
              class="flex flex-row text-sm justify-around flex-wrap space-x-4"
              v-if="!openedHabilities.includes(habilidad.id)"
            >
              <div
                class="flex flex-row"
                v-if="Object.keys(habilidad.effect).length > 0"
              >
                <p class="font-bold mr-1">Efectos:</p>
                <p v-if="habilidad.effect[0][0] == '+'">+</p>
                <p>{{ habilidad.effect[0][1] }}</p>
                <p v-if="habilidad.effect[0][0] == '%'">%</p>
                <p class="ml-1">{{ habilidad.effect[0][5] }}</p>
                <p v-if="Object.keys(habilidad.effect).length > 1">...</p>
              </div>
              <div
                class="flex flex-row"
                v-if="habilidad.difficulty['stat'] != ''"
              >
                <p class="font-bold mr-1">Dificultad:</p>
                <p>
                  {{ habilidad.difficulty.modificador }}
                  {{ habilidad.difficulty.stat }}
                </p>
              </div>
              <div class="flex flex-row" v-if="habilidad.cost.stat != ''">
                <p class="font-bold mr-1">Coste:</p>
                <p>{{ habilidad.cost.stat }} {{ habilidad.cost.value }}</p>
              </div>
              <div
                class="flex flex-row font-bold text-red-600"
                v-if="habilidad.from > -1"
              >
                {{ habilidad.fromName }}
              </div>
            </div>
            <div
              class="flex flex-col"
              v-if="openedHabilities.includes(habilidad.id)"
            >
              <div
                class="flex flex-row space-x-2"
                v-if="habilidad.atribute != ''"
              >
                <p class="font-bold">Atributo:</p>
                <p>{{ habilidad.atribute }}</p>
              </div>
              <div class="flex flex-row space-x-2">
                <p class="font-bold">Tipo:</p>
                <p>{{ habilidad.type }}</p>
              </div>
              <div class="" v-if="Object.keys(habilidad.effect).length > 0">
                <p class="font-bold">Efectos:</p>
                <div
                  class="flex flex-col"
                  v-for="(efecto, index) in habilidad.effect"
                  :key="index"
                >
                  <div class="flex flex-row">
                    <p v-if="efecto[0] == '+'">+</p>
                    <p>{{ efecto[1] }}</p>
                    <p v-if="efecto[0] == '%'">%</p>
                    <p class="ml-2">{{ efecto[2] }}</p>
                  </div>
                </div>
              </div>
              <div
                class="flex flex-row space-x-2"
                v-if="habilidad.difficulty['stat'] != ''"
              >
                <p class="font-bold">Dificultad:</p>
                <p>{{ habilidad.difficulty.modificador }}</p>
                <p>{{ habilidad.difficulty.stat }}</p>
              </div>
              <div class="flex flex-row space-x-2" v-if="habilidad.cost.stat != ''">
                <p class="font-bold">Coste:</p>
                <p>{{ habilidad.cost.value }} {{ habilidad.cost.stat }}</p>
              </div>
              <div class="flex flex-row space-x-2" v-if="habilidad.from > -1">
                <p class="font-bold">Procedencia:</p>
                <p>{{ habilidad.fromName }}</p>
              </div>
              <div class="flex flex-row space-x-2">
                <p class="font-bold">Descripción:</p>
                <p>{{ habilidad.description }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import BtnCloseSlide2 from "@/components/otros/BtnCloseSlide2.vue";
export default {
  name: "panelHabilidades",
  components: {
    BtnCloseSlide2,
  },
  props: {
    habilities: Object,
    objetos: Object,
    resetHabilitiesVar: Number,
  },
  data() {
    return {
      objetosHabilidades: [],
      filtro: "",
      filtros: [],
      typeSelected: "",
      width: "w-3/4",
      hideLista: false,
      classSelected: "Habilidades",
      classSelectedA: [],
      openedHabilities: [],
      Habilidades: [],
      Pasivas: [],
    };
  },
  watch: {
    typeSelected: function () {
      this.cargarFiltros();
    },
    habilities: function () {
      this.cargarHabilidadesF();
    },
    resetHabilitiesVar: function (val) {
      if(val != 0){
        this.cargarHabilidadesF();
        this.$emit("resetStats", 1);
        this.$emit("resetHabilities", 0);
      }
    },
  },
  methods: {
    focusF() {
      this.$emit("focusF", "habilidades");
    },
    equiparHabilidad(val) {
      for (var i = 0; i < Object.keys(this.habilities).length; i++) {
        var aux = 0;
        if (val == this.habilities[i].id) {
          if (this.habilities[i].equiped == 0) {
            aux = 1;
          } else {
            aux = 0;
          }
          this.habilities[i].equiped = aux;

          axios
          .post("/php/equipHabilitie.php", {
            id: this.habilities[i].id,
            val: aux,
          });

        }
      }
      this.$emit("resetStats", 1);
    },
    addOpenHabilitiesF(val) {
      if (this.openedHabilities.includes(val)) {
        var index = this.openedHabilities.indexOf(val);
        this.openedHabilities.splice(index, 1);
      } else {
        this.openedHabilities.push(val);
      }
    },
    aplyStyleF(val) {
      if (val == 1) {
        var aux = "background: green;";
      } else {
        aux = "";
      }
      return aux;
    },
    cargarHabilidadesF() {
      this.objetosHabilidadesF();
      this.listasClassF();
      this.cargarFiltros();
    },
    objetosHabilidadesF() {
      this.objetosHabilidades = [];
      for (var i = 0; i < Object.keys(this.objetos).length; i++) {
        if (this.objetos[i].habilities > 0 && this.objetos[i].equiped > 0) {
          this.objetosHabilidades.push(this.objetos[i].id);
        }
      }
      this.activarHabilidadesObjetos();
    },
    activarHabilidadesObjetos() {
      for (var i = 0; i < Object.keys(this.habilities).length; i++) {
        if (this.habilities[i].from > -1) {
          if (this.objetosHabilidades.includes(this.habilities[i].from)) {
            this.habilities[i].see = true;
            this.habilities[i].fromName = this.objetos[
              this.buscarItemPorIDPosicion(this.habilities[i].from)
            ].name;
          } else {
            this.habilities[i].see = false;
            this.habilities[i].equiped = 0;
          }
        }
      }
    },
    buscarItemPorIDPosicion(id) {
      var aux = -1;
      for (var i = 0; i < Object.keys(this.objetos).length; i++) {
        if (id == this.objetos[i]["id"]) {
          aux = i;
          break;
        }
      }
      return aux;
    },
    cargarFiltros() {
      var filtros2 = [];
      for (var i = 0; i < Object.keys(this.habilities).length; i++) {
        if (
          this.habilities[i]["class"] == this.classSelected &&
          this.typeSelected == this.habilities[i]["type"] &&
          !filtros2.includes(this.habilities[i]["atribute"])
        ) {
          filtros2.push(this.habilities[i]["atribute"]);
        }
      }
      if(JSON.stringify(this.filtros) != JSON.stringify(filtros2)){
        this.filtros = filtros2;
        this.filtro = "";
      }



    },
    listasClassF() {
      this.Habilidades = [];
      this.Pasivas = [];
      for (var i = 0; i < Object.keys(this.habilities).length; i++) {
        if (
          this.habilities[i]["class"] == "Habilidades" &&
          !this.Habilidades.includes(this.habilities[i]["type"])
        ) {
          this.Habilidades.push(this.habilities[i]["type"]);
        }
        if (
          this.habilities[i]["class"] == "Pasivas" &&
          !this.Pasivas.includes(this.habilities[i]["type"])
        ) {
          this.Pasivas.push(this.habilities[i]["type"]);
        }
      }
    },

    selectClassF(val) {
      this.cargarHabilidadesF();
      if (val == "Habilidades") {
        this.classSelected = "Habilidades";
        this.classSelectedA = this.Habilidades;
        if (this.Habilidades.length > 0) {
          this.typeSelected = this.Habilidades[0];
        }
      } else {
        this.classSelected = "Pasivas";
        this.classSelectedA = this.Pasivas;
        if (this.Pasivas.length > 0) {
          this.typeSelected = this.Pasivas[0];
        }
      }
      this.cargarFiltros();
    },
    styleclassSelectedF(val) {
      if (val == this.classSelected) {
        var aux = "background: green;";
      } else {
        aux = "background: red;";
      }
      return aux;
    },
    CerrarLista(val) {
      this.hideLista = val;
      if (this.hideLista) {
        this.width = "w-full";
      } else {
        this.width = "w-3/4";
      }
    },
    selectedTypeF(tipo) {
      if (tipo == this.typeSelected) {
        var aux = "background: yellow;";
      } else {
        aux = "background: white;";
      }
      return aux;
    },
  },
  created: function () {
    this.selectClassF("Habilidades");
    this.cargarHabilidadesF();
  },
};
</script>

<style scoped>
.hideLista-leave-active {
  transition: all 0.7s;
}
.hideLista-enter-active {
  transition: all 0.7s;
}
.hideLista-enter,
.hideLista-leave-to {
  transform: translateX(-100%);
}
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