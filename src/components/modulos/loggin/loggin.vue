<template>
    <div style="z-index: 3000;" class="fixed w-full h-full bg-gray-400" id="loggin">
        <div v-if="!registrarse" class="font-sans flex flex-col absolute bg-gray-100 h-80% max-w-500px m-auto inset-0 rounded-2xl shadow-2xl ring-4 ring-gray-600 ring-opacity-40">
            <div class="mt-20 w-full h-20% ">
                <img class="h-full m-auto inset-0" src="https://acegif.com/wp-content/gifs/dancing-pig-22.gif" alt="">
            </div>
            <div class="w-full h-10%  flex"><div class="w-full self-center text-3xl font-bold">INICIAR SESIÓN</div></div>
            <div class="w-full h-10%  flex flex-col justify-center">
                <div class="self-center font-bold mb-2">Usuario</div> 
                <div class="self-center">
                    <input class="rounded-lg bg-gray-500 focus:bg-opacity-100 bg-opacity-20 text-white ring-2 focus:ring-gray-800" type="text" v-model="usuario">
                </div>
            </div>
            <div class="w-full h-10%  flex flex-col justify-center">
                <div class="self-center font-bold mb-2">Contraseña</div> 
                <div class="self-center">
                    <input class="rounded-lg bg-gray-500 focus:bg-opacity-100 bg-opacity-20 text-white ring-2 focus:ring-gray-800" type="password" v-model="contraseña">
                </div>
            </div>
            <div class="w-full h-10% my-6 relative">
                <button @click="iniciarSesionF()" class="absolute inset-0 m-auto bg-blue-900 text-white h-content py-3 rounded-lg px-5">INICIAR</button>
            </div>
            <div class="w-full mb-3 flex flex-row justify-center">
                <div class="mr-2"><input type="checkbox" v-model="mantener"></div>
                <div>Mantener sesión iniciada</div>
            </div>
            <div class="w-full  flex flex-col">
                <div>¿No tienes sesión? Registrate aqui:</div>
                <button class="text-blue-500" @click="registrarse = true">REGISTRARSE</button>
            </div>
        </div>
 <!-- -->
        <registro v-if="registrarse" @atras="atras" />
    </div>
</template>

<script>
import axios from "axios";


import registro from "@/components/modulos/loggin/registro.vue"

export default {
    name: "loggin",
    components: {
        registro
    },
    props: {

    },
    data(){
        return {
            usuario: "",
            contraseña: "",
            mantener: false,
            registrarse: false,
        }
    },
    methods: {
        atras(val){
            this.registrarse = val;
        },
        iniciarSesionF(){
            axios
            .post("/php/loggin.php", {
                user: this.usuario,
                password: this.contraseña
            })
            .then((response) => {
                console.log(response.data);
                if(response.data != false){
                    if(!this.mantener){
                        this.$emit("iniciarSesionF", this.usuario);
                    }else{
                        localStorage.setItem("userName", this.usuario);
                        this.$emit("iniciarSesionF", this.usuario);
                    }
                }else{
                    alert("Credenciales no validad, pringao");
                }
            });
        }
    },
}
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