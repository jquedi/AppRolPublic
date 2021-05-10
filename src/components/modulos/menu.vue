<template>
  <div
    class="flex flex-wrap rounded-r-lg row-start-2 row-span-10 left-0 h-full w-full relative"
    id="menu2"
  >
    <img src="@/assets/BGMenu1.png" alt="" />
    <div class="h-full w-full absolute grid grid-cols-25">
      <div
        class="h-full w-full col-span-6 col-start-5 flex flex-row flex-nowrap justify-around grid grid-cols-3"
      >
        <btnMenu @toggleElement="toggleElement" elemento="stats" />
        <btnMenu @toggleElement="toggleElement" elemento="portrait" />
        <btnMenu @toggleElement="toggleElement" elemento="notes" />
      </div>
      <div class="h-full w-full col-start-13 flex relative">
        <button
          class="w-full h-1/3 bottom-0 absolute"
          @click="toggleElement('menu')"
        ></button>
      </div>
      <div
        class="h-full w-full col-span-6 col-start-16 flex flex-row flex-nowrap justify-around grid grid-cols-3"
      >
        <btnMenu @toggleElement="toggleElement" elemento="items" />
        <btnMenu @toggleElement="toggleElement" elemento="habilities" />
        <btnMenu @toggleElement="toggleElement" elemento="maps" />
      </div>
    </div>
  </div>
</template>

<script>
import btnMenu from "@/components/modulos/modulosMenu/btnMenu.vue";

export default {
  name: "menu2",
  components: {
    btnMenu,
  },
  props: {},
  data() {
    return {};
  },
  methods: {
    toggleElement(value) {
      this.$emit("toggleElement", value);
    },
  },
};
</script>

<style scoped>
:focus {
  outline: none;
}
.arrow {
  width: 0;
  height: 0;
  border-left: 30px solid transparent;
  border-right: 30px solid transparent;
  border-top: 30px solid black;
}
</style>