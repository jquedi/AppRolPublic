<template>
  <div
    id="graficaPoligonal"
    class="h-full w-full overflow-y-auto overflow-x-hidden"
    :class="grid"
    v-resize="onResize2"
  >
    <!-- Poligono completo -->
    <div id="poligonoID" v-resize="onResize" class="h-full" :class="hideSM">
      <!-- Etiquetas de stat -->
      <span
        v-for="(estadistica, index) in estadisticas2"
        v-bind:key="index"
        :style="positionTag(index, 1)"
        class="absolute w-60px"
      >
        <button
          style="background: none"
          class="font-mono italic font-bold text-yellow-900"
          :class="selected(index, 1)"
          @click="selectF(index)"
        >
          {{ estadistica.acronim }}
        </button>
      </span>

      <svg height="100%" width="100%">
        <!-- Poligono stats maximos -->
        <polygon
          :points="pointsRefs(100)"
          class="stroke-current text-blue-900 stroke-1"
          style="fill: blue; fill-opacity: 0.1"
        />
        <!-- Poligono stats 75% -->
        <polygon
          :points="pointsRefs(75)"
          class="stroke-current text-blue-900 stroke-1"
          style="fill: none"
        />
        <!-- Poligono stats medios -->
        <polygon
          :points="pointsRefs(50)"
          class="stroke-current text-blue-900 stroke-1"
          style="fill: none"
        />
        <!-- Poligono stats 25% -->
        <polygon
          :points="pointsRefs(25)"
          class="stroke-current text-blue-900 stroke-1"
          style="fill: none"
        />
        <!-- poligono stats -->
        <polygon
          :points="points"
          class="stroke-current text-blue-900 stroke-1"
          style="fill: lime; fill-opacity: 0.7"
        />
        <!-- Punto central -->
        <circle
          cx="50%"
          cy="50%"
          r="1"
          style="fill: none; stroke: purple; stroke-width: 1"
        ></circle>
      </svg>
    </div>
    <!-- tabla stats -->

    <div class="h-full w-full py-2 xl:px-5 2xl:px-10 px-2 flex flex-col space-y-3 relative" :class="hideSM2">
      <div class="w-full" v-for="(estadistica, index) in estadisticas" :key="index">
        <div v-if="estadistica.hide == 0 && indexSelected == -1" class="flex flex-row w-full h-12 relative">
          <div @click="selectF(index)" class="bg-blue-100 w-3/4 h-full border border-black flex rounded-l-lg rounded-r z-20 cursor-pointer">
            <div class="self-center mx-auto">{{estadistica.name}}</div> 
          </div>
          <div class="bg-white w-1/4 h-full border border-black flex rounded-r-lg rounded-l absolute right-1 z-10">
            <div class="self-center mx-auto flex flex-row">
              <div class="relative flex flex-row" v-if="estadistica.actual != null">
                <div class="absolute w-full h-1 top-0 "> <div @click="editarStat(0, 1, estadistica)" class="arrow-top-mini inset-x-0 mx-auto cursor-pointer"></div></div>
                <div class="absolute w-full h-1 bottom-0"> <div @click="editarStat(0, -1, estadistica)" class="arrow-bottom-mini inset-x-0 mx-auto cursor-pointer"></div></div>
                <p :style="modificadoActual(estadistica.actual, estadistica.total)" class="py-1">{{estadistica.actual}}</p><p>/</p>
              </div>
              <div :style="modificado(estadistica.total, estadistica.base)" class="relative">
                <div v-if="estadistica.editable" class="absolute w-full h-1 top-0 "> <div @click="editarStat(1, 0, estadistica)" class="arrow-top-mini inset-x-0 mx-auto cursor-pointer"></div></div>
                <div v-if="estadistica.editable" class="absolute w-full h-1 bottom-0"> <div @click="editarStat(-1, 0, estadistica)" class="arrow-bottom-mini inset-x-0 mx-auto cursor-pointer"></div></div>
                <p @click="effectInfoF(estadistica.acronim)" :class="modificadoCursor(estadistica.total, estadistica.base)"  class="py-1">{{estadistica.total}}</p> 
              </div>
            </div> 
          </div>
        </div>
        <div v-if="Object.keys(estadistica.effects).length > 0 && effectInfo.includes(estadistica.acronim) == true" class="bg-white border border-black rounded-b-lg p-2 pt-3 -top-2 relative mr-1">
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
      </div>


      <div v-if="indexSelected != -1" class="flex flex-col h-content absolute top-4 w-full left-0 border-black border bg-blue-100 p-2 rounded">
        
        <div
          v-if="indexSelected != -1"
          @click="selectF(-1)"
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

    </div>








    <!-- <div class="h-full w-full py-2 xl:px-5 2xl:px-10 px-2" :class="hideSM2">
      <table class="h-full w-full border-separate font-mono italic">
        <thead>
          <tr>
            <td class="not-italic underline font-bold text-red-900 text-xl">
              <div
                v-if="info"
                @click="selectF(-1)"
                class="arrow-left absolute cursor-pointer"
              ></div>
              Stat
            </td>
            <td class="not-italic underline font-bold text-red-900 text-xl">
              Value
            </td>
          </tr>
        </thead>
        <tbody>
          <div
            class="contents"
            v-for="(estadistica, index) in estadisticas"
            v-bind:key="index"
          >
            <div v-if="estadistica.hide == 0" class="contents">
              <tr
                class="h-content"
                v-if="indexSelected == index || indexSelected == -1"
              >
                <td
                  class="text-left border-b border-black break-words relative"
                  :class="selected(index, 2)"
                >
                  <div
                    v-if="
                      hoverInfo == estadistica.acronim &&
                      estadistica.total != estadistica.base
                    "
                    class="absolute right-7px flex flex-col bg-white border border-black rounded z-50"
                  >
                    <div class="arrow-right absolute left-full"></div>
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
                  <button
                    v-if="
                      hoverInfo != estadistica.acronim ||
                      estadistica.total == estadistica.base
                    "
                    :class="selected(index, 2)"
                    @click="selectF(index)"
                  >
                    {{ estadistica.name }}
                  </button>
                </td>
                <td
                  class="text-left border-b border-l border-black relative flex h-full"
                  @mouseover="hoverInfo = estadistica.acronim"
                  @mouseleave="hoverInfo = ''"
                  :style="modificado(estadistica.total, estadistica.base)"
                  :class="selected(index, 2)"
                >
                  <div
                    v-if="estadistica.editable == 1"
                    class="absolute left-0 h-full flex p-1"
                  >
                    <div
                      @click="editarStat(-1, estadistica)"
                      class="arrow-left-mini self-center cursor-pointer"
                    ></div>
                  </div>
                  <div
                    v-if="estadistica.editable == 1"
                    class="absolute right-0 h-full flex p-1"
                  >
                    <div
                      @click="editarStat(1, estadistica)"
                      class="arrow-right-mini self-center cursor-pointer"
                    ></div>
                  </div>

                  <p class="self-center inset-x-0 mx-auto">
                    {{ estadistica.total }}
                  </p>
                </td>
              </tr>
            </div>
          </div>
          <tr class="align-baseline" v-if="indexSelected != '-1'">
            <td colspan="2">
              {{ descriptionSelected }}

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
            </td>
          </tr>
        </tbody>
      </table>
    </div> -->
  </div>
