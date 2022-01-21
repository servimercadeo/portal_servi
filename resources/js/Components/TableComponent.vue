<template>
    <div id="table-mercadeo">
        <div class="d-flex botoneras">
            <button @click="$emit('crear')" type="button" class="btn btn-success">
                <i class="icon-plus"></i> Crear
            </button>
            <button v-show="masive_import" @click="this.$refs.fileInput.click()" type="button" class="btn btn-orage">
                <i class="icon-upload-alt"></i> Importe Masivo
            </button>
            <input type="file" name="file" class="visually-hidden" ref="fileInput" placeholder="importe masivo" @change="importeMasivo" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
        </div>
        <table class="table table-striped table-hover table-bordered">
            <thead class="thead-light">
                <tr>
                    <th v-for="(header, i) in headers" :key="i" >{{header}}</th>
                    <th v-show="actions">Acciones</th>
                </tr>
                <tr>
                    <td v-for="(header, e) in headers" :key="e"><input v-model="fillters[fillSearch(e)]" @keyup.enter="filtrar" class="input-search" type="text"></td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in info" :key="item.id">
                    <td v-for="(key, j) in keys" :key="j">{{filterItem(item,key)}}</td>
                    <td v-if="actions" class="actions">
                        <!-- <button @click="$emit('ver-'+vista, item)" type="button" class="btn btn-success">
                            <i class="icon-eye-open"></i>
                        </button> -->
                        <button @click="$emit('editar', item)" type="button" class="btn btn-info">
                            <i class="icon-pencil"></i>
                        </button>
                        <button @click="$emit('eliminar', item)" type="button" class="btn btn-danger">
                            <i class="icon-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import { defineComponent } from 'vue'
export default defineComponent({
    props:{
        headers: Array,
        info: Object,
        vista: String,
        keys: Array,
        actions:{
            type: Boolean,
            required: false,
            default: false
        },
        masive_import:{
            type: Boolean,
            required: false,
            default: false 
        }
    },
    data() {
        return {
            fillters: {},
        }
    },
    emits:['crear','editar', 'eliminar', 'importar', 'filtrar'],
    methods:{
        /**funcion para filtrar la columnas como rol de la tabal de usuarios */
        filterItem(item, key){
            if(Array.isArray(key)){
                return item[key[0]][0][key[1]]
            }else{
                return item[key]
            }
        },
        /**funcion para emitir un archivo excel para importar de manera masiva */
        importeMasivo(event){
            this.$emit('importar', event.target.files[0])
        },
        /**funcion para emitir los filtros de la tabla */
        filtrar(){
            this.$emit('filtrar', this.fillters)
        },
        /**funcion para filltrst los v-models de los inputs */
        fillSearch(x){
            if(Array.isArray(this.keys[x])){
                return this.keys[x][0]
            }else{
                return this.keys[x]
            }
        }
    },
    mounted(){
        this.keys.forEach(element => {
            if(Array.isArray(element)){
                this.fillters[element[0]] = ''
            }else{
                this.fillters[element] = ''
            }
        })
    }
})
</script>
<style lang="scss">
    @import '../../sass/variables';

    #table-mercadeo{
        text-transform: capitalize;
        background-color: #325190;
        overflow-x: scroll;

        .botoneras{
            button{
                margin: 0px 10px 0px 0px;
            }
        }

        .table{
            background-color: $body-bg;
            margin-bottom: 0px;

            td, th{
                padding: 5px;
                text-align: center;
            }
            
            .actions{
                min-width: 120px;

                button{ 
                    margin: 0px 5px;
                    display: inline-block;
                }
            }

        }
    }

</style>
