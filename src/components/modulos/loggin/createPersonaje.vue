<template>
  <div
    style="z-index: 3000"
    class="absolute h-full w-full"
    id="createPersonaje"
  >
    <div
      @click="cerrar()"
      class="absolute h-full w-full bg-black bg-opacity-40"
    ></div>
    <div
      v-if="fase == 1"
      class="absolute h-4/5 w-4/5 bg-gray-200 ring-2 inset-0 mt-6 m-auto rounded-xl flex flex-col"
    >
      <div
        class="h-3 w-1/2 bg-blue-200 rounded-full inset-x-0 mx-auto mt-6 border border-blue-600 relative"
      >
        <div
          class="absolute border border-blue-600 h-6 w-6 -bottom-2 rounded-full left-0 bg-gray-200"
        >
          <div class="absolute -bottom-8 font-bold text-xl">Aspecto</div>
        </div>
        <div
          class="absolute border border-blue-600 h-6 w-6 -bottom-2 rounded-full left-1/3 bg-gray-200"
        >
          <div class="absolute -bottom-6 font-bold">Nombre</div>
        </div>
        <div
          class="absolute border border-blue-600 h-6 w-6 -bottom-2 rounded-full left-2/3 bg-gray-200"
        >
          <div class="absolute -bottom-6 font-bold">Historia</div>
        </div>
        <div
          class="absolute border border-blue-600 h-6 w-6 -bottom-2 rounded-full right-0 bg-gray-200"
        >
          <div class="absolute -bottom-6 font-bold">Crear</div>
        </div>
        <div class="w-0 h-full bg-blue-600"></div>
      </div>
      <div class="h-full w-full mt-10 mb-20 flex flex-row">
        <div class="w-1/2 h-full flex flex-col">
          <div class="font-bold underline text-xl mt-6 mb-4">IMAGEN</div>
          <div class="mb-10 font-light italic">
            La imagen que representará a tu personaje en sus aventuras.
          </div>
          <div
            class="h-36 w-36 rounded-xl ring-2 ring-black overflow-hidden mx-auto inset-0"
          >
            <img class="" :src="display" alt="" />
          </div>
          <div class="mt-10">
            <input
              name="fileToUpload"
              type="file"
              id="file"
              ref="file"
              v-on:change="handleFile()"
            />
          </div>
        </div>
        <div class="w-1/2 h-full flex">
          <img
            class="max-w-4/5 max-h-4/5 m-auto inset-0 ring-2 ring-black"
            :src="display"
            alt=""
          />
        </div>
      </div>
      <div class="absolute bottom-0 flex flex-row w-full p-4">
        <div @click="cerrar()" class="p-3 rounded-lg cursor-pointer bg-red-400">
          Cancelar
        </div>
        <div
          @click="fase += 1"
          class="p-3 rounded-lg cursor-pointer bg-green-400 right-4 absolute"
        >
          Siguiente
        </div>
      </div>
    </div>
    <div
      v-if="fase == 2"
      class="absolute h-4/5 w-4/5 bg-gray-200 ring-2 inset-0 mt-6 m-auto rounded-xl flex flex-col"
    >
      <div
        class="h-3 w-1/2 bg-blue-200 rounded-full inset-x-0 mx-auto mt-6 border border-blue-600 relative"
      >
        <div
          class="absolute border border-blue-600 h-6 w-6 -bottom-2 rounded-full left-0 bg-blue-600"
        >
          <div class="absolute -bottom-6 font-bold">Aspecto</div>
        </div>
        <div
          class="absolute border border-blue-600 h-6 w-6 -bottom-2 rounded-full left-1/3 bg-gray-200"
        >
          <div class="absolute -bottom-8 font-bold text-xl">Nombre</div>
        </div>
        <div
          class="absolute border border-blue-600 h-6 w-6 -bottom-2 rounded-full left-2/3 bg-gray-200"
        >
          <div class="absolute -bottom-6 font-bold">Historia</div>
        </div>
        <div
          class="absolute border border-blue-600 h-6 w-6 -bottom-2 rounded-full right-0 bg-gray-200"
        >
          <div class="absolute -bottom-6 font-bold">Crear</div>
        </div>
        <div class="w-1/3 h-full bg-blue-600"></div>
      </div>

      <div class="flex flex-col h-full w-full p-10">
        <div class="flex flex-row h-full items-center">
          <div class="flex flex-col">
            <div class="font-bold underline text-xl mt-6 mb-4">Nombre:</div>
            <div class="mb-10 font-light italic">
              El nombre por el que conocen a tu personaje.
            </div>
          </div>
          <div class="h-20 w-1/3 ml-10">
            <input
              v-model="nombre"
              class="text-2xl font-bold p-2 text-center w-full h-full rounded-xl ring-2 ring-black ring-opacity-50"
              type="text"
            />
          </div>
        </div>
        <div class="flex flex-row h-full">
          <div class="flex flex-col">
            <div class="font-bold underline text-xl mb-4">Titulo:</div>
            <div class="mb-10 font-light italic">
              El titulo que representa a tu personaje.
            </div>
          </div>
          <div class="h-20 w-1/3 ml-10">
            <input
              v-model="titulo"
              class="text-xl font-semibold p-2 text-center w-full h-full rounded-xl ring-2 ring-black ring-opacity-50"
              type="text"
            />
          </div>
        </div>
      </div>

      <div class="absolute bottom-0 flex flex-row w-full p-4">
        <div
          @click="fase -= 1"
          class="p-3 rounded-lg cursor-pointer bg-red-400"
        >
          Atrás
        </div>
        <div
          @click="fase += 1"
          class="p-3 rounded-lg cursor-pointer bg-green-400 right-4 absolute"
        >
          Siguiente
        </div>
      </div>
    </div>
    <div
      v-if="fase == 3"
      class="absolute h-4/5 w-4/5 bg-gray-200 ring-2 inset-0 mt-6 m-auto rounded-xl flex flex-col"
    >
      <div
        class="h-3 w-1/2 bg-blue-200 rounded-full inset-x-0 mx-auto mt-6 border border-blue-600 relative"
      >
        <div
          class="absolute border border-blue-600 h-6 w-6 -bottom-2 rounded-full left-0 bg-blue-600"
        >
          <div class="absolute -bottom-6 font-bold">Aspecto</div>
        </div>
        <div
          class="absolute border border-blue-600 h-6 w-6 -bottom-2 rounded-full left-1/3 bg-blue-600"
        >
          <div class="absolute -bottom-6 font-bold">Nombre</div>
        </div>
        <div
          class="absolute border border-blue-600 h-6 w-6 -bottom-2 rounded-full left-2/3 bg-gray-200"
        >
          <div class="absolute -bottom-8 font-bold text-xl">Historia</div>
        </div>
        <div
          class="absolute border border-blue-600 h-6 w-6 -bottom-2 rounded-full right-0 bg-gray-200"
        >
          <div class="absolute -bottom-6 font-bold">Crear</div>
        </div>
        <div class="w-2/3 h-full bg-blue-600"></div>
      </div>

      <div class="flex flex-col h-full p-20">
        <div class="font-bold underline text-xl mb-4">TRASFONDO</div>
        <div class="mb-10 font-light italic">
          La historia de tu personaje, aquello que define su personalidad y su
          pasado e influye en las decisiones que este tomará en el futuro.
        </div>
        <div
          class="h-full overflow-hidden rounded-xl ring-2 ring-black ring-opacity-50"
        >
          <textarea
            v-model="transfondo"
            style="resize: none"
            class="h-full w-full overflow-y-auto p-4"
            name=""
            id=""
          ></textarea>
        </div>
      </div>

      <div class="absolute bottom-0 flex flex-row w-full p-4">
        <div
          @click="fase -= 1"
          class="p-3 rounded-lg cursor-pointer bg-red-400"
        >
          Atrás
        </div>
        <div
          @click="fase += 1"
          class="p-3 rounded-lg cursor-pointer bg-green-400 right-4 absolute"
        >
          Siguiente
        </div>
      </div>
    </div>
    <div
      v-if="fase == 4"
      class="absolute h-4/5 w-4/5 bg-gray-200 ring-2 inset-0 mt-6 m-auto rounded-xl flex flex-col"
    >
      <div
        class="h-3 w-1/2 bg-blue-200 rounded-full inset-x-0 mx-auto mt-6 border border-blue-600 relative"
      >
        <div
          class="absolute border border-blue-600 h-6 w-6 -bottom-2 rounded-full left-0 bg-blue-600"
        >
          <div class="absolute -bottom-6 font-bold">Aspecto</div>
        </div>
        <div
          class="absolute border border-blue-600 h-6 w-6 -bottom-2 rounded-full left-1/3 bg-blue-600"
        >
          <div class="absolute -bottom-6 font-bold">Nombre</div>
        </div>
        <div
          class="absolute border border-blue-600 h-6 w-6 -bottom-2 rounded-full left-2/3 bg-blue-600"
        >
          <div class="absolute -bottom-6 font-bold">Historia</div>
        </div>
        <div
          class="absolute border border-blue-600 h-6 w-6 -bottom-2 rounded-full right-0 bg-gray-200"
        >
          <div class="absolute -bottom-8 font-bold text-xl">Crear</div>
        </div>
        <div class="w-full h-full bg-blue-600"></div>
      </div>

      <div class="flex flex-col w-full h-full p-20">
        <div class="flex flex-row h-1/2 w-full">
          <div class="h-full w-1/3">
            <div class="h-full flex">
              <img v-if="display == ''"
                class="h-full m-auto inset-0 ring-2 ring-black"
                src="charactersImages/default.gif"
                alt=""
              />
              <img v-if="display != ''"
                class="h-full m-auto inset-0 ring-2 ring-black"
                :src="display"
                alt=""
              />
            </div>
          </div>
          <div class="flex flex-col h-full w-2/3">
            <div class="h-full w-2/3 flex">
              <div
                class="text-3xl font-semibold p-2 ml-0 inset-0 m-auto underline"
              >
                {{ nombre }}
              </div>
            </div>
            <div class="h-full w-full flex">
              <div class="text-xl font-semibold p-2 ml-0 inset-0 m-auto">
                {{ titulo }}
              </div>
            </div>
          </div>
        </div>
        <div class="h-full w-full p-4">
          <div
            class="h-full w-full bg-white rounded-xl ring-2 ring-black ring-opacity-50"
          >
            {{ transfondo }}
          </div>
        </div>
      </div>

      <div class="absolute bottom-0 flex flex-row w-full p-4">
        <div
          @click="fase -= 1"
          class="p-3 rounded-lg cursor-pointer bg-red-400"
        >
          Atrás
        </div>
        <div
          @click="crear()"
          class="p-3 rounded-lg cursor-pointer bg-green-400 right-4 absolute"
        >
          Crear
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "createPersonaje",
  components: {},
  props: {
    usuario: String,
  },
  data() {
    return {
      fase: 1,
      nombre: "",
      titulo: "",
      transfondo: "",
      display: "",
      image: null,
    };
  },
  methods: {
    cerrar() {
      this.$emit("cerrar2");
    },
    handleFile() {
      this.image = this.$refs.file.files[0];
      this.display = URL.createObjectURL(this.$refs.file.files[0]);
    },
    crear() {
      if (this.nombre != "" && this.titulo != "" && this.transfondo != "") {
        if (this.image != null) {
          let formData = new FormData();

          formData.append("file", this.image);
          formData.append("ruta", "charactersImages/");

          fetch("http://approll.arikelk9.es/uploadFile.php", {
            method: "POST",
            body: formData,
          })
            .then((response) => response.json())
            .then((result) => {
              var consulta =
                "INSERT INTO `personajes`(`name`, `user`, `title`, `image`, `background`) VALUES ('" +
                this.nombre +
                "','" +
                this.usuario +
                "','" +
                this.titulo +
                "','" +
                result +
                "','" +
                this.transfondo +
                "')";
              axios
                .post("/php/update.php", {
                  consulta: consulta,
                })
                .then(() => {
                  this.$emit("cerrar2");
                });
            })
            .catch((err) => console.log("err", err));
        } else {
          var consulta =
            "INSERT INTO `personajes`(`name`, `user`, `title`, `image`, `background`) VALUES ('" +
            this.nombre +
            "','" +
            this.usuario +
            "','" +
            this.titulo +
            "','charactersImages/default.gif','" +
            this.transfondo +
            "')";
          axios
            .post("/php/update.php", {
              consulta: consulta,
            })
            .then(() => {
              this.$emit("cerrar2");
            });
        }
      } else {
        alert("algo has hecho mal");
      }
    },
  },
};
</script>

<style scoped>
:focus {
  outline: none;
}
</style>