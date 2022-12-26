<template>
  <app-layout title="Inicio">
    <template #header>
      <h2 class="h4 font-weight-bold">
        Dashboard
      </h2>
    </template>
    <div class="py-12" id="welcome">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="overflow-hidden justify-content-center shadow-xl sm:rounded-lg row">
              <div class="col-sm-2" v-if="$page.props.user.id_pais == 1">
                <div class="card h-100">
                  <img :src="$page.props.global_url+'imgs/politicas.jpg'" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Politicas</h5>
                    <p class="card-text">
                      Conoce aquí los lineamientos generales de la operación.
                    </p>
                    <br>
                    <button @click="politics = true" class="btn btn-primary btn-lg">
                      Políticas
                    </button>
                  </div>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="card h-100">
                  <img :src="$page.props.global_url+'imgs/liquidacion.jpg'" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Liquidación</h5>
                    <p class="card-text">
                      Conoce aquí todo lo que necesitas saber sobre tu Liquidación.
                    </p>
                    <br>
                    <Link :href="route('liquidacion.aliados.index')" class="btn btn-primary btn-lg">
                      Descargar
                    </Link> 
                  </div>
                </div>
              </div>
              <!-- <div class="col-sm-2">
                <div class="card h-100">
                  <img :src="$page.props.global_url+'imgs/aviso.png'" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Comunicados</h5>
                    <p class="card-text">
                      Aca podras ver los Comunicados
                    </p>
                    <br>
                    <button :href="route('liquidacion.aliados.index')" class="btn btn-primary btn-lg" @click="vercom = true">
                      Ver
                    </button> 
                  </div>
                </div>
              </div> -->
              <div v-show="$page.props.role.includes('hughesnet') || $page.props.role.includes('dtv_hugs')" class="col-sm-2">
                <div class="card h-100">
                  <img :src="$page.props.global_url+'imgs/retencion.png'" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Retención</h5>
                    <p class="card-text">
                      Conoce aquí todo lo que necesitas saber sobre tu Retención.
                    </p>
                    <br>
                    <Link :href="route('retencion.aliados.index')" class="btn btn-primary btn-lg">
                      Descargar
                    </Link> 
                  </div>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="card h-100">
                  <img :src="$page.props.global_url+'imgs/pqrs.jpg'" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">PQRS</h5>
                    <p class="card-text">
                      Si presentas alguna duda, reclamo o sugerencia, compartenos tus comentarios aquí.
                    </p>
                    <br>
                    <Link :href="route('pqrs')" class="btn btn-primary btn-lg">
                      Diligenciar
                    </Link>
                  </div>
                </div>
              </div>
              <div v-show="$page.props.user.id_pais == 1" class="col-sm-2">
                <div class="card h-100">
                  <img :src="$page.props.global_url+'imgs/formato.png'" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Formato de Cuenta de Cobro</h5>
                    <p class="card-text">
                      ¿No tienes el Formato de Cuenta de Cobro? ¡Descargalo ya!
                    </p>
                    <br>
                    <a v-show="$page.props.role.includes('directv') || $page.props.role.includes('dtv_hugs')" target="_blank" href="https://servimercadeo.bitrix24.es/bitrix/services/main/ajax.php?action=disk.api.file.download&SITE_ID=s1&humanRE=1&fileId=1151199&fileName=MODELO+CUENTA+DE+COBRO+SERVIMERCADEO.docx" class="btn btn-primary btn-lg">
                      {{'Descargar '+($page.props.role.includes('dtv_hugs')?'Directv':'')}}
                    </a>
                    <a v-show="$page.props.role.includes('hughesnet') || $page.props.role.includes('dtv_hugs') " target="_blank" href="https://bitrix24public.com/servimercadeo.bitrix24.es/docs/pub/9295b171f54db9c24a1becde26d1451e/download/?&token=1l22ti3awlpf" class="btn btn-primary btn-lg" :class="($page.props.role.includes('dtv_hugs'))?'mt-2':''">
                      {{'Descargar '+($page.props.role.includes('dtv_hugs')?'Hughesnet':'')}}
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div v-if="politics" class="overflow-hidden shadow-xl sm:rounded-lg row mt-5 d-flex justify-content-center">
                <div v-if="$page.props.role.includes('directv') || $page.props.role.includes('dtv_hugs')" class="btn-orage politic-item drtv text-center" data-bs-toggle="modal" data-bs-target="#modal_right" @click="selecct_item = politics_items.dtv">
                    <img :src="$page.props.global_url+'imgs/DRTV.svg'" alt="" class="img-politic politic-drtv">
                    <strong>ver politicas</strong>
                </div>
                <div class="btn-orage politic-item text-center" data-bs-toggle="modal" data-bs-target="#modal_right" @click="selecct_item = politics_items.servi">
                    <i class="icon-shield d-block icon-politic"></i>
                    Seguridad y Salud en el Trabajo
                    <br>
                    <strong>ver politicas</strong>
                </div>
                <div v-if="$page.props.role.includes('hughesnet') || $page.props.role.includes('dtv_hugs')" class="btn-orage politic-item hugs text-center" data-bs-toggle="modal" data-bs-target="#modal_right" @click="selecct_item = politics_items.hugs">
                    <img :src="$page.props.global_url+'imgs/HN.svg'" alt="" class="img-politic politic-hugs">
                    <strong>ver politicas</strong>
                </div>
            </div>
            <div class="overflow-hidden shadow-xl sm:rounded-lg row mt-5 d-flex justify-content-center">
              <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img :src="$page.props.global_url+'imgs/car1.jpeg'" class="d-block w-100"/>
                  </div>
                  <div class="carousel-item">
                    <img :src="$page.props.global_url+'imgs/car2.png'" class="d-block w-100"/>
                  </div>
                  <div class="carousel-item">
                    <img :src="$page.props.global_url+'imgs/car3.jpeg'" class="d-block w-100"/>
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
        </div>
    </div>
    <!-- modal -->
    <modal id="modal_right">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <h2><strong>Nuestras politicas</strong></h2>
          <br>
          <img :src="$page.props.global_url+selecct_item.img"/>
          <div v-for="(btn, i) in selecct_item.buttons" :key="i">
            <br>
            <a :href="btn.link" target="_blank" class="btn btn-secondary btn-lg mt-3 pt-4 pr-3 pl-3 pb-4">{{ btn.text }}</a>
          </div>
        </div>
      </div>
    </modal>
    <modal id="modal_welcome" :show="vercom">
      <div class="modal-content">
        <div class="modal-body bg-light">
          <img :src="$page.props.global_url+'imgs/navidad.png'" alt="" class="img-fluid">
        </div>
        <div class="modal-footer bg-light">
            <button type="button" class="btn btn-primary mx-auto" data-bs-dismiss="modal" aria-label="Close" @click="vercom = false">OK</button>
        </div>
      </div>
    </modal>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue"
