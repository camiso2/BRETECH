<template>
  <!--emit importante :: https://programmerclick.com/article/5304926324/-->
  <div>
    <preloader-component v-show="preloader" />

    <div class="x_panel">
      <div class="x_content">
        <br />

        <form method="POST" role="form" enctype="multipart/form-data" @submit.prevent="ProductSubmit">
          <div class="content tab">

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input v-model="nombre" id="nombre" name="nombre" type="text" class="form-control has-feedback-left" placeholder="Ingrese el nombre del producto" required />
              <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input v-model="descripcion" id="descripcion" name="descripcion" type="text" class="form-control has-feedback-left" placeholder="Ingrese descripción del producto" required />
              <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group   has-feedback  ">
              <input v-model="precio" id="precio" name="precio" type="number" class="form-control has-feedback-left" placeholder="Ingrese el costo del producto $" required />
              <span class="fa fa-dollar form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group   has-feedback  ">
              <input v-model="iva" id="iva" name="precivaio" type="number" class="form-control has-feedback-left" placeholder="Ingrese el IVA del producto %" required />
              <span class="fa fa-dollar form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class=" form-group col-md-6 col-sm-6 col-xs-12">
              <div class="input-group">
                <span class="input-group-addon">Seleccione la imagen</span>
                <input type="file" ref="fileupload" accept=".jpg, .jpeg, .png, gif" class="form-control" @change="onImageChanged" name="imagen" />
                <span class="input-group-addon">|</span>
              </div>
              <p class="help-block">
                (.JPG, .PNG .GIF ->se recomienda que la imagen sea
                tomada de forma horizontal, tamaño maximo 10MP)
              </p>
              <hr>
              <button class="btn btn-success btn-block">REGISTRAR PRODUCTO</button>
            </div>
            <div class=" form-group col-md-6 col-sm-6 col-xs-12">
              <img :src="previewImage" class="img-thumbnail mt-2" v-if="fileImage" style="width: 50%" />
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
import Helpers from "./HelpersComponent";
export default {
  name: "registerProduct",
  components: {
    PreloaderComponent,
    Helpers,
  },
  computed: {},
  props: {
    title: String,
    user_id: String,
    authenticate: String,
  },
  data() {
    return {
      nombre: "",
      descripcion: "",
      precio: "",
      iva: "",
      preloader: false,
      fileImage: "",
      previewImage: "",
      fileupload: "",
      helper: Helpers,
    };
  },
  mounted() {
    console.log("Component mounted register product.");
  },
  methods: {
    onImageChanged: function (event) {
      // Preview imagen
      this.fileImage = event.target.files[0];
      this.previewImage = URL.createObjectURL(this.fileImage);
      var fileSize = event.target.files[0].size;
      if (fileSize > 100000000) {
        this.helper.helpers.error(
          "Lo Sentimos La imagen no debe pesar mas de 10MB, por favor introduzca una nueva",
          false,
          "oops"
        );
        this.$refs.fileupload.value = "";
      }
    },
    ProductSubmit() {
      this.preloader = true;
      let data = {
        nombre: this.nombre,
        descripcion: this.descripcion,
        precio: this.precio,
        IVA: this.iva,
        fileImage: this.fileImage,
        authenticate: this.authenticate,
      };
      // convert array a FormData
      var formData = this.helper.helpers.toFormData(data);
      axios
        .post("/api/store", formData, {

        })
        .then((response) => {
          this.preloader = false;
          console.log("correct : ", response.data);
          if (response.data.success) {
            this.helper.helpers.success(
              "El producto se registró con éxito",
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
          this.$refs.fileupload.value = "";
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
</style>
