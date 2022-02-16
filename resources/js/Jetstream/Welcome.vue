<template>
  <div class="row justify-content-center my-5">
    <div class="col-md-12">
      <div id="card-dash" class="card shadow bg-blue text-center">
        <h1>FORMACIÓN & CAPACITACIÓN</h1>
        <br>
        <p>Un Apoyo a Tu Desarrollo</p>
        <br>
        <span>
          <a target="_blank" class="btn btn-light" href="http://formacion.servimercadeo.com/moodle/login/index.php">Entrar</a>
          <a target="_blank" class="btn btn-outline-light" href="https://servimercadeo.com/">Web Servimercadeo</a>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
  import { defineComponent } from 'vue'
  import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'

  export default defineComponent({
    components: {
      JetApplicationLogo,
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
