<template>
  <!--emit importante :: https://programmerclick.com/article/5304926324/-->
  <div>
    <preloader-component v-show="preloader" />

    <div class="x_panel">
      <div class="x_content">
        <br />

        <form id="#bedroom" method="POST" role="form" enctype="multipart/form-data" @submit.prevent="bedRoomSubmit">
          <div class="content tab">
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input v-model="name" id="name" name="nombre" type="text" class="form-control has-feedback-left" placeholder="Ingrese el nombre de su habitación" required />
              <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group   has-feedback  ">
              <input v-model="dayRoomCost" id="dayRoomCost" name="dayRoomCost" type="number" class="form-control has-feedback-left" placeholder="Ingrese el costo por dia habitación $" required />
              <span class="fa fa-dollar form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12  form-group  has-feedback   ">
              <select v-model="typeBedrooms" class="form-control has-feedback">
                <option disabled value="">
                  &#xf0db; | Seleccionar tipo de habitación
                </option>
                <option value="habitacion sencilla">
                  Habitación Sencilla
                </option>
                <option value="habitacion matrimonial">
                  Habitación Matrimonial
                </option>
                <option value="habitacion doble">
                  Habitación Doble
                </option>
                <option value="habitacion tipo estudio">
                  Habitación Tipo Estudio
                </option>
                <option value="habitacion tipo suite">
                  Habitación Tipo Suite
                </option>
                <option value="habitacion comunicantes">
                  Habitación Comunicantes
                </option>
                <option value="habitacion triple">
                  Habitación Triple
                </option>
                <option value="habitacion cuadruple">
                  Habitación Cuadruple
                </option>
                <option value="habitacion familiar">
                  Habitación Familiar
                </option>
                <option value="habitacion compartida">
                  Habitación Compartida
                </option>
                <option value="cabanas">Cabanas</option>
                <option value="apartamento">Apartamento</option>
                <option value="bungalow">Bungalow</option>
                <option value="chalet">Chalet</option>
                <option value="Tienda">Tienda</option>
                <option value="Dormitory-room">Dormitory-Room</option>
                <option value="apartamento">Apartamento</option>
                <option value="casa-movil">Casa Móvil</option>
                <option value="tienda">Tienda</option>
                <option value="casa rural">Casa Rural</option>
                <option value="otra">Otra</option>
              </select>
              <!--<span>Seleccion : {{ typeBedrooms }}</span>-->
            </div>
            <div class=" col-md-6 col-sm-6 col-xs-12 form-group has-feedback ">
              <select v-model="bedQuantity" class="form-control">
                <option value="">
                  &#xf236; | Seleccione cantidad de camas
                </option>
                <option v-for="n in beds" :value="n" :key="n">
                  {{ n }}
                </option>
              </select>
            </div>
            <!--Define cantidad de camas spara habitación
                                                        <script type="text/javascript">
                                                            this.onchange = function() {}

                                                            function ShowSelected() {
                                                                var cantidad = document.getElementById("cant_camas").value;
                                                                //alert("Has escrito:" + cantidad);
                                                                if (cantidad > 15) {
                                                                    alert("la cantidad deber ser menor a 15 camas por habitación");
                                                                } else {
                                                                    var incremento = 0;
                                                                    incremento++;
                                                                    //Obteniendo el Div "productos"
                                                                    bloque = document.getElementById('campos_dinamicos');
                                                                    //Llenando el arreglo que contendrá los "Options" de nuestro "Select"
                                                                    var options = [
                                                                        "Sencilla"
                                                                        , "Doble"
                                                                        , "Triple"
                                                                        , "Matrimonial"
                                                                        , "Queen.Size"
                                                                        , "King.Size"
                                                                        , "King.California"
                                                                        , "Otro.Tipo"
                                                                    , ];
                                                                    // alert("cantida : "+cantidad);
                                                                    //Agregando nuestros "Options" a nuestro "Select"
                                                                    while (bloque.firstChild) bloque.removeChild(bloque.firstChild); // remover elementos;
                                                                    for (var k = 1, cantidad = Number(cantidad); k <= cantidad; k++) {
                                                                        //Creando el Select que irá dentro del Div "productos"
                                                                        var salto = document.createElement("P");
                                                                        var elemento = document.createElement('select');
                                                                        var text = document.createTextNode(" Seleccione Cama " + k + " : ");
                                                                        elemento.setAttribute("name", "cama" + k);
                                                                        elemento.setAttribute('required', true);
                                                                        elemento.id = 'select' + k;
                                                                        elemento.className = "select";
                                                                        //Agregando nuestros "Options" a nuestro "Select"
                                                                        for (var i = 0; i < options.length; i++) {
                                                                            var option = document.createElement("option");
                                                                            option.value = options[i];
                                                                            option.text = options[i];
                                                                            elemento.appendChild(option);
                                                                        }
                                                                        bloque.appendChild(text);
                                                                        bloque.appendChild(elemento);
                                                                        bloque.appendChild(salto);
                                                                        var seleccionada = elemento.options[elemento.selectedIndex].value;
                                                                        //alert(seleccionada);
                                                                    }
                                                                }
                                                            }
                                                            onload = ShowSelected;

                                                        </script> -->
            <div class="fo-top">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-2 control-label"></label>
                <div class="col-sm-12 ctl">
                  <table class="table table-bordered">
                    <thead>
                      <th style="width: 80%; padding-left: 10px">
                        <b> INGRESE LOS SIGUIENTES DATOS </b>
                      </th>
                      <th style="width: 10%; text-align: center">
                        SI
                      </th>
                      <th style="width: 10%; text-align: center">
                        NO
                      </th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>La habitación tiene radio ?</td>
                        <td id="center-td">
                          <input type="radio" name="rradio" value="si" required="true" v-model="rradio" />
                        </td>
                        <td id="center-td">
                          <input type="radio" name="rradio" required="true" value="no" v-model="rradio" lass="flat" />
                        </td>
                      </tr>
                      <tr>
                        <td>La habitación tiene televisión ?</td>
                        <td id="center-td">
                          <input type="radio" name="tv" value="si" required="true" v-model="tv" />
                        </td>
                        <td id="center-td">
                          <input type="radio" name="tv" required="true" value="no" v-model="tv" />
                        </td>
                      </tr>
                      <tr>
                        <td>La habitación tiene ventana ?</td>
                        <td id="center-td">
                          <input type="radio" name="roomWindow" value="si" required="true" v-model="roomWindow" />
                        </td>
                        <td id="center-td">
                          <input type="radio" name="roomWindow" required="true" value="no" v-model="roomWindow" />
                        </td>
                      </tr>
                      <tr>
                        <td>La habitación tiene baño privado ?</td>
                        <td id="center-td">
                          <input type="radio" name="privateBathroom" value="si" required="true" v-model="privateBathroom" />
                        </td>
                        <td id="center-td">
                          <input type="radio" name="privateBathroom" required="true" value="no" v-model="privateBathroom" />
                        </td>
                      </tr>
                      <tr>
                        <td>
                          La habitación tiene mobiliario basico ?
                        </td>
                        <td id="center-td">
                          <input type="radio" name="furniture" value="si" required="true" v-model="furniture" />
                        </td>
                        <td id="center-td">
                          <input type="radio" name="furniture" required="true" value="no" v-model="furniture" />
                        </td>
                      </tr>
                      <tr>
                        <td>
                          La habitación tiene servicio de internet ?
                        </td>
                        <td id="center-td">
                          <input type="radio" name="internet" value="si" required="true" v-model="internet" />
                        </td>
                        <td id="center-td">
                          <input type="radio" name="internet" required="true" value="no" v-model="internet" />
                        </td>
                      </tr>
                      <tr>
                        <td>
                          La habitación tiene aire acondicionado ?
                        </td>
                        <td id="center-td">
                          <input type="radio" name="airConditioning" value="si" required="true" v-model="airConditioning" />
                        </td>
                        <td id="center-td">
                          <input type="radio" name="airConditioning" required="true" value="no" v-model="airConditioning" />
                        </td>
                      </tr>
                      <tr>
                        <td>
                          La habitación tiene servicio teléfonico ?
                        </td>
                        <td id="center-td">
                          <input type="radio" name="telephoneService" value="si" required="true" v-model="telephoneService" />
                        </td>
                        <td id="center-td">
                          <input type="radio" name="telephoneService" required="true" value="no" v-model="telephoneService" />
                        </td>
                      </tr>
                      <tr>
                        <td>
                          La habitación tiene servicio de Nevera
                          (refrigerador) ?
                        </td>
                        <td id="center-td">
                          <input type="radio" name="cooling" value="si" required="true" v-model="cooling" />
                        </td>
                        <td id="center-td">
                          <input type="radio" name="cooling" required="true" value="no" v-model="cooling" />
                        </td>
                      </tr>
                      <tr>
                        <td>
                          La habitación tiene servicio de jacuzzi ?
                        </td>
                        <td id="center-td">
                          <input type="radio" name="jacuzzi" required="true" v-model="jacuzzi" value="si" />
                        </td>
                        <td id="center-td">
                          <input type="radio" name="jacuzzi" required="true" v-model="jacuzzi" value="no" />
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="fo-top">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-2 control-label"></label>
                <div class="input-group">
                  <span class="input-group-addon">Seleccione la imagen</span>
                  <img :src="previewImage" class="img-thumbnail mt-2" v-if="fileImage" style="width: 50%" />
                  <input type="file" ref="fileupload" accept=".jpg, .jpeg, .png, gif" class="form-control" @change="onImageChanged" name="imagen" />

                  <span class="input-group-addon">|</span>
                </div>

                <div class="clearfix"></div>
              </div>
            </div>
            <div class="fo-top">
              <p class="help-block">
                <label for="focusedinput" class="col-sm-2 control-label"></label>
                (.JPG, .PNG .GIF ->se recomienda que la imagen sea
                tomada de forma horizontal, tamaño maximo 10MP)
              </p>
              <hr />

              <div class="form-group">
                <label for="focusedinput" class="col-sm-2 control-label"></label>
                <button class="btn btn-success btn-block">
                  REGISTRAR HABITACIÓN
                </button>
              </div>
            </div>
          </div>
        </form>
        <br /><br />
      </div>
    </div>
  </div>

