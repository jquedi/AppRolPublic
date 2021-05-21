<template>
  <div
    style="z-index: 3000"
    class="w-full h-full overflow-y-auto"
    id="infoPersonaje"
  >
    <div
      @click="cerrar()"
      class="absolute h-content w-content bg-red-400 z-10 p-3 rounded-lg m-2 right-0 cursor-pointer"
    >
      Cerrar
    </div>

    <div class="h-full w-full flex flex-row bg-gray-200 overflow-hidden">
      <div class="h-full w-full">
        <div class="w-full h-2/5 flex flex-row gap-3 p-3">
          <div
            class="ring-2 ring-black rounded-xl w-content max-w-1/3 relative bg-white"
          >
            <img class="h-full inset-0 m-auto" :src="personaje.image" alt="" />
            <div
              class="flex flex-col max-w-4/5 absolute bottom-0 mx-auto inset-x-0 bg-gray-300 w-content ring-2 ring-blue-600 rounded-xl px-3 py-2 bg-opacity-90"
            >
              <div class="text-xl font-bold underline">
                {{ personaje.name }}
              </div>
              <div class="font-bold">{{ personaje.title }}</div>
            </div>
          </div>
          <div
            class="ring-2 ring-black bg-white rounded-xl w-full flex flex-col overflow-hidden"
          >
            <div
              class="h-content w-full text-xl underline font-bold text-left p-3"
            >
              TRASFONDO
            </div>
            <div class="h-full w-full overflow-y-auto text-left p-3">
              {{ personaje.background }}
            </div>
          </div>
        </div>
        <div class="w-full h-3/5 flex flex-row gap-3 p-3">
          <div
            class="ring-2 ring-black rounded-xl w-full bg-white flex flex-col overflow-y-auto pb-6"
          >
            <div
              class="flex flex-row w-full bg-blue-300 border-b-2 border-black"
              v-if="partidaSelected > -1"
            >
              <div
                class="border-r border-black w-1/4 break-words text-xl font-bold"
              >
                NOMBRE
              </div>
              <div
                class="border-r border-black w-1/4 break-words text-xl font-bold"
              >
                TIPO
              </div>
              <div
                class="border-r border-black w-1/4 break-words text-xl font-bold"
              >
                INVENTARIO
              </div>
              <div class="w-1/4 break-words text-xl font-bold">CANTIDAD</div>
            </div>
            <div v-if="partidaSelected == -1">
              TODAVIA NO HAS SELECCIONADO UNA PARTIDA
            </div>
            <div v-if="partidaSelected > -1 && Object.keys(objetos).length < 1">
              Este personaje no tiene objetos en la partida seleccionada.
            </div>
            <div class="flex flex-col w-full h-full">
              <div
                class="flex flex-col"
                v-for="(objeto, index) in objetos"
                :key="index"
              >
                <div class="flex flex-row border-b border-black">
                  <div class="border-r border-black w-1/4 break-words">
                    {{ objeto.name }}
                    <p v-if="objeto.equiped > 0" class="text-red-500">E</p>
                  </div>
                  <div class="border-r border-black w-1/4 break-words">
                    {{ objeto.type }}
                  </div>
                  <div class="border-r border-black w-1/4 break-words">
                    {{ objeto.list }}
                    <p v-if="objeto.list == ''" class="text-red-400">
                      REPARTIDO
                    </p>
                  </div>
                  <div class="w-1/4 break-words relative">
                    {{ objeto.cant
                    }}<button
                      @click="infoItem(objeto.id)"
                      class="bg-gray-200 border border-black px-1 absolute right-0 h-full"
                    >
                      V
                    </button>
                  </div>
                </div>
                <div
                  v-if="itemAbierto == objeto.id"
                  class="w-full border-b border-black flex flex-col bg-gray-200"
                >
                  <div class="flex flex-row w-full">
                    <div class="w-1/3 h-full max-h-48">
                      <img :src="objeto.image" alt="" />
                    </div>
                    <div class="w-2/3 h-full text-left p-4 font-semibold">
                      {{ objeto.description }}
                    </div>
                  </div>

                  <div
                    class="w-full grid grid-cols-2 p-3 border-b border-t border-black"
                  >
                    <div class="flex flex-row">
                      <p class="font-semibold mr-1">Nombre:</p>
                      {{ objeto.name }}
                    </div>
                    <div class="flex flex-row">
                      <p class="font-semibold mr-1">Tipo:</p>
                      {{ objeto.type }}
                    </div>
                    <div class="flex flex-row">
                      <p class="font-semibold mr-1">Cantidad:</p>
                      {{ objeto.cant }}
                    </div>
                    <div class="flex flex-row">
                      <p class="font-semibold mr-1">Perso por unidad:</p>
                      {{ objeto.weight }}
                    </div>
                    <div v-if="objeto.equiped > 0" class="flex flex-row">
                      <p class="font-semibold mr-1">Estado:</p>
                      EQUIPADO
                    </div>
                    <div v-if="objeto.equiped == 0" class="flex flex-row">
                      <p class="font-semibold mr-1">Estado:</p>
                      NO EQUIPADO
                    </div>
                    <div v-if="objeto.capacity > 0" class="flex flex-row">
                      <p class="font-semibold mr-1">Capacidad:</p>
                      {{ objeto.capacity }}
                    </div>
                  </div>

                  <div class="flex flex-row w-full p-3">
                    <div
                      v-if="Object.keys(objeto.effect).length > 0"
                      class="w-full h-full flex flex-col"
                    >
                      <div class="text-xl font-bold underline mb-2">
                        EFECTOS
                      </div>
                      <div
                        class="flex flex-row justify-center"
                        v-for="(efecto, index) in objeto.effect"
                        :key="index"
                      >
                        <div v-if="efecto[0] == '+' && efecto[1] > 0">+</div>
                        {{ efecto[1] }}
                        <div v-if="efecto[0] == '%'">%</div>
                        {{ efecto[2] }}
                      </div>
                    </div>
                    <div
                      v-if="objeto.list == ''"
                      class="w-full h-full flex flex-col border-l border-black"
                    >
                      <div class="text-xl font-bold underline mb-2">
                        UBICACIÓN
                      </div>
                      <table>
                        <tr>
                          <td class="underline">CANT</td>
                          <td class="underline">INVENTARIO</td>
                        </tr>
                        <tr
                          v-for="(distribucion, index) in objeto.distribucion"
                          :key="index"
                        >
                          <td>{{ distribucion[1] }}</td>
                          <td>{{ distribucion[0] }}</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div
            class="ring-2 ring-black rounded-xl w-full bg-white flex flex-col overflow-y-auto pb-6"
          >
            <div
              class="flex flex-row w-full bg-blue-300 border-b-2 border-black"
              v-if="partidaSelected > -1"
            >
              <div
                class="border-r border-black w-1/3 break-words text-xl font-bold"
              >
                NOMBRE
              </div>
              <div
                class="border-r border-black w-1/3 break-words text-xl font-bold"
              >
                TIPO
              </div>
              <div
                class="border-r border-black w-1/3 break-words text-xl font-bold"
              >
                ATRIBUTO
              </div>
              <div
                class="border-r border-black w-1/3 break-words text-xl font-bold"
              >
                CLASE
              </div>
            </div>
            <div v-if="partidaSelected == -1">
              TODAVIA NO HAS SELECCIONADO UNA PARTIDA
            </div>
            <div v-if="partidaSelected > -1 && Object.keys(habilities).length < 1">
              Este personaje no tiene habilidades en la partida seleccionada.
            </div>
            <div class="flex flex-col w-full h-full">
              <div
                class="flex flex-col"
                v-for="(habilitie, index) in habilities"
                :key="index"
              >
                <div class="flex flex-row border-b border-black">
                  <div class="border-r border-black w-1/4 break-words">
                    {{ habilitie.name }}
                  </div>
                  <div class="border-r border-black w-1/4 break-words">
                    {{ habilitie.class }}
                  </div>
                  <div class="border-r border-black w-1/4 break-words">
                    {{ habilitie.type }}
                  </div>
                  <div class="w-1/4 break-words relative">
                    {{ habilitie.atribute }}
                    <button
                      @click="infoHabilidad(habilitie.id)"
                      class="bg-gray-200 border border-black px-1 absolute right-0 h-full"
                    >
                      V
                    </button>
                  </div>
                </div>
                <div
                  v-if="habilidadAbierto == habilitie.id"
                  class="w-full border-b border-black flex flex-col bg-gray-200"
                >
                  <div class="flex flex-row w-full">
                    <div class="w-full h-full text-left p-4 font-semibold">
                      {{ habilitie.description }}
                    </div>
                  </div>

                  <div
                    class="w-full grid grid-cols-2 p-3 border-b border-t border-black"
                  >
                    <div class="flex flex-row">
                      <p class="font-semibold mr-1">Nombre:</p>
                      {{ habilitie.name }}
                    </div>
                    <div class="flex flex-row">
                      <p class="font-semibold mr-1">Atributo:</p>
                      {{ habilitie.type }}
                    </div>
                    <div class="flex flex-row">
                      <p class="font-semibold mr-1">Tipo:</p>
                      {{ habilitie.class }}
                    </div>
                    <div class="flex flex-row">
                      <p class="font-semibold mr-1">Clase:</p>
                      {{ habilitie.atribute }}
                    </div>
                    <div
                      class="flex flex-row"
                      v-if="
                        habilitie.cost.stat != '' && habilitie.cost.stat != null
                      "
                    >
                      <p class="font-semibold mr-1">Coste:</p>
                      <div class="mr-1">{{ habilitie.cost.value }}</div>
                      <div class="mr-1">{{ habilitie.cost.stat }}</div>
                    </div>
                    <div v-if="habilitie.from > -1" class="flex flex-row">
                      <p class="font-semibold mr-1">Origen:</p>
                      {{ habilitie.fromName }}
                    </div>
                  </div>

                  <div class="flex flex-row w-full p-3">
                    <div
                      v-if="Object.keys(habilitie.effect).length > 0"
                      class="w-full h-full flex flex-col"
                    >
                      <div class="text-xl font-bold underline mb-2">
                        EFECTOS
                      </div>
                      <div
                        class="flex flex-row justify-center"
                        v-for="(efecto, index) in habilitie.effect"
                        :key="index"
                      >
                        <div v-if="efecto[0] == '+' && efecto[1] > 0">+</div>
                        {{ efecto[1] }}
                        <div v-if="efecto[0] == '%'">%</div>
                        {{ efecto[2] }}
                      </div>
                    </div>
                    <div
                      v-if="
                        habilitie.difficulty.stat != '' &&
                        habilitie.difficulty.stat != null
                      "
                      class="w-full h-full flex flex-col"
                    >
                      <div class="text-xl font-bold underline mb-2">
                        Tirada de Dificultad
                      </div>
                      <div class="flex flex-row justify-center">
                        <div class="mr-1">
                          {{ habilitie.difficulty.modificador }}
                        </div>
                        <div class="mr-1">{{ habilitie.difficulty.stat }}</div>
                        <div class="mr-1">{{ habilitie.difficulty.dice }}</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div
            class="ring-2 ring-black rounded-xl w-full bg-white flex flex-col overflow-y-auto pb-6"
          >
            <div
              class="flex flex-row w-full bg-blue-300 border-b-2 border-black"
              v-if="partidaSelected > -1"
            >
              <div
                class="border-r border-black w-1/3 break-words text-xl font-bold"
              >
                NOMBRE
              </div>
              <div
                class="border-r border-black w-1/3 break-words text-xl font-bold"
              >
                ACRONIMO
              </div>
              <div
                class="border-r border-black w-1/3 break-words text-xl font-bold"
              >
                VALOR
              </div>
              <div
                class="border-r border-black w-1/3 break-words text-xl font-bold"
              >
                TOTAL
              </div>
            </div>
            <div v-if="partidaSelected == -1">
              TODAVIA NO HAS SELECCIONADO UNA PARTIDA
            </div>
            <div v-if="partidaSelected > -1 && Object.keys(stats).length < 1">
              Este personaje no tiene estadisticas en la partida seleccionada.
            </div>
            <div class="flex flex-col w-full h-full">
              <div
                class="flex flex-col"
                v-for="(stat, index) in stats"
                :key="index"
              >
                <div class="flex flex-row border-b border-black">
                  <div class="border-r border-black w-1/4 break-words">
                    {{ stat.name }}
                  </div>
                  <div class="border-r border-black w-1/4 break-words">
                    {{ stat.acronim }}
                  </div>
                  <div class="border-r border-black w-1/4 break-words">
                    {{ stat.base }}
                  </div>
                  <div class="w-1/4 break-words relative">
                    <p :style="modificadoActual(stat.total, stat.base)">
                      {{ stat.total }}
                    </p>
                    <button
                      @click="infoStat(stat.acronim)"
                      class="bg-gray-200 border border-black px-1 absolute right-0 h-full top-0"
                    >
                      V
                    </button>
                  </div>
                </div>
                <div
                  v-if="statAbierto == stat.acronim"
                  class="w-full border-b border-black flex flex-col bg-gray-200 p-3"
                >
                  <div class="flex flex-row">
                    <p class="font-semibold mr-1">Nombre:</p>
                    {{ stat.name }}
                  </div>
                  <div class="flex flex-row">
                    <p class="font-semibold mr-1">Acronimo:</p>
                    {{ stat.acronim }}
                  </div>
                  <div class="flex flex-row text-left">
                    <p class="font-semibold mr-1">Descripción:</p>
                    {{ stat.description }}
                  </div>
                  <div class="flex flex-row">
                    <p class="font-semibold mr-1">Valor base:</p>
                    {{ stat.base }}
                  </div>
                  <div class="flex flex-row">
                    <p class="font-semibold mr-1">Valor total:</p>
                    <p :style="modificadoActual(stat.total, stat.base)">
                      {{ stat.total }}
                    </p>
                  </div>
                  <div
                    v-if="stat.actual != '' && stat.actual != null"
                    class="flex flex-row"
                  >
                    <p class="font-semibold mr-1">Valor actual:</p>
                    <p :style="modificado(stat.total, stat.base)">
                      {{ stat.actual }}
                    </p>
                  </div>
                  <div class="flex flex-row">
                    <p class="font-semibold mr-1">Valor maximo:</p>
                    {{ stat.maximunStat }}
                  </div>
                  <div class="flex flex-row">
                    <p class="font-semibold mr-1">Valor minimo:</p>
                    {{ stat.minimunStat }}
                  </div>
                  <div
                    v-if="Object.keys(stat.effects).length > 0"
                    class="flex flex-col"
                  >
                    <div class="text-lg font-bold underline">
                      Efectos aplicados
                    </div>
                    <div
                      class="flex flex-row"
                      v-for="(effect, index) in stat.effects"
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
            </div>
          </div>
        </div>
      </div>
      <div class="h-full w-48">
        <div
          class="flex flex-col mt-24 h-calc2 w-full ring-2 ring-black rounded-xl bg-white"
        >
          <div class="underline text-xl font-bold">Partidas</div>
            <div v-if="Object.keys(partidas).length < 1">
              Este personaje no participa en ninguna partida.
            </div>
          <div
            @click="cargarInfoPartida(partida.id, partida.system)"
            v-for="(partida, index) in partidas"
            :key="index"
            class="bg-gray-600 text-white w-80% py-3 rounded-xl shadow-xl my-4 inset-0 mx-auto cursor-pointer break-words"
          >
            {{ partida.name }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "infoPersonaje",
  components: {},
  props: {
    personaje: Object,
    usuario: String,
  },
  data() {
    return {
      partidaSelected: -1,
      itemAbierto: 0,
      habilidadAbierto: 0,
      statAbierto: "",
      partidas: {},
      objetos: {
        // 0: {
        //   cant: 3,
        //   capacity: 0,
        //   character: "2",
        //   description:
        //     "Clásica cota de malla hecha de anillas de metal entrelazadas para aumentar su resistencia a ataques penetrantes.",
        //   distribucion: {
        //     0: ["Refugio", 2],
        //     1: ["Personal", 1],
        //   },
        //   effect: {
        //     0: ["+", 3, "Resistencia en Torso", 1, "base"],
        //     1: ["+", 3, "Resistencia en brazo izquierdo", 1, "base"],
        //     2: ["+", 3, "Resistencia en brazo derecho", 1, "base"],
        //   },
        //   equiped: 9,
        //   equipedOrigen: "Personal",
        //   game: "2",
        //   habilities: 0,
        //   hide: "0",
        //   id: 1,
        //   image:
        //     "https://img.rankedboost.com/wp-content/plugins/legends-of-runeterra/assets/spell-artwork/01DE013-full.png",
        //   letter: "",
        //   list: "",
        //   name: "Cota de malla",
        //   system: "2",
        //   type: "Armor",
        //   weight: 20,
        // },
      },
      habilities: {
        // 0: {
        //   atribute: "Buffos",
        //   class: "Pasivas",
        //   cost: {
        //     stat: "",
        //     value: 0,
        //   },
        //   description: "Diego es demasiado vago para dar una descripción.",
        //   difficulty: {
        //     stat: "INT",
        //     modificador: -10,
        //     dice: null,
        //   },
        //   effect: [],
        //   equiped: 0,
        //   from: -1,
        //   fromName: "",
        //   id: 11,
        //   name: "Sentidos Agudos",
        //   see: true,
        //   type: "Sentidos",
        // },
      },
      stats: {
        // 0: {
        //   acronim: "H",
        //   actual: 22,
        //   base: 22,
        //   character: 2,
        //   description: "Cantidad de daño que es capaz de soportar el personaje.",
        //   editable: 0,
        //   effects: {},
        //   game: 2,
        //   hide: 0,
        //   id: 1,
        //   maximunStat: 20,
        //   minimunStat: 10,
        //   name: "Heridas",
        //   orden: 1,
        //   system: 2,
        //   total: 0,
        //   user: "jquedi",
        // },
      },
      objetosHabilidades: [],
    };
  },
  methods: {
    infoStat(val) {
      if (val != this.statAbierto) {
        this.statAbierto = val;
      } else {
        this.statAbierto = "";
      }
    },
    infoHabilidad(val) {
      if (val != this.habilidadAbierto) {
        this.habilidadAbierto = val;
      } else {
        this.habilidadAbierto = 0;
      }
    },
    infoItem(val) {
      if (val != this.itemAbierto) {
        this.itemAbierto = val;
      } else {
        this.itemAbierto = 0;
      }
    },
    cerrar() {
      this.$emit("cerrar");
    },
    cargarInfoPartida(game, system) {
      this.partidaSelected = game;
      this.loadObjectsF(game, system, this.personaje.id);
    },

    loadObjectsF(game, system, personaje) {
      axios
        .post("/php/loadObjects.php", {
          game: game,
          system: system,
          personaje: personaje,
        })
        .then((response) => {
          this.objetos = response.data[0];
          this.loadHabilitiesF(game, system, this.personaje.id, this.usuario);
        });
    },

    loadHabilitiesF(game, system, personaje, usuario) {
      axios
        .post("/php/loadHabilities.php", {
          user: usuario,
          game: game,
          system: system,
          personaje: personaje,
        })
        .then((response) => {
          this.habilities = response.data;
          this.objetosHabilidadesF();
          this.loadStatsF(game, system, personaje, usuario);
        });
    },

    loadStatsF(game, system, personaje, usuario) {
      axios
        .post("/php/loadStats.php", {
          user: usuario,
          game: game,
          system: system,
          personaje: personaje,
        })
        .then((response) => {
          this.stats = response.data;
          this.calcTotal();
        });
    },

    calcTotal() {
      this.resetEffects();
      this.getEffects(this.objetos);
      this.getEffects(this.habilities);

      for (var i = 0; i < Object.keys(this.stats).length; i++) {
        this.stats[i]["total"] = this.stats[i]["base"];
        if (Object.keys(this.stats[i]["effects"]).length > 0) {
          for (
            var j = 0;
            j < Object.keys(this.stats[i]["effects"]).length;
            j++
          ) {
            if (this.stats[i]["effects"][j][0] == "+") {
              this.stats[i]["total"] += this.stats[i]["effects"][j][1];
            }
            if (this.stats[i]["effects"][j][0] == "%") {
              if (this.stats[i]["effects"][j][3] == "base") {
                this.stats[i]["total"] +=
                  this.stats[i]["base"] *
                  (this.stats[i]["effects"][j][1] / 100);
              } else {
                this.stats[i]["total"] +=
                  this.stats[i]["total"] *
                  (this.stats[i]["effects"][j][1] / 100);
              }
            }
          }
        }
      }
    },
    getEffects(val) {
      for (var i = 0; i < Object.keys(val).length; i++) {
        if (Object.keys(val[i]["effect"]).length > 0 && val[i]["equiped"] > 0) {
          for (var i2 = 0; i2 < Object.keys(val[i]["effect"]).length; i2++) {
            for (var i3 = 0; i3 < Object.keys(this.stats).length; i3++) {
              if (
                val[i]["effect"][i2][2] == this.stats[i3]["name"] &&
                val[i]["effect"][i2][3] == 1
              ) {
                this.stats[i3]["effects"][
                  Object.keys(this.stats[i3]["effects"]).length
                ] = [
                  val[i]["effect"][i2][0],
                  val[i]["effect"][i2][1],
                  val[i]["name"],
                  val[i]["effect"][i2][4],
                ];
              }
            }
          }
        }
      }
    },
    resetEffects() {
      for (var i3 = 0; i3 < Object.keys(this.stats).length; i3++) {
        this.stats[i3]["effects"] = {};
      }
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

    modificadoActual(total, base) {
      var aux = "";
      if (total < base / 2) {
        aux = "color: orange;";
      }
      if (base / 4 > total) {
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

    cargarPartidas() {
      axios
        .post("/php/gamesPersonaje.php", {
          personaje: this.personaje.id,
        })
        .then((response) => {
          this.partidas = response.data;
        });
    },
  },
  created: function () {
    this.cargarPartidas();
  },
};
</script>

<style scoped>
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