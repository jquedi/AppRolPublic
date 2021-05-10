<template>
  <div
    id="notasJugador"
    class="h-full w-full border-2 border-black bg-gray-200"
    @click="focusF"
  >
    <div
      @click="toggleElement"
      class="absolute top-0 right-0 bg-red-400 cursor-pointer z-60"
    >
      X
    </div>
    <div
      class="w-1/4 absolute text-left overflow-auto scrollbar-thin text-opacity-70 bottom-0 h-full"
    >
      <BtnCloseSlide2 direccion="left" @CerrarLista="CerrarLista" />
      <transition name="hideLista">
        <div
          class="px-2 py-6 border-r border-black h-full w-full bg-gray-500 absolute z-10 overflow-auto"
          v-if="!hideLista"
        >
          <div
            class="mb-4 flex flex-col"
            v-for="(nota, index) in notas"
            :key="index"
          >
            <div
              class="relative rounded-lg border border-black overflow-hidden"
            >
              <input
                @click="abrirNota(index)"
                :style="remarcado(index)"
                :class="renameAlert(index)"
                @keyup="renameF(nota.tittle)"
                class="cursor-pointer w-full bg-white p-2 italic font-bold underline focus:outline-none focus:ring focus:border-blue-300"
                type="text"
                v-model="nota.tittle"
                :readonly="rename != index"
              />
              <button
                @click="opciones(index)"
                class="absolute h-full p-1 w-content right-0 top-0 bg-red-200"
              >
                ª
              </button>
            </div>
            <div
              v-if="editar == index"
              class="h-content w-full bg-white mr-0 top-full grid grid-cols-2"
            >
              <button @click="renombrar(index)">Rename</button>
              <button @click="deleteF(index)">Delete</button>
            </div>
          </div>

          <div
            v-if="Object.keys(notas).length < 1"
            class="w-full bg-white rounded-lg border border-black p-2 mb-4 italic font-bold underline"
          >
            Vacio
          </div>
          <button
            @click="addNote()"
            class="h-6 w-6 absolute bottom-1 left-1 bg-green-400 rounded-md"
          >
            +
          </button>
        </div>
      </transition>
    </div>
    <div
      :class="width"
      class="py-6 px-4 bg-gray-400 absolute h-full right-0 transition-all duration-700 delay-0"
    >
      <div
        class="h-full w-full bg-white border-2 border-red-400 rounded-3xl py-6 px-4 text-left"
      >
        <textarea
          @keyup="reescribir()"
          class="h-full w-full resize-none"
          v-model="notaInfo"
        >
        </textarea>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import BtnCloseSlide2 from "@/components/otros/BtnCloseSlide2.vue";

export default {
  name: "notasJugador",
  components: {
    BtnCloseSlide2,
  },
  props: {
    player: Object,
  },
  data() {
    return {
      notas: {},
      hideLista: false,
      width: "w-3/4",
      notaInfo: "",
      seleccionado: 0,
      editar: -1,
      rename: -1,
    };
  },
  methods: {
    toggleElement() {
      this.$emit("toggleElement", "notes");
    },
    focusF() {
      this.$emit("focusF", "notasJ");
    },
    CerrarLista(val) {
      this.hideLista = val;
      if (this.hideLista) {
        this.width = "w-full";
      } else {
        this.width = "w-3/4";
      }
    },
    abrirNota(val) {
      if (this.seleccionado != val) {
        this.editar = -1;
        this.rename = -1;
      }
      this.seleccionado = val;
      if (Object.keys(this.notas).length < 1) {
        this.notaInfo = "NO HAY NOTAS";
      } else {
        this.notaInfo = this.notas[val].content;
      }
    },
    remarcado(val) {
      if (this.seleccionado == val) {
        var aux = "background: yellow";
      } else {
        aux = "";
      }
      return aux;
    },
    renameAlert(index){
      var aux = "";
      if(this.rename == index){
        aux = "animate-pulse";
      }
      return aux;
    },
    renameF(val){
      var query = "UPDATE `notesPlayer` SET `tittle`= '" + val + "' WHERE `id` = " + this.notas[this.seleccionado].id;


      this.updateNotes(query, 0);
    },
    reescribir() {

      
      var query = "UPDATE `notesPlayer` SET `content`= '" + this.notaInfo + "' WHERE `id` = " + this.notas[this.seleccionado].id;


      this.updateNotes(query, 0);

      
      this.notas[this.seleccionado]["content"] = this.notaInfo;
    },
    opciones(val) {
      if (this.editar == val) {
        this.editar = -1;
      } else {
        this.editar = val;
      }
      this.rename = -1;
    },
    renombrar(val) {
      this.rename = val;
    },
    deleteF(val) {
      // this.$delete(this.notas, val);
      // this.reorganizarLista();
      // if (this.seleccionado == val) {
      //   this.abrirNota(val);
      // }


      
      var query = "DELETE FROM `notesPlayer` WHERE `id` = " + this.notas[val].id;


      this.updateNotes(query, 1);


      this.editar = -1;
      this.rename = -1;
    },
    reorganizarLista() {
      for (var i = 0; i < Object.keys(this.notas).length; i++) {
        if (this.notas[i] == null) {
          for (var j = i; j < Object.keys(this.notas).length; j++) {
            this.notas[j] = this.notas[j + 1];
          }
          this.$delete(this.notas, Object.keys(this.notas).length - 1);
        }
      }
    },
    addNote() {
      
      var query = "INSERT INTO `notesPlayer`(`tittle`, `game`, `user`, `content`) VALUES ('NEW NOTE'," + this.player.game + ", '" + this.player.user + "', '')"


      this.updateNotes(query, 1);


      // this.notas[Object.keys(this.notas).length] = aux;
      // this.seleccionado = Object.keys(this.notas).length - 1;
      // this.abrirNota(this.seleccionado);
      // this.rename = Object.keys(this.notas).length - 1;
    },
    loadNotes(val){
        axios
          .post("/php/loadNotesPlayer.php", {
            user: this.player.user,
            game: this.player.game,
          })
          .then((response) => {
            this.notas = response.data;
            this.abrirNota(val);
        });
    },
    updateNotes(query, load){
        axios
          .post("/php/update.php", {
            consulta: query,
          })
          .then(() => {
            if(load == 1){
              this.loadNotes(this.seleccionado);
            }
        });
    },
  },
  created: function () {
    this.loadNotes(0);
  },
};
</script>

<style scoped>
.hideLista-leave-active {
  transition: all 0.7s;
}
.hideLista-enter-active {
  transition: all 0.7s;
}
.hideLista-enter,
.hideLista-leave-to {
  transform: translateX(-100%);
}
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