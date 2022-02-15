<template>
  <div>
    <preloader-component v-show="preloader" />
    <div class="x_panel">
      <div class="x_content">

        <form class="form-horizontal form-label-left input_mask" method="POST" role="form" @submit.prevent="invoiceSubmit">
          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <link rel="stylesheet" />
            <h5>
              <i class="fa fa-calculator fa-esp" aria-hidden="true"></i>Seleccione
              la habitación a la que le desea facturar.
            </h5>
            <select v-model="selectedBedroom" @change="roomSeleted($event)" class="form-control" required="true">
              <option value="">
                &#xf236; &nbsp;&nbsp;Seleccione Habitacion para Facturar
              </option>
              <option v-for="bedroomCode in bedrooms" :value="bedroomCode.codeRoom" :key="bedroomCode.id">
                {{ bedroomCode.codeRoom }}
              </option>
            </select>
          </div>
        </form>

        <transition name="fade">

          <form class="form-horizontal form-label-left input_mask" method="POST" role="form" action="/invoicePDF" target="_blank" v-if="showButtonGenerateInvoice" id="formReceipt">
            <input type="hidden" v-model="invoiceBebroom_id" />
            <input type="hidden" name="_token" :value="csrf" />
            <input type="hidden" name="debroom_id" :value="debroom_id" />
            <input type="hidden" name="user_id" :value="user_id" />

            <div v-if="disscount">
              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <input type="number" v-model="disscountClient" class="form-control has-feedback-left" placeholder="descuento del cliente" name="disscountClient" />
                <span class="fa fa-dollar form-control-feedback left" aria-hidden="true"></span>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <input v-model="observations" id="" class="form-control text-ar" type="text" maxlength="100" placeholder="porque? " name="observations" />
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
              <i class="fa fa-calculator fa-esp" aria-hidden="true"></i>Quiere
              Reliazar Descuento al Cliente !
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <button type="button" class="btn btn-warning btn-block btn-lg" @click="reloadData">
                <i class="fa fa-calculator fa-esp" aria-hidden="true"></i><b>PAGAR CUENTA DEL CLIENTE</b>
                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
              </button>
            </div>
          </form>
        </transition>

        <transition name="fade">
          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <div v-if="showViewInvoice">
              <h5><b>Costo por día : </b>{{ costDay }} COP</h5>
              <h6><b>Cliente : </b>{{ nameClient }}</h6>

              <table class="table table-bordered responsive-utilities jambo_table">
                <thead>
                  <tr>
                    <th scope="col" style="width: 80%">DESCRIPCIÓN</th>
                    <th scope="col">VALOR</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Estadía de {{ totalStay }}</td>
                    <td style="color: #0275d8; font-weigth: 600">
                      $ {{ valueStay }}
                    </td>
                  </tr>
                  <tr v-for="order in orders" :key="order.id" :value="order.id">
                    <td>{{ order.order }}</td>
                    <td>$ {{ NumberFormatJS(order.valueOrder.toString()) }}</td>
                  </tr>
                  <tr>
                    <td colspan="1" style="text-align: right"><b>SUB-TOTAL.. </b></td>
                    <td>$ {{ subTotal }}</td>
                  </tr>
                  <tr>
                    <td colspan="1" style="text-align: right"><b>IVA </b></td>
                    <td>$ {{ iva }}</td>
                  </tr>
                  <tr>
                    <td colspan="1" style="text-align: right"><b>ANTICIPO </b></td>
                    <td>$ {{ advance }}</td>
                  </tr>
                  <tr>
                    <td colspan="1" style="text-align: right">
                      <b>
                        <span style="color: green">{{ balanceFavor }}</span> TOTAL
                      </b>
                    </td>
                    <td>$ {{ total }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </transition>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import PreloaderComponent from "./PreloaderComponent";
import Helpers from "./HelpersComponent";
export default {
  name: "invoice",
  components: {
    PreloaderComponent,
    Helpers,
  },
  props: {
    user_id: String,
  },
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      selectedBedroom: "",
      bedrooms: {},
      preloader: false,
      debroom_id: "",
      showButtonGenerateInvoice: false,
      showViewInvoice: false,
      invoiceBebroom_id: "",
      disscount: true,
      disscountClient: "",
      observations: "",
      costDay: "",
      orders: {},
      totalStay: "",
      valueStay: "",
      iva: "",
      subTotal: "",
      total: "",
      advance: "",
      balanceFavor: "",
      nameClient: "",
      helper: Helpers,
    };
  },

  mounted() {
    this.listBebroomsOccupation();
    console.log("Component mounted invoice.");
  },
  methods: {
    reloadData() {
      this.preloader = true;
      document.getElementById("formReceipt").submit();
      location.reload();
    },
    invoiceSubmit() {
      this.preloader = true;
      let data = {
        selectedBedroom: this.selectedBedroom,
        user_id: this.user_id,
        debroom_id: this.debroom_id,
      };
      // convert el array a FormData
      var formData = this.helper.helpers.toFormData(data);
      axios
        .post("/viewInvoice", formData)
        .then((response) => {
          this.preloader = false;
          console.log("invoice : ", response.data);
          if (response.data.success == "success") {
            this.costDay = this.NumberFormatJS(
              response.data.bedroom.dayRoomCost
            );
            var dia = response.data.dayStay == 1 ? " dia, " : " dias, ";
            var hora = response.data.hourStay == 1 ? " hora" : " horas";

            this.orders = response.data.orders;
            this.totalStay =
              response.data.dayStay == 0
                ? "" + response.data.hourStay + hora
                : response.data.dayStay + dia + response.data.hourStay + hora;

            this.iva = this.NumberFormatJS(response.data.iva.toString());
            this.valueStay = this.NumberFormatJS(
              response.data.valueStay.toString()
            );
            this.subTotal = this.NumberFormatJS(
              response.data.subTotal.toString()
            );
            this.total = this.NumberFormatJS(response.data.total.toString());

            this.balanceFavor =
              response.data.total < 0 ? "( Balance a favor del cliente ) " : "";

            this.advance = this.NumberFormatJS(
              response.data.checkin.advance.toString()
            );
            this.nameClient = response.data.checkin.name;
            this.showButtonGenerateInvoice = true;
            this.showViewInvoice = true;
            this.invoiceBebroom_id = this.debroom_id;
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
    async listBebroomsOccupation() {
      this.preloader = true;
      await axios
        .get("/bedroomOccupation")
        .then((response) => {
          this.preloader = false;
          console.log(
            "correct bedroomOccupation : ",
            response.data.bedroomOccupation
          );
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
    NumberFormatJS(value) {
      return this.helper.helpers.NumberFormatJS(value);
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
            this.invoiceSubmit();
          }
        }
      }
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
  height: 44px;
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

