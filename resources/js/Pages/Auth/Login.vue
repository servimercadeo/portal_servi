<template>
  <div class="background-body">
    <Head title="Log in" />
    <h1 class="text-center bg-blue text-white pt-4 pb-4">
      PORTAL DE AUTOGESTIÓN - ALIADOS SERVIMERCADEO
    </h1>

    <div class="d-flex justify-content-center contain-img-logo mt-4">
      <img
        src="/imgs/logo.png"
        alt="Avanza y conoce"
        class="img-logo img-fluid"
      />
    </div>

    <section class="py-4">
      <div class="text-center text-white">
        <h1>¡ATENCIÓN!</h1>
      </div>
    </section>

    <section class="container cont-message rounded-3 shadow-lg text-center p-4 message">
      <div>
        <p class="fw-bold">
          Les informamos que a partir de agosto el módulo de retenciones y
          liquidaciones se trasladó al CRM Avanza y Conoce. Estos seran los
          iconos que encontrarás en el menú:
        </p>
      </div>

      <div class="row my-2">
        <div class="col-lg-4 col-md-6 my-2">
          <a href="https://crm.servimercadeo.com/aliados/liquidaciones"
            ><img
              src="/imgs/comisiones.png"
              alt="img_liquidaciones"
              class="imgs-menu"
          /></a>
        </div>
        <div class="col-lg-4 col-md-6 my-2">
          <a href="https://crm.servimercadeo.com/aliados/PQRS"
            ><img src="/imgs/pqrs.png" alt="img_pqrs" class="imgs-menu"
          /></a>
        </div>
        <div class="col-lg-4 col-md-6 my-2 d-flex">
          <a href="https://crm.servimercadeo.com/aliados/Retencion/Retenciones"><img src="/imgs/retenciones.png" alt="img_retenciones" class="imgs-menu"
          /></a>
        </div>
      </div>

      <div class="mt-5 text-center">
        <p class="fw-bold">
          Este cambio tiene como objetivo mejorar la experiencia y centralizar
          todos los procesos.
        </p>
      </div>

      <div class="mt-2 text-center">
        <p class="fw-bold">
          <span class="text-danger">¡Recuerda!</span> para ingresar al CRM
          utiliza el correo registrado y la contraseña del portal de aliados.
        </p>
        <p class="fw-bold">
          Si no lo recuerdas, ponte en contacto con tu lider inmediato.
        </p>
      </div>
    </section>

    <section class="d-flex justify-content-center py-5">
      <a
        href="https://crm.servimercadeo.com/"
        class="btn shadow btn-color text-white btn-lg"
        ><img src="/imgs/logo.ico" alt="icon_avanzaYconoce"> REDIRIGIR <img src="/imgs/logo.ico" alt="icon_avanzaYconoce"></a
      >
    </section>

    <modal id="modal_terms">
      <div class="modal-content">
        <div class="modal-header">
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <h3 class="text-center">
            <strong
              >AUTORIZACIÓN PARA EL TRATAMIENTO DE DATOS PERSONAS Y
              SENSIBLES</strong
            >
          </h3>
          <br />
          <p>
            En cumplimiento a lo dispuesto en la Ley 1581 de 2012, "Por el cual
            se dictan disposiciones generales para la protección de datos
            personales" y de conformidad con lo señalado en el Decreto 1377 de
            2013, doy mi consentimiento para el tratamiento de mis datos
            personales, sensibles y manifiesto que he sido informado por
            SERVIMERCADEO S.A.S. y S&M SERVICIOS Y MERCADEO S.A.S de lo
            siguiente:
          </p>
          <br />
          1. SERVIMERCADEO S.A.S. Y S&amp;M SERVICIOS Y MERCADEO S.A.S actuará
          como Responsable del Tratamiento de mis datos personalesy sensibles,
          los cuales han sido otorgados voluntariamente.<br /><br />2. Mis
          derechos como titular de los datos son los previstosla Ley tales como:
          conocer, actualizar, rectificar y suprimir mi información personal y
          sensible, así́ como el derecho a revocar el consentimiento otorgado
          para el tratamiento de datos personales y sensibles.<br /><br />3. En
          caso de recolección de mi información personal y/o sensible, tengo
          derecho a contestar o no las preguntas que me formulen, y a entregar o
          no, los datos solicitados.
        </div>
        <div class="modal-footer">
          <button
            class="btn btn-orage mx-auto"
            data-bs-dismiss="modal"
            aria-label="Close"
          >
            Acepto
          </button>
        </div>
      </div>
    </modal>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Modal from "../../Jetstream/Modal.vue";

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
    Modal,
  },

  props: {
    canResetPassword: Boolean,
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        nit: "",
        password: "",
        remember: false,
        terms: true,
      }),
    };
  },

  methods: {
    submit() {
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? "on" : "",
        }))
        .post(this.route("login"), {
          onFinish: () => this.form.reset("password"),
        });
    },
  },
});
</script>
<style>
* {
  font-family: "Nunito", sans-serif;
}

.btn-color {
  background-color: #40aca4;
}

.img-logo {
  width: 80px;
}

.imgs-menu {
  width: 40%;
  transition: 0.1s ease;
  cursor: pointer;
}

.imgs-menu:hover {
  transform: scale(1.1);
}

.message {
  color: #168ba0;
  font-size: larger;
}

.background-body {
  background-image: url("/imgs/fondo.png");
}

.cont-message {
  width: 60%;
  background-color: #fce786;
  border: #f69104 solid;
}
</style>
