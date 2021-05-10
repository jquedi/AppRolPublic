<template>
    <div style="z-index: 3000;" class="fixed w-full h-full bg-gray-400" id="selectPersonaje">
        <div class="font-sans flex flex-col absolute bg-gray-100 h-80% w-80% m-auto inset-0 rounded-2xl shadow-2xl ring-4 ring-gray-600 ring-opacity-40 overflow-y-auto">
            <div class="my-10 text-3xl font-bold underline">
                Tus personajes
            </div>
            <div class="flex flex-row flex-wrap w-full h-full p-4 gap-10">
               <personajeMiniFicha v-for="(personaje, index) in personajes" :key="index" :personaje="personaje" @selectPersonajeF="selectPersonajeF" />
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import personajeMiniFicha from "@/components/modulos/loggin/personajeMiniFicha.vue"

export default {
    name: "selectPersonaje",
    components: {
        personajeMiniFicha,
    },
    props: {
        usuario: String,
    },
    data(){
        return {
            personajes: {},
        }
    },
    methods: {
        selectPersonajeF(val){
            this.$emit("selectPersonajeF", val);
        },
        loadCharacters(){
            axios
            .post("/php/loadAllUserCharacters.php", {
                user: this.usuario,
            })
            .then((response) => {
                this.personajes = response.data;
            });
        },
    },
    created: function(){
        this.loadCharacters();
    }
}
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