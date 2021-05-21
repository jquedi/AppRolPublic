<template>
  <div class="grid grid-rows-20" id="btnMenu">
    <button @click="closeF()" class="w-full p-1 row-start-3 row-span-9">
      <img
        v-bind:src="datos[elemento]['imagen']"
        alt=""
        class="object-content object-center"
      />
    </button>
  </div>
</template>

<script>
export default {
  name: "btnMenu",
  components: {},
  props: {
    elemento: String,
  },
  data() {
    return {
      datos: {
        stats: {
          id: 1,
          imagen:
            "https://www.etc.cmu.edu/projects/star-stone/wp-content/uploads/2014/11/190px_icon_Ability-08.png",
          nombre: "Estadisticas",
        },
        items: {
          id: 2,
          imagen:
            "https://cdn2.iconfinder.com/data/icons/rpg-basic-set-2/512/bag-512.png",
          nombre: "Objetos",
        },
        habilities: {
          id: 3,
          imagen:
            "https://cdn2.iconfinder.com/data/icons/rpg-fantasy-game-skill-ui/512/game_skill_ui_bow_arrow_shot-512.png",
          nombre: "Habilidades",
        },
        portrait: {
          id: 4,
          imagen:
            "https://cdn.discordapp.com/attachments/796002359369007130/820282755342270495/IconoPJ.png",
          nombre: "Retrato",
        },
        maps: {
          id: 5,
          imagen: "https://img.icons8.com/ios/452/world-map.png",
          nombre: "Mapas",
        },
        notes: {
          id: 6,
          imagen:
            "https://www.sacredfiregame.com/wp-content/uploads/2016/06/icon-feather.png",
          nombre: "Notes",
        },
      },
    };
  },
  methods: {
    closeF() {
      this.$emit("toggleElement", this.elemento);
    },
  },
};
</script>

<style scoped>
</style>