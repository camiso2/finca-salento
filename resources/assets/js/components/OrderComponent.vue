<template>
  <div>
    <preloader-component v-show="preloader" />

    <form class="form-horizontal form-label-left input_mask" method="POST" role="form" enctype="multipart/form-data" @submit.prevent="OrderSubmit">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <link rel="stylesheet" />

        <select v-model="selectedBedroom" @change="roomSeleted($event)" class="form-control" required="true">
          <option value="">&#xf236; &nbsp;&nbsp;Habitacion para Venta</option>
          <option v-for="bedroomCode in bedrooms" :value="bedroomCode.codeRoom" :key="bedroomCode.id">
            {{ bedroomCode.codeRoom }}
          </option>
        </select>
      </div>

      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <input type="number" v-model="valueOrder" class="form-control has-feedback-left" placeholder="Valor del pedido" maxlength="8" minlength="3" required="true" />
        <span class="fa fa-dollar form-control-feedback left" aria-hidden="true"></span>
      </div>

      <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0">
          <textarea v-model="order" id="" class="form-control text-ar" type="text" maxlength="100" required="true" placeholder="Escriba el Pedido">
          </textarea>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0">
          <hr />
          <!--<button type="submit" class="btn btn-primary">Borrar</button>-->
          <button type="submit" class="btn btn-success">Registrar Venta</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import PreloaderComponent from "./PreloaderComponent";
import Helpers from "./HelpersComponent";
export default {
  name: "order",
  components: {
    PreloaderComponent,Helpers
  },
  props: {
    user_id: String,
  },
  data() {
    return {
      preloader: false,
      selectedBedroom: "",
      bedrooms: {},
      order: "",
      valueOrder: "",
      debroom_id: "",
      helper:Helpers,
    };
  },

  mounted() {
    this.listBebroomsOccupation();
    console.log("Component mounted order.");
  },
  methods: {
    OrderSubmit() {
      this.preloader = true;
      let data = {
        selectedBedroom: this.selectedBedroom,
        order: this.order,
        valueOrder: this.valueOrder,
        user_id: this.user_id,
        debroom_id: this.debroom_id,
      };
      // convertimos el array a FormData
      var formData = this.toFormData(data);
      axios
        .post("/registerOrder", formData)
        .then((response) => {
          this.preloader = false;
          //console.log("order : ", response.data);
          if (response.data.success == "success") {
            this.selectedBedroom = "";
            this.order = "";
            this.valueOrder = "";
            this.debroom_id = "";
            location.reload();
            Swal.fire({
              //position: "top-end",
              icon: "success",
              title: "El pedido se registró con éxito",
              showConfirmButton: false,
              timer: 1500,
            });
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
        var request = this.bedrooms;
        for (let i = 0; i < request.length; i++) {
          if (request[i].codeRoom == event.target.value) {
            this.debroom_id = request[i].id;
          }
        }
      }
    },
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
    async listBebroomsOccupation() {
      this.preloader = true;
      await axios
        .get("/bedroomOccupation")
        .then((response) => {
          this.preloader = false;
          //console.log("correct bedroomOccupationAll : ", response.data);
          this.bedrooms = response.data.bedroomOccupation;
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


