<template>
  <div
    id="chat"
    class="h-full w-full bg-gray-400 rounded-lg flex flex-col overflow-hidden border-2 border-black"
    @click="focusF"
  >
    <div
      @click="toggleElement"
      class="absolute top-0 right-0 bg-red-400 cursor-pointer z-60"
    >
      X
    </div>
    <div
      class="w-full h-8 bg-red-200 pt-1 px-3 flex flex-row border-b border-black"
    >
      <button
        :style="Zindexes(index)"
        @click="selected = index"
        v-for="(chat, index) in chats"
        :key="index"
        class="relative w-content h-full bg-green-200 rounded-t-lg border-t border-l border-r border-black -ml-2 px-2"
      >
        <span
          :class="notificacionPestaña(chat)"
          class="flex h-3 w-3 absolute bottom-5 -right-1"
        >
          <span
            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"
          ></span>
          <span
            class="relative inline-flex rounded-full h-3 w-3 bg-purple-500"
          ></span>
        </span>
        {{ chat.name }}
      </button>

      <button
        @click="(nuevoChat = 1), (checkedPlayers = [player])"
        class="relative w-content h-full bg-green-200 rounded-t-lg border-t border-l border-r border-black -ml-2 px-2"
      >
        +
      </button>
    </div>
    <div class="w-full h-full bg-blue-200 relative">
      <div
        v-if="nuevoChat == 1 || nuevoChat == 2 || nuevoChat == 3"
        class="h-full w-full absolute bg-gray-600 bg-opacity-90 z-50"
      >
        <div class="h-full w-full flex flex-row">
          <div v-if="nuevoChat == 1" class="h-full w-full flex flex-col">
            <div
              class="text-left overflow-y-auto text-white"
              v-for="(jugador, index) in jugadores"
              :key="index"
            >
              <div v-if="jugador.user != player['user']">
                <input
                  class="mr-2 m-2"
                  type="checkbox"
                  id="checkbox"
                  v-model="checkedPlayers"
                  :value="jugador"
                />
                {{ jugador.character }}({{ jugador.user }})
              </div>
            </div>
          </div>
          <div
            v-if="nuevoChat == 2 || nuevoChat == 3"
            class="h-full w-full flex flex-col"
          >
            <div class="p-1">
              <div class="text-white">Titulo del chat</div>
              <input class="mr-2" type="text" id="text" v-model="newName" />
            </div>
          </div>
          <div class="h-full w-2/6">
            <button
              v-if="nuevoChat == 3"
              @click="changeNameChat()"
              class="rounded bg-green-200 border border-black mt-4"
            >
              Cambiar
            </button>
            <button
              v-if="nuevoChat == 2"
              @click="newChat()"
              class="rounded bg-green-200 border border-black mt-4"
            >
              Crear
            </button>
            <button
              v-if="nuevoChat == 1"
              @click="nuevoChat = 2"
              class="rounded bg-green-200 border border-black mt-4"
            >
              Siguiente
            </button>
            <button
              @click="
                (nuevoChat = 0),
                  (checkedPlayers = [player]),
                  (newName = 'New chat')
              "
              class="rounded bg-red-200 border border-black mt-4"
            >
              Cancelar
            </button>
          </div>
        </div>
      </div>
      <div
        ref="msgArea"
        class="scroll absolute h-full w-full p-4 overflow-y-auto"
      >
        <div
          v-for="(mensaje, index) in chats[selected]['messages']"
          :key="index"
          :class="mensajeClass(mensaje.from)"
          class="w-5/6 h-content relative mt-6 mb-4"
        >
          <div
            :style="'border-color: ' + colorUsuario(mensaje.from)"
            :class="mensajePersonaClass(mensaje.from)"
            class="absolute h-6 w-content bottom-full bg-white rounded-b-none rounded-md p-1 border border-black border-b-0"
          >
            {{ mensaje.from }}
          </div>
          <div
            :style="'border-color: ' + colorUsuario(mensaje.from)"
            class="w-full h-content bg-white rounded-lg border border-black text-left p-2 whitespace-pre-line"
          >
            {{ mensaje.text }}
          </div>
        </div>
      </div>

      <div
        class="items-end flex flex-row flex-nowrap h-content absolute bottom-0 w-full space-x-4 px-2"
      >
        <button
          @click="hideInfoChat = !hideInfoChat"
          class="h-6 w-6 flex-none bg-red-200 border border-black rounded-md mb-2"
        >
          I
          <div
            v-if="!hideInfoChat"
            class="absolute h-content w-content bg-gray-400 bottom-full rounded-md border border-black flex flex-col"
          >
            <div
              v-for="(user, index) in chats[selected]['users']"
              :key="index"
              class="p-1 flex flex-row"
            >
              <div
                :style="'background: ' + user.color"
                class="h-4 w-4 rounded-sm border-2 border-black mr-2"
              ></div>
              <div class="">{{ user.character }}({{ user.user }})</div>
            </div>
          </div>
        </button>
        <div
          :class="opacity"
          class="flex flex-row flex-grow bg-gray-200 border border-b-0 border-black rounded-md rounded-b-none overflow-hidden"
        >
          <textarea
            v-model="texto"
            :rows="row"
            @keyup.enter.exact="save()"
            @blur="focus = false"
            @focus="focus = true"
            class="resize-none h-content w-full min-h-8 max-h-20 px-2 py-1"
          ></textarea>
          <button
            @click="save('enter')"
            class="bg-green-400 w-6 h-content min-h-8 self-end"
          >
            V
          </button>
        </div>
        <div
          class="h-6 w-6 flex-none bg-red-200 border border-black rounded-md mb-2"
        >
          <button
            @click="hideOpcionesChat = !hideOpcionesChat"
            class="h-full w-full"
          >
            S
          </button>
          <div
            v-if="!hideOpcionesChat"
            class="absolute h-content w-content bg-gray-400 right-0 bottom-full rounded-md border border-black flex flex-col"
          >
            <button
              @click="deleteChat()"
              class="border border-black bg-white w-full"
            >
              Eliminar
            </button>
            <button
              @click="abrirChangeNameChat()"
              class="border border-black bg-white w-full"
            >
              Renombrar
            </button>
            <button
              v-if="!silenciadoF(chats[selected])"
              @click="silenciarF(chats[selected])"
              class="border border-black bg-white w-full"
            >
              Silenciar
            </button>
            <button
              v-if="silenciadoF(chats[selected])"
              @click="silenciarF(chats[selected])"
              class="border border-black bg-white w-full"
            >
              Dessilenciar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "chat",
  components: {},
  props: {
    chats: Object,
    jugadores: Object,
    player: Object,
  },
  data() {
    return {
      hideInfoChat: true,
      hideOpcionesChat: true,
      texto: "",
      row: 1,
      selected: 0,
      focus: false,
      opacity: "opacity-50",
      checkedPlayers: [this.player],
      nuevoChat: 0,
      newName: "New chat",
      silenciados: {},
    };
  },
  watch: {
    selected: function (val) {
      this.leerMensajes(this.chats[val]);
      this.scrollBottom();
    },
    focus: function (val) {
      if (val) {
        this.opacity = "opacity-100";
      } else {
        this.opacity = "opacity-50";
      }
    },

    texto: function (val) {
      var posicion = 0;
      var aux = 1;
      while (posicion > -1) {
        posicion = val.indexOf("\n", posicion + 1);
        if (posicion > -1) {
          if (aux < 5) {
            aux++;
          }
        } else {
          break;
        }
      }
      this.row = aux;
    },
  },
  methods: {
    toggleElement() {
      this.$emit("toggleElement", "chat");
    },
    focusF() {
      this.$emit("focusF", "chat");
    },
    deleteChat() {
      this.$delete(this.chats, this.selected);
      this.selected = 0;
      this.hideOpcionesChat = true;
      this.reorganizarLista(this.chats);
    },
    changeNameChat() {
      this.chats[this.selected]["name"] = this.newName;

      this.newName = "New chat";
      this.nuevoChat = 0;
    },
    abrirChangeNameChat() {
      this.newName = this.chats[this.selected]["name"];
      this.nuevoChat = 3;
      this.hideOpcionesChat = true;
    },
    newChat() {
      var objeto = {
        id: 0,
        character: "",
        user: "",
        color: "",
        rol: "",
      };

      var usuarios = {};

      for (var i = 0; i < this.checkedPlayers.length; i++) {
        objeto["character"] = this.checkedPlayers[i]["character"];
        objeto["user"] = this.checkedPlayers[i]["user"];
        objeto["rol"] = this.checkedPlayers[i]["rol"];
        const randomColor = Math.floor(Math.random() * 16777215).toString(16);
        objeto["color"] = "#" + randomColor;

        usuarios[i] = objeto;

        objeto = {
          id: 0,
          character: "",
          user: "",
          color: "",
          rol: "",
        };
      }

      var aux = {
        id: Object.keys(this.chats).length,
        name: this.newName,
        users: usuarios,
        messages: {},
      };

      this.chats[Object.keys(this.chats).length] = aux;

      this.checkedPlayers = [this.player];
      this.newName = "New chat";
      this.nuevoChat = 0;
    },
    colorUsuario(val) {
      var aux = "";
      for (
        var i = 0;
        i < Object.keys(this.chats[this.selected]["users"]).length;
        i++
      ) {
        if (this.chats[this.selected]["users"][i]["user"] == val) {
          aux = this.chats[this.selected]["users"][i]["color"];
        }
      }
      return aux;
    },
    scrollBottom() {
      setTimeout(function () {
        var container = document.querySelector(".scroll");
        var scrollHeight = container.scrollHeight;
        container.scrollTop = scrollHeight;
      }, 10);
    },
    leerMensajes(val) {
      var aux = this.mensajesLeidos(val).noLeidos;
      for (var i = 0; i < aux.length; i++) {
        val["messages"][aux[i]]["readed"].push(this.player["user"]);
      }
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

    silenciarF(val) {
      if (this.silenciadoF(val)) {
        var j = Object.keys(this.silenciados).length;

        for (var i = 0; i < j; i++) {
          if (this.silenciados[i] == val.id) {
            this.$delete(this.silenciados, i);
            this.reorganizarLista(this.silenciados);
          }
        }
      } else {
        this.silenciados[Object.keys(this.silenciados).length] = val.id;
      }
      this.hideOpcionesChat = true;
    },
    silenciadoF(val) {
      var silenciado = false;
      for (var i = 0; i < Object.keys(this.silenciados).length; i++) {
        if (this.silenciados[i] == val.id) {
          silenciado = true;
        }
      }
      return silenciado;
    },
    notificacionPestaña(val) {
      var aux = this.mensajesLeidos(val).leidos;

      if (aux.length < Object.keys(val["messages"]).length) {
        if (this.silenciadoF(val)) {
          var aux2 = "hidden";
        } else {
          aux2 = "block";
        }
      } else {
        aux2 = "hidden";
      }
      return aux2;
    },
    mensajesLeidos(val) {
      var aux = [];
      var aux2 = [];
      var leido = false;
      for (var i = 0; i < Object.keys(val["messages"]).length; i++) {
        if (val["messages"][i]["readed"].includes(this.player["user"])) {
          leido = true;
        }

        if (leido) {
          aux.push(i);
        } else {
          aux2.push(i);
        }
        leido = false;
      }

      return {
        leidos: aux,
        noLeidos: aux2,
      };
    },
    mensajeClass(val) {
      if (val == this.player["user"]) {
        var aux = "float-right";
      } else {
        aux = "float-left";
      }
      return aux;
    },
    mensajePersonaClass(val) {
      if (val == this.player["user"]) {
        var aux = "right-2";
      } else {
        aux = "left-2";
      }
      return aux;
    },
    Zindexes(index) {
      var cant = Object.keys(this.chats).length;
      var aux = "z-index: ";

      if (this.selected == index) {
        aux += cant + 1;
        aux += "; background: yellow;";
      } else {
        aux += cant - index;
      }

      return aux;
    },
    saltoLinea() {
      this.texto += "\n";
    },
    save() {
      if (Object.keys(this.chats[this.selected]["messages"]).length < 1) {
        var orden = 0;
      } else {
        orden =
          this.chats[this.selected]["messages"][
            Object.keys(this.chats[this.selected]["messages"]).length - 1
          ]["order"] + 1;
      }

      var aux = {
        chat: this.selected,
        from: this.player["user"],
        text: this.texto,
        order: orden,
        readed: [this.player["user"]],
      };
      if (this.texto != "" && this.texto != "\n") {
        this.chats[this.selected]["messages"][
          Object.keys(this.chats[this.selected]["messages"]).length
        ] = aux;
      }

      this.texto = "";
      this.scrollBottom();
    },
  },
  mounted() {
    this.scrollBottom();
    this.leerMensajes(this.chats[this.selected]);
  },
  created: function () {},
};
</script>

<style scoped>
:focus {
  outline: none;
}
textarea:focus {
  outline: auto;
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