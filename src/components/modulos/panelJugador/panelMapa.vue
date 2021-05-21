<template>
  <div
    id="panelMapa"
    class="w-full h-full bg-gray-200 rounded-lg border-2 border-black"
    @click="focusF"
  >
    <div
      @click="toggleElement"
      class="absolute top-0 right-0 bg-red-400 cursor-pointer z-60"
    >
      X
    </div>
    <div
      class="w-1/4 absolute text-left overflow-auto scrollbar-thin text-opacity-70 bottom-0 h-full"
    >
      <BtnCloseSlide2 direccion="left" @CerrarLista="CerrarLista" />
      <transition name="hideLista">
        <div
          class="px-2 py-6 border-r border-black h-full w-full bg-gray-500 absolute z-10 overflow-auto"
          v-if="!hideLista"
        >
          <div class="mb-4 flex flex-col">
            <div
              class="relative rounded-lg border border-black overflow-hidden"
              v-for="(mapa, index) in mapas"
              :key="index"
            >
              <div
                :style="styleSelected(mapa.id)"
                @click="(selected = mapa), (zoom = 100), (zoomStyle = '')"
                class="cursor-pointer w-full bg-white p-2 italic font-bold underline"
              >
                <div class="max-h-20 w-20 bg-black float-left mr-2">
                  <img :src="mapa.image" alt="" />
                </div>

                <span>{{ mapa.name }}</span>
              </div>
            </div>
          </div>
          <div
            class="w-full bg-white rounded-lg border border-black p-2 mb-4 italic font-bold underline"
            v-if="Object.keys(mapas).length < 1"
          >
            Vacio
          </div>
        </div>
      </transition>
    </div>
    <div
      :class="width"
      class="py-6 px-4 bg-gray-400 absolute h-full right-0 transition-all duration-700 delay-0"
    >
      <div
        class="h-full w-full bg-white border-2 border-red-400 rounded-3xl py-6 px-4 overflow-hidden relative"
      >
        <img
          :style="zoomStyle + topStyle + leftStyle"
          class="object-contain w-full relative"
          :src="selected.image"
          alt=""
        />
        <div v-if="zoomed" class="absolute w-full top-4 inset-x-0">
          <button
            @mousedown="slide('top')"
            @mouseleave="stop()"
            @mouseup="stop()"
            @touchstart="slide('top')"
            @touchend="stop()"
            @touchcancel="stop()"
            class="hover:opacity-100 opacity-50 inset-x-0 mx-auto flecha-top cursor-pointer"
          ></button>
        </div>
        <div v-if="zoomed" class="absolute w-full bottom-4 inset-x-0">
          <div
            @mousedown="slide('bottom')"
            @mouseleave="stop()"
            @mouseup="stop()"
            @touchstart="slide('bottom')"
            @touchend="stop()"
            @touchcancel="stop()"
            class="hover:opacity-100 opacity-50 inset-x-0 mx-auto flecha-bot cursor-pointer"
          ></div>
        </div>
        <div v-if="zoomed" class="absolute h-full right-4 inset-y-0 flex">
          <div
            @mousedown="slide('right')"
            @mouseleave="stop()"
            @mouseup="stop()"
            @touchstart="slide('right')"
            @touchend="stop()"
            @touchcancel="stop()"
            class="hover:opacity-100 opacity-50 self-center flecha-derecha cursor-pointer"
          ></div>
        </div>
        <div v-if="zoomed" class="absolute h-full left-4 inset-y-0 flex">
          <div
            @mousedown="slide('left')"
            @mouseleave="stop()"
            @mouseup="stop()"
            @touchstart="slide('left')"
            @touchend="stop()"
            @touchcancel="stop()"
            class="hover:opacity-100 opacity-50 self-center flecha-izquierda cursor-pointer"
          ></div>
        </div>
        <div class="absolute right-4 bottom-4 flex flex-col">
          <label class="font-bold text-lg" for="vol">{{ zoom }}%</label>
          <div class="flex flex-row">
            <span class="text-bold text-lg m-2">-</span>
            <input
              type="range"
              id="vol"
              name="vol"
              min="100"
              max="300"
              v-model="zoom"
            /><span class="text-bold text-lg m-2">+</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BtnCloseSlide2 from "@/components/otros/BtnCloseSlide2.vue";
