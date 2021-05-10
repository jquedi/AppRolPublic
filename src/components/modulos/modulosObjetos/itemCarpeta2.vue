<template>
  <div
    id="itemCarpeta2"
    class="bg-white border-2 border-black rounded-xl overflow-y-auto h-full w-full flex flex-col pb-10 pt-10"
    :key="componentKey"
  >
    <drop
      class="w-full h-full top-0 right-0 absolute z-10"
      @drop="handleDrop"
    ></drop>

    <!-- Opciones de inventario -->

    <button
      @click="(menu = !menu), listaInventarios2F(), (opcion = '')"
      class="w-auto h-6 top-0 right-0 absolute mt-12 mr-4 z-20"
    >
      <img
        class="h-full w-auto z-20"
        src="data:image/png;base64,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"
        alt=""
      />
    </button>
    <div
      v-if="menu"
      id="opcionMenu"
      style="height: calc(100% - 3rem)"
      class="w-content h-content top-12 right-8 absolute mt-4 mr-4 flex flex-row-reverse overflow-y-none z-20"
      v-click-outside="hide"
    >
      <div class="border-2 border-black rounded self-start z-20">
        <ul>
          <li
            class="border-b border-black"
            v-if="Object.keys(listaInventarios).length > 1"
          >
            <button @click="abrirSubMenu('Eliminar')" class="w-full">
              Eliminar inventario
            </button>
          </li>
          <li class="border-b border-black">
            <button @click="abrirSubMenu('Renombrar')" class="w-full">
              Renombrar
            </button>
          </li>
          <li
            class="border-b border-black"
            v-if="
              cantidadObjetos != 0 && Object.keys(listaInventarios).length > 1
            "
          >
            <button @click="abrirSubMenu('MoverTodo')" class="w-full">
              Mover todo
            </button>
          </li>
          <li>
            <button @click="abrirSubMenu('Compartir')" class="w-full">
              Compartir inventario
            </button>
          </li>
        </ul>
      </div>

      <!-- Opcion Eliminar inventario -->

      <div
        v-if="opcion == 'Eliminar'"
        class="max-h-80% overflow-y-auto mr-2 p-2 border-2 border-black rounded max-w-1/2 flex flex-col self-start"
      >
        <span>¿Que quieres hacer con los objetos del inventario?</span>
        <div class="flex flex-row justify-start mx-auto my-2">
          <input type="radio" id="mover" value="mover" v-model="check" />
          <span class="mx-2">Moverlos a </span>
          <select
            class="border border-black ml-2"
            name=""
            id=""
            v-model="inventarioSeleccionado"
          >
            <option
              v-for="(inventario, index) in listaInventarios2"
              :key="index"
              :value="inventario"
            >
              {{ inventario }}
            </option>
          </select>
        </div>
        <div class="flex flex-row justify-start mx-auto">
          <input type="radio" id="eliminar" value="eliminar" v-model="check" />
          <span class="mx-2">Eliminarlos todos</span>
        </div>
        <div class="w-full p-4 flex flex-row">
          <button
            class="border-2 border-black mx-auto p-1 rounded-xl bg-green-200 font-bold"
            @click="opcion = 'Eliminar2'"
          >
            Eliminar
          </button>
        </div>
      </div>

      <!-- Opcion Confirmacion Eliminar -->

      <div
        v-if="opcion == 'Eliminar2'"
        class="max-h-80% overflow-y-auto mr-2 p-2 border-2 border-black rounded max-w-1/2 flex flex-col self-start"
      >
        <span>¿Seguro que desea eliminar este inventario?</span>
        <div class="h-1/2 w-full p-4 flex flex-row">
          <button
            class="border-2 border-black mr-4 p-1 rounded-xl bg-green-200 font-bold"
            @click="eliminarF()"
          >
            Confirmar
          </button>
          <button
            @click="
              (opcion = ''), (inventarioSeleccionado = ''), (check = 'mover')
            "
            class="border-2 border-black ml-4 p-1 rounded-xl bg-red-200 font-bold"
          >
            Cancelar
          </button>
        </div>
      </div>

      <!-- Opcion Renombrar -->

      <div
        v-if="opcion == 'Renombrar'"
        class="max-h-80% overflow-y-auto mr-2 p-2 border-2 border-black rounded max-w-1/2 flex flex-col self-start"
      >
        <span>¿Como quieres llamar al inventario?</span>
        <div class="mx-auto">
          <input
            class="mt-2 border border-black"
            type="text"
            id="text"
            v-model="nuevoNombre"
          />
        </div>
        <div class="h-1/2 w-full" v-if="nameExist">
          <span
            class="text-xs text-red-400 mt-5 w-full right-0 h-content font-bold"
            >Ya existe un inventario con ese nombre</span
          >
        </div>
        <div class="w-full p-4 flex flex-row">
          <button
            class="border-2 border-black mx-auto p-1 rounded-xl bg-green-200 font-bold"
            @click="rename()"
          >
            Renombrar
          </button>
        </div>
      </div>

      <!-- Opcion Mover todo -->

      <div
        v-if="opcion == 'MoverTodo' && cantidadObjetos != 0"
        class="max-h-80% overflow-y-auto mr-2 p-2 border-2 border-black rounded max-w-1/2 flex flex-col self-start"
      >
        <span>¿Donde quieres mover los objetos?</span>
        <div class="flex flex-row justify-start mx-auto my-2">
          <span>Mover a </span>
          <select
            class="border border-black ml-2"
            name=""
            id=""
            v-model="inventarioSeleccionado"
          >
            <option
              v-for="(inventario, index) in listaInventarios2"
              :key="index"
              :value="inventario"
            >
              {{ inventario }}
            </option>
          </select>
        </div>
        <div class="w-full p-4 flex flex-row">
          <button
            class="border-2 border-black mx-auto p-1 rounded-xl bg-green-200 font-bold"
            @click="moverF(inventarioSeleccionado)"
          >
            Mover
          </button>
        </div>
      </div>

      <!-- Opcion Compartir -->

      <div
        v-if="opcion == 'Compartir'"
        class="mr-2 max-h-80% overflow-y-auto p-2 border-2 border-black rounded max-w-1/2 flex flex-col self-start"
      >
        <span>¿Con quien quieres compartir este inventario?</span>
        <div class="flex flex-row justify-start mx-auto my-2">
          <input
            class="mr-2"
            type="checkbox"
            id="checkbox"
            v-model="nuevoNombre"
          />
          <span>Jugador 1</span>
        </div>
        <div class="flex flex-row justify-start mx-auto my-2">
          <input
            class="mr-2"
            type="checkbox"
            id="checkbox"
            v-model="nuevoNombre"
          />
          <span>Jugador 2</span>
        </div>
        <div class="flex flex-row justify-start mx-auto my-2">
          <input
            class="mr-2"
            type="checkbox"
            id="checkbox"
            v-model="nuevoNombre"
          />
          <span>Jugador 3</span>
        </div>
        <div class="flex flex-row justify-start mx-auto my-2">
          <input
            class="mr-2"
            type="checkbox"
            id="checkbox"
            v-model="nuevoNombre"
          />
          <span>Jugador 4</span>
        </div>
        <div class="flex flex-row justify-start mx-auto my-2">
          <input
            class="mr-2"
            type="checkbox"
            id="checkbox"
            v-model="nuevoNombre"
          />
          <span>Jugador 5</span>
        </div>
      </div>
    </div>

    <!-- Filtro por tipos -->

    <div
      class="w-content h-6 top-0 right-0 absolute mt-4 mr-4 border border-black z-20"
    >
      <select v-model="filtro" name="" id="">
        <option value=""></option>
        <option
          v-for="(type, index) in types"
          v-bind:key="index"
          v-bind:value="type"
        >
          {{ type }}
        </option>
      </select>
    </div>

    <!-- Objetos -->

    <div
      class="flex-none z-20 h-content w-content"
      v-for="(objeto, index) in objetos"
      v-bind:key="index"
    >
      <item2
        v-if="estaItem(objeto, inventarioSelected) && id2 != objeto['id']"
        v-bind:objeto="objeto"
        v-bind:objetos="objetos"
        v-bind:filtro="filtro"
        v-bind:inventario="inventarioSelected"
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

    <!-- Papelera -->

    <drop
      class="w-content h-10 bottom-8 right-0 absolute mb-1 z-20 bg-red-200 mr-6"
      @drop="handleDropPapelera"
      @click="hidePapelera = !hidePapelera"
    >
      <div class="w-content h-10 relative flex flex-row cursor-pointer">
        <img
          @click="hidePapelera = !hidePapelera"
          class="h-full"
          src="https://image.flaticon.com/icons/png/512/39/39220.png"
          alt=""
        />
        <div
          v-if="!hidePapelera"
          class="right-0 bg-red-200 opacity-80 absolute w-content p-2 bottom-calc1 mx-auto rounded-lg"
        >
          <div class="absolute h-7px w-content -bottom-7px right-4">
            <div class="arrow-bot2 relative bottom-0 mt-auto ml-0"></div>
          </div>

          <div v-for="(item, index) in objetos" :key="index">
            <itemPapelera
              v-if="estaItem(item, 'Papelera')"
              v-bind:objeto="item"
              v-bind:rutaPre="listaInventarios[0]"
              @objetoInfoF="objetoInfoF"
            />
          </div>
        </div>
      </div>
    </drop>

    <!-- Peso y monedas -->

    <div
      class="w-content h-6 bottom-0 right-0 absolute mb-1 flex flex-row-reverse border-t border-l border-black z-20"
    >
      <div
        class="h-full flex flex-row relative"
        @mouseover="hover = 'weight'"
        @mouseleave="hover = ''"
      >
        <p class="font-bold oldstyle-nums text-lg">{{ weight.toFixed(2) }}</p>
        <img
          class="h-full mr-6 ml-2"
          src="https://d1nhio0ox7pgb.cloudfront.net/_img/o_collection_png/green_dark_grey/512x512/plain/weight.png"
          alt=""
        />
        <div
          v-if="hover == 'weight'"
          class="bg-gray-800 opacity-80 absolute w-content p-2 bottom-calc1 mx-auto text-white rounded-lg"
        >
          <div class="absolute h-7px w-full -bottom-7px left-0">
            <div class="arrow-bot relative bottom-0 mt-auto mx-auto"></div>
          </div>

          Peso del inventario
        </div>
      </div>
      <div
        v-for="(coin, index) in coins"
        v-bind:key="index"
        class="h-full flex flex-row relative"
        @mouseover="hover = coin[1]"
        @mouseleave="hover = ''"
      >
        <p class="font-bold oldstyle-nums text-lg">{{ coin[3] }}</p>
        <img class="h-full mr-6 ml-2" v-bind:src="coin[2]" alt="" />
        <div
          v-if="hover == coin[1]"
          class="bg-gray-800 opacity-80 absolute w-content p-2 bottom-calc1 mx-auto text-white rounded-lg"
        >
          <div class="absolute h-7px w-full -bottom-7px left-0">
            <div class="arrow-bot relative bottom-0 mt-auto mx-auto"></div>
          </div>

          {{ coin[1] }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import item2 from "@/components/modulos/modulosObjetos/modulosCarpeta/item2.vue";
import ClickOutside from "vue-click-outside";
import itemPapelera from "@/components/modulos/modulosObjetos/modulosCarpeta/itemPapelera.vue";

export default {
  name: "itemCarpeta2",
  components: {
    item2,
    itemPapelera,
  },
  props: {
    objetos: Object,
    listaInventarios: Array,
    inventarioSelected: String,
    destino: String,
    origen: String,
    id2: Number,
    player: Object,
  },
  data() {
    return {
      weight: 0,
      coins: {},
      types: {},
      filtro: "",
      hover: "",
      opcion: "",
      menu: false,
      cantidadObjetos: 0,
      cantidadInventarios: 0,
      nuevoNombre: "",
      inventarioSeleccionado: "",
      listaInventarios2: [],
      check: "mover",
      nameExist: false,
      ruta2: this.ruta,
      componentKey: 0,
      hidePapelera: true,
    };
  },
  watch: {
    objetos: function () {
      this.cargarCarpeta();
    },
    inventarioSelected: function () {
      this.filtro = "";
      this.cargarCarpeta();
    },
    destino: function (val) {
      if (val == this.inventarioSelected) {
        this.$emit("resetRuta", 0);
        this.cargarCarpeta();
      }
    },
    origen: function (val) {
      if (val == this.inventarioSelected) {
        this.$emit("resetRuta", 1);
        this.cargarCarpeta();
      }
    },
  },
  methods: {
    resetRuta(val) {
      this.$emit("resetRuta", val);
    },

    moverItem2(val) {
      this.$emit("moverItem2", val);
    },

    handleDropPapelera(val) {
      var aux = {
        id: val.id,
        origen: val.origen,
        destino: "Papelera",
      };

      this.$emit("moverItem2", aux);
    },

    handleDrop(val) {
      var aux = {
        id: val.id,
        origen: val.origen,
        destino: this.inventarioSelected,
        action: val.action,
      };

      this.$emit("moverItem2", aux);
    },

    // Llama a la funcion eliminar despues de hacer lo debido con los items
    eliminarF() {
      if (this.check == "mover") {
        this.moverF(this.inventarioSeleccionado);
        this.eliminarF2(this.inventarioSelected);
      }
      if (this.check == "eliminar") {
        this.moverF("Papelera");
        this.eliminarF2(this.inventarioSelected);
      }
      this.hide();
    },

    // Elimina el inventario con todo dentro
    eliminarF2(val) {
      this.$emit("eliminarInventario", val);
    },

    // cierra el menu de opciones

    hide() {
      this.opcion = "";
      this.menu = false;
      this.nuevoNombre = "";
      this.inventarioSeleccionado = "";
      this.listaInventarios2 = [];
      this.check = "mover";
      this.nameExist = false;
    },

    // Crea la lista de inventarios menos el actual
    listaInventarios2F() {
      this.$emit("inventariosF");

      var index = this.listaInventarios.indexOf(this.inventarioSelected);
      if (index > -1) {
        var j = 0;
        for (var i = 0; i < this.listaInventarios.length; i++) {
          j++;
          if (i != index) {
            this.listaInventarios2[j] = this.listaInventarios[i];
          } else {
            j--;
          }
        }
      }
      this.cantidadInventarios = this.listaInventarios.length;
    },

    // Cambia la propiedad list de cada objeto del inventario
    cambiarList(val) {
      for (var i = 0; i < Object.keys(this.objetos).length; i++) {
        if (this.objetos[i]["list"] == "") {
          for (
            var j = 0;
            j < Object.keys(this.objetos[i]["distribucion"]).length;
            j++
          ) {
            if (
              this.inventarioSelected == this.objetos[i]["distribucion"][j][0]
            ) {
              this.objetos[i]["distribucion"][j][0] = val;
            }
          }
        } else {
          if (this.inventarioSelected == this.objetos[i]["list"]) {
            this.objetos[i]["list"] = val;
          }
        }
      }
      axios
      .post("/php/moveAllObjects.php", {
        inventoryOld: this.inventarioSelected,
        inventoryNew: val,
        system: this.player.system,
        game: this.player.game,
        personaje: this.player.character,
      });
    },

    // Cambia el nombre al inventario
    rename() {
      this.nameExist = false;
      for (var i = 0; i < this.listaInventarios.length; i++) {
        if (this.listaInventarios[i] == this.nuevoNombre) {
          this.nameExist = true;
        }
      }

      if (!this.nameExist) {
        this.$emit("renameInventory", this.nuevoNombre);
        this.cambiarList(this.nuevoNombre);
        this.hide();
      }
    },

    // Mover todos los items a otro inventario
    moverF(val) {
      this.cambiarList(val);

      this.$emit("moverTodos", val);
      this.hide();
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
      var inventarios = [this.inventarioSelected];

      var objetos = this.objetosEnInventario(inventarios);

      this.cantidadObjetos = Object.keys(objetos).length;
    },
    abrirSubMenu(val) {
      if (val == this.opcion) {
        this.opcion = "";
      } else {
        if (val == "Eliminar") {
          if (this.cantidadObjetos > 0) {
            this.opcion = val;
          } else {
            this.opcion = "Eliminar2";
          }
        } else {
          this.opcion = val;
        }
      }
    },
    typesF() {
      this.types = 0;
      var aux = [];

      var inventarios = [this.inventarioSelected];

      var objetos = this.objetosEnInventario(inventarios);

      for (var i = 0; i < Object.keys(objetos).length; i++) {
        if (!aux.includes(objetos[i]["type"])) {
          aux.push(objetos[i]["type"]);
        }
      }
      this.types = aux;
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
      var inventarios = this.subInventarios(this.inventarioSelected);
      inventarios.push(this.inventarioSelected);

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

    calcularDinero() {
      this.coins = [];
      var inventarios = this.subInventarios(this.inventarioSelected);
      inventarios.push(this.inventarioSelected);
      var aux = [];
      for (var i = 0; i < Object.keys(this.objetos).length; i++) {
        if (this.objetos[i]["list"] == "") {
          for (
            var j = 0;
            j < Object.keys(this.objetos[i]["distribucion"]).length;
            j++
          ) {
            if (
              inventarios.includes(this.objetos[i]["distribucion"][j][0]) &&
              this.objetos[i]["type"] == "money"
            ) {
              aux.push(this.objetos[i]["id"]);
              aux.push(this.objetos[i]["name"]);
              aux.push(this.objetos[i]["image"]);
              aux.push(this.objetos[i]["distribucion"][j][1]);
              this.coins.push(aux);
              aux = [];
            }
          }
        } else {
          if (
            inventarios.includes(this.objetos[i]["list"]) &&
            this.objetos[i]["type"] == "money"
          ) {
            aux.push(this.objetos[i]["id"]);
            aux.push(this.objetos[i]["name"]);
            aux.push(this.objetos[i]["image"]);
            aux.push(this.objetos[i]["cant"]);
            this.coins.push(aux);
            aux = [];
          }
        }
      }
      this.coins = this.combinarCoins(this.coins);
    },
    combinarCoins(coins) {
      for (var i = 0; i < coins.length; i++) {
        for (var j = 0; j < coins.length; j++) {
          if (i != j && coins[i][0] == coins[j][0]) {
            coins[i][3] += coins[j][3];
            coins.splice(j, 1);
          }
        }
      }
      return coins;
    },

    objetoInfoF(val) {
      this.$emit("objetoInfoF", val);
    },
    cargarCarpeta() {
      this.calcularWeight();
      this.calcularDinero();
      this.typesF();
      this.cantidadObjetosF();
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

    abrirMapa(id) {
      this.$emit("abrirMapa", id);
    },
    abrirNota(val) {
      this.$emit("abrirNota", val);
    },
  },
  created: function () {
    this.cargarCarpeta();
  },
  mounted() {
    this.popupItem = this.$el;
  },
  directives: {
    ClickOutside,
  },
};
</script>

<style scoped>
:focus {
  outline: none;
}
.arrow-bot {
  width: 0;
  height: 0;
  border-left: 7px solid transparent;
  border-right: 7px solid transparent;
  border-top: 7px solid #1f2937;
}
.arrow-bot2 {
  width: 0;
  height: 0;
  border-left: 7px solid transparent;
  border-right: 7px solid transparent;
  border-top: 7px solid rgba(254, 202, 202, var(--tw-bg-opacity));
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