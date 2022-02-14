<template>
<div>
  <Head title="Log in" />

  <jet-authentication-card>

    <div class="card-body">

      <jet-authentication-card-logo />
      <jet-validation-errors class="mb-3" />

      <div v-if="status" class="alert alert-success mb-3 rounded-0" role="alert">
        {{ status }}
      </div>

      <form @submit.prevent="submit">
        <div class="mb-3">
          <jet-label for="phone" value="Usuario" />
          <jet-input id="phone" type="text" v-model="form.phone" required autofocus />
        </div>

        <div class="mb-3">
          <jet-label for="password" value="Contraseña" />
          <jet-input id="password" type="password" v-model="form.password" required autocomplete="current-password" />
        </div>

        <div class="mb-3">
          <div class="custom-control custom-checkbox">
            <jet-checkbox id="terms" name="terms" @click="form.terms = !form.terms" />

            <label class="custom-control-label" for="terms">
              <span class="ml-2 text-sm text-gray-600">Acepto <a data-bs-toggle="modal" data-bs-target="#modal_terms" href="#">Terminos y Condiciones</a></span>
            </label>
          </div>
        </div>
          <div class="custom-control custom-checkbox">
            <jet-checkbox id="remember_me" name="remember" @click="form.remember = !form.remember" />

            <label class="custom-control-label" for="remember_me">
              Recuerdame
            </label>
          </div>
        <div class="mb-0">
          <div class="d-flex justify-content-end align-items-baseline">
            <Link v-if="canResetPassword" :href="route('password.request')" class="text-muted me-3">
              Forgot your password?
            </Link>

            <jet-button class="ml-4 btn-orage" :class="{ 'opacity-25': form.terms }" :disabled="form.terms">
              Ingresar
            </jet-button>
          </div>
        </div>
      </form>
    </div>
  </jet-authentication-card>

  <modal id="modal_terms">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h3 class="text-center"><strong>AUTORIZACIÓN PARA EL TRATAMIENTO DE DATOS PERSONAS Y SENSIBLES</strong></h3>
          <br>
          <p>En cumplimiento a lo dispuesto en la Ley 1581 de 2012, "Por el cual se dictan
             disposiciones generales para la protección de datos personales" y de conformidad 
            con lo señalado en el Decreto 1377 de 2013, doy mi consentimiento para el 
            tratamiento de mis datos personales, sensibles y manifiesto que he sido 
            informado por SERVIMERCADEO S.A.S. y S&M SERVICIOS Y MERCADEO S.A.S de lo siguiente:</p>
          <br>
          1. SERVIMERCADEO S.A.S. Y S&amp;M SERVICIOS Y MERCADEO S.A.S actuará como Responsable del Tratamiento 
          de mis datos personalesy sensibles, los cuales han sido otorgados voluntariamente.<br><br>2. Mis 
          derechos como titular de los datos son los previstosla Ley  tales como: conocer, actualizar, 
          rectificar y suprimir mi información personal y sensible, así́ como el derecho a revocar el 
          consentimiento otorgado para el tratamiento de datos personales y sensibles.<br><br>3. En 
          caso de recolección de mi información personal y/o sensible, tengo derecho a contestar o no 
          las preguntas que me formulen, y a entregar o no, los datos solicitados.
        </div>
        <div class="modal-footer">
            <button class="btn btn-orage mx-auto" data-bs-dismiss="modal" aria-label="Close">Acepto</button>
        </div>
      </div>
    </modal>

</div>
  
</template>

<script>
import { defineComponent } from 'vue'
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import Modal from '../../Jetstream/Modal.vue'


export default defineComponent({
  components: {
    Head,
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    Link,
    Modal
  },

  props: {
    canResetPassword: Boolean,
    status: String
  },

  data() {
    return {
      form: this.$inertia.form({
        phone: '',
        password: '',
        remember: false,
        terms: true
      })
    }
  },

  methods: {
    submit() {
      this.form
          .transform(data => ({
            ... data,
            remember: this.form.remember ? 'on' : ''
          }))
          .post(this.route('login'), {
            onFinish: () => this.form.reset('password'),
          })
    }
  }
})
</script>
