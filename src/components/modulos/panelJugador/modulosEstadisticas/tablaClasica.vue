<template>
  <div id="tablaClasica" class="h-full w-full">
    <div
       v-if="indexSelected == -1"
      class="overflow-y-auto space-x-4 w-content h-full flex flex-row flex-wrap p-5% content-start justify-around"
    >
      <div v-for="(estadistica, index) in estadisticas" v-bind:key="index">
        <div
          class="flex-1 my-4 border border-red-800 relative rounded-lg bg-white w-20"
          :class="marginFirst(index)"
          v-if="estadistica.hide == 0"
        >
          <div
            v-if="
              hoverInfo == estadistica.acronim &&
              estadistica.total != estadistica.base
            "
            class="absolute left-full flex flex-col bg-white border border-black rounded z-50"
          >
            <div class="absolute left-full"></div>
            <div
              class="flex flex-row"
              v-for="(effect, index) in estadistica.effects"
              :key="index"
              :style="modificado(effect[1], 0)"
            >
              <p v-if="effect[0] == '+' && effect[1] > 0">+</p>
              <p>{{ effect[1] }}</p>
              <p v-if="effect[0] == '%'">%</p>
              <p class="ml-1">{{ effect[2] }}</p>
            </div>
          </div>
          <div class="flex flex-col h-full">
            <button
              @click="infoF(index)"
              class="break-words px-4 font-mono italic font-bold tracking-wider border-b border-black"
            >
              {{ estadistica.acronim }}
            </button>
            <div
              class="oldstyle-nums font-mono italic font-bold tracking-wider border-black h-10 relative  flex"
              @mouseover="hoverInfo = estadistica.acronim"
              @mouseleave="hoverInfo = ''"
            >
              <!-- <div v-if="estadistica.editable == 1" class="absolute left-0 h-full flex p-1">
                <div @click="editarStat(-1, estadistica)" class="arrow-left-mini self-center cursor-pointer"></div>
              </div>
              <div v-if="estadistica.editable == 1" class="absolute right-0 h-full flex p-1">
                <div @click="editarStat(1, estadistica)" class="arrow-right-mini self-center cursor-pointer"></div>
              </div> -->
              <div class="self-center mx-auto flex flex-row">
                <div class="relative flex flex-row" v-if="estadistica.actual != null">
                  <div class="absolute w-full h-1 top-0 "> <div @click="editarStat(0, 1, estadistica)" class="arrow-top-mini inset-x-0 mx-auto cursor-pointer"></div></div>
                  <div class="absolute w-full h-1 bottom-0"> <div @click="editarStat(0, -1, estadistica)" class="arrow-bottom-mini inset-x-0 mx-auto cursor-pointer"></div></div>
                  <p :style="modificadoActual(estadistica.actual, estadistica.total)" class="py-1">{{estadistica.actual}}</p><p>/</p>
                </div>
                <div :style="modificado(estadistica.total, estadistica.base)" class="relative">
                  <div v-if="estadistica.editable" class="absolute w-full h-1 top-0 "> <div @click="editarStat(1, 0, estadistica)" class="arrow-top-mini inset-x-0 mx-auto cursor-pointer"></div></div>
                  <div v-if="estadistica.editable" class="absolute w-full h-1 bottom-0"> <div @click="editarStat(-1, 0, estadistica)" class="arrow-bottom-mini inset-x-0 mx-auto cursor-pointer"></div></div>
                  <p class="py-1">{{estadistica.total}}</p> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

      <div v-if="indexSelected != -1" class="flex flex-col inset-x-0 mx-auto h-content absolute top-4 w-5/6 left-0 border-black border bg-blue-100 p-2 rounded">
        
        <div
          v-if="indexSelected != -1"
          @click="infoF(-1)"
          class="arrow-left absolute cursor-pointer"
        ></div>

        <div class="inset-x-0 mx-auto text-2xl font-bold border-b-2 border-black w-full">{{estadisticas[indexSelected].name}}</div>
        <div class="flex flex-row w-full mt-4">
          <div v-if="estadisticas[indexSelected].total != estadisticas[indexSelected].base" class="inset-x-0 mx-auto flex flex-col border border-black rounded-lg">
            <div class="inset-x-0 mx-auto border-b-2 border-black pt-2 px-2 bg-blue-400 rounded-t-lg font-bold">
              BASE
            </div>
            <div class="inset-x-0 mx-auto h-full w-full pt-3 pb-2 px-2 bg-white rounded-b-lg font-bold">
            {{estadisticas[indexSelected].base}}
            </div>
          </div>
          <div class="inset-x-0 mx-auto flex flex-col border border-black rounded-lg">
            <div class="inset-x-0 mx-auto border-b-2 border-black pt-2 px-2 bg-blue-400 rounded-t-lg font-bold">
              TOTAL
            </div>
            <div class="inset-x-0 mx-auto w-full pb-2 pt-2 bg-white rounded-b-lg font-bold">
              <div class="self-center mx-auto flex flex-row w-content">
                <div class="relative flex flex-row" v-if="estadisticas[indexSelected].actual != null">
                  <div class="absolute w-full h-1 top-0 "> <div @click="editarStat(0, 1, estadisticas[indexSelected])" class="arrow-top-mini inset-x-0 mx-auto cursor-pointer"></div></div>
                  <div class="absolute w-full h-1 bottom-0"> <div @click="editarStat(0, -1, estadisticas[indexSelected])" class="arrow-bottom-mini inset-x-0 mx-auto cursor-pointer"></div></div>
                  <p :style="modificadoActual(estadisticas[indexSelected].actual, estadisticas[indexSelected].total)" class="py-1">{{estadisticas[indexSelected].actual}}</p><p>/</p>
                </div>
                <div :style="modificado(estadisticas[indexSelected].total, estadisticas[indexSelected].base)" class="relative">
                  <div v-if="estadisticas[indexSelected].editable" class="absolute w-full h-1 top-0 "> <div @click="editarStat(1, 0, estadisticas[indexSelected])" class="arrow-top-mini inset-x-0 mx-auto cursor-pointer"></div></div>
                  <div v-if="estadisticas[indexSelected].editable" class="absolute w-full h-1 bottom-0"> <div @click="editarStat(-1, 0, estadisticas[indexSelected])" class="arrow-bottom-mini inset-x-0 mx-auto cursor-pointer"></div></div>
                  <p class="py-1">{{estadisticas[indexSelected].total}}</p> 
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="inset-x-0 mx-auto mt-4 text-left">{{estadisticas[indexSelected].description}}</div>
        <div v-if="estadisticas[indexSelected].total != estadisticas[indexSelected].base" class="inset-x-0 mx-auto mt-4 text-left">
          <div
            class="flex flex-row"
            v-for="(effect, index) in estadisticas[indexSelected].effects"
            :key="index"
            :style="modificado(effect[1], 0)"
          >
            <p v-if="effect[0] == '+' && effect[1] > 0">+</p>
            <p>{{ effect[1] }}</p>
            <p v-if="effect[0] == '%'">%</p>
            <p class="ml-1">{{ effect[2] }}</p>
          </div>
        </div>
      </div>





    <!-- <div v-if="info" class="my-4 mx-2">
      <div @click="infoF(-1)" class="arrow-left absolute cursor-pointer"></div>
      <div class="flex flex-col grid-flow-row h-full">
        <button
          @click="infoF(-1)"
          class="break-words px-4 text-2xl font-mono italic font-bold tracking-wider border-b border-black"
        >
          {{ nombre }}
        </button>
        <div
          class="oldstyle-nums text-2xl font-mono italic font-bold tracking-wider border-black"
          :style="modificado(valor, base)"
        >
          {{ valor }}
        </div>
        <div class="break-words mt-4 font-mono italic tracking-wider">
          {{ descripcion }}
        </div>
        <div
          v-for="(effect, index) in effects"
          :key="index"
          class="break-words mt-4 font-mono italic tracking-wider flex flex-row"
          :style="modificado(effect[1], 0)"
        >
          <p v-if="effect[0] == '+' && effect[1] > 0">+</p>
          <p>{{ effect[1] }}</p>
          <p v-if="effect[0] == '%'">%</p>
          <p class="ml-1">{{ effect[2] }}</p>
        </div>
      </div>
    </div> -->
  </div>
