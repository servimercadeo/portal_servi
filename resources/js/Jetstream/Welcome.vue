<template>
  <div class="row justify-content-center my-5">
    <div class="col-md-12">
      <div id="card-dash" class="card shadow bg-blue text-center">
        <h1>bienvenido</h1>
        <br>
        <p>¿Que deseas hacer hoy?</p>
        <br>
        <span>
          <Link :href="route('users.index')" class="btn btn-outline-light">Gestionar Usuarios</Link>
          <Link  :href="route('liquidacion.index')" class="btn btn-outline-light">Gestionar Liquidaciones</Link>
          <Link  :href="route('retencion.index')" class="btn btn-outline-light">Gestionar Retenciones</Link>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
  import { defineComponent } from 'vue'
  import { Link } from '@inertiajs/inertia-vue3'

  export default defineComponent({
    components: {
      Link,
    },
  })
</script>
<style lang="scss">
  #card-dash{
      height: 500px;
      color: white;
      font-family: 'Montserrat', sans-serif;
      text-transform: uppercase;
      h1{
        font-size: 80px;
        font-weight: 900;
        margin-top: 10%;
      }
      p{
        font-size: 22px;
        font-weight: 700;
      }
      span{
        a{
         border-radius: 40px;
         font-weight: 700;
         padding: 13px 25px;
         font-size: 18px;
         margin-right: 10px;
        }
        .btn-light{
          color: black;
        }
      }
  }
</style>
