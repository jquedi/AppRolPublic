<template>
  <div
    class="w-screen h-screen flex justify-center overflow-hidden relative"
    id="panelJugador"
  >

  <div class="fixed top-0 right-0 h-10 w-10 cursor-pointer" @click="logOut()"><img class="w-full h-full" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAZlBMVEX///8AAAC7u7tra2vIyMiGhoZLS0ulpaXc3Nzi4uKenp7Pz8+0tLTr6+vy8vIzMzM8PDxRUVHo6OgjIyONjY1DQ0P5+flUVFQdHR03NzfBwcEPDw8ICAgXFxdhYWEVFRWBgYF3d3eWMxUFAAAD3UlEQVR4nO3di04bQQwF0EzLK6QBGgoNr9L+/0+WClVluzuzM7P22te6/gHryL54UBTYbN4rua3PG5myduSLQgoptC8KKaTQviikkEL7WkN4txNqUlknqwtT+rqq0UK4rtFGuKbRSrheHu2Eb3M8EWpXLEthSt9XMNoKUzpT31Vrob7RXqidRw9CXaMPoebt8CLUewP4EWoZPQl1jL6EGnn0JpT/uepPKP2W8yiUfef4FEoavQrlfq76FUoZPQtlbodvocTt8C58ux0L5+hfuPTnKoJwWR4xhEvyiCJM6TG88BOFFFJIIYUUUkghhRRSCCo8XEQXbtM+vLCXCCQ8bqML0+0hujA99SwqlDA9d0wRS5hu27MIJkzH5imiCduPBp7wpXGKeMLWowEoTC9Ni+pX+CMrTKllip6EV7uPNfxlYihsecB5EpZqKGzJIqgwPVdnEVWYnmqnCCusfsDhCmsfcMDCygcctLBqitDCqqOBLUyv84sKLqx4wMELZ48GvHA2iyjCQ6FfOYv6wsefpwL1q9Cv/IDTF15qtBhWMYsaDVcXpmNhUTX6rS8sZVGjm4Uw/1u/RjcLYf5oaDQzEWY/ttHoZSPMfWyj0cpImDkaGp2shNNZ1GhkJpw8GhptDIWv4ylqtDEUTiyqRhdL4fjDN40mpsJ0E114cxVcOAJGE16PgMGE1/cjYCzheEWDCR+mgJGEUysaSvgwDYwjnMxgJOHEmYglzGQwjjC7olGE02diNeHuXKK+FfoVVnQVoUwVPnvKnQkwYf7zw1IGQwjzZyKIsJzBAMK5FYUXVgCxhbMZRBfOZxBcWLOi0MLiUy2CsG5FgYUzTzV8YWUGvQkPXz7W8A9qDYVVZ8KhsPo7M9UZ9C3Mf++pYUUxhW1AQGFLBiGFTRlEFDauKJ6w9qkGK2xeUTRh/VMNVNieQTBh65mAE/ZkEEl4cds3QRzhvutv0yAJ+4tCCimkkEIKKaSQQgoppJBCCimkkEIKKaSQQgopzNfl9qKntucwQpmikEIK7YtCCim0LwoppNC+PAsfzgTq7lRIuC99Dbyzev/zuFZdiRs1vhW0rO5Powul5+hRKJtHn8K3OYrtqleh3K76FUrtqmehjNG3UCKP3oXL8+hfuHRXEYTL5oghXPKWQxH2zxFH2JtHJGHf7cAS9uwqmrB9V/GErXNEFLbdDkxhyxxRhfV5xBXW3g5kYZ0RW1hjRBfO5xFfODfHCMLy7YghLO1qFGF+jnGEubdcJOH0HGMJp/IYTTi+HfGE/+9qROFwV2MKPxqjCv/lMa7wbx4jC993Nbbwzxx9CH8DcsB9CofuM50AAAAASUVORK5CYII=" alt=""></div>



  <!-- Inicio de sesion!! -->

    <selectPersonaje v-if="(player.user != '' && player.user != null) && player.character == 0"
       @selectPersonajeF="selectPersonajeF"
       :usuario="this.player.user"
     />








    <!-- Menu para controlar las diferentes ventanas -->

    <div
      class="absolute w-1/2 h-content sm:min-w-640px sm:max-w-800px min-w-full max-w-full transition-slide duration-700"
      id="menu"
      v-bind:style="slide3"
    >
      <menu2 @toggleElement="toggleElement" :class="zIndexMenu" />
    </div>

    <!-- Panel de grupo -->
    <div
      :class="zIndexMenu"
      v-bind:style="slide1"
      class="h-5% w-content max-w-1/2 min-w-1/5 fixed bottom-0 min-h-16 transition-slide duration-700 z-50"
      id="grupo"
      @mouseover="slide2 = '-translate-y-6'"
      @mouseleave="slide2 = slide2Aux"
    >
      <BtnCloseSlideH
        rotate="-rotate-90"
        xPosition="inset-x-0 mx-auto"
        xPositionInitial="right-0"
        xPositionFinal="right-0"
        v-bind:yPosition="slide2"
        yPositionInitial="top-0"
        yPositionFinal="top-full"
        position="absolute"
        size="h-20 w-16"
        @toggleElement="toggleElement"
      />

      <group class="z-20" />
    </div>

    <!-- Panel Dados -->

    <transition name="botonDado">
      <button
        v-if="hideDice"
        @click="openDiceF()"
        :class="zIndexMenu"
        class="fixed bottom-0 right-0 h-3vw w-3vw min-w-8 min-h-8 max-h-16"
      >
        <img
          class="h-full w-full"
          src="https://cdn.iconscout.com/icon/premium/png-256-thumb/dice-1873414-1589537.png"
          alt=""
        />
      </button>
    </transition>

    <transition name="hidePanelDado">
      <vue-resizable
        v-if="!hideDice"
        :class="zIndex.dados"
        :style="
          prueba(
            this.positionDice.width,
            this.positionDice.height,
            this.positionDice.left,
            this.positionDice.top
          )
        "
        style="
          position: fixed;
          min-width: 230px;
          min-height: 170px;
          max-width: 800px;
          max-height: 500px;
        "
        class=""
        ref="resizeStats"
        :dragSelector="positionDice.dragSelector"
        :active="positionDice.handlers"
        :fit-parent="positionDice.fit"
        :max-width="positionDice.maxW"
        :max-height="positionDice.maxH"
        :min-width="positionDice.minW"
        :min-height="positionDice.minH"
        :width="positionDice.width"
        :height="positionDice.height"
        :left="positionDice.left"
        :top="positionDice.top"
        @mount="eHandlerDice"
        @resize:move="eHandlerDice"
        @resize:start="eHandlerDice"
        @resize:end="eHandlerDice"
        @drag:move="eHandlerDice"
        @drag:start="eHandlerDice"
        @drag:end="eHandlerDice"
      >
        <div
          @click="focusF('dados')"
          class="drag-dice h-4 w-4 absolute top-0 left-0 bg-white border border-black z-50 cursor-move"
        >
          M
        </div>
        <paneldado
          @hideDaceFromChild="cerrarDadoFromChild"
          v-bind:close="hideDice"
          @focusF="focusF"
        />
      </vue-resizable>
    </transition>

    <!-- Estadisticas -->
    <vue-resizable
      v-if="!hideEstadisticas"
      :class="zIndex.estadisticas"
      style="
        position: fixed;
        min-width: 250px;
        min-height: 215px;
        max-width: 100%;
        max-height: 90%;
      "
      :style="
        prueba(
          this.positionStats.width,
          this.positionStats.height,
          this.positionStats.left,
          this.positionStats.top
        )
      "
      class=""
      ref="resizeStats"
      :dragSelector="positionStats.dragSelector"
      :active="positionStats.handlers"
      :fit-parent="positionStats.fit"
      :max-width="positionStats.maxW"
      :max-height="positionStats.maxH"
      :min-width="positionStats.minW"
      :min-height="positionStats.minH"
      :width="positionStats.width"
      :height="positionStats.height"
      :left="positionStats.left"
      :top="positionStats.top"
      @mount="eHandlerStats"
      @resize:move="eHandlerStats"
      @resize:start="eHandlerStats"
      @resize:end="eHandlerStats"
      @drag:move="eHandlerStats"
      @drag:start="eHandlerStats"
      @drag:end="eHandlerStats"
    >
      <div
        @click="focusF('estadisticas')"
        class="drag-stats h-4 w-4 absolute top-0 left-0 bg-white border border-black z-50 cursor-move"
      >
        M
      </div>
      <estadisticas
        :objetos="objetos"
        :habilidades="habilities"
        :resetStatsVar="resetStatsVar"
        :player="player"
        @resetStats="resetStats"
        @focusF="focusF"
      />
    </vue-resizable>

    <!-- Objetos -->

    <vue-resizable
      :class="zIndex.objetos"
      :style="
        prueba(
          this.positionObjects.width,
          this.positionObjects.height,
          this.positionObjects.left,
          this.positionObjects.top
        )
      "
      v-if="!hideObjetos"
      style="
        position: fixed;
        min-width: 575px;
        min-height: 330px;
        max-width: 100%;
        max-height: 90%;
      "
      class=""
      ref="resizeStats"
      :dragSelector="positionObjects.dragSelector"
      :active="positionObjects.handlers"
      :fit-parent="positionObjects.fit"
      :max-width="positionObjects.maxW"
      :max-height="positionObjects.maxH"
      :min-width="positionObjects.minW"
      :min-height="positionObjects.minH"
      :width="positionObjects.width"
      :height="positionObjects.height"
      :left="positionObjects.left"
      :top="positionObjects.top"
      @mount="eHandlerObjects"
      @resize:move="eHandlerObjects"
      @resize:start="eHandlerObjects"
      @resize:end="eHandlerObjects"
      @drag:move="eHandlerObjects"
      @drag:start="eHandlerObjects"
      @drag:end="eHandlerObjects"
    >
      <div
        @click="focusF('objetos')"
        class="drag-objects h-4 w-4 absolute top-0 left-0 bg-white border border-black z-50 cursor-move"
      >
        M
      </div>
      <objetos
        v-bind:list="objetos"
        :player="player"
        :inventarios="inventarios"
        @abrirMapa="abrirMapa"
        @abrirNota="abrirNota"
        @focusF="focusF"
      />
    </vue-resizable>

    <!-- Habilidades -->

    <vue-resizable
      v-if="!hideHabilidades"
      :class="zIndex.habilidades"
      :style="
        prueba(
          this.positionHabilities.width,
          this.positionHabilities.height,
          this.positionHabilities.left,
          this.positionHabilities.top
        )
      "
      style="
        position: fixed;
        min-width: 500px;
        min-height: 320px;
        max-width: 1040px;
        max-height: 600px;
      "
      class=""
      ref="resizeStats"
      :dragSelector="positionHabilities.dragSelector"
      :active="positionHabilities.handlers"
      :fit-parent="positionHabilities.fit"
      :max-width="positionHabilities.maxW"
      :max-height="positionHabilities.maxH"
      :min-width="positionHabilities.minW"
      :min-height="positionHabilities.minH"
      :width="positionHabilities.width"
      :height="positionHabilities.height"
      :left="positionHabilities.left"
      :top="positionHabilities.top"
      @mount="eHandlerHabilities"
      @resize:move="eHandlerHabilities"
      @resize:start="eHandlerHabilities"
      @resize:end="eHandlerHabilities"
      @drag:move="eHandlerHabilities"
      @drag:start="eHandlerHabilities"
      @drag:end="eHandlerHabilities"
    >
      <div
        @click="focusF('habilidades')"
        class="drag-habilities h-4 w-4 absolute top-0 left-0 bg-white border border-black z-50 cursor-move"
      >
        M
      </div>
      <panelHabilidades
        :habilities="habilities"
        :resetHabilitiesVar="resetHabilitiesVar"
        @resetStats="resetStats"
        @resetHabilities="resetHabilities"
        @focusF="focusF"
        v-bind:objetos="objetos"
      />
    </vue-resizable>

    <!-- Notas de jugador -->

    <vue-resizable
      v-if="!hideNotasJugador"
      :class="zIndex.notasJ"
      :style="
        prueba(
          this.positionNotesPlayer.width,
          this.positionNotesPlayer.height,
          this.positionNotesPlayer.left,
          this.positionNotesPlayer.top
        )
      "
      style="
        position: fixed;
        min-width: 500px;
        min-height: 260px;
        max-width: 1670px;
        max-height: 760px;
      "
      class=""
      ref="resizeStats"
      :dragSelector="positionNotesPlayer.dragSelector"
      :active="positionNotesPlayer.handlers"
      :fit-parent="positionNotesPlayer.fit"
      :max-width="positionNotesPlayer.maxW"
      :max-height="positionNotesPlayer.maxH"
      :min-width="positionNotesPlayer.minW"
      :min-height="positionNotesPlayer.minH"
      :width="positionNotesPlayer.width"
      :height="positionNotesPlayer.height"
      :left="positionNotesPlayer.left"
      :top="positionNotesPlayer.top"
      @mount="eHandlerNotesPlayer"
      @resize:move="eHandlerNotesPlayer"
      @resize:start="eHandlerNotesPlayer"
      @resize:end="eHandlerNotesPlayer"
      @drag:move="eHandlerNotesPlayer"
      @drag:start="eHandlerNotesPlayer"
      @drag:end="eHandlerNotesPlayer"
    >
      <div
        @click="focusF('notasJ')"
        class="drag-notesPlayer h-4 w-4 absolute top-0 left-0 bg-white border border-black z-50 cursor-move"
      >
        M
      </div>
      <notasJugador
        :player="player"
        @focusF="focusF"
        @toggleElement="toggleElement"
      />
    </vue-resizable>

    <!-- Notas Objeto -->
    <vue-resizable
      v-if="!hideNotas"
      :class="zIndex.notas"
      :style="
        prueba(
          this.positionNotes.width,
          this.positionNotes.height,
          this.positionNotes.left,
          this.positionNotes.top
        )
      "
      style="
        position: fixed;
        min-width: 500px;
        min-height: 260px;
        max-width: 1670px;
        max-height: 760px;
      "
      class=""
      ref="resizeStats"
      :dragSelector="positionNotes.dragSelector"
      :active="positionNotes.handlers"
      :fit-parent="positionNotes.fit"
      :max-width="positionNotes.maxW"
      :max-height="positionNotes.maxH"
      :min-width="positionNotes.minW"
      :min-height="positionNotes.minH"
      :width="positionNotes.width"
      :height="positionNotes.height"
      :left="positionNotes.left"
      :top="positionNotes.top"
      @mount="eHandlerNotes"
      @resize:move="eHandlerNotes"
      @resize:start="eHandlerNotes"
      @resize:end="eHandlerNotes"
      @drag:move="eHandlerNotes"
      @drag:start="eHandlerNotes"
      @drag:end="eHandlerNotes"
    >
      <div
        @click="focusF('notas')"
        class="drag-notes h-4 w-4 absolute top-0 left-0 bg-white border border-black z-50 cursor-move"
      >
        M
      </div>
      <notas :nota="nota" @focusF="focusF" @toggleElement="toggleElement" />
    </vue-resizable>

    <!-- Chat -->

    <button
      v-if="hideChat"
      @click="toggleElement('chat')"
      :class="zIndexMenu"
      class="fixed bottom-0 left-0 h-3vw w-3vw min-w-8 min-h-8 max-h-16"
    >
      <span
        :class="notificacionChat()"
        class="flex h-3 w-3 absolute bottom-5 -right-1"
      >
        <span
          class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"
        ></span>
        <span
          class="relative inline-flex rounded-full h-3 w-3 bg-purple-500"
        ></span>
      </span>
      <img
        class="h-full w-full"
        src="https://cdn.iconscout.com/icon/premium/png-256-thumb/dice-1873414-1589537.png"
        alt=""
      />
    </button>
    <vue-resizable
      :class="zIndex.chat"
      :style="
        prueba(
          this.positionChat.width,
          this.positionChat.height,
          this.positionChat.left,
          this.positionChat.top
        )
      "
      v-if="!hideChat"
      style="
        position: fixed;
        min-width: 290px;
        min-height: 225px;
        max-width: 800px;
        max-height: 800px;
      "
      class=""
      ref="resizeStats"
      :dragSelector="positionChat.dragSelector"
      :active="positionChat.handlers"
      :fit-parent="positionChat.fit"
      :max-width="positionChat.maxW"
      :max-height="positionChat.maxH"
      :min-width="positionChat.minW"
      :min-height="positionChat.minH"
      :width="positionChat.width"
      :height="positionChat.height"
      :left="positionChat.left"
      :top="positionChat.top"
      @mount="eHandlerChat"
      @resize:move="eHandlerChat"
      @resize:start="eHandlerChat"
      @resize:end="eHandlerChat"
      @drag:move="eHandlerChat"
      @drag:start="eHandlerChat"
      @drag:end="eHandlerChat"
    >
      <div
        @click="focusF('chat')"
        class="drag-chat h-4 w-4 absolute top-0 left-0 bg-white border border-black z-50 cursor-move"
      >
        M
      </div>

      <chat
        :chats="chats"
        :jugadores="jugadores"
        :player="player"
        @focusF="focusF"
        @toggleElement="toggleElement"
      />
    </vue-resizable>

    <!-- Panel de los mapas -->

    <vue-resizable
      :class="zIndex.mapas"
      :style="
        prueba(
          this.positionMap.width,
          this.positionMap.height,
          this.positionMap.left,
          this.positionMap.top
        )
      "
      v-if="!hideMapas"
      style="
        position: fixed;
        min-width: 500px;
        min-height: 300px;
        max-width: 1800px;
        max-height: 900px;
      "
      class=""
      ref="resizeStats"
      :dragSelector="positionMap.dragSelector"
      :active="positionMap.handlers"
      :fit-parent="positionMap.fit"
      :max-width="positionMap.maxW"
      :max-height="positionMap.maxH"
      :min-width="positionMap.minW"
      :min-height="positionMap.minH"
      :width="positionMap.width"
      :height="positionMap.height"
      :left="positionMap.left"
      :top="positionMap.top"
      @mount="eHandlerMap"
      @resize:move="eHandlerMap"
      @resize:start="eHandlerMap"
      @resize:end="eHandlerMap"
      @drag:move="eHandlerMap"
      @drag:start="eHandlerMap"
      @drag:end="eHandlerMap"
    >
      <div
        @click="focusF('mapas')"
        class="drag-map h-4 w-4 absolute top-0 left-0 bg-white border border-black z-50 cursor-move"
      >
        M
      </div>
      <panelMapa
        :items="objetos"
        :mapaSE="mapaSelected"
        @abrirMapa="abrirMapa"
        @toggleElement="toggleElement"
        @focusF="focusF"
      />
    </vue-resizable>

    <!-- Panel de equipamiento, trasfondo e imagen -->

    <vue-resizable
      v-if="!hidePersonaje"
      :style="
        prueba(
          this.positionCharacter.width,
          this.positionCharacter.height,
          this.positionCharacter.left,
          this.positionCharacter.top
        )
      "
      :class="zIndex.personaje"
      style="
        position: fixed;
        min-width: 250px;
        min-height: 300px;
        max-width: 700px;
        max-height: 730px;
      "
      class=""
      ref="resizeStats"
      :dragSelector="positionCharacter.dragSelector"
      :active="positionCharacter.handlers"
      :fit-parent="positionCharacter.fit"
      :max-width="positionCharacter.maxW"
      :max-height="positionCharacter.maxH"
      :min-width="positionCharacter.minW"
      :min-height="positionCharacter.minH"
      :width="positionCharacter.width"
      :height="positionCharacter.height"
      :left="positionCharacter.left"
      :top="positionCharacter.top"
      @mount="eHandlerCharacter"
      @resize:move="eHandlerCharacter"
      @resize:start="eHandlerCharacter"
      @resize:end="eHandlerCharacter"
      @drag:move="eHandlerCharacter"
      @drag:start="eHandlerCharacter"
      @drag:end="eHandlerCharacter"
    >
      <div
        @click="focusF('personaje')"
        class="drag-character h-4 w-4 absolute top-0 left-0 bg-white border border-black z-75 cursor-move"
      >
        M
      </div>
      <panelPersonaje
        :objetos="objetos"
        :personaje="personaje"
        @resetStats="resetStats"
        @resetHabilities="resetHabilities"
        @focusF="focusF"
      />
    </vue-resizable>
  </div>