</template>

<script>
import axios from "axios";
import PreloaderComponent from "./PreloaderComponent";
export default {
  name: "registerBedroom",
  components: {
    PreloaderComponent,
  },
  computed: {},
  props: {
    title: String,
    user_id: String,
  },
  data() {
    return {
      preloader: false,
      typeBedrooms: "",
      bedQuantity: "",
      dayRoomCost: "",
      name: "",
      jacuzzi: "",
      cooling: "",
      telephoneService: "",
      airConditioning: "",
      internet: "",
      furniture: "",
      privateBathroom: "",
      roomWindow: "",
      tv: "",
      rradio: "",
      fileImage: "",
      previewImage: "",
      fileupload: "",
      /*delete: null,
      state: null,
      occupation: null,*/
      beds: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    };
  },
  mounted() {
    console.log("Component mounted registerBedroom.");
  },

  methods: {
    onImageChanged: function (event) {
      // Preview imagen
      this.fileImage = event.target.files[0];
      this.previewImage = URL.createObjectURL(this.fileImage);
      var fileSize = event.target.files[0].size;
      if (fileSize > 10000000) {
        //this.companyLogoError ="La imagen no debe pesar mas de 1MB, por favor introduzca una nueva";
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Lo Sentimos La imagen no debe pesar mas de 10MB, por favor introduzca una nueva",
          allowOutsideClick: false,
          //footer: '<a href="">Why do I have this issue?</a>',
        });
        this.$refs.fileupload.value = "";
      }
    },
    bedRoomSubmit() {
      this.preloader = true;
      let data = {
        typeBedrooms: this.typeBedrooms,
        bedQuantity: this.bedQuantity,
        dayRoomCost: this.dayRoomCost,
        name: this.name,
        jacuzzi: this.jacuzzi,
        cooling: this.cooling,
        telephoneService: this.telephoneService,
        airConditioning: this.airConditioning,
        internet: this.internet,
        furniture: this.furniture,
        privateBathroom: this.privateBathroom,
        roomWindow: this.roomWindow,
        tv: this.tv,
        rradio: this.rradio,
        fileImage: this.fileImage,
        user_id: this.user_id,
        /* delete: this.delete,
        state: this.state,
        occupation: this.occupation,*/
      };
      // convertimos el array a FormData
      var formData = this.toFormData(data);
      axios
        .post("/registerBedroom", formData, {
          "content-type": "multipart/form-data",
        })
        .then((response) => {
          this.preloader = false;
          console.log("correct : ", response.data);
          if (response.data.success == "success") {
            Swal.fire({
              //position: "top-end",
              icon: "success",
              title: "La habitación se registró con éxito",
              showConfirmButton: false,
              timer: 1500,
            });
            location.reload();
            /*this.$refs.fileupload.value = "";
            this.typeBedrooms = "";
            this.bedQuantity = "";
            this.dayRoomCost = "";
            this.name = "";
            this.jacuzzi = "";
            this.cooling = "";
            this.telephoneService = "";
            this.airConditioning = "";
            this.internet = "";
            this.furniture = "";
            this.privateBathroom = "";
            this.roomWindow = "";
            this.tv = "";
            this.rradio = "";
            this.fileImage = "";
            this.imagen = "";
            Swal.fire({
              icon: "success",
              title: "La Habitación se Registró con Éxito !",
              confirmButtonColor: "#3085d6",
              confirmButtonText: "Registrar Más Habitaciones",
              footer:
                '<a href="/dashboard/bedrooms">VER LISTA DE HABITACIONES</a>',
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
  },
};
</script>
<style lang="scss" scoped>
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
#center-td {
  text-align: center;
}
select {
  font-family: fontAwesome !important ;
  font-size: 16px !important;
  color: #788c9e !important;
}
</style>
