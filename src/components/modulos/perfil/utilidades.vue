<template>
  <div
    style="width: 270px; height: 330px"
    class="flex flex-col ring-4 ring-blue-400 ring-opacity-20 overflow-hidden rounded-xl shadow-xl cursor-pointer"
    id="utilidades"
  >
    <div class="h-full w-auto overflow-hidden">
      <img class="object-cover" :src="image" alt="" />
    </div>
    <div :class="bg_tittle" class="border-t border-black text-2xl p-3">
      {{ tittle }}
    </div>
  </div>
</template>

<script>
export default {
  name: "utilidades",
  components: {},
  props: {
    tittle: String,
    bg_tittle: String,
    image: String,
  },
  data() {
    return {};
  },
  methods: {},
  created: function () {},
};
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