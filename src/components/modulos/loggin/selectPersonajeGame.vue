<template>
  <div
    style="z-index: 3000"
    class="absolute h-full w-full"
    id="selectPersonajeGame"
  >
    <div
      @click="cerrar()"
      class="absolute h-full w-full bg-black bg-opacity-40"
    ></div>
    <div
      class="absolute h-4/5 w-4/5 bg-gray-200 ring-2 inset-0 mt-6 m-auto rounded-xl flex flex-row gap-10 p-10"
    >
        <personajeMiniFicha
            :class="seleccionado(personaje.id)"
          v-for="(personaje, index) in personajes"
          :key="index"
          :personaje="personaje"
          @selectPersonajeF="selectPersonajeF"
        />
        <div class="absolute bottom-0 flex flex-row w-full p-4">
        <div
          @click="cerrar()"
          class="p-3 rounded-lg cursor-pointer bg-red-400"
        >
          Atrás
        </div>
        <div
            v-if="selected > -1"
          @click="jugar()"
          class="p-3 right-1/2 absolute rounded-lg cursor-pointer bg-green-400"
        >
          JUGAR
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// import axios from "axios";
import personajeMiniFicha from "@/components/modulos/loggin/personajeMiniFicha.vue";
export default {
  name: "selectPersonajeGame",
  components: {
    personajeMiniFicha,
    },
  props: {
    personajes: Object,
  },
  data() {
    return {
        selected: -1,
    };
  },
  methods: {
      seleccionado(id){
          if(this.selected == id){
              var aux = "transition-all duration-150 transform scale-150 ring-green-400 z-90";
          }else{
              aux = "";
          }
          return aux;
      },
      selectPersonajeF(val){
          if(this.selected == val.id){
            this.selected = -1;
          }else{
              this.selected = val.id;
          }
          
      },
    cerrar() {
      this.$emit("cerrar");
    },
    jugar(){
        this.$emit("jugar", this.selected);
    },
  },
};
</script>

<style scoped>
:focus {
  outline: none;
}
</style>