<template>
  <div>
    <div class="x_panel">
      <div class="x_content">
        <br />

        <form method="POST" role="form" action="api/invoicePDF" id="formReceipt" target="_blank">
          <input type="hidden" name="_token" :value="csrf" />
          <input type="hidden" name="user_id" :value="user_id" />
          <input type="hidden" name="authenticate" :value="authenticate" />
          <input type="hidden" name="user_id" :value="user_id" />

          <div class="content tab">

            <div class="col-md-6 col-sm-6 col-xs-12 form-group   has-feedback  ">
              <input v-model="numberInvoice" name="numberInvoice" type="text" class="form-control has-feedback-left" required readonly />
              <span class="	fa fa-file-pdf-o form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input v-model="cliente" name="cliente" type="text" class="form-control has-feedback-left" placeholder="Ingrese el nombre del cliente" required />
              <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group   has-feedback  ">
              <input v-model="telefono" name="telefono" type="number" min="1" pattern="^[0-9]+" maxlength="10" class="form-control has-feedback-left" placeholder="Ingrese teléfono del cliente" required />
              <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group  has-feedback  ">
              <input v-model="email" name="email" type="email" class="form-control has-feedback-left" placeholder="Ingrese email del cliente" required />
              <span class="fa fa-envelope-open-o form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12 form-group   has-feedback  ">
              <hr>

              <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                <label for="">Lista de Productos</label>
                <link rel="stylesheet" />
                <select v-model="selectedProduct" @change="roomSeleted($event)" class="form-control" required="true">
                  <option value="">
                    &#xf0c9; &nbsp;&nbsp;Seleccione Producto
                  </option>
                  <option v-for="product in products" :value="product.SKU" :key="product.id">
                    {{ product.nombre }}
                  </option>
                </select>
              </div>

              <div class="col-md-2 col-sm-2 col-xs-12 form-group   has-feedback  ">
                <label for="">Cantidad</label>
                <input v-model="cantidad" name="cantidad" type="number" min="1" pattern="^[0-9]+" maxlength="10" class="form-control has-feedback-left pd" v-on:keyup="updateValues" placeholder="Cantidad" required />
                <span class="fa fa-plus form-control-feedback left" aria-hidden="true"></span>
              </div>

              <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  ">
                <label for="">Valor Unitario</label>
                <input v-model="valorUnitario" name="valorUnitario" type="number" class="form-control has-feedback-left pd" placeholder="---" required readonly />
                <span class="fa fa-dollar form-control-feedback left" aria-hidden="true"></span>
              </div>

              <div class="col-md-2 col-sm-2 col-xs-12 form-group   has-feedback  ">
                <label for=""> &nbsp;&nbsp; IVA</label>
                <input v-model="iva" name="iva" type="number" class="form-control pdi" placeholder="---" required readonly />

              </div>

              <div class="col-md-2 col-sm-2 col-xs-12 form-group   has-feedback  ">
                <label for="">TOTAL</label>
                <input v-model="valorTotal" name="valorTotal" type="number" class="form-control has-feedback-left pd" placeholder="---" required readonly />
                <span class="fa fa-dollar form-control-feedback left" aria-hidden="true"></span>

              </div>

              <div class="col-md-12 col-sm-12 col-xs-12 form-group   has-feedback  ">
                <hr>
                <button type="button" name="" id="" class="btn btn-primary btn-lg btn-block" v-on:click="AddOrders">AGREGAR A PEDIDO</button>
                <hr>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12 form-group   has-feedback  ">
            <transition name="fade">
              <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <div v-if="showViewInvoice">
                  <table class="table table-bordered responsive-utilities jambo_table">
                    <thead>
                      <tr>
                        <th class="cvt"><i class="fa fa-trash-o"></i></th>
                        <th class="cvex ">Producto</th>
                        <th class="cvc ">Cantidad</th>
                        <th class="cv1">valor Unitario</th>
                        <th class="cv1 ">IVA</th>
                        <th class="cv1 ">Valor Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="order in totalOrders" :key="order.id" :value="order.id">
                        <input type="hidden" :name="'nombre_'+order.id" :value=order.nombre />
                        <input type="hidden" :name="'cantidad_'+order.id" :value=order.cantidad />
                        <input type="hidden" :name="'valorUnitario_'+order.id" :value=order.valorUnitario />
                        <input type="hidden" :name="'iva_'+order.id" :value=order.iva />
                        <input type="hidden" :name="'valorTotal_'+order.id" :value=order.valorTotal />
                        <input type="hidden" name="inputs" :value=order.id />
                        <td class="cvt">
                          <button type="button" v-on:click="deletedOrder(order.id)" class="btn btn-danger btn-xs "> <i class="fa fa-trash-o"></i></button>
                        </td>
                        <td class="">{{ order.nombre}}</td>
                        <td class="">{{ order.cantidad}}</td>
                        <td class="">$ {{ NumberFormatJS(order.valorUnitario.toString())}}</td>
                        <td class="">$ {{ NumberFormatJS(order.iva.toString())}}</td>
                        <td class="">$ {{ NumberFormatJS(order.valorTotal.toString())}}</td>
                      </tr>

                      <tr>
                        <td colspan=5 class="subt"><b> Sub Total</b> </td>
                        <td><b>$ {{NumberFormatJS(granSubtotal.toString())}}</b> </td>
                        <input type="hidden" name="granSubtotal" :value=granSubtotal />
                      </tr>
                      <tr>
                        <td colspan=5 class="subt"> <b>Iva</b> </td>
                        <td> <b>$ {{NumberFormatJS(granIva.toString())}}</b> </td>
                        <input type="hidden" name="granIva" :value=granIva />

                      </tr>
                      <tr>
                        <td colspan=5 class="subt"><b>Gran Total</b></td>
                        <td><b>$ {{NumberFormatJS(granTotal.toString())}}</b></td>
                        <input type="hidden" name="granTotal" :value=granTotal />

                      </tr>
                    </tbody>
                  </table>

                  <button type="button" class="btn btn-warning btn-block btn-lg" @click="generateInvoiceSubmit">
                    <i class="fa fa-calculator fa-esp" aria-hidden="true"></i><b>PAGAR CUENTA DEL CLIENTE</b>
                    <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                  </button>

                </div>

              </div>
            </transition>
          </div>
        </form>
      </div>
    </div>
  </div>

