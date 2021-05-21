<template>
  <div
    class="font-sans flex flex-col w-full h-full bg-gray-200 overflow-y-auto"
    id="selectPersonaje"
  >
    <div v-if="!abrirInfo">
      <div
        @click="atras()"
        class="bg-red-400 h-content w-content absolute m-6 p-3 rounded-lg cursor-pointer"
      >
        Atrás
      </div>
      <div class="my-10 text-3xl font-bold underline">Mis personajes</div>
      <div class="flex flex-row flex-wrap w-full h-full p-4 gap-10">
        <personajeMiniFicha
          v-for="(personaje, index) in personajes"
          :key="index"
          :personaje="personaje"
          @selectPersonajeF="selectPersonajeF"
        />
        <div
          @click="crearPersonaje = true"
          class="cursor-pointer w-40 h-60 bg-gray-200 rounded-lg flex flex-col overflow-hidden ring-2 ring-blue-600 shadow-xl"
        >
          <img
            class="w-40 h-40 object-fit object-center mt-10"
            src="https://cdn.pixabay.com/photo/2014/04/02/10/55/plus-304947_1280.png"
            alt=""
          />
        </div>
      </div>
    </div>

    <createPersonaje
      v-if="crearPersonaje"
      :usuario="usuario"
      @cerrar2="cerrar2"
    />
    <infoPersonaje
      v-if="abrirInfo"
      :usuario="usuario"
      :personaje="personajeSelected"
      @cerrar="cerrar"
    />
  </div>
</template>

<script>
import axios from "axios";
import personajeMiniFicha from "@/components/modulos/loggin/personajeMiniFicha.vue";
import infoPersonaje from "@/components/modulos/loggin/infoPersonaje.vue";
import createPersonaje from "@/components/modulos/loggin/createPersonaje.vue";

export default {
  name: "selectPersonaje",
  components: {
    personajeMiniFicha,
    infoPersonaje,
    createPersonaje,
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
      personajeSelected: {},
      abrirInfo: false,
      crearPersonaje: false,
    };
  },
  methods: {
    cerrar() {
      this.abrirInfo = false;
    },
    cerrar2() {
      this.crearPersonaje = false;
      this.loadCharacters();
    },
    atras() {
      this.$emit("atras");
    },
    selectPersonajeF(val) {
      this.personajeSelected = val;
      this.abrirInfo = true;
    },
    loadCharacters() {
      axios
        .post("/php/loadAllUserCharacters.php", {
          user: this.usuario,
        })
        .then((response) => {
          this.personajes = response.data;
        });
    },
  },
  created: function () {
    this.loadCharacters();
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