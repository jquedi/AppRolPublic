<template>
    <div @click="selectPersonajeF()" style="z-index: 3000;" class="cursor-pointer w-40 h-60 bg-gray-400 rounded-lg flex flex-col overflow-hidden ring-2 ring-blue-600 shadow-xl" id="personajeMiniFicha">
        <div class="h-80% w-full overflow-hidden">
            <img class="w-full" :src="personaje.image" alt="">
        </div>
        <div class="h-20% w-full bg-white p-2 text-sm">
            {{ personaje.name }}
        </div>
    </div>
</template>

<script>

export default {
    name: "personajeMiniFicha",
    components: {
    },
    props: {
        personaje: Object,
    },
    data(){
        return {

        }
    },
    methods: {
        selectPersonajeF(){
            this.$emit("selectPersonajeF", this.personaje);
        }
    },
}
</script>

<style scoped>
:focus {
  outline: none;
}
</style>