export default {
  name: "panelMapa",
  components: {
    BtnCloseSlide2,
  },
  props: {
    items: Object,
    mapaSE: Number,
  },
  data() {
    return {
      interval: false,
      hideLista: false,
      zoom: 100,
      zoomStyle: "",
      zoomed: false,
      left: 0,
      top: 0,
      leftStyle: "",
      topStyle: "",
      selected: {},
      width: "w-3/4",
      mapas: {},
      stopV: false,
    };
  },
  watch: {
    mapaSE: function (val) {
      if (val > -1) {
        this.buscarMapas();
      }
    },
    top: function (val) {
      this.topStyle = "top: " + val + "%;";
    },
    left: function (val) {
      this.leftStyle = "left: " + val + "%;";
    },
    zoom: function (val) {
      var aux = val / 100;
      this.zoomStyle = "transform: scale(" + aux + ");";

      if (val > 100) {
        this.zoomed = true;

        if (this.left < 0) {
          this.left = this.left + 1;
        }
        if (this.left > 0) {
          this.left = this.left - 1;
        }
        if (this.top < 0) {
          this.top = this.top + 1;
        }
        if (this.top > 0) {
          this.top = this.top - 1;
        }
      } else {
        this.zoomed = false;
        this.left = 0;
        this.top = 0;
      }
    },
  },
  methods: {
    toggleElement() {
      this.$emit("toggleElement", "maps");
    },
    focusF() {
      this.$emit("focusF", "mapas");
    },
    sleep(ms) {
      return new Promise((resolve) => setTimeout(resolve, ms));
    },

    stop() {
      this.stopV = true;
    },

    async slide(val) {
      this.stopV = false;
      while (!this.stopV) {
        if (val == "right") {
          var aux = (this.zoom - 100) / 100;
          if (this.left < -aux * 50) {
            this.stop();
          } else {
            this.left = this.left - aux * 0.5;
          }
        }
        if (val == "left") {
          aux = (this.zoom - 100) / 100;

          if (this.left > aux * 50) {
            this.stop();
          } else {
            this.left = this.left + aux * 0.5;
          }
        }
        if (val == "bottom") {
          aux = (this.zoom - 100) / 100;

          if (this.top < -aux * 50) {
            this.stop();
          } else {
            this.top = this.top - aux * 0.5;
          }
        }
        if (val == "top") {
          aux = (this.zoom - 100) / 100;

          if (this.top > aux * 50) {
            this.stop();
          } else {
            this.top = this.top + aux * 0.5;
          }
        }
        await this.sleep(30);
      }
    },
    styleSelected(val) {
      if (val == this.selected.id) {
        var aux = "background: yellow;";
      } else {
        aux = "";
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
    buscarMapas() {
      this.mapas = {};
      for (var i = 1; i < Object.keys(this.items).length; i++) {
        if (this.items[i]["type"] == "Map") {
          this.mapas[Object.keys(this.mapas).length] = this.items[i];
        }
      }
      if (Object.keys(this.mapas).length > 0) {
        if (this.mapaSE != -1) {
          var index = this.buscarMapaPorID(this.mapaSE);
          this.selected = this.mapas[index];
          this.$emit("abrirMapa", -1);
        } else {
          this.selected = this.mapas[0];
        }
      }
    },
    buscarMapaPorID(id) {
      var aux = -1;
      for (var j = 0; j < Object.keys(this.mapas).length; j++) {
        if (this.mapas[j]["id"] == id) {
          aux = j;
        }
      }
      return aux;
    },
  },
  created: function () {
    this.buscarMapas();
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

.flecha-derecha {
  width: 0;
  height: 0;
  border-top: 30px solid transparent;
  border-bottom: 30px solid transparent;
  border-left: 30px solid black;
}
.flecha-izquierda {
  width: 0;
  height: 0;
  border-top: 30px solid transparent;
  border-bottom: 30px solid transparent;
  border-right: 30px solid black;
}
.flecha-top {
  width: 0;
  height: 0;
  border-right: 30px solid transparent;
  border-left: 30px solid transparent;
  border-bottom: 30px solid black;
}
.flecha-bot {
  width: 0;
  height: 0;
  border-right: 30px solid transparent;
  border-left: 30px solid transparent;
  border-top: 30px solid black;
}
</style>