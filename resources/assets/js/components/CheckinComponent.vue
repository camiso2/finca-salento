<template>
  <div>
    <preloader-component v-show="preloader" />
    <div class="x_panel">
      <div class="x_content">
        <br />
        <form class="form-horizontal form-label-left input_mask" method="POST" role="form" enctype="multipart/form-data" @submit.prevent="checkinSubmit">
          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
            <label for="">Fecha de ingreso</label>
            <input type="text" v-model="timeEnter" class="form-control has-feedback-left" placeholder="Ingresar nombre del cliente" required="true" readonly />
            <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
          </div>
          <div div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
            <label for="">Fecha de salida</label>
            <date-picker v-model="timeGetout" valueType="format" class="input-cal" placeholder="Fecha de salida, ejemplo : 2022-09-22"></date-picker>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
            <input type="text" v-model="name" class="form-control has-feedback-left" placeholder="Ingresar nombre del cliente" required="true" />
            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
          </div>

          <div class="col-md-2 col-sm-2 col-xs-2 form-group has-feedback">
            <select v-model="typeIdent" class="form-control has-feedback" required="true">
              <option value="">Tipo</option>
              <option value="0">Cédula de Ciudadania</option>
              <option value="1">Tarjeta de Identidad</option>
              <option value="2">Cédula Extranjera</option>
              <option value="3">Carnet Diplomático</option>
              <option value="4">Número de Identificación Personal</option>
              <option value="5">Pasaporte</option>
              <option value="6">Permiso Especial de Permanencia</option>
              <option value="7">Persona Juridica</option>
            </select>
          </div>

          <div class="col-md-4 col-sm-4 col-xs-10 form-group has-feedback">
            <input type="number" v-model="identClient" class="form-control has-feedback-left" placeholder="Ingresar identificación" required="true" />
            <span class="fa fa-cc form-control-feedback left" aria-hidden="true"></span>
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
            <span class="fa fa-dollar form-control-feedback left" aria-hidden="true"> </span>
          </div>

          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
            <link rel="stylesheet" />

            <select v-model="personsQuantity" class="form-control" required="true">
              <option value="">
                &#xf0c0; &nbsp;&nbsp;Seleccione cantidad de personas
              </option>
              <option v-for="n in persons" :value="n" :key="n">
                {{ n }}
              </option>
            </select>
          </div>
          <div class="col-md-2 col-sm-2 col-xs-4 form-group has-feedback_">
            <span class="fa fa-globe form-control" style="font-size: 32px !important" aria-hidden="true"></span>
          </div>

          <div class="col-md-4 col-sm-4 col-xs-8 form-group has-feedback">
            <vue-bootstrap-typeahead @hit="onNationalitySelected" v-model="query" :data="countries" placeholder="Buscar Nacionalidad" size="lg" class="form-group has-feedback" style="font-size: 14px !important" required="true" />
            <span class="sel">País Seleccionado: <strong>{{ query }}</strong></span>
          </div>

          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
            <link rel="stylesheet" />

            <select v-model="selectedBedroom" @change="roomSeleted($event)" class="form-control" required="true">
              <option value="">
                &#xf236; &nbsp;&nbsp;Habitaciones Disponibles
              </option>
              <option v-for="bedroomCode in bedrooms" :value="bedroomCode.codeRoom" :key="bedroomCode.id">
                {{ bedroomCode.codeRoom }}
              </option>
            </select>
          </div>

          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-0">
              <textarea v-model="observations" id="" class="form-control text-ar" type="text" maxlength="100" required="true" placeholder="Observaciones">
              </textarea>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0">
              <hr />
              <!--<button type="submit" class="btn btn-primary">Borrar</button>-->
              <button type="submit" class="btn btn-success">CHECK-IN</button>
              <a href="/dashboard/home">
                <button type="button" class="btn btn-primary">
                  Ver Lista de Check-In
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
import VueAutosuggest from "vue-autosuggest";
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
import "vue2-datepicker/locale/es";
import VueBootstrapTypeahead from "vue-bootstrap-typeahead";

