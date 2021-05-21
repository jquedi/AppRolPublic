<template>
  <div
    class="font-sans flex flex-col w-full h-full bg-gray-200 overflow-y-auto"
    id="selectGame"
  >
    <div v-if="!abrirInfo" class="h-full flex flex-col">
      <div
        @click="atras()"
        class="bg-red-400 h-content w-content absolute m-6 p-3 rounded-lg cursor-pointer"
      >
        Atrás
      </div>
      <div class="my-10 text-3xl font-bold underline">Mis partidas</div>
      <div class="flex flex-row h-full">
        <div
          class="flex flex-col flex-wrap w-full h-full p-4 gap-10 border border-black"
        >
          <div class="text-2xl font-bold underline">Como Jugador</div>
          <div class="flex flex-row flex-wrap">
            <gameMiniFicha
              v-for="(game, index) in games1"
              :key="index"
              :game="game"
              @selectGameF="selectGameF"
            />
          </div>
        </div>
        <div
          class="flex flex-col flex-wrap w-full h-full p-4 gap-10 border border-black"
        >
          <div class="text-2xl font-bold underline">Como Master</div>
          <div class="flex flex-row flex-wrap">
            <gameMiniFicha
              v-for="(game, index) in games2"
              :key="index"
              :game="game"
              @selectGameF="selectGameF"
            />
          </div>
        </div>
      </div>
    </div>
    <selectPersonajeGame v-if="abrirInfo" :personajes="personajes" @cerrar="cerrar" @jugar="jugar" />
  </div>
</template>

<script>
import axios from "axios";
import gameMiniFicha from "@/components/modulos/loggin/gameMiniFicha.vue";
import selectPersonajeGame from "@/components/modulos/loggin/selectPersonajeGame.vue";

export default {
  name: "selectGame",
  components: {
    gameMiniFicha,
    selectPersonajeGame,
  },
  props: {
    usuario: String,
  },
  data() {
    return {
      personajes: {
        0: {
          background:
            "Paco es un tio muy grande, lider de un grupo especializado en contención de hordas. Actualmente es la persona a cargo de la defensa de la ciudad. Ha sido recientemente dopado.",
          id: "2",
          image:
            "https://i.pinimg.com/originals/10/d1/85/10d185a1050587ac2a450997689469b6.jpg",
          name: "Paco",
          title: "El de los hombres de Paco",
          user: "jquedi",
        },
        1: {
          background: "Es un personaje de prueba",
          id: "3",
          image: "https://acegif.com/wp-content/gifs/dancing-pig-22.gif",
          name: "Personaje de prueba",
          title: "Prueba",
          user: "jquedi",
        },
      },
      gameSelected: {},
      games1: {
        0: {
          id: 2,
          name: "Paco y otros contra el Nigromante y la bicicleta oculta1",
          system: 2,
          master: "diegoriño",
        },
      },
      games2: {
        0: {
          id: 2,
          name: "Paco y otros contra el Nigromante y la bicicleta oculta",
          system: 2,
          master: "diegoriño",
        },
      },
      abrirInfo: false,
    };
  },
  methods: {
      jugar(val){
          var aux = [val, this.gameSelected.id, this.gameSelected.system];
          this.$emit("jugar", aux);
      },
    cerrar() {
      this.abrirInfo = false;
    },
    atras() {
      this.$emit("atras");
    },
    selectGameF(val) {
      this.gameSelected = val;
      this.loadCharacters();
      this.abrirInfo = true;
    },
    loadCharacters() {
      axios
        .post("/php/loadPersonajesGame.php", {
          user: this.usuario,
          game: this.gameSelected.id,
        })
        .then((response) => {
            this.personajes = response.data;
        });
    },
    loadGames() {
      axios
        .post("/php/loadGamesUser.php", {
          user: this.usuario,
        })
        .then((response) => {
          this.games1 = response.data[0];
          this.games2 = response.data[1];
        });
    },
  },
  created: function () {
    this.loadGames();
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