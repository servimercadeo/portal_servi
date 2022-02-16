<template>
    <app-layout title="Usuarios">
        <jet-authentication-card>
            <jet-validation-errors class="mb-4" />
            <form @submit.prevent="submit" class="row">
                <div>
                    <jet-label for="name" value="Nombre" />
                    <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus />
                </div>

                <div class="mt-2">
                    <jet-label for="email" value="Email" />
                    <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus/>
                </div>

                <div class="mt-2 col-6">
                    <jet-label for="password" value="Contraseña" />
                    <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required />
                </div>

                <div class="mt-2 col-6">
                    <jet-label for="password_confirmation" value="Confirmar contraseña" />
                    <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required />
                </div>

                <div class="mt-2 col-6">
                    <jet-label for="operation" value="Operacíon" />
                    <jet-input id="operation" type="text" class="mt-1 block w-full" v-model="form.operation" required />
                </div>

                <div class="mt-2 col-6">
                    <jet-label for="city" value="Ciudad" />
                    <jet-input id="city" type="text" class="mt-1 block w-full" v-model="form.city" required />
                </div>

                <div class="mt-2 col-6">
                    <jet-label for="region" value="Region" />
                    <jet-input id="region" type="text" class="mt-1 block w-full" v-model="form.region" required />
                </div>

                <div class="mt-2 col-6">
                    <jet-label for="phone" value="Telefono" />
                    <jet-input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" required />
                </div>

                <div class="mt-2">
                    <jet-label for="nit" value="NIT" />
                    <jet-input id="nit" type="number" class="mt-1 block w-full" v-model="form.nit" required />
                </div>

                <div class="mt-2 col-6">
                    <jet-label for="rol" value="Rol" />
                    <select class="form-select" form-select-sm name="rol" id="" v-model="role">
                        <option disabled value="">Seleciona un Rol</option>
                        <option v-for="rol in roles" :key="rol" :value="rol.id">{{rol.name}}</option>
                    </select>
                </div>

                <div class="mt-2 col-6">
                    <jet-label for="pais" value="Pais" />
                    <select class="form-select" form-select-sm name="pais" id="" v-model="form.pais">
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
            roles: Object
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    operation: '',
                    city: '',
                    region: '',
                    pais: 0,
                    phone: '',
                    nit: ''
                }),
                role: ''
            }
        },
        methods:{
            submit() {
                this.$inertia.post(route('users.insert'),{ 'form' :this.form,'role':this.role})
            }
        }
    })
</script>