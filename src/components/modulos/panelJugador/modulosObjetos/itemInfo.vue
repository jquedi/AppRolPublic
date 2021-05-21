<template>
  <div
    id="itemInfo"
    class="bg-gray-400 overflow-y-auto h-full w-full flex flex-row flex-wrap content-start items-stretch justify-start"
  >
    <div class="font-mono italic text-left pl-2 pt-2 text-lg flex-1 min-w-1/2">
      <img
        class="h-auto min-w-100px max-w-2/5 float-left pr-2"
        v-bind:src="item['image']"
        alt=""
      />
      <ul class="pl-2">
        <li>
          <strong><u>Nombre:</u></strong> {{ item["name"] }}
        </li>
        <li>
          <strong><u>Cantidad:</u></strong> {{ objeto[1] }}
        </li>
        <li>
          <strong><u>Tipo:</u></strong> {{ item["type"] }}
        </li>
        <li v-if="Object.keys(item['effect']).length > 0">
          <strong><u>Efecto:</u></strong>
          <div
            class="mt-2 text-md text-left"
            v-for="(efecto, index) in item['effect']"
            :key="index"
          >
            {{ efecto[0] }}{{ efecto[1] }}{{ efecto[2] }}
          </div>
        </li>
      </ul>
    </div>
    <div class="">
      <h1 class="font-mono italic font-bold pt-2 text-3xl underline">
        Descripción
      </h1>
      <p class="font-mono italic font-bold pt-2 text-left pl-4">
        {{ item["description"] }}
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: "itemInfo",
  components: {},
  props: {
    objeto: Array,
    list: Object,
  },
  data() {
    return {
      item: {},
    };
  },
  watch: {
    objeto: function(){
      this.loadItem();
    }
  },
  methods: {
    loadItem(){
      for(var i = 0; i < Object.keys(this.list).length; i++){
        if(this.list[i].id == this.objeto[0]){
          this.item = this.list[i];
        }
      }
    },
    cerrarF() {
      this.$emit("estado", false);
    },
  },
  created: function(){
    this.loadItem();
  },
};
</script>

<style scoped>
</style>