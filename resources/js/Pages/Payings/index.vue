<template>
    <app-layout title="Usuarios">
        <div class="py-12" id="pqrs">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg">
                    <div v-if="$page.props.role.includes('dtv_hugs')" class="d-flex justify-content-center change-pqr">
                        <button @click="operation = true" class="btn btn-primary">Directv</button>
                        <button @click="operation = false" class="btn btn-primary">Hughesnet</button>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mx-auto mt-3 h-100 section-central pt-2 pb-2 text-center">
                            <img :src="$page.props.global_url+((operation)?'imgs/directtv.svg':'imgs/hnn.png')"
                            class="mx-auto d-block" alt="">
                            <p class="fs-4 mt-2">{{tipo}}</p>
                            <table class="table rounded f-o text-muted">
                                <thead>
                                    <tr>
                                        <td>Periodo</td>
                                        <td>Operación</td>
                                        <td>Descargar</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(paying, i) in payinds.data" :key="i" v-show="paying.operation == ((operation)? 'directv':'hughesnet')">
                                        <td>{{ paying.periodo }}</td>
                                        <td>{{ paying.operation }}</td>
                                        <td>
                                            <a :href="paying._link" target="_blank" class="btn btn-primary btn-lg">
                                                <i class="icon-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
        props:{
            payinds: Object,
            tipo: String,
        },
        data(){
            return{
                operation: this.getOperation(),
            }
        },
        methods:{
            /**Funcion para optener la operacíon */
            getOperation(){
                return (this.$page.props.role.includes('dtv_hugs')||this.$page.props.role.includes('directv'))
            }
        },
        mounted() {
            console.log(this.payinds)
        },
    })
</script>
<style lang="scss">
    #pqrs{
        .change-pqr{
            button{
                margin-right: 10px;
            }
        }

        .section-central{
            img{
                max-width: 460px;
            }
        }
    }
</style>
