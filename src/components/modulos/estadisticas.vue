<template>
  <div
    id="estadisticas"
    class="overflow-hidden bg-gray-200 h-full w-full relative rounded-2xl border-2 border-red-700 relative"
    @click="focusF"
  >
    <button
      @click="switchF()"
      class="absolute bottom-0 left-2 text-xs bg-white border-black border z-90"
    >
      Switch
    </button>
    <graficaPoligonal
      v-if="statsType == 'poligon'"
      v-bind:estadisticas="stats"
      :resetPoligon="resetPoligon"
      @resetPoligonF="resetPoligonF"
      @editarStat="editarStat"
    />

    <tablaClasica
      v-if="statsType == 'classic'"
      v-bind:estadisticas="stats"
      @editarStat="editarStat"
    />
  </div>
</template>

<script>
import axios from "axios";
import graficaPoligonal from "@/components/modulos/modulosEstadisticas/graficaPoligonal.vue";
import tablaClasica from "@/components/modulos/modulosEstadisticas/tablaClasica.vue";

export default {
  name: "estadisticas",
  components: {
    graficaPoligonal,
    tablaClasica,
  },
  props: {
    objetos: Object,
    habilidades: Object,
    resetStatsVar: Number,
    player: Object,
  },
  data() {
    return {
      HideEstadisticas: false,
      statsType: "poligon",
      resetPoligon: 0,
      actualizador: 0,
      stats: {
        0: {
          id: 0,
          user: "jquedi",
          character: 1,
          game: 1,
          system: 1,
          name: "Heridas",
          acronim: "H",
          maximunStat: 20,
          minimunStat: 10,
          base: 22,
          actual: 15,
          total: 0,
          effects: {},
          description:
            "Cantidad de daño que es capaz de soportar el personaje.",
          orden: 0,
          hide: 0,
          editable: 1,
        },
        1: {
          id: 0,
          user: "jquedi",
          character: 1,
          game: 1,
          system: 1,
          name: "Habilidad de armas",
          acronim: "HA",
          maximunStat: 75,
          minimunStat: 20,
          base: 45,
          actual: null,
          total: 0,
          effects: {},
          description:
            "La capacidad del personaje para asestar golpes con armas cuerpo a cuerpo.",
          orden: 0,
          hide: 0,
          editable: 0,
        },
        2: {
          id: 0,
          user: "jquedi",
          character: 1,
          game: 1,
          system: 1,
          name: "Habilidad de proyectiles",
          acronim: "HP",
          maximunStat: 75,
          minimunStat: 20,
          base: 35,
          actual: null,
          total: 0,
          effects: {},
          description:
            "La capacidad del personaje para asestar golpes a distancia.",
          orden: 0,
          hide: 0,
          editable: 0,
        },
        3: {
          id: 0,
          user: "jquedi",
          character: 1,
          game: 1,
          system: 1,
          name: "Fuerza",
          acronim: "F",
          maximunStat: 7,
          minimunStat: 2,
          base: 8,
          actual: null,
          total: 0,
          effects: {},
          description: "Fuerza del personaje, afecta al daño causado.",
          orden: 0,
          hide: 0,
          editable: 0,
        },
        4: {
          id: 0,
          user: "jquedi",
          character: 1,
          game: 1,
          system: 1,
          name: "Resistencia",
          acronim: "RES",
          maximunStat: 7,
          minimunStat: 1,
          base: 8,
          actual: null,
          total: 0,
          effects: {},
          description:
            "Resiliencia fisica del personaje, afecta al daño que recibe de ataques fisicos.",
          orden: 0,
          hide: 0,
          editable: 0,
        },
        5: {
          id: 0,
          user: "jquedi",
          character: 1,
          game: 1,
          system: 1,
          name: "Iniciativa",
          acronim: "INIC",
          maximunStat: 75,
          minimunStat: 20,
          base: 60,
          actual: null,
          total: 0,
          effects: {},
          description:
            "Indica la capacidad y velocidad de reaccion del personaje.",
          orden: 0,
          hide: 0,
          editable: 0,
        },
        6: {
          id: 0,
          user: "jquedi",
          character: 1,
          game: 1,
          system: 1,
          name: "Agilidad",
          acronim: "AGI",
          maximunStat: 60,
          minimunStat: 20,
          base: 50,
          actual: null,
          total: 0,
          effects: {},
          description: "Afecta a la capacidad de evitar ataques del personaje.",
          orden: 0,
          hide: 0,
          editable: 0,
        },
        7: {
          id: 0,
          user: "jquedi",
          character: 1,
          game: 1,
          system: 1,
          name: "Destreza",
          acronim: "DES",
          maximunStat: 75,
          minimunStat: 20,
          base: 38,
          actual: null,
          total: 0,
          effects: {},
          description: "Umm... no tengo claro a que aplica...",
          orden: 0,
          hide: 0,
          editable: 0,
        },
        8: {
          id: 0,
          user: "jquedi",
          character: 1,
          game: 1,
          system: 1,
          name: "Inteligencia",
          acronim: "INT",
          maximunStat: 60,
          minimunStat: 20,
          base: 45,
          actual: null,
          total: 0,
          effects: {},
          description: "Lo capaz intelectualmente que es el personaje.",
          orden: 0,
          hide: 0,
          editable: 0,
        },
        9: {
          id: 0,
          user: "jquedi",
          character: 1,
          game: 1,
          system: 1,
          name: "Movimiento",
          acronim: "M",
          maximunStat: 5,
          minimunStat: 1,
          base: 6,
          actual: null,
          total: 0,
          effects: {},
          description: "Lo que puede desplazarse el personaje por accion.",
          orden: 0,
          hide: 0,
          editable: 0,
        },
        10: {
          id: 0,
          user: "jquedi",
          character: 1,
          game: 1,
          system: 1,
          name: "Fuerza de voluntad",
          acronim: "FV",
          maximunStat: 100,
          minimunStat: 25,
          base: 35,
          actual: null,
          total: 0,
          effects: {},
          description:
            "La resistencia mental que tiene el personaje para resistir acciones de manipulacion mental.",
          orden: 0,
          hide: 0,
          editable: 0,
        },
        11: {
          id: 0,
          user: "jquedi",
          character: 1,
          game: 1,
          system: 1,
          name: "Frialdad",
          acronim: "FI",
          maximunStat: 100,
          minimunStat: 25,
          base: 100,
          actual: null,
          total: 0,
          effects: {},
          description:
            "Capacidad del personaje para mantenerse sereno en situaciones de estrés.",
          orden: 0,
          hide: 0,
          editable: 0,
        },
        12: {
          id: 0,
          user: "jquedi",
          character: 1,
          game: 1,
          system: 1,
          name: "Empatia",
          acronim: "EMP",
          maximunStat: 100,
          minimunStat: 25,
          base: 30,
          actual: null,
          total: 0,
          effects: {},
          description:
            "Hace referencia a la habilidades sociales del personje, es decir, lo que bien que cae a la peña.",
          orden: 0,
          hide: 0,
          editable: 0,
        },
        13: {
          id: 0,
          user: "jquedi",
          character: 1,
          game: 1,
          system: 1,
          name: "Liderazgo",
          acronim: "LID",
          maximunStat: 100,
          minimunStat: 25,
          base: 60,
          actual: null,
          total: 0,
          effects: {},
          description:
            "La facilidad del personaje para hacer que sus subordinados sigan sus ordenes.",
          orden: 0,
          hide: 0,
          editable: 0,
        },
        14: {
          id: 0,
          user: "jquedi",
          character: 1,
          game: 1,
          system: 1,
          name: "Ataques",
          acronim: "ATK",
          maximunStat: 4,
          minimunStat: 1,
          base: 3,
          actual: null,
          total: 0,
          effects: {},
          description: "Cantidad de acciones que puede realizar por turno.",
          orden: 0,
          hide: 0,
          editable: 0,
        },
      },
    };
  },
  watch: {
    resetStatsVar: function (val) {
      if (val == 1) {
        this.calcTotal();
        this.$emit("resetStats", 0);
      }
    },
  },
  methods: {
    async loadStatsF() {
      while (this.actualizador > 0) {
        axios
          .post("/php/loadStats.php", {
            user: this.player.user,
            game: this.player.game,
            system: this.player.system,
            personaje: this.player.character,
          })
          .then((response) => {
            this.stats = response.data;
            this.calcTotal();
          });
        await this.sleep(2000);
      }
    },
    sleep(ms) {
      return new Promise((resolve) => setTimeout(resolve, ms));
    },

    editarStat(val) {
      axios
        .post("/php/editValueStat.php", {
          user: this.player.user,
          game: this.player.game,
          personaje: this.player.character,
          id: val.id,
          base: val.base,
          actual: val.actual,
        })
        .then((response) => {
          for (var i = 0; i < Object.keys(this.stats).length; i++) {
            if (this.stats[i].id == val.id) {
              this.stats[i].base = response.data[0];
              this.stats[i].actual = response.data[1];
            }
          }
          this.calcTotal();
        });
    },

    switchF() {
      if (this.statsType == "poligon") {
        this.statsType = "classic";
      } else {
        if (this.statsType == "classic") {
          this.statsType = "poligon";
        }
      }
    },

    focusF() {
      this.$emit("focusF", "estadisticas");
    },
    resetPoligonF(val) {
      this.resetPoligon = val;
    },
    calcTotal() {
      this.resetEffects();
      this.getEffects(this.objetos);
      this.getEffects(this.habilidades);

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
      this.resetPoligon = 1;
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
  },
  created: function () {
    this.calcTotal();
    this.actualizador = 1;
    this.loadStatsF();
  },
  beforeDestroy: function () {
    this.actualizador = 0;
  },
};
</script>

<style scoped>
</style>