<template>
    <app-layout title="Usuarios">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table-component ref="table" :headers="['Nombre','Email','Operacíon','City','Region', 'Pais','Phone', 'NIT', 'Rol', 'Razon Social']"
                        :masive_import="true"
                        :keys="['name','email','operation','city','region',['pais','obj','name'],'phone','nit', ['roles','name'], 'razon_social']"
                        :info="users.data"
                        :vista="'User'" :actions="true" @crear="crearUsuario" @editar="editarUsuario"
                        @eliminar="eliminarUsuario" @importar="importeMasivoUsuarios" @filtrar="fillUsers"></table-component>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import TableComponent from '../../Components/TableComponent.vue'
    

    export default defineComponent({
        components: {
            AppLayout,
            TableComponent,
        },
        props: {
            user: Object,
        },
        data(){
            return{
                users: this.user,
            }
        },
        methods:{
            crearUsuario(){
                this.$inertia.get(route('users.create'))
            },
            editarUsuario(user){
                this.$inertia.get(route('users.edit'), {'user': user})
            },
            eliminarUsuario(user){
                axios.post(route('users.destroy'), {'id': user.id}).then(this.$refs.table.filtrar())
            },
            importeMasivoUsuarios(file){
                this.$inertia.post(route('users.import'), {'file': file},{onSuccess: () => {
                    this.$refs.table.filtrar()
                }})
            },
            fillUsers(filters){
                axios.post(route('users.fill'), {'filters': filters}).then(res =>{
                    this.users = res.data.users
                })
            }
        },
        mounted(){
            // console.log(this.user)
        }
    })
</script>
