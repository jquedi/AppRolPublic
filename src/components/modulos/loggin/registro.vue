<template>
  <div
    style="z-index: 3000"
    class="fixed w-full h-full bg-gray-400"
    id="registro"
  >
    <div
      class="font-sans flex flex-col absolute bg-gray-100 h-80% w-60% m-auto inset-0 rounded-2xl shadow-2xl ring-4 ring-gray-600 ring-opacity-40 overflow-y-auto"
    >
      <div
        @click="atras()"
        class="absolute flex-none cursor-pointer bg-red-200 p-1 border-r border-b border-black"
      >
        Atrás
      </div>
      <div class="h-content w-content m-10">
        <div class="underline text-xl font-bold">Icono:</div>
        <div
          class="h-36 w-36 bg-white mx-auto my-6 inset-0 rounded-full shadow-xl ring-2 overflow-hidden"
        >
          <img class="object-cover h-full" :src="display" alt="" />
        </div>

        <input
          name="fileToUpload"
          type="file"
          id="file"
          ref="file"
          v-on:change="handleFile()"
        />
        <div class="text-red-400" v-if="comprobarFormatoFile() == 0">
          Formato no soportado
        </div>
      </div>

      <div class="flex flex-row align-center flex-wrap justify-around">
        <div class="h-content w-content m-10">
          <div class="flex flex-row">
            <p class="text-red-400">*</p>
            <div class="self-center font-bold mb-2">Usuario:</div>
          </div>

          <input
            class="rounded-lg bg-gray-500 focus:bg-opacity-100 bg-opacity-20 text-white ring-2 focus:ring-gray-800"
            type="text"
            maxlength="20"
            v-model="usuario"
          />
        </div>
        <div class="h-content w-content m-10">
          <div>
            <div class="flex flex-row">
              <p class="text-red-400">*</p>
              <div class="self-center font-bold mb-2">Contraseña:</div>
            </div>
            <input
              class="rounded-lg bg-gray-500 focus:bg-opacity-100 bg-opacity-20 text-white ring-2 focus:ring-gray-800"
              type="password"
              maxlength="50"
              v-model="password"
            />
          </div>
          <div>
            <div class="flex flex-row">
              <p class="text-red-400">*</p>
              <div class="self-center font-bold mb-2">
                Confirmar contraseña:
              </div>
            </div>
            <input
              class="rounded-lg bg-gray-500 focus:bg-opacity-100 bg-opacity-20 text-white ring-2 focus:ring-gray-800"
              type="password"
              maxlength="50"
              v-model="password2"
            />
          </div>
          <p class="text-red-400" v-if="compararContraseñasF() == 0">
            Las contraseñas no coinciden
          </p>
        </div>
        <div class="h-content w-content m-10">
          <div class="flex flex-row">
            <p class="text-red-400">*</p>
            <div class="self-center font-bold mb-2">Correo:</div>
          </div>
          <input
            class="rounded-lg bg-gray-500 focus:bg-opacity-100 bg-opacity-20 text-white ring-2 focus:ring-gray-800"
            type="email"
            v-model="mail"
          />
          <p class="text-red-400" v-if="comprobarCorreo() == 0">
            Correo no valido
          </p>
        </div>
      </div>

      <div>
        <button
          @click="registrarF()"
          class="bg-blue-900 text-white h-content rounded-lg p-5"
        >
          REGISTRARSE
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "registro",
  components: {},
  props: {},
  data() {
    return {
      usuario: "",
      password: "",
      password2: "",
      mail: "",
      image: null,
      display: "",
    };
  },
  methods: {
    atras() {
      this.$emit("atras", false);
    },
    comprobarFormatoFile() {
      if (this.image != null) {
        var name = this.image.name;

        var extension = name.split(".").pop();

        var extensiones = [
          "jpg",
          "png",
          "jpeg",
          "gif",
          "JPG",
          "JPEG",
          "PNG",
          "GIF",
        ];

        var aux = 0;
        if (extensiones.includes(extension)) {
          aux = 1;
        }
      } else {
        aux = 1;
      }

      return aux;
    },
    compararContraseñasF() {
      var aux = 0;
      if (this.password == this.password2) {
        aux = 1;
      }
      if (this.password2 == "") {
        aux = 2;
      }
      return aux;
    },
    comprobarCorreo() {
      var aux = 0;
      if (
        /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(
          this.mail
        )
      ) {
        aux = 1;
      }
      if (this.mail == "") {
        aux = 2;
      }
      return aux;
    },

    registrarF() {
      if (
        this.usuario != "" &&
        this.comprobarCorreo() == 1 &&
        this.compararContraseñasF() == 1 &&
        this.comprobarFormatoFile() == 1
      ) {
        var consulta1 =
          "SELECT * FROM `users` WHERE `user` = '" +
          this.usuario +
          "' OR `email` = '" +
          this.mail +
          "'";
        axios
          .post("/php/load.php", {
            consulta: consulta1,
          })
          .then((response) => {
            console.log(Object.keys(response.data).length);
            console.log(response.data);
            if (Object.keys(response.data).length > 0) {
              alert(
                "El nombre de usuario o correo electronico ya están en uso."
              );
            } else {
              if (this.image != null) {
                let formData = new FormData();

                formData.append("file", this.image);
                formData.append("ruta", "userImages/");

                fetch("http://approll.arikelk9.es/uploadFile.php", {
                  method: "POST",
                  body: formData,
                })
                  .then((response) => response.json())
                  .then((result) => {
                    var consulta =
                      "INSERT INTO `users`(`user`, `email`, `password`, `image`) VALUES ('" +
                      this.usuario +
                      "','" +
                      this.mail +
                      "','" +
                      this.password +
                      "','" +
                      result +
                      "')";
                    axios
                      .post("/php/update.php", {
                        consulta: consulta,
                      })
                      .then(() => {
                        this.$emit("atras", false);
                      });
                  })
                  .catch((err) => console.log("err", err));
              } else {
                var consulta =
                  "INSERT INTO `users`(`user`, `email`, `password`, `image`) VALUES ('" +
                  this.usuario +
                  "','" +
                  this.mail +
                  "','" +
                  this.password +
                  "','userImages/default.jpg')";
                axios
                  .post("/php/update.php", {
                    consulta: consulta,
                  })
                  .then(() => {
                    this.$emit("atras", false);
                  });
              }
            }
          });
      } else {
        alert("algo has hecho mal");
      }
    },

    handleFile() {
      this.image = this.$refs.file.files[0];
      this.display = URL.createObjectURL(this.$refs.file.files[0]);
    },
  },
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