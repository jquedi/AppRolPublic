<template>
  <div
    class="bg-red-200 rounded-t h-full w-full py-2 flex flex-row flex-nowrap justify-start overflow-x-auto"
    id="group"
  >
    <aliadoMiniatura
      v-for="(aliado, index) in grupo"
      v-bind:key="index"
      v-bind:id="grupo[index]['id']"
      v-bind:nombre="grupo[index]['nombre']"
      v-bind:imagen="grupo[index]['imagen']"
    />
  </div>
</template>

<script>
import aliadoMiniatura from "@/components/modulos/panelJugador/modulosGrupo/aliadoMiniatura.vue";

export default {
  name: "group",
  components: {
    aliadoMiniatura,
  },
  props: {},
  data() {
    return {
      grupo: {
        0: {
          id: 0,
          nombre: "Paduol",
          imagen: "https://vectorified.com/images/overwatch-icon-png-1.png",
        },
        1: {
          id: 1,
          nombre: "Alot",
          imagen: "https://vectorified.com/images/overwatch-icon-png-1.png",
        },
        2: {
          id: 2,
          nombre: "Personaje de Nuria",
          imagen: "https://vectorified.com/images/overwatch-icon-png-1.png",
        },
      },
    };
  },
  methods: {},
};
</script>

<style scoped>
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