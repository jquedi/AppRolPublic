<template>
  <div class="" id="app">
    <panelJ v-if="posicion == 2" :player="player" @logOut="logOut" />

    <loggin v-if="posicion == 0" @iniciarSesionF="iniciarSesionF" />

    <perfil
      :player="player"
      @desconectar="desconectar"
      @jugar="jugar"
      v-if="posicion == 1"
    />
  </div>
</template>

<script>
import panelJ from "./components/panelJugador.vue";
import loggin from "@/components/modulos/loggin/loggin.vue";
import perfil from "@/components/modulos/perfil/perfil.vue";

export default {
  name: "App",
  components: {
    panelJ,
    loggin,
    perfil,
  },
  data() {
    return {
      player: {
        id: 1,
        user: localStorage.getItem("userName"),
        character: 0,
        rol: "player",
        game: 2,
        system: 2,
      },
      jugarV: false,
      posicion: 0,
    };
  },
  methods: {
    logOut(val) {
      this.posicion = val;
    },
    jugar(val) {
      this.player.character = val[0];
      this.player.game = val[1];
      this.player.system = val[2];
      this.posicion = 2;
    },
    desconectar() {
      this.player.user = "";
      localStorage.setItem("userName", "");
      this.posicion = 0;
    },
    iniciarSesionF(val) {
      this.player.user = val;
      this.posicion = 1;
    },
    posicionF() {
      if (this.player.user == "" || this.player.user == null) {
        this.posicion = 0;
      }
      if (this.player.user != "" && this.player.user != null) {
        this.posicion = 1;
      }
    },
  },
  created: function () {
    this.posicionF();
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
