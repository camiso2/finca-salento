<template>
  <div>
    <preloader-component v-show="preloader" />
    <div class="x_panel">
      <div class="x_content">
        <br />
        <form class="form-horizontal form-label-left input_mask" method="POST" role="form" action="/reportDayPDF" target="_blank" id="formReportDay">
          <input type="hidden" name="_token" :value="csrf" />
          <input type="hidden" name="typeReport" value="1" />

          <div div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <h4>
              <i class="fa fa-file-pdf-o fa-esp" aria-hidden="true"></i>Generar
              Reporte por día
            </h4>
            <hr />
          </div>
          <div div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
            <date-picker v-model="fetchIni" valueType="format" class="input-cal" placeholder="Fecha de salida, ejemplo : 2022-09-22"></date-picker>
            <input type="hidden" name="fetchIni" :value="fetchIni" />
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
            <button type="button" class="btn btn-warning btn-block btn-lg" @click="reloadDayReport">
              <i class="fa fa-file-pdf-o fa-esp" aria-hidden="true"></i><b>GENERAR REPORTE</b>
              <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
            </button>
          </div>
        </form>

        <hr class="hr" />
        <form class="form-horizontal form-label-left input_mask" method="POST" role="form" action="/reportDayPDF" target="_blank" id="formReportBetweenDates">
          <input type="hidden" name="_token" :value="csrf" />
          <input type="hidden" name="typeReport" value="2" />
          <div div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <h4>
              <i class="fa fa-file-pdf-o fa-esp" aria-hidden="true"></i>Generar
              Reporte entre fechas
            </h4>
            <hr />
          </div>
          <div div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
            <label for="">Fecha inicio</label>
            <date-picker v-model="initDate" valueType="format" class="input-cal" placeholder="Fecha de inicio, ejemplo : 2022-09-22"></date-picker>
            <input type="hidden" name="initDate" :value="initDate" />
          </div>
          <div div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
            <label for="">Fecha de final</label>
            <date-picker v-model="finalDate" valueType="format" class="input-cal" placeholder="Fecha de final, ejemplo : 2022-10-22"></date-picker>
            <input type="hidden" name="finalDate" :value="finalDate" />
          </div>

          <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
            <label for="">&nbsp;</label>

            <button type="button" class="btn btn-warning btn-block btn-lg" @click="reloadBetweenReport">
              <i class="fa fa-file-pdf-o fa-esp" aria-hidden="true"></i><b>GENERAR REPORTE</b>
              <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
            </button>
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
import Helpers from "./HelpersComponent";

export default {
  name: "Report",
  components: {
    DatePicker,
    PreloaderComponent,
    Helpers,
  },
  props: {
    user_id: String,
  },
  data() {
    return {
      initDate: "",
      finalDate: "",
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      timeGetout: null,
      preloader: false,
      fetchIni: "",
      helper: Helpers,
    };
  },
  methods: {
    reloadBetweenReport() {
      let initDateValidDate = Date.parse(this.initDate);
      let finalDateValidDate = Date.parse(this.finalDate);

      if (
        isNaN(initDateValidDate) ||
        isNaN(finalDateValidDate) ||
        finalDateValidDate === null ||
        initDateValidDate === null ||
        this.validateBetweenDates(this.initDate, this.finalDate)
      ) {
        this.helper.helpers.errorFooter(
          "<p><b>POSIBLES ERRORES</b></p><div><ul><li>El formato de las fechas no es válido.</li><li>Las fechafinal debe ser mayor a la fecha inicial.</li></ul></div>",
          "Lo  Sentimos Hay un Error, La fechas no son  validas !",
          "oops",
          false
        );
        return false;
      }
      document.getElementById("formReportBetweenDates").submit();
    },
    reloadDayReport() {
      let fetchIniDate = Date.parse(this.fetchIni);
      if (isNaN(fetchIniDate) || fetchIniDate === null || fetchIniDate === "") {
        this.helper.helpers.errorFooter(
          "<p><b>POSIBLE ERROR</b></p><div><ul><li>El formato de las fechas no es válido.</li></ul></div>",
          "Lo  Sentimos Hay un Error, La fecha no es valida !",
          "oops",
          false
        );
        return false;
      }
      document.getElementById("formReportDay").submit();
      //location.reload();
    },
    validateBetweenDates(timeEnter, timeGetout) {
      return this.helper.helpers.validateBetweenDates(timeEnter, timeGetout);
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

h4 {
  font-weight: 600;
  text-transform: uppercase;
}

.hr {
  border-top: 5px solid #c3c3c5 !important;
}
hr {
  border-top: 2px solid #c3c3c5 !important;
}

.input_mask {
  background-color: rgb(237, 238, 242);
  border-radius: 5px;
}
</style>



