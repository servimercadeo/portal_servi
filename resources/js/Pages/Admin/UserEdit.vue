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
                    <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
                </div>

                <div class="mt-2 col-6">
                    <jet-label for="password" value="Nueva Contraseña" />
                    <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" />
                </div>

                <div class="mt-2 col-6">
                    <jet-label for="password_confirmation" value="Confirmar contraseña" />
                    <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation"/>
                </div>

                <div class="mt-2 col-6">
                    <jet-label for="operation" value="Operacíon" />
                    <jet-input id="operation" type="text" class="mt-1 block w-full" v-model="form.operation" required autocomplete="new-password" />
                </div>

                <div class="mt-2 col-6">
                    <jet-label for="city" value="Ciudad" />
                    <jet-input id="city" type="text" class="mt-1 block w-full" v-model="form.city" required autocomplete="new-password" />
                </div>

                <div class="mt-2 col-6">
                    <jet-label for="region" value="Region" />
                    <jet-input id="region" type="text" class="mt-1 block w-full" v-model="form.region" required autocomplete="new-password" />
                </div>

                <div class="mt-2 col-6">
                    <jet-label for="phone" value="Telefono" />
                    <jet-input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" required autocomplete="new-password" />
                </div>

                <div class="mt-2">
                    <jet-label for="nit" value="Telefono" />
                    <jet-input id="nit" type="number" class="mt-1 block w-full" v-model="form.nit" required />
                </div>

                <div class="mt-2 col-6">
                    <jet-label for="rol" value="Rol" />
                    <select class="form-select" form-select-sm name="rol" id="" v-model="role">
                        <option :value="this.user.roles[0].id" selected>{{this.user.roles[1].name}}</option>
                        <option v-for="rol in fillRoles" :key="rol" :value="rol.id">{{rol.name}}</option>
                    </select>
                </div>

                <div class="mt-2 col-6">
                    <jet-label for="pais" value="Pais" />
                    <select class="form-select" form-select-sm name="pais" id="" v-model="form.pais">
                        <option :value="this.user.pais.id" selected>{{ this.user.pais.name }}</option>
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
            roles: Object,
            user: Object
        },
        data() {
            return {
                form: this.$inertia.form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    operation: '',
                    city: '',
                    region: '',
                    pais: '',
                    phone: '',
                    nit: ''
                }),
                role: '',
                fillRoles: {},
                fillPaises: {}
            }
        },
        methods:{
            submit() {
                this.$inertia.post(route('users.update'),{ 'form' :this.form,'role':this.role})
            },
            /**
             * funcion para filtar el formulario y que quede con los datos que llegan
             * 
             * @author Santiago Giraldo 
             * @returns Void
             */
            assignForm(){
                Object.assign(this.form,this.user)
                let x = this.user.roles[0].id
                this.role = x;
                this.fillRoles = this.roles.filter(function(rol){
                    return rol.id != x
                })
                x = this.user.pais.id
                this.form.pais = x
                this.fillPaises = this.$page.props.paises.filter(function(pais){
                    return pais.id != x
                })
            }
        },
        mounted() {
            this.assignForm()
        },
    })
</script>