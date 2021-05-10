<template>
  <div class="" id="app">
    <panelJ titulo="Panel de Jugador"/>
  </div>
</template>

<script>
import panelJ from './components/panelJugador.vue'

export default {
  name: 'App',
  components: {
    panelJ
  }
}
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
