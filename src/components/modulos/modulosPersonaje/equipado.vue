<template>
  <div id="equipado" class="h-full w-full relative">
    <div
      :style="opacityF2()"
      class="h-full w-1/4 grid grid-rows-5 bg-gray-800 max-w-120px min-w-120px px-5"
    >
      <input
        class="w-full"
        type="range"
        id="vol"
        name="vol"
        min="10"
        max="100"
        v-model="opacity"
      />
      <slotEquipado
        :style="opacityF()"
        :objeto="arma1"
        :objetos="objetos"
        :info="infoSlots['arma1']"
        fondo="https://static.vecteezy.com/system/resources/thumbnails/000/421/448/small/Sports__28131_29.jpg"
        @equipNew="equipNew"
        @unEquip="unEquip"
        @infoItem="infoItem"
      />
      <slotEquipado
        :style="opacityF()"
        :objeto="arma2"
        :objetos="objetos"
        :info="infoSlots['arma2']"
        fondo="https://static.vecteezy.com/system/resources/thumbnails/000/421/448/small/Sports__28131_29.jpg"
        @equipNew="equipNew"
        @unEquip="unEquip"
        @infoItem="infoItem"
      />
      <slotEquipado
        :style="opacityF()"
        :objeto="arma3"
        :objetos="objetos"
        :info="infoSlots['arma3']"
        fondo="https://cdn4.iconfinder.com/data/icons/sports-and-games-glyph/614/560_-_Bow-512.png"
        @equipNew="equipNew"
        @unEquip="unEquip"
        @infoItem="infoItem"
      />
      <slotEquipadoOtros
        :style="opacityF()"
        :reserOtros="reserOtros"
        :objetos="objetos"
        :info="infoSlots['otros']"
        fondo="https://d1nhio0ox7pgb.cloudfront.net/_img/o_collection_png/green_dark_grey/512x512/plain/helmet.png"
        @equipNew="equipNew"
        @unEquip="unEquip"
        @infoItem="infoItem"
        @guardarOtros="guardarOtros"
        @resetOtrosF="resetOtrosF"
      />
    </div>
    <div
      :style="opacityF2()"
      class="h-full w-1/4 grid grid-rows-5 bg-gray-800 max-w-120px px-5 min-w-120px absolute right-0 top-0"
    >
      <slotEquipado
        :style="opacityF()"
        :objeto="cabeza"
        :objetos="objetos"
        :info="infoSlots['cabeza']"
        fondo="https://d1nhio0ox7pgb.cloudfront.net/_img/o_collection_png/green_dark_grey/512x512/plain/helmet.png"
        @equipNew="equipNew"
        @unEquip="unEquip"
        @infoItem="infoItem"
      />
      <slotEquipado
        :style="opacityF()"
        :objeto="pecho"
        :objetos="objetos"
        :info="infoSlots['pecho']"
        fondo="https://cdn2.iconfinder.com/data/icons/rpg-fantasy-game-basic-ui/512/equipment_costume_armor_glove_body_metal_knight_warrior_protection-512.png"
        @equipNew="equipNew"
        @unEquip="unEquip"
        @infoItem="infoItem"
      />
      <slotEquipado
        :style="opacityF()"
        :objeto="manos"
        :objetos="objetos"
        :info="infoSlots['manos']"
        fondo="https://cdn2.iconfinder.com/data/icons/diving-elements-2/64/Diving_16-512.png"
        @equipNew="equipNew"
        @unEquip="unEquip"
        @infoItem="infoItem"
      />
      <slotEquipado
        :style="opacityF()"
        :objeto="piernas"
        :objetos="objetos"
        :info="infoSlots['piernas']"
        fondo="data:image/png;base64,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"
        @equipNew="equipNew"
        @unEquip="unEquip"
        @infoItem="infoItem"
      />
      <slotEquipado
        :style="opacityF()"
        :objeto="pies"
        :objetos="objetos"
        :info="infoSlots['pies']"
        fondo="https://cdn0.iconfinder.com/data/icons/ppe-safety-equipment-glyph/64/217_ppe-safety-equipment-protective-boots-rubber-512.png"
        @equipNew="equipNew"
        @unEquip="unEquip"
        @infoItem="infoItem"
      />
    </div>

    <div
      v-if="abrirInfo"
      :style="opacityF()"
      :class="posicionInfo"
      class="h-full w-3/4 bg-red-200 absolute overflow-y-auto flex flex-col z-50 top-0"
    >
      <button
        class="absolute text-red-900 font-bold top-0 right-0 bg-white border border-black"
        @click="(abrirInfo = false), (objetoInfo = {})"
      >
        X
      </button>
      <div class="flex flex-row">
        <div class="max-w-2/5 min-w-16">
          <img :src="objetoInfo['image']" alt="" />
        </div>
        <div class="ml-2 mt-4 font-bold underline text-3xl break-all">
          {{ objetoInfo["name"] }}
        </div>
      </div>
      <div
        v-if="Object.keys(objetoInfo['effect']).length > 0"
        class="flex flex-col"
      >
        <div class="ml-2 mt-4 font-bold underline text-xl text-left">
          EFECTOS:
        </div>
        <div
          class="ml-4 mt-4 text-lg text-left"
          v-for="(efecto, index) in objetoInfo['effect']"
          :key="index"
        >
          {{ efecto[0] }}{{ efecto[1] }}{{ efecto[2] }}
        </div>
      </div>
      <div class="flex flex-col">
        <div class="ml-2 mt-4 font-bold underline text-xl text-left">
          DESCRIPCION:
        </div>
        <div class="ml-4 mt-4 text-lg text-left">
          {{ objetoInfo["description"] }}
        </div>
      </div>
    </div>

    <div
      v-if="abrirInfoOtros"
      :style="opacityF()"
      class="left-1/4 h-full w-3/4 bg-red-200 absolute overflow-y-auto flex flex-col z-50 top-0 pt-6"
    >
      <div v-for="(item, index) in otros" :key="index">
        <div
          v-if="!otroAbierto.includes(item.id)"
          class="flex flex-row m-2 relative bg-white"
        >
          <img class="w-14 h-14" draggable="false" :src="item.image" alt="" />
          <p class="ml-2">{{ item.name }}</p>
          <button
            @click="unEquip(item.id)"
            class="absolute bottom-0 right-0 bg-white border border-black"
          >
            X
          </button>
          <button
            @click="openInfoOtroF(item.id, 1)"
            class="absolute bottom-0 inset-x-0 mx-auto bg-white border border-black"
          >
            V
          </button>
        </div>
        <div
          v-if="otroAbierto.includes(item.id)"
          class="bg-white flex flex-col m-2 relative"
        >
          <div class="flex flex-row">
            <img class="w-20 h-20" draggable="false" :src="item.image" alt="" />
            <div class="ml-2 mt-4 font-bold underline text-xl">
              {{ item.name }}
            </div>
          </div>
          <div class="flex flex-col">
            <div class="ml-2 mt-4 font-bold underline text-xl">EFECTOS:</div>
            <div
              v-for="(efecto, index) in item.effect"
              :key="index"
              class="ml-2 mt-1 text-md text-left"
            >
              {{ efecto[0] }}{{ efecto[1] }}{{ efecto[2] }}
            </div>
          </div>
          <div class="flex flex-col">
            <div class="ml-2 mt-4 font-bold underline text-xl">
              Descripcion:
            </div>
            <div class="ml-2 mt-1 text-md text-left mb-6">
              {{ item.description }}
            </div>
          </div>

          <button
            @click="openInfoOtroF(item.id, 0)"
            class="absolute bottom-0 inset-x-0 mx-auto bg-white border border-black"
          >
            V
          </button>
        </div>
      </div>

      <button
        class="absolute text-red-900 font-bold top-0 right-0 bg-white border border-black"
        @click="
          (abrirInfoOtros = false), (abrirInfo = false), (objetoInfo = {})
        "
      >
        X
      </button>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import slotEquipado from "@/components/modulos/modulosPersonaje//modulosEquipado/slotEquipado.vue";
