<template>
  <div>
    <div class="x_content">
      <!-- start project list -->
      <div style="overflow-x: auto">
        <table class="table table-striped projects">
          <thead></thead>
          <tbody>
            <tr
              v-for="booking in bookings.data"
              :key="booking.id"
              :value="booking.id"
            >
              <td>{{ booking.id }}</td>
              <td>
                <p class="ps"><b>Cliente :</b> {{ booking.name }}</p>

                <small>Fecha de Ingreso {{ booking.timeEnter }}</small>
              </td>
              <td>
                <ul class="list-inline">
                  <li>
                    <img
                      src="http://localhost/personal/njoroge/assets3/img.jpg"
                      class="avatar"
                      alt="Avatar"
                    />
                  </li>
                </ul>
              </td>
              <td class="project_progress">
                <div class="progress progress_sm">
                  <div
                    class="progress-bar bg-green"
                    role="progressbar"
                    v-bind:data-transitiongoal="valor"
                    v-bind:style="{ width: valor + '%' }"
                  ></div>
                </div>
                <small>{{ valor }}% Complete</small>
              </td>
              <td>
                <button
                  type="button"
                  class="btn btn-success btn-xs"
                  @click="dataBookingId(booking)"
                >
                  Datos de Reservación
                </button>
              </td>
              <td>
                <a href="#" class="btn btn-danger btn-xs"
                  ><i class="fa fa-trash-o"></i>
                </a>

                <a href="#" class="btn btn-info btn-xs"
                  ><i class="fa fa-pencil"></i>
                  Edit
                </a>
              </td>
              <td>
                <button
                  type="button"
                  class="btn btn-primary btn-block btn-xs"
                  @click="obs(booking.id)"
                >
                  Check-In
                  <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td colspan="7">
                <nav>
                  <ul class="pagination">
                    <li class="page-item" v-show="bookings['prev_page_url']">
                      <a
                        href="#"
                        class="page-link"
                        @click.prevent="getPreviousPage"
                      >
                        <span>
                          <span aria-hidden="true">«</span>
                        </span>
                      </a>
                    </li>
                    <li
                      class="page-item"
                      :class="{
                        active: bookings['current_page'] === n,
                      }"
                      v-for="n in bookings['last_page']"
                    >
                      <a href="#" class="page-link" @click.prevent="getPage(n)">
                        <span>
                          {{ n }}
                        </span>
                      </a>
                    </li>
                    <li class="page-item" v-show="bookings['next_page_url']">
                      <a
                        href="#"
                        class="page-link"
                        @click.prevent="getNextPage"
                      >
                        <span>
                          <span aria-hidden="true">»</span>
                        </span>
                      </a>
                    </li>
                  </ul>
                </nav>
              </td>
            </tr>
          </tbody>
        </table>
        <!-- end project list -->
      </div>
    </div>

    <preloader-component v-show="preloader" />
  </div>
</template>

<script>
import axios from "axios";
import PreloaderComponent from "./PreloaderComponent";

export default {
  name: "listBookings",
  components: {
    PreloaderComponent,
  },
  data() {
    return {
      preloader: false,
      valor: "38",
      bookings: {},
      contactos: {},
    };
  },

  beforeCreate() {
    this.preloader = true;
  },

  mounted() {
    this.getBookingsList();
    console.log("Component mounted list bookings.");
  },
  created() {
    //this.listBookings();
  },
  methods: {
    dataBookingId(booking) {
      console.log(booking.name);

      Swal.fire({
        icon: "info",
        title: "Datos de la Reservación",

        html:
          "<div style='text-align:left'>" +
          "<table class='table'>" +
          "<thead></thead>" +
          "<tbody><tr><td style='width:110px !important;'><b >Nombre  </b></td><td>" +
          booking.name +
          "</td></tr></tbody>" +
          "<tbody><tr><td ><b >E-mail  </b></td><td>" +
          booking.email +
          "</td></tr></tbody>" +
          "<tbody><tr><td ><b >Teléfono  </b></td><td>" +
          booking.phone +
          "</td></tr></tbody>" +
          "<tbody><tr><td ><b >Ingreso  </b></td><td>" +
          booking.timeEnter +
          "</td></tr></tbody>" +
          "<tbody><tr><td ><b >Salida  </b></td><td>" +
          booking.timeGetout +
          "</td></tr></tbody>" +
          "<tbody><tr><td ><b >Anticipo  </b></td><td>" +
          booking.advance +
          "</td></tr></tbody>" +
          "<tbody><tr><td ><b >Personas  </b></td><td>" +
          booking.personsQuantity +
          "</td></tr></tbody>" +
          "<tbody><tr><td ><b >Observaciones  </b></td><td>" +
          booking.observations +
          "</td></tr></tbody>" +
          "<tbody><tr><td ><b >Fecha de Registro  </b></td><td>" +
          booking.updated_at +
          "</td></tr></tbody>" +
          "</table></div>",
      });
    },
    obs(id) {
      window.location = "/dashboard/home";
    },
    async getBookingsList() {
      this.preloader = true;
     await axios
        .get("/listBookingsAll")
        .then(
          (response) => {
            this.preloader = false;
            this.$set(this.$data, "bookings", response.data);
           // console.log(response.data);
          },
          (response) => {
            console.log(response.data);
          }
        )
        .catch((error) => {
          console.log("tenemos errores" + error);
          this.preloader = false;
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Lo  Sentimos Hay un Error, Intente de Nuevo...",
            allowOutsideClick: false,
            //footer: '<a href="">Why do I have this issue?</a>',
          });
        });
    },
    async getPage(page) {
      this.preloader = true;
     await axios
        .get("/listBookingsAll?page=" + page)
        .then(
          (response) => {
            this.preloader = false;
            this.$set(this.$data, "bookings", response.data);
            console.log(response.data);
          },
          (response) => {}
        )
        .catch((error) => {
         // console.log("tenemos errores" + error);
          this.preloader = false;
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Lo  Sentimos Hay un Error, Intente de Nuevo...",
            allowOutsideClick: false,
            //footer: '<a href="">Why do I have this issue?</a>',
          });
        });
    },
    async getPreviousPage() {
      this.preloader = true;
      await axios
        .get(this.bookings["prev_page_url"])
        .then(
          (response) => {
            this.preloader = false;
            this.$set(this.$data, "bookings", response.data);
            //console.log(response.data);
          },
          (response) => {}
        )
        .catch((error) => {
         // console.log("tenemos errores" + error);
          this.preloader = false;
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Lo  Sentimos Hay un Error, Intente de Nuevo...",
            allowOutsideClick: false,
            //footer: '<a href="">Why do I have this issue?</a>',
          });
        });
    },
    async getNextPage() {
      this.preloader = true;
     await  axios
        .get(this.bookings["next_page_url"])
        .then(
          (response) => {
            this.preloader = false;
            this.$set(this.$data, "bookings", response.data);
          },
          (response) => {}
        )
        .catch((error) => {
         // console.log("tenemos errores" + error);
          this.preloader = false;
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Lo  Sentimos Hay un Error, Intente de Nuevo...",
            allowOutsideClick: false,
            //footer: '<a href="">Why do I have this issue?</a>',
          });
        });
    },
  },
};
</script>

<style lang="scss" scoped>
.obs {
  width: 100%;
  border: 0;
  background-color: transparent;
}

.ps {
  width: 250px;
  overflow: hidden !important;
  white-space: nowrap !important;
  text-overflow: ellipsis !important;
}

.badge {
  background-color: red !important;
}
.badge-primary {
  background-color: red !important;
}
.badge-pill {
  background-color: red !important;
}
</style>