</template>

<script>
export default {
  name: "tablaClasica",
  components: {},
  props: {
    estadisticas: Object,
  },
  data() {
    return {
      hoverInfo: "",
      indexSelected: -1,
      seleccionado: {},
    };
  },
  methods: {
    editarStat(val, val2, estadistica) {
      var aux2 = 0;
      if(estadistica.actual == null && val2 == 0){
        aux2 = "null";
      }else{
        aux2 = estadistica.actual + val2;
      }
      var aux = {
        base: estadistica.base + val,
        actual: aux2,
        id: estadistica.id,
      };

      this.$emit("editarStat", aux);
    },
    marginFirst(index){
      var aux = 0;
      if(index == 0){
        aux = "ml-4";
      }
      return aux;
    },
    modificadoActual(total, base) {
      var aux = "";
      if (total < base/2) {
        aux = "color: orange;";
      }
      if (base/4 > total) {
        aux = "color: red;";
      }
      return aux;
    },
    modificado(total, base) {
      var aux = "";
      if (total > base) {
        aux = "color: green;";
      }
      if (base > total) {
        aux = "color: red;";
      }
      return aux;
    },
    infoF(aux) {
      if (aux == -1) {
        this.indexSelected = -1;
        this.seleccionado = {};
      } else {
        this.indexSelected = aux;
        this.seleccionado = this.estadisticas[aux];
      }
    },
  },
};
</script>

<style scoped>
.arrow-left {
  width: 0;
  height: 0;
  border-bottom: 10px solid transparent;
  border-top: 10px solid transparent;
  border-right: 10px solid #1f2937;
}
.arrow-left-mini {
  width: 0;
  height: 0;
  border-bottom: 5px solid transparent;
  border-top: 5px solid transparent;
  border-right: 5px solid #1f2937;
}
.arrow-right-mini {
  width: 0;
  height: 0;
  border-bottom: 5px solid transparent;
  border-top: 5px solid transparent;
  border-left: 5px solid #1f2937;
}
.arrow-top-mini {
  width: 0;
  height: 0;
  border-right: 5px solid transparent;
  border-left: 5px solid transparent;
  border-bottom: 5px solid #1f2937;
}
.arrow-bottom-mini {
  width: 0;
  height: 0;
  border-right: 5px solid transparent;
  border-left: 5px solid transparent;
  border-top: 5px solid #1f2937;
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