</template>

<script>
export default {
  name: "graficaPoligonal",
  components: {},
  props: {
    estadisticas: Object,
    resetPoligon: Number,
  },
  data() {
    return {
      effectInfo: [],
      points: "",
      points2: "",
      height: 0,
      width: 0,
      width2: 0,
      indexSelected: -1,
      seleccionado: {},
      descriptionSelected: "",
      smallMode: -1,
      grid: "",
      hideSM: "",
      hideSM2: "overflow-y-auto",

      estadisticas2: {},

      // valor: 0,
      // base: 0,
      // effects: {},
      // info: false,
    };
  },
  mounted: function () {
    this.getWidthF();
  },
  watch: {
    resetPoligon: function (val) {
      if (val > 0) {
        this.createPolygonF();
        this.$emit("resetPoligonF", 0);
      }
    },
    width2: function (val) {
      if (val < 335) {
        this.smallMode = 1;
      } else {
        this.smallMode = 0;
      }
    },
    smallMode: function (val) {
      if (val == 1) {
        this.grid = "";
        if (this.indexSelected != -1) {
          this.hideSM = "hidden";
          this.hideSM2 = "block overflow-y-visible";
        } else {
          this.hideSM = "block";
          this.hideSM2 = "block overflow-y-visible";
        }
      } else {
        this.grid = "grid grid-cols-2";

        this.hideSM = "block";
        this.hideSM2 = "block overflow-y-auto";
      }
      this.createPolygonF();
    },
    indexSelected: function (val) {
      if (this.smallMode == 1) {
        if (val != -1) {
          this.hideSM = "hidden";
          this.hideSM2 = "block overflow-y-visible";
        } else {
          this.hideSM = "block";
          this.hideSM2 = "block overflow-y-visible";
        }
      } else {
        this.hideSM = "block";
        this.hideSM2 = "block overflow-y-auto";
      }
    },
  },
  methods: {
    effectInfoF(val){
      if(this.effectInfo.includes(val)){
        this.effectInfo.splice(this.effectInfo.indexOf(val), 1);
      }else{
        this.effectInfo.push(val);
      }
    },
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
    modificadoCursor(total, base) {
      var aux = "";
      if (total > base) {
        aux = "cursor-pointer";
      }
      if (base > total) {
        aux = "cursor-pointer";
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
    getWidthF() {
      if (document.getElementById("graficaPoligonal").offsetWidth >= 335) {
        this.width =
          document.getElementById("graficaPoligonal").offsetWidth / 2;
      } else {
        this.width = document.getElementById("graficaPoligonal").offsetWidth;
      }
      this.width2 = document.getElementById("graficaPoligonal").offsetWidth;
      this.height = document.getElementById("poligonoID").offsetHeight;
    },
    selectF(index) {
      if (index == -1) {
        this.seleccionado = {};
        this.indexSelected = -1;
      } else {
        if (index == this.indexSelected) {
          this.seleccionado = {};
          this.indexSelected = -1;
        } else {
          this.seleccionado = this.estadisticas[index];
          this.indexSelected = index;
        }
      }
    },

    selected: function (index, num) {
      if (index == this.indexSelected) {
        var aux = "text-blue-700 font-bold text-lg";
      } else if (this.indexSelected == -1) {
        aux = "";
      } else if (index != this.indexSelected && num == 2) {
        aux = "hidden";
      }

      return aux;
    },

    positionTag: function (index) {
      var longitud = Object.keys(this.estadisticas2).length;

      var porcentaje =
        (this.estadisticas2[index].maximunStat /
          this.estadisticas2[index].maximunStat) *
        100;

      var aux = this.valueToPointTag(porcentaje, index, longitud);

      var sin = aux.sin;
      var cos = aux.cos;

      var align = "";

      if (cos < -0.9) {
        align = "center";
      } else if (cos > 0.9) {
        align = "center";
      } else if (sin < 0) {
        align = "right";
      } else if (sin > 0) {
        align = "left";
      }

      return {
        left: aux.x + "px",
        top: aux.y + "px",
        textAlign: align,
      };
    },

    onResize({ width, height }) {
      this.width = width;
      this.height = height;
      this.createPolygonF();
    },

    onResize2({ width }) {
      this.width2 = width;
    },

    valueToPoint(value, index, total) {
      if (this.height < this.width) {
        var value2 = value * ((this.height - 80) / 200);
      } else {
        value2 = value * ((this.width - 80) / 200);
      }

      var x = 0;
      var y = -value2 * 1;
      var angle = ((Math.PI * 2) / total) * index;
      var cos = Math.cos(angle);
      var sin = Math.sin(angle);
      var tx = x * cos - y * sin + this.width / 2;
      var ty = x * sin + y * cos + this.height / 2;
      return {
        x: tx,
        y: ty,
      };
    },

    valueToPointTag(value, index, total) {
      var angle = ((Math.PI * 2) / total) * index;
      var cos = Math.cos(angle);
      var sin = Math.sin(angle);

      if (this.height < this.width) {
        var value2 = value * ((this.height - 80) / 200);
      } else {
        value2 = value * ((this.width - 80) / 200);
      }

      var x = 0;
      var y = -value2 * 1;

      var tx = x * cos - y * sin + this.width / 2;
      var ty = x * sin + y * cos + this.height / 2;

      if (cos < -0.9) {
        tx = tx - 30;
      } else if (cos > 0.9) {
        tx = tx - 30;
      } else if (sin < 0) {
        tx = tx - 65;
      } else if (sin > 0) {
        tx = tx + 5;
      }

      if (sin < -0.9 || sin > 0.9) {
        ty = ty - 12;
      } else if (cos < 0) {
        ty = ty - 0;
      } else if (cos > 0) {
        ty = ty - 25;
      }

      return {
        x: tx,
        y: ty,
        cos: cos,
        sin: sin,
      };
    },

    pointsRefs(porcentaje) {
      // Poligono maximo

      var aux = "";
      var aux2 = "";
      var longitud = Object.keys(this.estadisticas2).length;

      for (var i = 0; i < longitud; i++) {
        aux = this.valueToPoint(porcentaje, i, longitud);

        aux2 = aux2 + " " + aux.x + "," + aux.y;
      }

      return aux2;
    },

    estadisticas2F() {
      this.estadisticas2 = {};
      for (var i = 0; i < Object.keys(this.estadisticas).length; i++) {
        if (this.estadisticas[i].hide == 0) {
          this.estadisticas2[
            Object.keys(this.estadisticas2).length
          ] = this.estadisticas[i];
        }
      }
    },

    createPolygonF() {
      this.estadisticas2F();
      var longitud1 = Object.keys(this.estadisticas2).length;
      var porcentaje1 = 1;

      // Poligono Valores

      var aux = "";

      var longitud = Object.keys(this.estadisticas2).length;


      var aux2 = "";
      var porcentaje = 0;

      for (var i = 0; i < longitud; i++) {
        porcentaje =
          (this.estadisticas2[i].total / this.estadisticas2[i].maximunStat) *
          100;

        if (porcentaje < 0) {
          porcentaje = 0;
        }

        aux = this.valueToPoint(porcentaje, i, longitud);

        aux2 = aux2 + " " + aux.x + "," + aux.y;
      }

      this.points = aux2;

      // Poligono tags

      var aux3 = "";

      var aux13 = "";

      for (var i1 = 0; i1 < longitud1; i1++) {
        porcentaje1 =
          (this.estadisticas2[i1].maximunStat /
            this.estadisticas2[i1].maximunStat) *
          100;

        aux3 = this.valueToPointTag(porcentaje1, i1, longitud1);

        aux13 = aux13 + " " + aux3.x + "," + aux3.y;
      }
    },
  },
  created: function () {
    this.$emit("resetPoligonF", 0);
    this.estadisticas2F();
  },
};
</script>

<style scoped>
.arrow-right {
  width: 0;
  height: 0;
  border-top: 7px solid transparent;
  border-bottom: 7px solid transparent;
  border-left: 7px solid #1f2937;
}
.arrow-left {
  width: 0;
  height: 0;
  border-bottom: 10px solid transparent;
  border-top: 10px solid transparent;
  border-right: 10px solid #1f2937;
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