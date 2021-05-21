<template>
  <div
    id="objetos"
    class="overflow-hidden h-full w-full bg-gray-200 rounded-2xl border-2 border-red-700 flex flex-rows p-4 z-20"
    @click="focusF"
  >
    <!-- Pestañas de inventarios -->

    <div class="h-calc1 w-full mt-6 mx-4 flex-grow relative">
      <div
        class="absolute h-6 w-full -top-6 px-4 flex flex-row overflow-x-auto"
      >
        <div
          v-for="(inventario, index) in inventarios"
          v-bind:key="index"
          @click="guardarRutaInventario(index)"
        >
          <div
            v-bind:style="inventarioSelectedF(index)"
            v-if="index > 0"
            class="bg-blue-400 border-2 border-black border-b-0 px-2 rounded-t-lg cursor-pointer ml-1"
          >
            <drop
              class="h-full w-full"
              @drop="handleDrop"
              @dragenter="drop = index"
            >
              {{ inventario.name }}
            </drop>
          </div>
        </div>
        <div
          class="bg-green-300 border-2 border-black border-b-0 px-2 rounded-t-lg font-bold cursor-pointer ml-1"
          @click="addInventoryWindow = true"
        >
          +
        </div>
      </div>
      <itemCarpeta2
        v-bind:objetos="list"
        v-bind:listaInventarios="inventariosLista"
        v-bind:inventarioSelected="inventarios[inventarioSelected]['name']"
        :id2="id2"
        :origen="origen2"
        :player="player"
        :destino="destino2"
        @resetRuta="resetRuta"
        @moverItem2="handleDrop2"
        @objetoInfoF="objetoInfoF"
        @inventariosF="inventariosF"
        @renameInventory="renameInventory"
        @moverTodos="sumarDistribuciones"
        @eliminarInventario="eliminarInventario"
        @abrirMapa="abrirMapa"
        @abrirNota="abrirNota"
      />
    </div>

    <!-- Info de objeto seleccionado -->

    <div
      v-if="infoAbierta"
      class="bg-red-200 h-full w-full border-2 border-black mx-4 max-w-1/4 min-w-250px rounded-xl overflow-hidden"
    >
      <itemInfo v-bind:objeto="objetoInfo" v-bind:list="list" />
    </div>

    <!-- Confirmar crear nueva pestaña inventario -->

    <div
      v-if="addInventoryWindow"
      class="bg-gray-700 bg-opacity-70 h-full w-full flex-none absolute top-0 left-0 z-50"
    >
      <div
        class="bg-white w-60 h-content absolute inset-0 m-auto border border-black rounded-2xl flex flex-col py-2"
      >
        <div class="h-1/2 w-full">
          <span class="mt-5 w-full right-0 h-content font-bold"
            >Nombre nuevo inventario</span
          >
          <input
            class="border border-black mx-auto rounded-full px-1"
            placeholder="New"
            type="text"
            v-model="newInventory"
          />
        </div>
        <div class="h-1/2 w-full" v-if="nameExist">
          <span
            class="text-xs text-red-400 mt-5 w-full right-0 h-content font-bold"
            >Ya existe un inventario con ese nombre</span
          >
        </div>
        <div class="h-1/2 w-full p-4">
          <button
            class="border-2 border-black mr-4 p-1 rounded-xl bg-green-200 font-bold"
            @click="addInventoryF()"
          >
            Añadir
          </button>
          <button
            @click="addInventoryWindow = false"
            class="border-2 border-black ml-4 p-1 rounded-xl bg-red-200 font-bold"
          >
            Cancelar
          </button>
        </div>
      </div>
    </div>

    <!-- Confirmar mover item entre inventarios -->

    <div
      v-if="moveItemWindow"
      class="bg-gray-700 bg-opacity-70 h-full w-full flex-none absolute top-0 left-0 z-50"
    >
      <div
        class="bg-white w-60 h-40 absolute inset-0 m-auto border border-black rounded-2xl"
      >
        <div class="h-1/2 w-full relative">
          <span class="absolute mt-5 w-full right-0 h-content font-bold"
            >Cantidad a pasar</span
          >
          <input
            class="border border-black bottom-0 absolute inset-x-0 mx-auto rounded-full px-1"
            type="number"
            v-model="cantidad"
            min="0"
            max="100"
          />
        </div>
        <div class="h-1/2 w-full p-4">
          <button
            class="border-2 border-black mr-4 p-1 rounded-xl bg-green-200 font-bold"
            @click="moverItem2(mover), (moveItemWindow = false)"
          >
            Mover
          </button>
          <button
            @click="moveItemWindow = false"
            class="border-2 border-black ml-4 p-1 rounded-xl bg-red-200 font-bold"
          >
            Cancelar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import itemCarpeta2 from "@/components/modulos/panelJugador/modulosObjetos/itemCarpeta2.vue";
