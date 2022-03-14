<template>
    <app-layout title="Paying">
        <jet-authentication-card>
            <jet-validation-errors class="mb-4" />
            <form @submit.prevent="submit" class="row">
                <div class="mt-2">
                    <jet-label for="_link" value="Link" />
                    <textarea name="_link" id="link" class="form-control" cols="10" rows="10" v-model="form._link"></textarea>
                </div>

                <div class="mt-2">
                    <jet-label for="operation" value="Operacíon" />
                    <jet-input id="operation" type="text" class="mt-1 block w-full" v-model="form.operation" required autocomplete="new-password" />
                </div>

                <div class="mt-2">
                    <jet-label for="periodo" value="Periodo" />
                    <jet-input id="periodo" type="text" class="mt-1 block w-full" v-model="form.periodo" required/>
                </div>

                <div class="mt-2">
                    <jet-label for="pais" value="Pais" />
                    <select class="form-select" form-select-sm name="pais" id="" v-model="form.id_pais">
                        <option disabled value="">Seleciona un Pais</option>
                        <option v-for="pais in $page.props.paises" :key="pais.id" :value="pais.id">{{pais.name}}</option>
                    </select>
                </div>

                <div class="justify-end mt-3 mb-2 d-flex flex-row-reverse">

                    <jet-button class="ml-4 btn-orage">
                        Crear
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
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    

    export default defineComponent({
        components: {
            AppLayout,
            JetAuthenticationCard,
            JetButton,
            JetInput,
            JetLabel,
            JetValidationErrors,
        },
        data() {
            return {
                form: this.$inertia.form({
                    _link: '',
                    operation: '',
                    tipo: (this.route().current('liquidacion.create'))?'liquidacion':'retencion',
                    periodo: '',
                    id_pais: ''
                }),
            }
        },
        methods:{
            submit() {
                this.$inertia.post(route('payings.insert'), this.form )
            }
        },
    })
</script>