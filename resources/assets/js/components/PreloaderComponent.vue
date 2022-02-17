<template>
  <div>
    <span class="load">
      <img src="/images/preloads/preloader_9.gif" />
      <p>Cargando...</p>
    </span>
  </div>
</template>
<script>
export default {
  name: "preloader",
  mounted() {
    console.log("Component mounted preloader.");
  },

};
</script>

<style lang="scss" scoped>
/*preload*/

.load {
  display: block;
  background: rgb(236, 234, 234);
  color: white;
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 10000;
  opacity: 0.75;
  filter: alpha(opacity=75); /* For IE8 and earlier */
  border-radius: 8px;
}
.load p {
  display: block;
  width: 100px;
  height: 30px;
  font-family: "Poppins", sans-serif;
  font-size: 20px;
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  margin: auto;
  padding-top: 100px;
  color: rgb(72, 151, 224);
}
.load img {
  display: block;
  width: 190px;
  height: 190px;
  font-family: "Poppins", sans-serif;
  font-size: 30px;
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  margin: auto;
  border-radius: 50%;
}

/*preload*/
</style>

