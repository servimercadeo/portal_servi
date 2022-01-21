<template>
    <app-layout title="Permisos">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Permisos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                   <p v-for="permiso in Permission" :key="permiso.id">{{ permiso.name }}</p>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'

    export default defineComponent({
        components: {
            AppLayout,
        },
        props: {
            permisos: Object
        },
        data(){
            return{
                Permission: this.permisos
            }
        },
        mounted(){
            console.log(this.Permission);
        }
    })
</script>
