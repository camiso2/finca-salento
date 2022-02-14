<template>
  <div>
    <preloader-component v-show="preloader" />
    <div class="x_panel">
      <div class="x_content">
        <br />
        <form class="form-horizontal form-label-left input_mask" method="POST" role="form" enctype="multipart/form-data" @submit.prevent="bookingSubmit">
          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
            <h4>Desde:</h4>
            <date-picker :lang="lang" v-model="timeEnter" valueType="format" class="input-cal" placeholder="Fecha de llegada, ejemplo : 2022-01-22" required="true" readonly></date-picker>
          </div>
          <div div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
            <h4>Hasta:</h4>
            <date-picker v-model="timeGetout" valueType="format" class="input-cal" placeholder="Fecha de salida, ejemplo : 2022-09-22"></date-picker>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
            <input type="text" v-model="name" class="form-control has-feedback-left" placeholder="Ingresar nombre del cliente" required="true" />
            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
          </div>

          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
            <input type="number" v-model="phone" class="form-control has-feedback-left" placeholder="Ingresar teléfono del cliente" required="true" />
            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
            <input type="email" v-model="email" class="form-control has-feedback-left" placeholder="Ingresar E-mail del cliente" required="true" />
            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
            <input type="number" v-model="advance" class="form-control has-feedback-left" placeholder="Ingresar anticipo del cliente" required="true" />
            <span class="fa fa-dollar form-control-feedback left" aria-hidden="true"></span>
          </div>

          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />

            <select v-model="personsQuantity" class="form-control" required="true">
              <option value="">
                &#xf0c0; |&nbsp;&nbsp;Seleccione cantidad de personas
              </option>
              <option v-for="n in persons" :value="n" :key="n">
                {{ n }}
              </option>
            </select>
          </div>

          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0">
              <textarea v-model="observations" id="" class="form-control text-ar" type="text" maxlength="100" required="true" placeholder="Observaciones">
              </textarea>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0">
              <hr />
              <!--<button type="submit" class="btn btn-primary">Borrar</button>-->
              <button type="submit" class="btn btn-success">Reservar</button>
              <a href="/dashboard/home">
                <button type="button" class="btn btn-primary">
                  Ver Lista de Reservaciones
                </button>
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import PreloaderComponent from "./PreloaderComponent";
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
import "vue2-datepicker/locale/es";
export default {
  name: "Bookings",
  components: { DatePicker, PreloaderComponent },
  props: {
    user_id: String,
  },

  data() {
    return {
      lang: {
        formatLocale: {
          firstDayOfWeek: 1,
        },
        monthBeforeYear: false,
      },
      timeEnter: null,
      timeGetout: null,
      persons: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
      personsQuantity: "",
      observations: "Ninguna observación",
      email: "",
      name: "",
      phone: "",
      advance: "0",
      preloader: false,
      //user_id:"",
    };
  },

  mounted() {
    console.log("Component mounted booking.");
  },

  methods: {
    bookingSubmit() {
      console.log("fectch:", this.timeEnter);

      let timeEnterValidDate = Date.parse(this.timeEnter);
      let timeGetoutValidDate = Date.parse(this.timeGetout);

      if (
        isNaN(timeEnterValidDate) ||
        isNaN(timeGetoutValidDate) ||
        timeGetoutValidDate === null ||
        timeEnterValidDate === null ||
        this.validateMinorCurrent(this.timeEnter) ||
        this.validateMinorCurrent(this.timeGetout) ||
        this.validateBetweenDates(this.timeEnter, this.timeGetout)
      ) {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Lo  Sentimos Hay un Error, La fechas no son  validas !",
          footer:
            "<p><b>POSIBLES ERRORES</b></p><div><ul><li>El formato de las fechas no es válido.</li><li>Las fechas deben ser mayores a la fecha actual.</li><li>La fecha de salida del cliente no puede ser menor a la de la entrada.</li></ul></div>",
        });
      } else {
        this.preloader = true;
        let data = {
          timeEnter: this.timeEnter,
          timeGetout: this.timeGetout,
          personsQuantity: this.personsQuantity,
          observations: this.observations,
          email: this.email,
          name: this.name,
          phone: this.phone,
          advance: this.advance,
          user_id: this.user_id,
        };
        // convertimos el array a FormData
        var formData = this.toFormData(data);
        axios
          .post("/registerBooking", formData)
          .then((response) => {
            this.preloader = false;
            console.log("booking : ", response.data);
            if (response.data.success == "success") {
              Swal.fire({
                //position: "top-end",
                icon: "success",
                title: "La reservación se registró con éxito",
                showConfirmButton: false,
                timer: 1500,
              });
              location.reload();
              /*this.timeEnter = "";
              this.timeGetout = "";
              this.personsQuantity = "";
              this.observations = "";
              this.email = "";
              this.name = "";
              this.phone = "";
              this.advance = "";*/
              /*Swal.fire({
                icon: "success",
                title: "La Reservación se Registró con Éxito !",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Registrar Más Reservaciones",
                footer:
                  '<a href="/dashboard/home">VER LISTA DE RESERVACIONES</a>',
                allowOutsideClick: false,
                showClass: {
                  popup: "animate__animated animate__fadeInDown",
                },
                hideClass: {
                  popup: "animate__animated animate__fadeOutUp",
                },
              });*/
            } else {
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Lo  Sentimos Hay un Error, Intente de Nuevo",
                //footer: '<a href="">Why do I have this issue?</a>',
              });
            }
          })
          .catch((error) => {
            console.log("tenemos errores" + error);
            this.preloader = false;
            this.$refs.fileupload.value = "";
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Lo  Sentimos Hay un Error, Intente de Nuevo",
              allowOutsideClick: false,
              //footer: '<a href="">Why do I have this issue?</a>',
            });
          });
      }
    },
    toFormData(obj) {
      // funcion que convierte a formData
      var formData = new FormData();
      for (var key in obj) {
        formData.append(key, obj[key]);
        console.log(key, obj[key]);
      }
      return formData;
    },
    validateMinorCurrent(date) {
      var x = new Date();
      var fecha = date.split("-");
      x.setFullYear(fecha[0], fecha[1] - 1, fecha[2]);
      var today = new Date();
      console.log("que es ::  ", x);
      if (x >= today) return false;
      else return true;
    },

    validateBetweenDates(timeEnter, timeGetout) {
      var _timeEnter_ = new Date();
      var _timeEnter = timeEnter.split("-");
      _timeEnter_.setFullYear(_timeEnter[0], _timeEnter[1] - 1, _timeEnter[2]);

      var _timeGetout_ = new Date();
      var _timeGetout = timeGetout.split("-");
      _timeGetout_.setFullYear(
        _timeGetout[0],
        _timeGetout[1] - 1,
        _timeGetout[2]
      );
      console.log("que es ::  ", _timeGetout_);
      if (_timeGetout_ >= _timeEnter_) return false;
      else return true;
    },
  },
};
</script>

<style lang="css" scoped>
.form-control {
  color: #788c9e;
  border-radius: 5px;
  height: 45px;
  opacity: 0.6;
}
.input-group-addon {
  border-radius: 5px;
  border: 0;
}

.input-cal {
  width: 100% !important;
  color: #788c9e;
  border-radius: 5px;

  opacity: 0.6;
}
.text-ar {
  height: 80px;
}

select {
  font-family: fontAwesome, Arial, sans-serif !important ;
  font-size: 14px !important;
  color: #788c9e !important;
}

.form-control-feedback {
  padding-top: 8px !important;
}
</style>