import itemInfo from "@/components/modulos/panelJugador/modulosObjetos/itemInfo.vue";

export default {
  name: "objetos",
  components: {
    itemCarpeta2,
    itemInfo,
  },
  props: {
    list: Object,
    inventarios: Object,
    player: Object,
  },
  data() {
    return {
      mover: "",
      objetoInfo: [],
      infoAbierta: false,
      inventarioSelected: 1,
      addInventoryWindow: false,
      newInventory: "",
      drop: "",
      listaVacia: {
        name: "",
        block: false,
        compartir: [],
      },
      moveItemWindow: false,
      cantidad: 1,
      inventariosLista: [],
      nameExist: false,
      ruta: {},
      destino: "",
      destino2: "",
      origen2: "",
      id2: -1,
    };
  },
  watch: {
    inventarios: function () {
      this.inventariosF();
    },
  },
  methods: {
    resetRuta(val) {
      if (val == 0) {
        this.destino2 = "";
      }
      if (val == 1) {
        this.origen2 = "";
      }
      if (val == 2) {
        this.id2 = -1;
      }
    },

    // Guarda la ruta y el index del inventario actual
    guardarRutaInventario(index) {
      if (index == 0) {
        this.inventarioSelected = 1;
      } else {
        this.inventarioSelected = parseInt(index);
      }
    },

    // Elimina el inventario con todo dentro
    eliminarInventario(val) {
      var query2 =
        "DELETE FROM `inventories` WHERE `id` = " +
        this.inventarios[this.inventarioSelected]["id"];
      var query =
        "DELETE FROM `inventoriesAccess` WHERE `inventory` = " +
        this.inventarios[this.inventarioSelected]["id"];

      axios
        .post("/php/update.php", {
          consulta: query,
        })
        .then(() => {

            axios
            .post("/php/update.php", {
              consulta: query2,
            })
            .then(() => {
              for (var i = 0; i < Object.keys(this.inventarios).length; i++) {
                if (this.inventarios[i]["name"] == val) {
                  this.$delete(this.inventarios, i);
                  this.arreglarLista();
                  break;
                }
              }
              this.inventarioSelected = 1;
            });
        });
    },

    // Elimina los inventarios que no existen
    arreglarLista() {
      for (var i = 0; i < Object.keys(this.inventarios).length; i++) {
        if (this.inventarios[i] == null) {
          for (var j = i; j < Object.keys(this.inventarios).length; j++) {
            this.inventarios[j] = this.inventarios[j + 1];
          }
          this.$delete(
            this.inventarios,
            Object.keys(this.inventarios).length - 1
          );
        }
      }
      this.inventariosF();
    },

    // Crea la lista de inventarios (Array)

    inventariosF() {
      this.inventariosLista = [];
      for (var i = 1; i < Object.keys(this.inventarios).length; i++) {
        this.inventariosLista[i - 1] = this.inventarios[i]["name"];
      }
    },

    // cambia el nombre del inventario actual

    renameInventory(val) {
      var query =
        "UPDATE `inventories` SET `name` = '" +
        val +
        "' WHERE `name` = '" +
        this.inventarios[this.inventarioSelected]["name"] +
        "' AND `system` = " +
        this.player.system +
        " AND `game` = " +
        this.player.game +
        " AND `personaje` = " +
        this.player.character;

      axios
        .post("/php/update.php", {
          consulta: query,
        })
        .then(() => {
          this.inventarios[this.inventarioSelected]["name"] = val;
          this.inventariosF();
        });
    },

    // Crear nuevo inventario

    addInventoryF() {
      this.nameExist = false;
      for (var i = 0; i < Object.keys(this.inventarios).length; i++) {
        if (this.inventarios[i]["name"] == this.newInventory) {
          this.nameExist = true;
        }
      }

      if (!this.nameExist) {
        if (this.newInventory != "") {
          var aux = this.listaVacia;
          aux["name"] = this.newInventory;
          this.inventarios[Object.keys(this.inventarios).length] = aux;

          axios.post("/php/createInventory.php", {
            name: this.newInventory,
            system: this.player.system,
            game: this.player.game,
            personaje: this.player.character,
          });

          this.newInventory = "";
        }
        this.inventariosF();

        this.listaVacia = {
          name: "",
          block: false,
          compartir: [],
        };
        this.addInventoryWindow = false;
        this.nameExist = false;
      }
    },

    // Abrir info objeto

    objetoInfoF(val) {
      if (this.objetoInfo[0] == val[0] && this.objetoInfo[1] == val[1]) {
        this.infoAbierta = false;
        this.objetoInfo = [];
      } else {
        this.infoAbierta = true;
        this.objetoInfo = val;
      }
    },

    // -------------------------------------------------------------------------------------------------------------- Nuevas-------------------------------------------------------------------------------

    // Remarcar inventario actual

    inventarioSelectedF(val) {
      if (this.inventarioSelected == val) {
        return "background: gold";
      }
    },

    // Dropear item en pestaña

    handleDrop(val) {
      var item = this.buscarItemPorID(val.id);
      this.destino = this.inventarios[this.drop]["name"];

      if (this.destino != val.origen) {

        if(item["list"] != ""){
          var cant2 = item["cant"];
        }else{
          cant2 = item["distribucion"][this.posicionDistribucion(item, val.origen)][1];
        }

        if (cant2 > 1) {
          this.moveItemWindow = true;
          this.mover = val;
        } else {
          this.cantidad = 0;
          this.moverItemF(val.id, this.destino, val.origen, this.cantidad);
        }
      }
      if (val.action == "unEquip") {
        this.unEquipF(val.id);
      }
    },

    // Dropear item en carpeta, contenedor o papelera

    handleDrop2(val) {
      if (val.destino != val.origen) {
        var item = this.buscarItemPorID(val.id);
        this.destino = val.destino;

        if(item["list"] != ""){
          var cant2 = item["cant"];
        }else{
          cant2 = item["distribucion"][this.posicionDistribucion(item, val.origen)][1];
        }

        if (cant2 > 1) {
          this.moveItemWindow = true;
          this.mover = val;
        } else {
          this.cantidad = 0;
          this.moverItemF(val.id, val.destino, val.origen, this.cantidad);
        }
      }
      if (val.action == "unEquip") {
        this.unEquipF(val.id);
      }
    },

    // mover despues de decidir cantidad

    moverItem2(val) {
      if (val.destino != val.origen) {
        var item = this.buscarItemPorID(val.id);

        if (item["list"] == "") {
          var cant =
            item["distribucion"][
              this.posicionDistribucion(item, val.origen)
            ][1] - this.cantidad;
        } else {
          cant = item["cant"] - this.cantidad;
        }

        this.moverItemF(val.id, this.destino, val.origen, cant);
      }

      if (val.action == "unEquip") {
        this.unEquipF(val.id);
      }
    },

    buscarItemPorID(id) {
      var aux = -1;
      for (var i = 0; i < Object.keys(this.list).length; i++) {
        if (id == this.list[i]["id"]) {
          aux = this.list[i];
          break;
        }
      }
      return aux;
    },
    buscarItemPorIDPosicion(id) {
      var aux = -1;
      for (var i = 0; i < Object.keys(this.list).length; i++) {
        if (id == this.list[i]["id"]) {
          aux = i;
          break;
        }
      }
      return aux;
    },

    posicionDistribucion(item, distribucion) {
      var aux = -1;
      for (var i = 0; i < Object.keys(item["distribucion"]).length; i++) {
        if (item["distribucion"][i][0] == distribucion) {
          aux = i;
          break;
        }
      }
      return aux;
    },

    sumarDistribuciones() {
      for (var i = 0; i < Object.keys(this.list).length; i++) {
        if (this.list[i]["list"] == "") {
          for (
            var j = 0;
            j < Object.keys(this.list[i]["distribucion"]).length;
            j++
          ) {
            for (
              var i2 = 0;
              i2 < Object.keys(this.list[i]["distribucion"]).length;
              i2++
            ) {
              if (
                j != i2 &&
                this.list[i]["distribucion"][j][0] ==
                  this.list[i]["distribucion"][i2][0]
              ) {
                this.list[i]["distribucion"][j][1] += this.list[i][
                  "distribucion"
                ][i2][1];
                this.list[i]["distribucion"][i2][1] = 0;
                this.borrarDistribucciones0(i);
              }
            }
          }
        }
      }
    },

    borrarDistribucciones0(index) {
      for (
        var i = 0;
        i < Object.keys(this.list[index]["distribucion"]).length;
        i++
      ) {
        if (this.list[index]["distribucion"][i][1] < 1) {
          this.$delete(this.list[index]["distribucion"], i);
        }
      }
      this.reorganizarLista(this.list[index]["distribucion"]);
    },
    reorganizarLista(ruta) {
      for (var i = 0; i < Object.keys(ruta).length; i++) {
        if (ruta[i] == null) {
          for (var j = i; j < Object.keys(ruta).length; j++) {
            ruta[j] = ruta[j + 1];
          }
          this.$delete(ruta, Object.keys(ruta).length - 1);
        }
      }
    },


    equipedOrigenF(id, destino){
      var query = "UPDATE `objectsPersonaje` SET `equipedOrigen`= '" + destino + "' WHERE `id` =" + id;

      axios.post("/php/update.php", {
        consulta: query,
      });
    },



    // Funcion para mover objetos entre inventarios

    moverItemF(id, destino, origen, cantidad) {
      var item = this.buscarItemPorID(id);
      var index = this.buscarItemPorIDPosicion(id);

      // Si el item está distribuido entre varios inventarios

      if (item["list"] == "") {
        var distribucionOrigen = this.posicionDistribucion(item, origen);
        var distribucionDestino = this.posicionDistribucion(item, destino);

        var canOrigen = this.list[index]["distribucion"][distribucionOrigen][1];

        this.list[index]["distribucion"][distribucionOrigen][1] = cantidad;

        // Si ese objeto ya existe en el destino
        if (distribucionDestino > -1) {
          var canDestino =
            this.list[index]["distribucion"][distribucionDestino][1] +
            (canOrigen - cantidad);
          this.list[index]["distribucion"][distribucionDestino][1] +=
            canOrigen - cantidad;

          axios.post("/php/moveObject.php", {
            opcion: 1,
            object: item.id,
            origen: origen,
            destino: destino,
            cantidadOrigen: cantidad,
            cantidadDestino: canDestino,
          });
        } else {
          this.list[index]["distribucion"][
            Object.keys(this.list[index]["distribucion"]).length
          ] = [destino, canOrigen - cantidad];

          axios.post("/php/moveObject.php", {
            opcion: 2,
            object: item.id,
            origen: origen,
            destino: destino,
            cantidadOrigen: cantidad,
            cantidadDestino: canOrigen - cantidad,
          });
        }

        this.borrarDistribucciones0(index);

        if (Object.keys(this.list[index]["distribucion"]).length <= 1) {
          this.list[index]["distribucion"] = {};
          this.list[index]["list"] = destino;
        }
      }

      // Si el item está solo en un inventario
      else {
        // si se desplaza el stack entero
        if (cantidad == 0) {
          this.list[index]["list"] = destino;

          axios.post("/php/moveObject.php", {
            opcion: 2,
            object: item.id,
            origen: origen,
            destino: destino,
            cantidadOrigen: cantidad,
            cantidadDestino: this.list[index]["cant"] - cantidad,
          });
        } else {
          this.list[index]["distribucion"][
            Object.keys(this.list[index]["distribucion"]).length
          ] = [destino, this.list[index]["cant"] - cantidad];
          this.list[index]["distribucion"][
            Object.keys(this.list[index]["distribucion"]).length
          ] = [origen, cantidad];

          this.list[index]["list"] = "";

          axios.post("/php/moveObject.php", {
            opcion: 2,
            object: item.id,
            origen: origen,
            destino: destino,
            cantidadOrigen: cantidad,
            cantidadDestino: this.list[index]["cant"] - cantidad,
          });
        }
      }
      
      if(cantidad == 0 && this.list[index]["equiped"] > 0){
        this.equipedOrigenF(id, destino);
      }

      this.enviarID(id);
      this.origen2 = origen;
      this.destino2 = destino;

      this.cantidad = 0;
      this.destino = "";
    },
    enviarID(id) {
      this.id2 = id;
    },

    focusF() {
      this.$emit("focusF", "objetos");
    },

    abrirMapa(id) {
      this.$emit("abrirMapa", id);
    },

    abrirNota(val) {
      this.$emit("abrirNota", val);
    },
    unEquipF(id) {
      for (var i = 0; i < Object.keys(this.list).length; i++) {
        if (this.list[i]["id"] == id) {
          this.list[i]["equiped"] = 0;
          this.list[i]["equipedOrigen"] = "";
        }
      }
    },
  },
  created: function () {
    this.inventariosF();
    this.guardarRutaInventario(0);
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