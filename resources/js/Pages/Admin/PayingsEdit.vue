<template>
    <app-layout title="Usuarios">
        <jet-authentication-card>
            <jet-validation-errors class="mb-4" />
            <form @submit.prevent="submit" class="row">
                <div class="mt-2">
                    <jet-label for="doc" value="Documento" />
                    <a :href="paying._link" target="_blank" class="btn btn-primary btn-md">
                        <i class="icon-download"></i>
                    </a>
                    <br>
                    <small>solo sube ub archivo si deseas cambiarlo*</small>
                    <br>
                    <input type="file" name="doc" @change="upFile"/>
                </div>

                <div class="mt-2">
                    <jet-label for="operation" value="Operacíon" />
                    <select class="form-select" form-select-sm name="operation" id="" v-model="form.operation">
                        <option disabled value="">Seleciona una Operacíon</option>
                        <option value="hughesnet">Hughesnet</option>
                        <option value="directv">Directv</option>
                    </select>
                </div>

                <div class="mt-2">
                    <jet-label for="periodo" value="Periodo" />
                    <jet-input id="periodo" type="text" class="mt-1 block w-full" v-model="form.periodo" required/>
                </div>

                <div class="mt-2">
                    <jet-label for="pais" value="Pais" />
                    <select class="form-select" form-select-sm name="pais" id="" v-model="form.id_pais">
                        <option :value="paying.pais.id" selected>{{paying.pais.name}}</option>
                        <option v-for="pais in fillPaises" :key="pais.id" :value="pais.id">{{pais.name}}</option>
                    </select>
                </div>

                <div class="justify-end mt-3 mb-2 d-flex flex-row-reverse">

                    <jet-button class="ml-4 btn-orage">
                        Editar
                    </jet-button>
                </div>
            </form>
        </jet-authentication-card>
    </app-layout>
</template>
<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'


    export default defineComponent({
        components: {
            AppLayout,
            JetAuthenticationCard,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
        },
        props:{
            paying:Object
        },
        data() {
            return {
                form: this.$inertia.form({
                    doc: null,
                    _link: '',
                    id: '',
                    operation: '',
                    tipo: '',
                    periodo: '',
                    id_pais: '',
                    file_name: '',
                }),
                fillPaises: {}
            }
        },
        methods:{
            submit() {
                this.$inertia.post(route('payings.update'), this.form)
            },
            /**
             * funcion para filtar el formulario y que quede con los datos que llegan
             *
             * @author Santiago Giraldo
             * @returns Void
             */
             assignForm(){
                Object.assign(this.form,this.paying)
                let x = this.paying.pais.id
                this.form.id_pais = x
                this.fillPaises = this.$page.props.paises.filter(function(pais){
                    return pais.id != x
                })
            },
        },
        mounted() {
            console.log(this.paying)
            this.assignForm()
        },
    })
</script>