import Helpers from "./HelpersComponent";

export default {
  name: "Bookings",
  components: {
    DatePicker,
    PreloaderComponent,
    VueBootstrapTypeahead,
    Helpers,
  },
  props: {
    user_id: String,
  },

  data() {
    return {
      selectedBedroom: "",
      bedrooms: {},
      iso: "",
      query: "",
      countries: [],
      nationalitySelected: null,
      lang: {
        formatLocale: {
          firstDayOfWeek: 1,
        },
        monthBeforeYear: false,
      },
      timeEnter: null,
      timeGetout: null,
      persons: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
      //typeIdPersons: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
      personsQuantity: "",
      typeIdent: "",
      observations: "Ninguna observación",
      email: "",
      name: "",
      phone: "",
      advance: "0",
      identClient: "",
      preloader: false,
      debroom_id: "",
      helper: Helpers,
    };
  },
  props: {
    user_id: String,
  },

  mounted() {
    this.fetchCurrent();
    this.listCountriesAll();
    console.log("Component mounted checkin.");
  },

  methods: {
    async checkinSubmit() {
      let timeEnterValidDate = Date.parse(this.timeEnter);
      let timeGetoutValidDate = Date.parse(this.timeGetout);

      if (
        isNaN(timeEnterValidDate) ||
        isNaN(timeGetoutValidDate) ||
        timeGetoutValidDate === null ||
        timeEnterValidDate === null ||
        this.nationalitySelected === null ||
        this.validateMinorCurrent(this.timeEnter) ||
        this.validateMinorCurrent(this.timeGetout) ||
        this.validateBetweenDates(this.timeEnter, this.timeGetout)
      ) {
        this.helper.helpers.errorFooter(
          "<p><b>POSIBLES ERRORES</b></p><div><ul><li>Debe ingresar nacionalidad del huésped.</li><li>El formato de las fechas no es válido.</li><li>Las fechas deben ser mayores a la fecha actual.</li><li>La fecha de salida del cliente no puede ser menor a la de la entrada.</li></ul></div>",
          "Lo  Sentimos Hay un Error, La fechas no son  validas !",
          "oops",
          false
        );
      } else {
        this.preloader = true;
        let data = {
          timeEnter: this.timeEnter,
          timeGetout: this.timeGetout,
          name: this.name,
          personsQuantity: this.personsQuantity,
          observations: this.observations,
          email: this.email,
          typeIdent: this.typeIdent,
          identClient: this.identClient,
          phone: this.phone,
          email: this.email,
          advance: this.advance,
          personsQuantity: this.personsQuantity,
          nationalitySelected: this.nationalitySelected,
          selectedBedroom: this.selectedBedroom,
          observations: this.observations,
          debroom_id: this.debroom_id,
          user_id: this.user_id,
        };
        // convert el array a FormData
        var formData = this.helper.helpers.toFormData(data);
        await axios
          .post("/registerCheckin", formData)
          .then((response) => {
            this.preloader = false;
            // console.log("checkin : ", response.data);
            if (response.data.success == "success") {
              this.helper.helpers.success(
                "La reservación se registró con éxito",
                false,
                1500
              );
              location.reload();
            } else {
              this.helper.helpers.error(
                "Lo Sentimos Hay un Error, Intente de Nuevo",
                false,
                "oops"
              );
            }
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
      }
    },
    roomSeleted(event) {
      if (
        event.target.value == "" ||
        event.target.value == undefined ||
        event.target.value == null
      ) {
        Swal.fire({
          icon: "info",
          title: "Oops...",
          text: "Debe Seleccionar una habitación...",
          allowOutsideClick: false,
          //footer: '<a href="">Why do I have this issue?</a>',
        });
      } else {
        this.viewBedroom = true;
        var request = this.bedrooms;
        for (let i = 0; i < request.length; i++) {
          if (request[i].codeRoom == event.target.value) {
            this.debroom_id = request[i].id;
            Swal.fire({
              title: request[i].name,
              imageUrl: "/" + request[i].fileImage,
              imageWidth: 400,
              imageHeight: 200,
              imageAlt: "Custom image",
              html:
                "<div><p><b>COSTO : </b>" +
                this.NumberFormatJS(request[i].dayRoomCost) +
                " por día</p></div>" +
                "<div><p><b>Tipo Habitación : </b>" +
                request[i].typeBedrooms +
                "</p></div>" +
                "<div style='text-align:left'>" +
                "<table class='table'>" +
                "<thead></thead>" +
                "<tbody><tr><td style='width:80% !important;'><b >La habitación tiene internet </b></td><td>" +
                request[i].internet +
                "</td></tr></tbody>" +
                "<tbody><tr><td ><b >La habitación tiene tv </b></td><td>" +
                request[i].tv +
                "</td></tr></tbody>" +
                "<tbody><tr><td ><b >La habitación tiene radio  </b></td><td>" +
                request[i].rradio +
                "</td></tr></tbody>" +
                "<tbody><tr><td ><b >Cantidad de camas  </b></td><td>" +
                request[i].bedQuantity +
                "</td></tr></tbody>" +
                "<tbody><tr><td ><b >La habitación tiene aire acondicionado  </b></td><td>" +
                request[i].airConditioning +
                "</td></tr></tbody>" +
                "<tbody><tr><td ><b >La habitación tiene enfriamiento  </b></td><td>" +
                request[i].cooling +
                "</td></tr></tbody>" +
                "<tbody><tr><td ><b >La habitación tiene mobiliario básico  </b></td><td>" +
                request[i].furniture +
                "</td></tr></tbody>" +
                "<tbody><tr><td ><b >La habitación tiene jacuzzi  </b></td><td>" +
                request[i].jacuzzi +
                "</td></tr></tbody>" +
                "<tbody><tr><td ><b >La habitación tiene baño privado  </b></td><td>" +
                request[i].privateBathroom +
                "</td></tr></tbody>" +
                "<tbody><tr><td ><b >La habitación tiene ventana  </b></td><td>" +
                request[i].roomWindow +
                "</td></tr></tbody>" +
                "<tbody><tr><td ><b >La habitación tiene teléfono  </b></td><td>" +
                request[i].telephoneService +
                "</td></tr></tbody>" +
                "</table></div>",
            });
          }
        }
      }
    },
    NumberFormatJS(value) {
      return this.helper.helpers.NumberFormatJS(value);
    },
    async listCountriesAll() {
      this.preloader = true;
      await axios
        .get("/listCountriesAll")
        .then((response) => {
          this.preloader = false;
          //console.log("correct countries : ", response.data);
          this.countries = this.decodeJsonCountries(
            response.data.listCountries
          );
          this.bedrooms = response.data.beroomsOccupationFalse;
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
    decodeJsonCountries(json) {
      var request = json;
      var result = [];
      for (let i = 0; i < request.length; i++) {
        if (request[i].name != null) {
          result.push(request[i].name);
        }
      }
      return result;
    },
    onNationalitySelected(country) {
      this.nationalitySelected = country;
    },

    fetchCurrent() {
      const today = new Date();
      this.timeEnter = this.formatFetch(today, "yy-mm-dd");
    },
    formatFetch(fecha, format) {
      const map = {
        dd: fecha.getDate(),
        mm: fecha.getMonth() + 1,
        yy: fecha.getFullYear(),
        // yy: fecha.getFullYear().toString().slice(-2),
        yyyy: fecha.getFullYear(),
      };

      return format.replace(/dd|mm|yy|yyy/gi, (matched) => map[matched]);
    },

    validateMinorCurrent(date) {
      var x = new Date();
      var fecha = date.split("-");
      x.setFullYear(fecha[0], fecha[1] - 1, fecha[2]);
      var today = new Date();
      //console.log("que es ::  ", x);
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
      // console.log("que es ::  ", _timeGetout_);
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

.has-feedback_ {
  text-align: center;
}
.sel {
  position: absolute;
  margin-top: -15px;
}
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>