import AppLayout from "@/Layouts/AppLayout.vue"
import { Link } from '@inertiajs/inertia-vue3'
import Modal from '../Jetstream/Modal.vue'
import Button from "../Jetstream/Button.vue";

export default defineComponent({
  components: {
    AppLayout,
    Link,
    Modal,
    Button,
  },
  data() {
    return {
      politics : false,
      politics_items: {
        dtv: {
          img: 'imgs/directtv.svg',
          buttons: [
            {
              text: 'suscripciones',
              link: 'https://drive.google.com/uc?id=1OMCUnT9EK7r_XDiDc7Hm4Lf9JNW9-uo6'
            }
          ]
        },
        servi:{
          img: 'imgs/servimercadeo_logo.png',
          buttons: [
            {
              text: 'control de alcohol, tabaquismo y drogas',
              link: 'https://drive.google.com/uc?id=1f_HsMSbj593F1n2slq2XL5cZgxQ5I779'
            },
            {
              text: 'Manual del contratista',
              link: 'https://drive.google.com/uc?id=1bbEmuIFFXqYNMj7bCfSTHwZfpqJZqKAm'
            },
            {
              text: 'SST',
              link: 'https://drive.google.com/uc?id=1jHwSOUR8Geyp5G_oou59akSkytRWY_X4'
            },
          ]
        },
        hugs:{
          img: 'imgs/hnn.png',
          buttons: [
            {
              text: 'Manejo de inventarios',
              link: 'https://servimercadeo.bitrix24.es/disk/downloadFile/1160935/?&ncc=1&filename=POLITICAS+EQUIPOS+RECUPERADOS+%281%29.pdf'
            },
            {
              text: 'Equipos des-instalados',
              link: 'https://servimercadeo.bitrix24.es/disk/downloadFile/1160893/?&ncc=1&filename=de-install+Audit+Guidelines+V1.1%2830-Jul-2020%29+GUIA+HUGHES.pdf'
            },
            {
              text: 'Calidad',
              link: 'https://drive.google.com/uc?id=1fwz3NO-e0l3d_Ej0XPNqhJMwMLZvYpXs'
            },
            {
              text: 'Auditoria de Reparaciones',
              link: 'https://servimercadeo.bitrix24.es/disk/downloadFile/1160911/?&ncc=1&filename=Repair+Audit+Guidelines+V1.1%2831-Jul-2020%29+GUIA+HUGHES.pdf'
            },
          ]
        }
      },
      selecct_item:{},
      nextimg: this.$page.props.user.id_pais == 1,
      vercom: true
    }
  },
  computed:{
    modal_w(){
      let cookie = decodeURIComponent(document.cookie)
      cookie = cookie.split(';')
      if(!cookie.includes('loget=true')){
        let now = new Date
        now.setTime(now.getTime() + (360*24*60*60*1000));
        document.cookie = "loget=true; expires="+now.toUTCString()+";path=/";
        return true
      }
      return false
    }
  }
});
</script>
<style lang="scss">
    #welcome{
      .card-img-top{
        min-height: 261px;
        max-height: 272px;
      }
      .card-text{
        min-height: 46px;
      }
      .politic-item{
        height: 200px;
        width: 200px;
        margin: 0px 20px;
        border-radius: 10px;
        color: white;

        &:hover{
            background-color: orange;
        }

        .img-politic{
          width: 180px;
          text-align: center;
        }
        strong{
          display: block;
          font-size: 18px;
        }
        .politic-drtv{
          margin-top: 75px;
        }
        .politic-hugs{
          margin-top: 50px;
        }
        .icon-politic{
          font-size: 75px;
          margin-top: 30px;
        }
      }
      .drtv{
        strong{
          margin-top: 41px;
        }
      }
      .hugs{
        strong{
          margin-top: 30px;
        }
      }
      .carousel-item{
        img{
          max-height: 670px;
        }
      }
    }
    /**modal*/
    #modal_right{
      .modal-dialog{
        left: -3px;
        margin: 0px;
        top: -1px;
        height: 100%;
        bottom: 0px;
        max-width: 400px;
        
        .modal-content{
          border-radius: 0px;
          height: 100%;
          overflow-y: auto;
          .modal-header{
            border: none;
          }

          img{
            max-width: 350px;
          }

          a{
            width: 220px;
          }
        }
      }
    }

    // #modal_welcome{
    //   .modal-body{

    //   }
    // }
</style>
