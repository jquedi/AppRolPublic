<template>
  <div
    style="z-index: 3000"
    class="fixed w-full h-full bg-white flex flex-col"
    id="perfil"
  >
    <div
      class="flex flex-row flex-nowrap w-full h-20 bg-white border-b-2 border-indigo-800"
    >
      <div class="h-full w-full"></div>
      <div
        class="flex flex-row flex-nowrap h-full w-content cursor-pointer"
        @mouseover="abrir = true"
        @mouseleave="abrir = false"
      >
        <div
          class="h-16 w-16 mt-1 mx-6 rounded-full bg-gray-600 overflow-hidden"
        >
          <img class="object-cover h-full" :src="user.image" alt="" />
        </div>
        <div class="mr-10 h-full flex flex-row">
          <div class="self-center font-bold text-xl">{{ user.user }}</div>
        </div>
      </div>
    </div>
    <div
      @mouseover="abrir = true"
      @mouseleave="abrir = false"
      v-if="!hideMenuPerfil"
      class="bg-white absolute right-4 top-20 h-content w-content flex flex-col z-90 rounded-lg shadow-xl"
    >
      <div class="p-3 px-14 text-lg text-gray-600 border-b border-gray-600">
        <p class="cursor-pointer">Editar perfil</p>
      </div>
      <div class="p-3 px-14 text-lg text-gray-600 border-b border-gray-600">
        <p class="cursor-pointer">Amigos</p>
      </div>
      <div class="p-3 px-14 text-lg text-gray-600 border-b border-gray-600">
        <p class="cursor-pointer">Opcion3</p>
      </div>
      <div class="p-3 px-14 text-lg text-gray-600 border-b border-gray-600">
        <p class="cursor-pointer">Opcion4</p>
      </div>
      <div
        @click="desconectar()"
        class="text-right pr-2 py-2 text-opacity-80 text-red-400 border-b border-gray-600"
      >
        <p class="cursor-pointer">Desconectarse</p>
      </div>
    </div>
    <div
      class="w-full h-full bg-gray-200 flex flex-row flex-wrap p-20 pt-36 justify-around gap-20 relative overflow-y-auto"
      v-if="utilidad == 0"
    >
      <div @click="utilidadF(1)">
        <utilidades
          tittle="MIS PERSONAJES"
          image="https://image.freepik.com/vector-gratis/ilustracion-dibujos-animados-robot-fantasy-character_11460-9807.jpg"
          bg_tittle="bg-red-200"
        />
      </div>
      <div @click="utilidadF(2)">
        <utilidades
          tittle="MIS PARTIDAS"
          image="https://image.freepik.com/vector-gratis/ilustracion-dibujos-animados-robot-fantasy-character_11460-9807.jpg"
          bg_tittle="bg-red-200"
        />
      </div>
      <div @click="utilidadF(0)">
        <utilidades
          tittle="MIS SISTEMAS"
          image="https://image.freepik.com/vector-gratis/ilustracion-dibujos-animados-robot-fantasy-character_11460-9807.jpg"
          bg_tittle="bg-red-200"
        />
      </div>
      <div @click="utilidadF(0)">
        <utilidades
          tittle="MIS OBJETOS"
          image="https://image.freepik.com/vector-gratis/ilustracion-dibujos-animados-robot-fantasy-character_11460-9807.jpg"
          bg_tittle="bg-red-200"
        />
      </div>
      <div @click="utilidadF(0)">
        <utilidades
          tittle="MIS HABILIDADES"
          image="https://image.freepik.com/vector-gratis/ilustracion-dibujos-animados-robot-fantasy-character_11460-9807.jpg"
          bg_tittle="bg-red-200"
        />
      </div>
    </div>

    <selectPersonaje
      :usuario="player.user"
      @atras="atras"
      v-if="utilidad == 1"
    />

    <selectGame
      :usuario="player.user"
      @atras="atras"
      @jugar="jugar"
      v-if="utilidad == 2"
    />
  </div>
</template>

<script>
import axios from "axios";
import utilidades from "@/components/modulos/perfil/utilidades.vue";
import selectPersonaje from "@/components/modulos/loggin/selectPersonaje.vue";
import selectGame from "@/components/modulos/loggin/selectGame.vue";

export default {
  name: "perfil",
  components: {
    utilidades,
    selectPersonaje,
    selectGame,
  },
  props: {
    player: Object,
  },
  data() {
    return {
      hideMenuPerfil: true,
      abrir: false,
      utilidad: 0,
      user: {},
    };
  },
  watch: {
    abrir: function () {
      this.abrirmenu();
    },
  },
  methods: {
    jugar(val){
      this.$emit("jugar", val);
    },
    async abrirmenu() {
      if (this.abrir == true) {
        this.hideMenuPerfil = false;
      } else {
        await this.sleep(2000);
        if (this.abrir == false) {
          this.hideMenuPerfil = true;
        }
      }
    },
    sleep(ms) {
      return new Promise((resolve) => setTimeout(resolve, ms));
    },
    loadUser() {
      var consulta1 =
        "SELECT * FROM `users` WHERE `user` = '" + this.player.user + "'";
      axios
        .post("/php/load.php", {
          consulta: consulta1,
        })
        .then((response) => {
          this.user = response.data[0];
        });
    },
    desconectar() {
      this.$emit("desconectar");
    },
    utilidadF(val) {
      this.utilidad = val;
    },
    atras(){
      this.utilidad = 0;
    },
  },
  created: function () {
    this.loadUser();
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