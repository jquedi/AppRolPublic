<template>
  <button
    class="h-full w-auto mx-10 overflow-hidden flex-shrink-0 flex flex-row transition-all duration-700"
    id="aliadoMiniatura"
    @click="hover = !hover"
  >
    <img v-bind:src="imagen" alt="" class="rounded-lg h-full w-auto z-20" />
    <transition name="slide">
      <div
        v-if="hover"
        class="h-full pl-2 max-w-80 overflow-hidden z-10 flex-1"
      >
        <span
          class="my-auto font-serif text-sm italic font-bold slashed-zero text-center underline capitalize break-words overflow-ellipsis"
          >{{ nombre }}</span
        >
      </div>
    </transition>
  </button>
</template>

<script>
export default {
  name: "aliadoMiniatura",
  components: {},
  props: {
    imagen: String,
    id: Number,
    nombre: String,
  },
  data() {
    return {
      hover: false,
    };
  },
  methods: {},
};
</script>

<style scoped>
:focus {
  outline: none;
}
.slide-enter-active {
  transition: all 1s;
}
.slide-leave-active {
  transition: all 1s;
}
.slide-enter,
.slide-leave-to {
  transform: translateX(-100%);
}
</style>