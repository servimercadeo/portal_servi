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
                            <iframe width="500px" height="800px" :src="(operation) ? urls.drtv : urls.husg" ></iframe>
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
        data(){
            return{
                urls:{
                    husg: '',
                    drtv: '',
                },
                operation: this.getOperation(),
            }
        },
        methods:{
            /**Funcion para optener la operacíon */
            getOperation(){
                return (this.$page.props.role.includes('dtv_hugs')||this.$page.props.role.includes('directv'))
            },
            /*Funcion para armar la url del jframe*/
            armarUrls(){
                this.urls.husg = 'https://servimercadeo.forms.eureka.click/rVJAnwcc_ZUS08kL_v8NN?data-values='+encodeURIComponent(JSON.stringify({
                    'NEW-SQ13ef3NOWTeuBV80HF3o': this.$page.props.user.email,
                    'TEXTINPUT-eXfxUXwNMN0tDohn1eHS2': this.$page.props.user.nit,
                    // razon social 'NEW-oLfOterE6em9LWxjz6FQi': 
                }))
                this.urls.drtv = 'https://servimercadeo.forms.eureka.click/CpyRepby5qgoVryJzdg6R?data-values='+encodeURIComponent(JSON.stringify({
                    'NEW-PeDSA75bbvNloIlqM2YwK': this.$page.props.user.email,
                    'NEW-9RVlRrrgT2EhQ2OiYmPCS': this.$page.props.user.nit,
                    //razon social 'TEXTINPUT-xTY9cvNCGRdvtMtsxbDvn':

                }))
            }
        },
        mounted() {
            this.armarUrls()
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
