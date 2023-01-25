<template>
    <app-layout :title="tipo">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table-component :headers="['Periodo','Link','Operacíon', 'Pais']" ref="table"
                        :tipo_input="['text','text','text','text']"
                     :keys="['periodo','_link','operation', ['pais','obj','name']]" :info="payind.data"
                     :vista="'User'" :actions="true" @crear="crearPaying" @editar="editarPaying"
                     @eliminar="eliminarPaying" @filtrar="fillPaying"></table-component>
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
            payinds: Object,
        },
        data(){
            return{
                payind: this.payinds,
                tipo: 'churn',
            }
        },
        methods:{
            crearPaying(){
                this.$inertia.get(route('churn.create'))
            },
            editarPaying(paying){
                this.$inertia.get(route('churn.edit'), {'paying': paying})
            },
            eliminarPaying(paying){
                axios.post(route('payings.destroy'), paying).then(this.$refs.table.filtrar())
            },
            fillPaying(filters){
                axios.post(route('payings.fill'), {'filters': filters, 'tipo': this.tipo}).then(res =>{
                    this.payind = res.data.payings
                })
            }
        },
    })
</script>