</template>

<script>
import axios from "axios";
import PreloaderComponent from "./PreloaderComponent";
import Helpers from "./HelpersComponent";
export default {
  name: "registerSales",
  components: {
    PreloaderComponent,
    Helpers,
  },
  props: {
    title: String,
    user_id: String,
    authenticate: String,
  },

  mounted() {
    this.gatListProductActive();
    console.log("Component mounted register sales.");
  },
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      numberInvoice: "",
      cliente: "",
      telefono: "",
      email: "",
      selectedProduct: "",
      valorUnitario: "",
      iva: "",
      valorTotal: "",
      cantidad: "",
      preloader: false,
      helper: Helpers,
      products: {},
      selected: "",
      orders: {},
      totalOrders: [],
      showViewInvoice: false,
      granSubtotal: 0,
      granIva: 0,
      granTotal: 0,
      id: 0,
      expression: /\w+@\w+\.+[a-z]/,
    };
  },
  methods: {
    deletedOrder(orderId) {
      this.totalOrders = this.totalOrders.filter(function (order) {
        return order.id !== orderId;
      });
      var iva = 0;
      var subtotal = 0;
      var total = 0;
      for (const indice in this.totalOrders) {
        iva += parseInt(a + this.totalOrders[indice].iva);
        subtotal += parseInt(this.totalOrders[indice].valorTotal);
        total += parseInt(this.totalOrders[indice].valorTotal);
      }

      this.granIva = iva;
      this.granSubtotal = subtotal - iva;
      this.granTotal = total;
      if (this.totalOrders.length < 1) {
        this.showViewInvoice = false;
      }
    },
    uniqueId(prefix) {
      var id = +new Date() + "-" + Math.floor(Math.random() * 1000);
      return prefix ? prefix + id : id;
    },
    NumberFormatJS(value) {
      return this.helper.helpers.NumberFormatJS(value);
    },
    generateInvoiceSubmit() {
      if (
        this.cliente === null || this.cliente === "" ||
        this.telefono === null || this.telefono === "" ||
        this.email === null || this.email === "" || !this.expression.test(this.email)
      ) {
        this.helper.helpers.error(
          "Lo Sentimos Hay un Error, Todos los campos deben ser diligenciados con el formato correcto",
          false,
          "oops"
        );

        return false;
      } else {
        Swal.fire({
          title: "Esta Seguro/a?",
          text: "No Podrá Revertir Esto",
          icon: "info",
          showCancelButton: true,
          confirmButtonColor: "#00a6d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Deseo Generar Factura",
        }).then((result) => {
          if (result.isConfirmed) {
            console.log("enviar");
            this.preloader = true;
            document.getElementById("formReceipt").submit();
            location.reload();
          }
        });
      }
    },
    async gatListProductActive() {
      this.preloader = true;
      let data = {
        authenticate: this.authenticate,
      };

      var formData = this.helper.helpers.toFormData(data);
      await axios
        .post("api/create", formData)
        .then((response) => {
          this.preloader = false;
          this.products = response.data.list;
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
    roomSeleted(event) {
      if (
        event.target.value == "" ||
        event.target.value == undefined ||
        event.target.value == null
      ) {
        Swal.fire({
          icon: "info",
          title: "Oops...",
          text: "Debe Seleccionar un Producto...",
          allowOutsideClick: false,
        });
      } else {
        this.calculate(event.target.value);
      }
    },
    updateValues() {
      this.calculate(this.selected);
    },
    calculate(event) {
      //console.log("hola" + event);
      var request = this.products;
      for (let i = 0; i < request.length; i++) {
        if (request[i].SKU == event) {
          this.valorUnitario = request[i].precio;
          this.valorTotal = parseInt(request[i].precio * this.cantidad);
          this.selected = request[i].SKU;
          this.nombre = request[i].nombre;
          this.iva = parseInt((request[i].IVA / 100) * this.valorTotal);
        }
      }
    },

    AddOrders() {
      if (this.cantidad >= 1) {
        this.orders = {
          id: this.id++,
          nombre: this.nombre,
          cantidad: this.cantidad,
          valorUnitario: this.valorUnitario,
          iva: this.iva,
          valorTotal: this.valorTotal,
        };
        this.totalOrders.push(this.orders);
        var iva = 0;
        var subtotal = 0;
        var total = 0;
        for (const indice in this.totalOrders) {
          iva += parseInt(a + this.totalOrders[indice].iva);
          subtotal += parseInt(this.totalOrders[indice].valorTotal);
          total += parseInt(this.totalOrders[indice].valorTotal);
        }
      }
      this.granIva = iva;
      this.granSubtotal = subtotal - iva;
      this.granTotal = total;
      this.orders = [];
      this.showViewInvoice = true;
      this.numberInvoice = this.uniqueId("No-").toString();
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
  font-family: fontAwesome, Arial, sans-serif !important ;
  font-size: 14px !important;
  color: #788c9e !important;
}

.pd {
  padding-right: 5px !important;
}

.pdi {
  padding-right: 0 !important;
}

input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input[type="number"] {
  -moz-appearance: textfield;
}

.cvc {
  width: 10px;
  text-align: center !important;
  padding-left: 0 !important;
  padding-right: 0 !important;
}
.cv1 {
  width: 70px;
  text-align: center !important;
}
.cv {
  text-align: center !important;
}

.cvex {
  width: 140px;
}
.cvri {
  text-align: right !important;
}
.subt {
  text-align: right;
}
.cvt {
  width: 5px !important;
  padding-left: 0 !important;
  padding-right: 0 !important;
  text-align: center !important;
}
</style>

