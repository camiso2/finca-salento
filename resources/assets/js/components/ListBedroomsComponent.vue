<template>
  <div>
    <preloader-component v-show="preloader" />
    <!-- price element -->
    <div class="col-md-3 col-sm-6 col-xs-12 pad" v-for="bedRoom in bedRooms" :key="bedRoom.id" :value="bedRoom.id">
      <div class="pricing ui-ribbon-container">
        <div class="ui-ribbon-wrapper">
          <div class="ui-ribbon" style="background-color: #5cb85c" v-if="bedRoom.occupation === 'null' || bedRoom.occupation === null">
            Disponible
          </div>
          <div class="ui-ribbon" style="background-color: #f0ad4e" v-else>
            Ocupada
          </div>
        </div>
        <div class="title">
          <h2>{{ bedRoom.name }}</h2>
          <h1>
            $ {{ NumberFormatJS(bedRoom.dayRoomCost) }}
            <b class="pd">Por Día</b>
          </h1>
          <span>Código Habitación : <b>{{ bedRoom.codeRoom }}</b></span>
        </div>
        <div class="x_content_">
          <div class="">
            <div class="pricing_features">
              <div class="pos-img-p">
                <img v-bind:src="'/' + bedRoom.fileImage" class="mar-img-prof" id="silverfox" />
              </div>

              <ul class="list-unstyled text-left">
                <li v-if="bedRoom.rradio == 'si'">
                  <i class="fa fa-check text-success"></i> La habitación tiene
                  <strong> Radio</strong>
                </li>
                <li v-else>
                  <i class="fa fa-times text-danger"></i> La habitación tiene
                  <strong> Radio</strong>
                </li>

                <li v-if="bedRoom.tv == 'si'">
                  <i class="fa fa-check text-success"></i> La habitación tiene
                  <strong> Televisión </strong>
                </li>
                <li v-else>
                  <i class="fa fa-times text-danger"></i> La habitación tiene
                  <strong> Televisión </strong>
                </li>

                <li v-if="bedRoom.roomWindow == 'si'">
                  <i class="fa fa-check text-success"></i> La habitación tiene
                  <strong> Ventana </strong>
                </li>
                <li v-else>
                  <i class="fa fa-times text-danger"></i> La habitación tiene
                  <strong> Ventana </strong>
                </li>

                <li v-if="bedRoom.privateBathroom == 'si'">
                  <i class="fa fa-check text-success"></i> La habitación tiene
                  <strong> Baño Privado</strong>
                </li>
                <li v-else>
                  <i class="fa fa-times text-danger"></i> La habitación tiene
                  <strong> Baño Privado</strong>
                </li>

                <li v-if="bedRoom.furniture == 'si'">
                  <i class="fa fa-check text-success"></i> La habitación tiene
                  <strong> Mobiliario Básico</strong>
                </li>
                <li v-else>
                  <i class="fa fa-times text-danger"></i> La habitación tiene
                  <strong> Mobiliario Básico</strong>
                </li>

                <li v-if="bedRoom.internet == 'si'">
                  <i class="fa fa-check text-success"></i> La habitación tiene
                  <strong> Servicio de Internet</strong>
                </li>
                <li v-else>
                  <i class="fa fa-times text-danger"></i> La habitación tiene
                  <strong> Servicio de Internet</strong>
                </li>

                <li v-if="bedRoom.airConditioning == 'si'">
                  <i class="fa fa-check text-success"></i> La habitación tiene
                  <strong> Aire Acondicionado</strong>
                </li>
                <li v-else>
                  <i class="fa fa-times text-danger"></i> La habitación tiene
                  <strong> Aire Acondicionado</strong>
                </li>

                <li v-if="bedRoom.telephoneService == 'si'">
                  <i class="fa fa-check text-success"></i> La habitación tiene
                  <strong> Servicio teléfonico</strong>
                </li>
                <li v-else>
                  <i class="fa fa-times text-danger"></i> La habitación tiene
                  <strong> Servicio teléfonico</strong>
                </li>

                <li v-if="bedRoom.cooling == 'si'">
                  <i class="fa fa-check text-success"></i> La habitación tiene
                  <strong> Nevera (refrigerador)</strong>
                </li>
                <li v-else>
                  <i class="fa fa-times text-danger"></i> La habitación tiene
                  <strong> de Nevera (refrigerador)</strong>
                </li>

                <li v-if="bedRoom.jacuzzi == 'si'">
                  <i class="fa fa-check text-success"></i> La habitación tiene
                  <strong> Jacuzzi</strong>
                </li>
                <li v-else>
                  <i class="fa fa-times text-danger"></i> La habitación tiene
                  <strong> jacuzzi</strong>
                </li>
              </ul>
            </div>
          </div>
          <div class="pricing_footer heig">
            <div class="col-md-10 col-sm-12 col-xs-12">
              <a class="btn btn-success btn-block" role="button">Download <span> now!</span></a>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-12">
              <a class="btn btn-danger btn-block" role="button"><i class="fa fa-trash"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- price element -->
  </div>
</template>

<script>
import axios from "axios";
import PreloaderComponent from "./PreloaderComponent";
import Helpers from "./HelpersComponent";
export default {
  name: "listBedrooms",
  components: {
    PreloaderComponent,
    Helpers,
  },
  data() {
    return {
      preloader: true,
      bedRooms: [],
      helper: Helpers,
    };
  },
  mounted() {
    console.log("Component mounted listdebroomss.");
  },
  beforeMount() {},
  beforeCreate() {
    this.preloader = true;
  },
  created() {
    this.listRooms();
  },
  methods: {
    NumberFormatJS(value) {
      if (parseInt(value) < 1000) {
        return value;
      } else {
        var filtered_number = value.replace(/[^0-9]/gi, "");
        var length = filtered_number.length;
        var breakpoint = 1;
        var formated_number = "";
        var i;
        for (i = 1; i <= length; i++) {
          if (breakpoint > 3) {
            breakpoint = 1;
            formated_number = "." + formated_number;
          }
          var next_letter = i + 1;
          formated_number =
            filtered_number.substring(length - i, length - (i - 1)) +
            formated_number;
          breakpoint++;
        }
        return formated_number;
      }
    },

    async listRooms() {
      this.preloader = true;
      await axios
        .get("/listBedroomsAll")
        .then((response) => {
          this.preloader = false;
          //console.log("correct : ", response.data);
          this.bedRooms = response.data;
        })
        .catch((error) => {
          console.log("tenemos errores" + error);
          this.preloader = false;
          this.helper.helpers.error(
            "Lo Sentimos Hay un Error, Intente de Nuevo",
            false,
            "oops"
          );
        });
    },
  },
};
</script>


<style lang="scss" scoped>
.pad {
  padding: 10px 10px 10px 10px;
}
.pd {
  font-size: 15px;
}

#silverfox {
  /* Asignamos una altura mínima */
  object-fit: cover;
  width: 4vw;
  height: 4vw;
  padding: 0.5vw;
}
.mar-img-prof {
  border: #fff 4px solid !important;
  width: 180px !important;
  height: 180px !important;
  border-radius: 15px;
}

.pos-img-p img {
  border-radius: 25px;
}
.pos-img-p {
  text-align: left;
}

.heig {
  height: 90px;
}
</style>