</template>

<script>
import axios from "axios";
import VueResizable from "vue-resizable";

import selectPersonaje from "@/components/modulos/loggin/selectPersonaje.vue";
import menu2 from "@/components/modulos/panelJugador/menu.vue";
import BtnCloseSlideH from "@/components/otros/BtnCloseSlideH.vue";
import group from "@/components/modulos/panelJugador/group.vue";
import paneldado from "@/components/modulos/panelJugador/paneldado.vue";
import estadisticas from "@/components/modulos/panelJugador/estadisticas.vue";
import objetos from "@/components/modulos/panelJugador/panelObjetos.vue";
import notasJugador from "@/components/modulos/panelJugador/notasJugador.vue";
import notas from "@/components/modulos/panelJugador/notas.vue";
import chat from "@/components/modulos/panelJugador/chat.vue";
import panelMapa from "@/components/modulos/panelJugador/panelMapa.vue";
import panelHabilidades from "@/components/modulos/panelJugador/panelHabilidades.vue";
import panelPersonaje from "@/components/modulos/panelJugador/panelPersonaje.vue";

export default {
  name: "panelJugador",
  components: {
    VueResizable,
    menu2,
    BtnCloseSlideH,
    group,
    paneldado,
    estadisticas,
    objetos,
    notasJugador,
    notas,
    chat,
    panelMapa,
    panelHabilidades,
    panelPersonaje,
    selectPersonaje,
  },
  props: {
    player: Object,
  },
  watch: {
    hideGroup: function (val) {
      if (val) {
        this.slide1 =
          "bottom: -" + document.getElementById("grupo").offsetHeight + "px;";
        this.slide2Aux = "-translate-y-6";
      } else {
        this.slide1 = "bottom: 0px;";
        this.slide2Aux = "translate-y-0";
      }
    },
    hideMenu: function (val) {
      this.slideMenu(val);
    },
  },
  methods: {

    logOut(){
      this.$emit("logOut", 1);
    },

     selectPersonajeF(val){
       this.player.character = val.id;
       this.personaje = val;
     },
    



    async loadDataF() {
      while (this.actualizador > 0) {
        this.cargarDatos();
        await this.sleep(2000);
      }
    },
    sleep(ms) {
      return new Promise((resolve) => setTimeout(resolve, ms));
    },

    cargarDatos() {
      this.loadHabilitiesF();
      this.loadObjectsF();
    },

    loadHabilitiesF() {
      axios
        .post("/php/loadHabilities.php", {
          user: this.player.user,
          game: this.player.game,
          system: this.player.system,
          personaje: this.player.character,
        })
        .then((response) => {
          this.habilities = response.data;
        });
    },
    loadObjectsF() {
      axios
        .post("/php/loadObjects.php", {
          game: this.player.game,
          system: this.player.system,
          personaje: this.player.character,
        })
        .then((response) => {
          this.inventarios = response.data[1];
          this.objetos = response.data[0];
        });
    },

    notificacionChat() {
      var aux = "hidden";
      for (var i = 0; i < Object.keys(this.chats).length; i++) {
        if (Object.keys(this.chats[i].messages).length > 0) {
          for (var j = 0; j < Object.keys(this.chats[i].messages).length; j++) {
            if (!this.chats[i].messages[j].readed.includes(this.player.user)) {
              aux = "block";
            }
          }
        }
      }
      return aux;
    },

    focusF(val) {
      this.zIndexChat = "z-90";
      this.zIndexEstadisticas = "z-90";
      this.zIndexNotas = "z-90";
      this.zIndexNotasJ = "z-90";
      this.zIndexDados = "z-90";
      this.zIndexHabilidades = "z-90";
      (this.zIndexMapa = "z-90"), (this.zIndexObjetos = "z-90");
      this.zIndexPersonaje = "z-90";

      if (this.zIndexLista.includes(val)) {
        var index = this.zIndexLista.indexOf(val);
        this.zIndexLista.splice(index, 1);
        this.zIndexLista.unshift(val);
      }

      for (var i = 0; i < this.zIndexLista.length; i++) {
        this.zIndex[this.zIndexLista[i]] = "z-" + (100 - (i + 1) * 10);
      }
    },
    eHandlerStats(data) {
      this.positionStats.width =
        ((data.width / window.innerWidth) * 100).toFixed(0) + "%";
      this.positionStats.height =
        ((data.height / window.innerHeight) * 100).toFixed(0) + "%";

      this.positionStats.left =
        ((data.left / window.innerWidth) * 100).toFixed(0) + "%";
      this.positionStats.top =
        ((data.top / window.innerHeight) * 100).toFixed(0) + "%";
    },
    eHandlerDice(data) {
      this.positionDice.width =
        ((data.width / window.innerWidth) * 100).toFixed(0) + "%";
      this.positionDice.height =
        ((data.height / window.innerHeight) * 100).toFixed(0) + "%";

      this.positionDice.left =
        ((data.left / window.innerWidth) * 100).toFixed(0) + "%";
      this.positionDice.top =
        ((data.top / window.innerHeight) * 100).toFixed(0) + "%";
    },
    eHandlerObjects(data) {
      this.positionObjects.width =
        ((data.width / window.innerWidth) * 100).toFixed(0) + "%";
      this.positionObjects.height =
        ((data.height / window.innerHeight) * 100).toFixed(0) + "%";

      this.positionObjects.left =
        ((data.left / window.innerWidth) * 100).toFixed(0) + "%";
      this.positionObjects.top =
        ((data.top / window.innerHeight) * 100).toFixed(0) + "%";
    },
    eHandlerHabilities(data) {
      this.positionHabilities.width =
        ((data.width / window.innerWidth) * 100).toFixed(0) + "%";
      this.positionHabilities.height =
        ((data.height / window.innerHeight) * 100).toFixed(0) + "%";

      this.positionHabilities.left =
        ((data.left / window.innerWidth) * 100).toFixed(0) + "%";
      this.positionHabilities.top =
        ((data.top / window.innerHeight) * 100).toFixed(0) + "%";
    },
    eHandlerNotesPlayer(data) {
      this.positionNotesPlayer.width =
        ((data.width / window.innerWidth) * 100).toFixed(0) + "%";
      this.positionNotesPlayer.height =
        ((data.height / window.innerHeight) * 100).toFixed(0) + "%";

      this.positionNotesPlayer.left =
        ((data.left / window.innerWidth) * 100).toFixed(0) + "%";
      this.positionNotesPlayer.top =
        ((data.top / window.innerHeight) * 100).toFixed(0) + "%";
    },
    eHandlerNotes(data) {
      this.positionNotes.width =
        ((data.width / window.innerWidth) * 100).toFixed(0) + "%";
      this.positionNotes.height =
        ((data.height / window.innerHeight) * 100).toFixed(0) + "%";

      this.positionNotes.left =
        ((data.left / window.innerWidth) * 100).toFixed(0) + "%";
      this.positionNotes.top =
        ((data.top / window.innerHeight) * 100).toFixed(0) + "%";
    },
    eHandlerChat(data) {
      this.positionChat.width =
        ((data.width / window.innerWidth) * 100).toFixed(0) + "%";
      this.positionChat.height =
        ((data.height / window.innerHeight) * 100).toFixed(0) + "%";

      this.positionChat.left =
        ((data.left / window.innerWidth) * 100).toFixed(0) + "%";
      this.positionChat.top =
        ((data.top / window.innerHeight) * 100).toFixed(0) + "%";
    },
    eHandlerMap(data) {
      this.positionMap.width =
        ((data.width / window.innerWidth) * 100).toFixed(0) + "%";
      this.positionMap.height =
        ((data.height / window.innerHeight) * 100).toFixed(0) + "%";

      this.positionMap.left =
        ((data.left / window.innerWidth) * 100).toFixed(0) + "%";
      this.positionMap.top =
        ((data.top / window.innerHeight) * 100).toFixed(0) + "%";
    },
    eHandlerCharacter(data) {
      this.positionCharacter.width =
        ((data.width / window.innerWidth) * 100).toFixed(0) + "%";
      this.positionCharacter.height =
        ((data.height / window.innerHeight) * 100).toFixed(0) + "%";

      this.positionCharacter.left =
        ((data.left / window.innerWidth) * 100).toFixed(0) + "%";
      this.positionCharacter.top =
        ((data.top / window.innerHeight) * 100).toFixed(0) + "%";
    },

    resetStats(val) {
      this.resetStatsVar = val;
    },
    resetHabilities(val) {
      this.resetHabilitiesVar = val;
    },
    prueba(width, height, left, top) {
      var aux =
        "width: " +
        width +
        "; height: " +
        height +
        "; left: " +
        left +
        "; top: " +
        top +
        ";";

      return aux;
    },
    resize() {
      this.slideMenu(this.hideMenu);
    },
    slideMenu(val) {
      if (val) {
        this.slide3 =
          "bottom: calc(100% - " +
          (document.getElementById("menu").offsetHeight / 100) * 30 +
          "px)";
      } else {
        this.slide3 =
          "bottom: calc(100% - " +
          document.getElementById("menu").offsetHeight +
          "px)";
      }
    },
    openDiceF() {
      this.hideDice = !this.hideDice;
      this.focusF("dados");
    },
    cerrarDadoFromChild(value) {
      this.hideDice = value;
    },
    toggleElement(value) {
      if (value == "Group") {
        this.hideGroup = !this.hideGroup;
      }
      if (value == "menu") {
        this.hideMenu = !this.hideMenu;
      }
      if (value == "stats") {
        this.hideEstadisticas = !this.hideEstadisticas;
        this.focusF("estadisticas");
      }
      if (value == "portrait") {
        this.hidePersonaje = !this.hidePersonaje;
        this.focusF("personaje");
      }
      if (value == "maps") {
        this.hideMapas = !this.hideMapas;
        this.focusF("mapas");
      }
      if (value == "items") {
        this.hideObjetos = !this.hideObjetos;
        this.focusF("objetos");
      }
      if (value == "habilities") {
        this.hideHabilidades = !this.hideHabilidades;
        this.focusF("habilidades");
      }
      if (value == "chat") {
        this.hideChat = !this.hideChat;
        this.focusF("chat");
      }
      if (value == "notes") {
        this.hideNotasJugador = !this.hideNotasJugador;
        this.focusF("notasJ");
      }
      if (value == "notes2") {
        this.hideNotas = !this.hideNotas;
      }
    },
    abrirMapa(id) {
      this.hideMapas = false;
      this.mapaSelected = id;
      this.focusF("mapas");
    },
    abrirNota(val) {
      this.hideNotas = false;
      this.nota = val;
      this.focusF("notas");
    },
  },
  created() {
    window.addEventListener("resize", this.resize);
    this.actualizador = 1;
    this.loadDataF();
  },
  destroyed() {
    window.removeEventListener("resize", this.resize);
  },
  beforeDestroy: function () {
    this.actualizador = 0;
  },
  data() {
    return {
      zIndexLista: [
        "chat",
        "estadisticas",
        "notas",
        "notasJ",
        "dados",
        "habilidades",
        "mapas",
        "objetos",
        "personaje",
      ],

      zIndex: {
        chat: "z-90",
        estadisticas: "z-80",
        notas: "z-70",
        notasJ: "z-60",
        dados: "z-50",
        habilidades: "z-40",
        mapas: "z-30",
        objetos: "z-20",
        personaje: "z-10",
      },

      zIndexMenu: "z-100",

      positionStats: {
        handlers: ["r", "rb", "b"],
        height: "40%",
        width: "40%",
        top: "5%",
        left: "60%",
        maxW: 8000,
        maxH: 8000,
        minW: 250,
        minH: 215,
        fit: true,
        dragSelector: ".drag-stats",
      },

      positionDice: {
        handlers: ["r", "rb", "b"],
        height: "30%",
        width: "25%",
        top: "70%",
        left: "75%",
        maxW: 800,
        maxH: 500,
        minW: 230,
        minH: 170,
        fit: true,
        dragSelector: ".drag-dice",
      },
      positionObjects: {
        handlers: ["r", "rb", "b"],
        height: "45%",
        width: "50%",
        top: "48%",
        left: "0%",
        maxW: 8000,
        maxH: 8000,
        minW: 575,
        minH: 330,
        fit: true,
        dragSelector: ".drag-objects",
      },
      positionHabilities: {
        handlers: ["r", "rb", "b"],
        height: "45%",
        width: "45%",
        top: "48%",
        left: "52%",
        maxW: 1040,
        maxH: 600,
        minW: 500,
        minH: 320,
        fit: true,
        dragSelector: ".drag-habilities",
      },
      positionNotesPlayer: {
        handlers: ["r", "rb", "b"],
        height: "60%",
        width: "60%",
        top: "10%",
        left: "10%",
        maxW: 1670,
        maxH: 760,
        minW: 500,
        minH: 260,
        fit: true,
        dragSelector: ".drag-notesPlayer",
      },
      positionNotes: {
        handlers: ["r", "rb", "b"],
        height: "60%",
        width: "50%",
        top: "10%",
        left: "10%",
        maxW: 1670,
        maxH: 760,
        minW: 500,
        minH: 260,
        fit: true,
        dragSelector: ".drag-notes",
      },
      positionChat: {
        handlers: ["r", "rb", "b"],
        height: "35%",
        width: "25%",
        top: "60%",
        left: "2%",
        maxW: 800,
        maxH: 800,
        minW: 290,
        minH: 225,
        fit: true,
        dragSelector: ".drag-chat",
      },
      positionMap: {
        handlers: ["r", "rb", "b"],
        height: "70%",
        width: "60%",
        top: "15%",
        left: "15%",
        maxW: 1800,
        maxH: 900,
        minW: 500,
        minH: 300,
        fit: true,
        dragSelector: ".drag-map",
      },
      positionCharacter: {
        handlers: ["r", "rb", "b"],
        height: "47%",
        width: "20%",
        top: "0%",
        left: "0%",
        maxW: 700,
        maxH: 730,
        minW: 250,
        minH: 300,
        fit: true,
        dragSelector: ".drag-character",
      },

      hideMenu: false,
      hideGroup: false,
      hideDice: true,
      hideEstadisticas: true,
      hideObjetos: true,
      hideHabilidades: true,
      hideNotasJugador: true,
      hideNotas: true,
      hideChat: true,
      hideMapas: true,
      hidePersonaje: true,
      mapaSelected: -1,
      resetStatsVar: 0,
      resetHabilitiesVar: 0,
      actualizador: 0,
      slide1: "",
      slide2: "",
      slide3: "",
      slide2Aux: "-translate-y-6",
      personaje: {
        id: 2,
        name: "Paco",
        title: "El de los Hombres de Paco",
        image:
          "https://i.pinimg.com/originals/10/d1/85/10d185a1050587ac2a450997689469b6.jpg",
        background:
          "David is an accessibility expert, a world-class front-end developer, a gifted educator, and a compassionate leader. Hes performed black magic with Tailwind UI in Figma that Steve and I didnt even know was possible, and hes been doing an incredible job turning Steves Tailwind UI designs into pixel-perfect HTML and CSS that works for everyone.\n" +
          "\n",
      },
      nota: {},
      objetos: {
        0: {
          id: 0,
          name: "Cota de malla",
          description:
            "Clasica cota de malla hecha de anillas de metal entrelazadas para aumentar su resistencia a ataques penetrantes.",
          type: "Armor",
          effect: {
            0: ["+", 3, "Resistencia en torso", 1, "base"],
            1: ["+", 3, "Resistencia en brazo izquierdo", 1, "base"],
            2: ["+", 3, "Resistencia en brazo derecho", 1, "base"],
          },
          cant: 1,
          weight: 20,

          capacity: 0,
          letter: "",
          hide: false,
          list: "Personal",
          distribucion: {},
          habilities: 0,
          equiped: 2,
          equipedOrigen: "Personal",
          system: 0,
          game: 0,
          character: 0,
          image:
            "https://img.rankedboost.com/wp-content/plugins/legends-of-runeterra/assets/spell-artwork/01DE013-full.png",
        },
        1: {
          id: 1,
          name: "Armadura completa",
          description:
            "Una armadura de cuerpo entero hecha de placas de metal. Pesada pero resistente.",
          type: "Armor",
          effect: {
            0: ["+", 4, "Resistencia en torso", 1, "base"],
            1: ["+", 4, "Resistencia en brazo izquierdo", 1, "base"],
            2: ["+", 4, "Resistencia en brazo derecho", 1, "base"],
            3: ["+", 4, "Resistencia en pierna derecha", 1, "base"],
            4: ["+", 4, "Resistencia en pierna izquierda", 1, "base"],
            5: ["+", 4, "Resistencia en cabeza", 1, "base"],
          },
          cant: 1,
          weight: 40,

          capacity: 0,
          letter: "",
          hide: false,
          list: "Personal",
          distribucion: {},
          habilities: 0,
          equiped: 0,
          equipedOrigen: "",
          system: 0,
          game: 0,
          character: 0,
          image:
            "https://images.contentstack.io/v3/assets/blt731acb42bb3d1659/blt60bf0a94019449a0/5fa1efd76178a9645452d2b8/3075_Tank_T3_Thornmail.png",
        },
        2: {
          id: 2,
          name: "Hacha a dos manos(Mejorada)",
          description:
            "Pesada hacha a dos manos con doble filo. Mejorada habilmente por el maestro herrero Paduol (con la ayuda de Kowalski) haciendo que uno de sus filos esté perfectamente bañado en plata, pudiendo hacer frente a enemigos incorporeos.",
          type: "Weapon",
          effect: {
            0: ["+", 2, "Filo", 0, "base"],
            1: ["+", 1, "Perforante", 0, "base"],
            2: ["+", 1, "Daño", 0, "base"],
          },
          cant: 1,
          weight: 15,

          capacity: 0,
          letter: "",
          hide: false,
          list: "Personal",
          distribucion: {},
          habilities: 0,
          equiped: 6,
          equipedOrigen: "Personal",
          system: 0,
          game: 0,
          character: 0,
          image:
            "http://d1mt9jmphk9kik.cloudfront.net/teamdignitas/image1592423176.png",
        },
        3: {
          id: 11,
          name: "Objeto 1",
          description: "Objeto",
          type: "Weapon",
          effect: {},
          cant: 2,
          weight: 4,

          capacity: 0,
          letter: "",
          hide: false,
          list: "Bolso de viaje2",
          distribucion: {},
          habilities: 0,
          equiped: 0,
          equipedOrigen: "",
          system: 0,
          game: 0,
          character: 0,
          image: "",
        },
        4: {
          id: 12,
          name: "Objeto 2",
          description: "Objeto",
          type: "Other",
          effect: {},
          cant: 1,
          weight: 2,

          capacity: 3,
          letter: "",
          hide: false,
          list: "Bolso de viaje2",
          distribucion: {},
          habilities: 0,
          equiped: 0,
          equipedOrigen: "",
          system: 0,
          game: 0,
          character: 0,
          image: "",
        },
        5: {
          id: 16,
          name: "Mapa de un pais que prueba que Thanos tenia razón",
          description: "La mitad de la gente de este país es muy muy tonta.",
          type: "Map",
          effect: {},
          cant: 1,
          weight: 0.1,

          capacity: 0,
          letter: "",
          hide: false,
          list: "Bolso de viaje2",
          distribucion: {},
          habilities: 0,
          equiped: 0,
          equipedOrigen: "",
          system: 0,
          game: 0,
          character: 0,
          image: "https://pbs.twimg.com/media/EhiQFhAXkAAwrls.jpg",
        },
        6: {
          id: 10,
          name: "Bolso de viaje2",
          description: "Pues... eso, un bolso de viaje.",
          type: "Container",
          effect: {},
          cant: 1,
          weight: 2,

          capacity: 3,
          letter: "",
          hide: false,
          list: "Bolso de viaje",
          distribucion: {},
          habilities: 0,
          equiped: 0,
          equipedOrigen: "",
          system: 0,
          game: 0,
          character: 0,
          image: "",
        },

        7: {
          id: 13,
          name: "Objeto 3",
          description: "Objeto",
          type: "Weapon",
          effect: {},
          cant: 1,
          weight: 7,

          capacity: 0,
          letter: "",
          hide: false,
          list: "Bolso de viaje",
          distribucion: {},
          habilities: 0,
          equiped: 0,
          equipedOrigen: "",
          system: 0,
          game: 0,
          character: 0,
          image: "",
        },

        8: {
          id: 14,
          name: "Objeto 4",
          description: "Objeto",
          type: "Weapon",
          effect: {},
          cant: 1,
          weight: 5,

          capacity: 0,
          letter: "",
          hide: false,
          list: "Bolso de viaje",
          distribucion: {},
          habilities: 0,
          equiped: 0,
          equipedOrigen: "",
          system: 0,
          game: 0,
          character: 0,
          image: "",
        },
        9: {
          id: 9,
          name: "Bolso de viaje",
          description: "Pues... eso, un bolso de viaje.",
          type: "Container",
          effect: {},
          cant: 1,
          weight: 3,

          capacity: 5,
          letter: "",
          hide: false,
          list: "Personal",
          distribucion: {},
          habilities: 0,
          equiped: 0,
          equipedOrigen: "",
          system: 0,
          game: 0,
          character: 0,
          image: "",
        },
        10: {
          id: 15,
          name: "Planos del motel del objetivo",
          description:
            "Plano optenido de un contenedor random. (No era posible ser encontrado, pero Iñaki tubo un golpe de suerte)",
          type: "Map",
          effect: {},
          cant: 1,
          weight: 0.1,

          capacity: 0,
          letter: "",
          hide: false,
          list: "Personal",
          distribucion: {},
          habilities: 0,
          equiped: 0,
          equipedOrigen: "",
          system: 0,
          game: 0,
          character: 0,
          image:
            "https://steamuserimages-a.akamaihd.net/ugc/547509848336863018/A7BCE007F4A9ADA6C3F171601CAF3BCF42356225/",
        },
        11: {
          id: 3,
          name: "Escudo de torre",
          description:
            "Gran escudo de metal, capaz de cubrir al mas alto gerrero desde la rodilla hasta el cuello. Quita la capacidad de usar un arma.",
          type: "Shield",
          effect: {
            0: ["%", 20, "Bloqueo", 1, "base"],
          },
          cant: 1,
          weight: 20,

          capacity: 0,
          letter: "",
          hide: false,
          list: "Refugio",
          distribucion: {},
          habilities: 0,
          equiped: 0,
          equipedOrigen: "",
          system: 0,
          game: 0,
          character: 0,
          image:
            "https://images.contentstack.io/v3/assets/blt731acb42bb3d1659/bltf3dc17f9ce977bcf/5fa1f0001f9166620ed88bd9/3143_Tank_T3_RanduinsOmen.png",
        },
        12: {
          id: 4,
          name: "Hacha/maza corta",
          description:
            "Hacha de una mano bañada en plata. Consta de un lado cortante y otro contundente.",
          type: "Weapon",
          effect: {},
          cant: 1,
          weight: 5,

          capacity: 0,
          letter: "",
          hide: false,
          list: "Refugio",
          distribucion: {},
          habilities: 0,
          equiped: 0,
          equipedOrigen: "",
          system: 0,
          game: 0,
          character: 0,
          image:
            "https://images.contentstack.io/v3/assets/blt731acb42bb3d1659/bltf3dc17f9ce977bcf/5fa1f0001f9166620ed88bd9/3143_Tank_T3_RanduinsOmen.png",
        },
        13: {
          id: 5,
          name: "Escudo lagrima",
          description:
            "Escudo mediano de metal, con forma de lagrima y pinchos.",
          type: "Shield",
          effect: {},
          cant: 1,
          weight: 10,

          capacity: 0,
          letter: "",
          hide: false,
          list: "Refugio",
          distribucion: {},
          habilities: 0,
          equiped: 0,
          equipedOrigen: "",
          system: 0,
          game: 0,
          character: 0,
          image:
            "https://images.contentstack.io/v3/assets/blt731acb42bb3d1659/bltf3dc17f9ce977bcf/5fa1f0001f9166620ed88bd9/3143_Tank_T3_RanduinsOmen.png",
        },
        14: {
          id: 6,
          name: "Gold",
          description: "Monedas de oro. Equivalen a 12 de plata.",
          type: "money",
          effect: {},
          cant: 4,
          weight: 0.1,

          capacity: 0,
          letter: "",
          hide: false,
          list: "Refugio",
          distribucion: {},
          habilities: 0,
          equiped: 0,
          equipedOrigen: "",
          system: 0,
          game: 0,
          character: 0,
          image:
            "https://cdn.shopify.com/s/files/1/0276/3250/0771/products/25-Gold-1.4-oz-Proof-Obv-HighRes-2020-Layered_0c42cb22-507c-4edb-8cbd-ca2b7cd9d29d_1200x1200.png?v=1584311233",
        },
        15: {
          id: 7,
          name: "Silver",
          description: "Monedas de plata. Equivalen a 12 de bronce.",
          type: "money",
          effect: {},
          cant: 10,
          weight: 0.07,

          capacity: 0,
          letter: "",
          hide: false,
          list: "Refugio",
          distribucion: {},
          habilities: 0,
          equiped: 0,
          equipedOrigen: "",
          system: 0,
          game: 0,
          character: 0,
          image:
            "https://tienda.fnmt.es/fnmttv/medias/92897007-anverso1200.jpg?context=bWFzdGVyfHByb2R1Y3RfaW1hZ2VzfDEyMzYwMTN8aW1hZ2UvanBlZ3xwcm9kdWN0X2ltYWdlcy9oYjUvaGEzLzg4Mjk2MTYzOTAxNzQuanBnfGExM2E0ZmE4MWQzZDUwMThhOTNmMzBlY2E3MTAwMTc5YTc1ZmRiYzRiNDM2NGQ4ZDAwM2FhZGZmMTQ3ZjU5MDU",
        },
        16: {
          id: 8,
          name: "Bronze",
          description: "Monedas de bronce.",
          type: "money",
          effect: {},
          cant: 150,
          weight: 0.05,
          capacity: 0,
          letter: "",
          hide: false,
          list: "",
          distribucion: {
            0: ["Refugio", 100],
            1: ["Personal", 30],
            2: ["Bolso de viaje", 20],
          },
          habilities: 0,
          equiped: 0,
          equipedOrigen: "",
          system: 0,
          game: 0,
          character: 0,
          image:
            "https://media.istockphoto.com/photos/blank-bronze-coin-picture-id622435342?s=612x612",
        },

        17: {
          id: 17,
          name: "Bolso de viaje3",
          description: "Pues... eso, un bolso de viaje.",
          type: "Container",
          effect: {},
          cant: 1,
          weight: 3,

          capacity: 5,
          letter: "",
          hide: false,
          list: "Bolso de viaje2",
          distribucion: {},
          habilities: 0,
          equiped: 0,
          equipedOrigen: "",
          system: 0,
          game: 0,
          character: 0,
          image: "",
        },

        18: {
          id: 18,
          name: "Nota de Rodrigo",
          description: "Nota de Rodrigo pa Paco",
          type: "Note",
          effect: {},
          cant: 1,
          weight: 3,

          capacity: 0,
          letter:
            "Hola Paco, que tal? Yo muy bien. PD: Me estoy trincando a tu prima.",
          hide: false,
          list: "Personal",
          distribucion: {},
          habilities: 0,
          equiped: 0,
          equipedOrigen: "",
          system: 0,
          game: 0,
          character: 0,
          image: "",
        },
        19: {
          id: 19,
          name: "Nota de Rodrigo2",
          description: "Nota de Rodrigo pa Paco 2",
          type: "Note",
          effect: {},
          cant: 1,
          weight: 3,

          capacity: 0,
          letter: "Esto es la nota numero 2",
          hide: false,
          list: "Personal",
          distribucion: {},
          habilities: 0,
          equiped: 0,
          equipedOrigen: "",
          system: 0,
          game: 0,
          character: 0,
          image: "",
        },
        20: {
          id: 20,
          name: "Botas bonitas",
          description: "Botas magicaliciosas",
          type: "Boots",
          effect: {},
          cant: 1,
          weight: 3,

          capacity: 0,
          letter: "",
          hide: false,
          list: "Personal",
          distribucion: {},
          habilities: 1,
          equiped: 0,
          equipedOrigen: "",
          system: 0,
          game: 0,
          character: 0,
          image: "",
        },
        21: {
          id: 21,
          name: "Croquis Ciudad",
          description: "",
          type: "Map",
          effect: {},
          cant: 1,
          weight: 3,

          capacity: 0,
          letter: "",
          hide: false,
          list: "Personal",
          distribucion: {},
          habilities: 1,
          equiped: 0,
          equipedOrigen: "",
          system: 0,
          game: 0,
          character: 0,
          image:
            "https://cdn.discordapp.com/attachments/791361632987119656/827956626736545822/unknown.png",
        },
      },
      inventarios: {
        0: {
          name: "Papelera",
          block: false,
          compartir: [],
        },
        1: {
          name: "Personal",
          block: false,
          compartir: [],
        },
        2: {
          name: "Refugio",
          block: false,
          compartir: [],
        },
      },
      habilities: {
        0: {
          id: 0,
          name: "Aliento de Dragon",
          atribute: "Fuego",
          type: "Magias",
          class: "Habilidades",
          effect: {},
          difficulty: {
            stat: "INT",
            modificador: "-10",
            dice: null,
          },
          cost: {
            value: 10,
            stat: "Mana",
          },
          description: "Crea un area conica de fuego enfrente del lanzador.",
          from: -1,
          fromName: "",
          equiped: 0,
          see: true,
        },
        1: {
          id: 1,
          name: "Tiro preciso",
          atribute: "Punteria",
          type: "Magias",
          class: "Habilidades",
          effect: {},
          difficulty: {
            stat: "HP",
            modificador: "+10",
            dice: null,
          },
          cost: "5 Mana",
          description: "Realiza un tiro preciso.",
          from: -1,
          fromName: "",
          equiped: 0,
          see: true,
        },
        2: {
          id: 2,
          name: "Acrobacias",
          atribute: "Movimiento",
          type: "Magias",
          class: "Habilidades",
          effect: {
            0: ["+", 15, "Agilidad", 1, "base", "AGI"],
          },
          difficulty: {
            stat: "Culo",
            modificador: "+100",
            dice: 100,
          },
          cost: "100 Mana",
          description: "Piruetas chachis",
          from: 20,
          fromName: "",
          equiped: 0,
          see: false,
        },
        3: {
          id: 3,
          name: "Esconderse en las sombras",
          atribute: "Sigilo",
          type: "Subterfugio",
          class: "Pasivas",
          effect: {
            0: ["+", 5, "Habilidad de armas", 1, "base", "HA"],
          },
          difficulty: {
            stat: "",
            modificador: "0",
            dice: null,
          },
          cost: "",
          description: "Eres negro.",
          from: -1,
          fromName: "",
          equiped: 0,
          see: true,
        },
        4: {
          id: 4,
          name: "Maestria contra enemigos grandes",
          atribute: "Ataque",
          type: "Combate",
          class: "Pasivas",
          effect: {
            0: ["%", 50, "Fuerza", 1, "base", "F"],
          },
          difficulty: {
            stat: "",
            modificador: "0",
            dice: null,
          },
          cost: "",
          description:
            "Eres un experto luchando contra enemigos grandes (Los gordos tambien cuentan).",
          from: -1,
          fromName: "",
          equiped: 0,
          see: true,
        },
        5: {
          id: 5,
          name: "Rubia pechugona",
          atribute: "Persuadir",
          type: "Carisma",
          class: "Pasivas",
          effect: {
            0: ["%", -40, "Inteligencia", 1, "base", "INT"],
            1: ["%", 100, "Empatia", 1, "base", "EMP"],
          },
          difficulty: {
            stat: "",
            modificador: "0",
            dice: null,
          },
          cost: "",
          description: "Estas muuuuuuuy buena, tienes la vida soluccionada.",
          from: -1,
          fromName: "",
          equiped: 0,
          see: true,
        },
      },
      chats: {
        0: {
          id: 0,
          name: "Chat 1",
          users: {
            0: {
              id: 0,
              user: "Pablito",
              character: "Personaje 1",
              color: "green",
              rol: "player",
            },
            1: {
              id: 1,
              user: "Diegoriño",
              character: "Master",
              color: "red",
              rol: "master",
            },
            2: {
              id: 0,
              user: "Jorgito",
              character: "Personaje 2",
              color: "yellow",
              rol: "player",
            },
          },
          messages: {
            0: {
              chat: 0,
              from: "Pablito",
              text: "Prueba de mensaje 1",
              order: 0,
              readed: ["Jorgito", "Pablito", "Diegoriño"],
            },
            1: {
              chat: 0,
              from: "Jorgito",
              text: "Respuesta a prueba 1",
              order: 1,
              readed: ["Jorgito", "Pablito", "Diegoriño"],
            },
            2: {
              chat: 0,
              from: "Diegoriño",
              text: "Respuesta 2",
              order: 2,
              readed: ["Diegoriño"],
            },
            3: {
              chat: 0,
              from: "Diegoriño",
              text: "Pregunta 2",
              order: 3,
              readed: ["Diegoriño"],
            },
            4: {
              chat: 0,
              from: "Jorgito",
              text: "Respuesta a pregunta 2",
              order: 3,
              readed: ["Jorgito"],
            },
          },
        },
        1: {
          id: 1,
          name: "Chat 2",
          users: {
            0: {
              id: 1,
              user: "Diegoriño",
              character: "Master",
              color: "red",
              rol: "master",
            },
            1: {
              id: 0,
              user: "Jorgito",
              character: "Personaje 2",
              color: "yellow",
              rol: "player",
            },
          },
          messages: {
            0: {
              chat: 1,
              from: "Diegoriño",
              text: "Respuesta 2",
              order: 0,
              readed: ["Jorgito", "Diegoriño"],
            },
            1: {
              chat: 1,
              from: "Diegoriño",
              text: "Pregunta 2",
              order: 1,
              readed: ["Diegoriño"],
            },
          },
        },
        2: {
          id: 2,
          name: "Chat 3",
          users: {},
          messages: {},
        },
      },
      jugadores: {
        0: {
          id: 0,
          user: "Diegoriño",
          character: "Master",
          rol: "master",
        },
        1: {
          id: 0,
          user: "Pablito",
          character: "Personaje 1",
          rol: "player",
        },
        2: {
          id: 0,
          user: "Jorgito",
          character: "Personaje 2",
          rol: "player",
        },
        3: {
          id: 0,
          user: "Jugador 3",
          character: "Personaje 3",
          rol: "player",
        },
        4: {
          id: 0,
          user: "Jugador 4",
          character: "Personaje 4",
          rol: "player",
        },
        5: {
          id: 0,
          user: "Jugador 5",
          character: "Personaje 5",
          rol: "player",
        },
      },
    };
  },
};
</script>

<style scoped>
.hidePanelDado-enter-active {
  animation: hidePanelDado-in 1s;
}
.hidePanelDado-leave-active {
  animation: hidePanelDado-in 1s reverse;
}
@keyframes hidePanelDado-in {
  0% {
    transform: scale(0);
    right: -10%;
    bottom: -10%;
    opacity: 0;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}

/* transicion Menu */
.slideMenu-enter-active {
  transition: all 0.7s;
}
.slideMenu-leave-active {
  transition: all 0.7s;
}
.slideMenu-enter,
.slideMenu-leave-to {
  transform: translateX(-6rem);
}

/* transicion boton dado */
.botonDado-enter-active {
  animation: botonDado-in 1s;
}
.botonDado-leave-active {
  animation: botonDado-in 1s reverse;
}
@keyframes botonDado-in {
  0% {
    transform: scale(0);
    opacity: 0;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}
</style>