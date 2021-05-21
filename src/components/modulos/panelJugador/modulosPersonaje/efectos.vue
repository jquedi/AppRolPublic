<template>
  <div
    id="efectos"
    class="h-full w-full flex flex-col bg-red-200 overflow-y-auto"
  >
    <div class="ml-2 mt-4 font-bold underline text-3xl">Estados</div>
    <div class="ml-2 mt-4 font-bold underline text-3xl">Efectos</div>
    <div
      class="ml-2 mt-2 text-xl flex flex-row"
      v-for="(efecto, index) in efectosNombres"
      :key="index"
    >
      <div v-if="efectosSignos[index] == '+' && efectosValores[index] > 0">
        +
      </div>
      {{ efectosValores[index] }}
      <div v-if="efectosSignos[index] == '%'">%</div>
      {{ efecto }}
    </div>
  </div>
</template>

<script>
export default {
  name: "efectos",
  components: {},
  props: {
    objetos: Object,
  },
  data() {
    return {
      efectosNombres: [],
      efectosValores: [],
      efectosSignos: [],
    };
  },
  watch: {},
  methods: {
    cargarEfectos() {
      this.efectosNombres = [];
      this.efectosValores = [];
      this.efectosSignos = [];

      for (var i = 0; i < Object.keys(this.objetos).length; i++) {
        if (this.objetos[i]["equiped"] > 0) {
          if (Object.keys(this.objetos[i]["effect"]).length > 0) {
            for (
              var j = 0;
              j < Object.keys(this.objetos[i]["effect"]).length;
              j++
            ) {
              if (this.efectosNombres.length == 0) {
                if (this.objetos[i]["effect"][j][3] == 1) {
                  this.efectosNombres.push(this.objetos[i]["effect"][j][2]);
                  this.efectosValores.push(this.objetos[i]["effect"][j][1]);
                  this.efectosSignos.push(this.objetos[i]["effect"][j][0]);
                }
              } else {
                if (this.objetos[i]["effect"][j][3] == 1) {
                  if (
                    !this.efectosNombres.includes(
                      this.objetos[i]["effect"][j][2]
                    )
                  ) {
                    this.efectosNombres.push(this.objetos[i]["effect"][j][2]);
                    this.efectosValores.push(this.objetos[i]["effect"][j][1]);
                    this.efectosSignos.push(this.objetos[i]["effect"][j][0]);
                  } else {
                    var index = this.efectosNombres.indexOf(
                      this.objetos[i]["effect"][j][2]
                    );

                    if (
                      this.efectosSignos[index] ==
                      this.objetos[i]["effect"][j][0]
                    ) {
                      this.efectosValores[index] += this.objetos[i]["effect"][
                        j
                      ][1];
                    } else {
                      this.efectosNombres.push(this.objetos[i]["effect"][j][2]);
                      this.efectosValores.push(this.objetos[i]["effect"][j][1]);
                      this.efectosSignos.push(this.objetos[i]["effect"][j][0]);
                    }
                    index = 0;
                  }
                }
              }
            }
          }
        }
      }
    },
  },
  created: function () {
    this.cargarEfectos();
  },
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