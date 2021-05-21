<template>
    <div
      class="p-2 text-left overflow-auto scrollbar-thin hover:scrollbar-thumb-gray-300 hover:scrollbar-track-gray-500 text-opacity-70 text-white bg-opacity-60 bg-black bottom-0 h-full w-full"
      id="historialDados"
    >
        <div class="" v-for="(tirada, index) in historial" v-bind:key="index">
            <span>{{ tirada["tirada"] }}</span>
        </div>
    </div>
</template>

<script>
export default {
  name: "historialDados",
  components: {},
  props: {

  },
  data() {
    return {
        historial: {
            0:{
                tirada: "20 sobre 100"
            },
            1:{
                tirada: "2 sobre 10"
            },
            2:{
                tirada: "20 sobre 20"
            },
            3:{
                tirada: "4 sobre 6"
            },
            4:{
                tirada: "5 sobre 12"
            },
            5:{
                tirada: "3 sobre 20"
            },
            6:{
                tirada: "1 sobre 2"
            },
            7:{
                tirada: "20 sobre 100"
            },
            8:{
                tirada: "20 sobre 100"
            },
            9:{
                tirada: "20 sobre 100"
            },
            10:{
                tirada: "20 sobre 100"
            },
            11:{
                tirada: "20 sobre 100"
            },
            12:{
                tirada: "20 sobre 100"
            },
        }
    };
  },
  methods: {
      
  },
};
</script>

<style scoped>

</style>