import slotEquipadoOtros from "@/components/modulos/modulosPersonaje//modulosEquipado/slotEquipadoOtros.vue";

export default {
  name: "equipado",
  components: {
    slotEquipado,
    slotEquipadoOtros,
  },
  props: {
    objetos: Object,
    opacidadPadre: Number,
  },
  data() {
    return {
      objetoInfo: {},
      posicionInfo: "",
      abrirInfo: false,
      abrirInfoOtros: false,
      reserOtros: 0,
      otroAbierto: [],
      opacity: this.opacidadPadre,
      cabeza: {},
      pecho: {},
      manos: {},
      piernas: {},
      pies: {},
      arma1: {},
      arma2: {},
      arma3: {},
      otros: {},

      infoSlots: {
        cabeza: {
          type: ["Head"],
          valor: 1,
        },
        pecho: {
          type: ["Armor"],
          valor: 2,
        },
        manos: {
          type: ["Golve", "Ring"],
          valor: 3,
        },
        piernas: {
          type: ["Pants"],
          valor: 4,
        },
        pies: {
          type: ["Boots", "Ring"],
          valor: 5,
        },
        arma1: {
          type: ["Weapon", "Shield", "Fire Weapon"],
          valor: 6,
        },
        arma2: {
          type: ["Weapon", "Shield", "Fire Weapon"],
          valor: 7,
        },
        arma3: {
          type: ["Weapon", "Shield", "Fire Weapon"],
          valor: 8,
        },
        otros: {
          type: [
            "Weapon",
            "Shield",
            "Fire Weapon",
            "Head",
            "Armor",
            "Golve",
            "Ring",
            "Pants",
            "Boots",
            "Accesory",
          ],
          valor: 9,
        },
      },
    };
  },
  watch: {
    opacity: function (val) {
      this.$emit("cambioOpacidad", val);
    },
  },
  methods: {
    guardarOtros(val) {
      this.otros = val;
    },
    resetOtrosF(val) {
      this.reserOtros = val;
    },
    openInfoOtroF(id, action) {
      if (action == 1) {
        this.otroAbierto.push(id);
      } else {
        var index = this.otroAbierto.indexOf(id);
        this.otroAbierto.splice(index, 1);
      }
    },

    opacityF() {
      var aux = "opacity: " + this.opacity / 100 + ";";
      return aux;
    },
    opacityF2() {
      var aux = "--tw-bg-opacity: " + this.opacity / 100 + ";";
      return aux;
    },
    asignarItemSlot() {
      this.cabeza = {};
      this.pecho = {};
      this.manos = {};
      this.piernas = {};
      this.pies = {};
      this.arma1 = {};
      this.arma2 = {};
      this.arma3 = {};

      for (var i = 0; i < Object.keys(this.objetos).length; i++) {
        if (this.objetos[i]["equiped"] == 1) {
          this.cabeza = this.objetos[i];
        }
        if (this.objetos[i]["equiped"] == 2) {
          this.pecho = this.objetos[i];
        }
        if (this.objetos[i]["equiped"] == 3) {
          this.manos = this.objetos[i];
        }
        if (this.objetos[i]["equiped"] == 4) {
          this.piernas = this.objetos[i];
        }
        if (this.objetos[i]["equiped"] == 5) {
          this.pies = this.objetos[i];
        }
        if (this.objetos[i]["equiped"] == 6) {
          this.arma1 = this.objetos[i];
        }
        if (this.objetos[i]["equiped"] == 7) {
          this.arma2 = this.objetos[i];
        }
        if (this.objetos[i]["equiped"] == 8) {
          this.arma3 = this.objetos[i];
        }
      }
    },
    updateF(query){
        axios
          .post("/php/update.php", {
            consulta: query,
          });
    },
    equipNew(val) {
      if (val[0] > -1) {
        for (var i = 0; i < Object.keys(this.objetos).length; i++) {
          if (this.objetos[i].id == val[0]) {
            this.objetos[i]["equiped"] = 0;
            this.objetos[i]["equipedOrigen"] = "";
            var query = "UPDATE `objectsPersonaje` SET `equiped`= 0 ,`equipedOrigen`= '' WHERE `id` = " + val[0];
            this.updateF(query);
          }
        }
      }

      for (var j = 0; j < Object.keys(this.objetos).length; j++) {
        if (this.objetos[j].id == val[1]) {
          this.objetos[j]["equiped"] = val[2];
          this.objetos[j]["equipedOrigen"] = val[3];
          query = "UPDATE `objectsPersonaje` SET `equiped`= " + val[2] + " ,`equipedOrigen`= '" + val[3] + "' WHERE `id` = " + val[1];
          this.updateF(query);
        }
      }
      this.$emit("resetStats", 1);
      this.$emit("resetHabilities", 1);
      this.asignarItemSlot();
    },
    unEquip(val) {
      for (var i = 0; i < Object.keys(this.objetos).length; i++) {
        if (this.objetos[i].id == val) {
          this.objetos[i]["equiped"] = 0;
          this.objetos[i]["equipedOrigen"] = "";
          var query = "UPDATE `objectsPersonaje` SET `equiped`= 0 ,`equipedOrigen`= '' WHERE `id` = " + val;
          this.updateF(query);
        }
      }
      this.$emit("resetStats", 1);
      this.$emit("resetHabilities", 1);

      this.reserOtros = 1;
      this.asignarItemSlot();
    },
    infoItem(val) {
      if (val == 1) {
        if (this.objetoInfo == this.cabeza) {
          this.abrirInfo = false;
          this.objetoInfo = {};
        } else {
          this.abrirInfo = true;
          this.abrirInfoOtros = false;
          this.posicionInfo = "";

          this.objetoInfo = this.cabeza;
        }
      }
      if (val == 2) {
        if (this.objetoInfo == this.pecho) {
          this.abrirInfo = false;
          this.objetoInfo = {};
        } else {
          this.abrirInfo = true;
          this.abrirInfoOtros = false;

          this.posicionInfo = "";

          this.objetoInfo = this.pecho;
        }
      }
      if (val == 3) {
        if (this.objetoInfo == this.manos) {
          this.abrirInfo = false;
          this.objetoInfo = {};
        } else {
          this.abrirInfo = true;
          this.abrirInfoOtros = false;

          this.posicionInfo = "";

          this.objetoInfo = this.manos;
        }
      }
      if (val == 4) {
        if (this.objetoInfo == this.piernas) {
          this.abrirInfo = false;
          this.objetoInfo = {};
        } else {
          this.abrirInfo = true;
          this.abrirInfoOtros = false;

          this.posicionInfo = "";

          this.objetoInfo = this.piernas;
        }
      }
      if (val == 5) {
        if (this.objetoInfo == this.pies) {
          this.abrirInfo = false;
          this.objetoInfo = {};
        } else {
          this.abrirInfo = true;
          this.abrirInfoOtros = false;

          this.posicionInfo = "";

          this.objetoInfo = this.pies;
        }
      }
      if (val == 6) {
        if (this.objetoInfo == this.arma1) {
          this.abrirInfo = false;
          this.objetoInfo = {};
        } else {
          this.abrirInfo = true;
          this.abrirInfoOtros = false;

          this.posicionInfo = "left-1/4";

          this.objetoInfo = this.arma1;
        }
      }
      if (val == 7) {
        if (this.objetoInfo == this.arma2) {
          this.abrirInfo = false;
          this.objetoInfo = {};
        } else {
          this.abrirInfo = true;
          this.abrirInfoOtros = false;

          this.posicionInfo = "left-1/4";

          this.objetoInfo = this.arma2;
        }
      }
      if (val == 8) {
        if (this.objetoInfo == this.arma3) {
          this.abrirInfo = false;
          this.objetoInfo = {};
        } else {
          this.abrirInfo = true;
          this.abrirInfoOtros = false;

          this.posicionInfo = "left-1/4";

          this.objetoInfo = this.arma3;
        }
      }
      if (val == 9) {
        if (this.abrirInfoOtros == true) {
          this.abrirInfoOtros = false;
        } else {
          this.abrirInfoOtros = true;
          this.abrirInfo = false;
          this.objetoInfo = {};
        }
      }
    },
  },
  created: function () {
    this.asignarItemSlot();
  },
};
</script>

<style scoped>
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