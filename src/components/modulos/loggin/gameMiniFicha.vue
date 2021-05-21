<template>
    <div @click="selectGameF()" style="z-index: 3000;" class="cursor-pointer w-80 h-48 bg-gray-400 rounded-lg flex flex-col overflow-hidden ring-2 ring-purple-600 shadow-xl" id="gameMiniFicha">
        <div class="h-80% w-full overflow-hidden">
        </div>
        <div class="h-content w-full bg-white p-2 text-sm">
            {{ game.name }}
        </div>
    </div>
</template>

<script>

export default {
    name: "gameMiniFicha",
    components: {
    },
    props: {
        game: Object,
    },
    data(){
        return {

        }
    },
    methods: {
        selectGameF(){
            this.$emit("selectGameF", this.game);
        }
    },
}
</script>

<style scoped>
:focus {
  outline: none;
}
</style>