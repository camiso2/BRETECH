

<script>
const serverSrc = "https://elrosario-salento.com/";
const token = "null";
const hasEnter = false;
const userSite = "Administración Web Panel";
export default {
  userSite,
  token,
  serverSrc,
  hasEnter,
  helpers: {
    /**
     * Get string invert
     *
     * @param String $text
     * @return string
     */
    reverseText: function (text) {
      return text.split("").reverse().join("");
    },

    /**
     * Get boolean fech value date >= today
     *
     * @param String date
     * @return boolean
     */
    validateMinorCurrent(date) {
      var x = new Date();
      var fetch = date.split("-");
      x.setFullYear(fetch[0], fetch[1] - 1, fetch[2]);
      var today = new Date();
      if (x >= today) return false;
      else return true;
    },

    /**
     * Get boolean fech value timeGetout >= timeEnter
     *
     * @param String timeEnter
     * @param String timeGetout
     * @return boolean
     */
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

    /**
     * Get string number format numbers > 1000
     *
     * @param String value
     * @return string
     */
    NumberFormatJS: function (value) {
      if (parseInt(value) < 1000) {
        return value;
      }
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
    },

    /**
     * Get all dat form Data Object
     *
     * @param String obj
     * @return object
     */
    toFormData(obj) {
      var formData = new FormData();
      for (var key in obj) {
        formData.append(key, obj[key]);
        //console.log(key, obj[key]);
      }
      return formData;
    },
    /**
     * Get alert error  view
     *
     * @param String message
     * @param Bool allowOutside
     * @param String titleModal
     * @return void
     */
    error(message, allowOutside, titleModal) {
      Swal.fire({
        icon: "error",
        title: titleModal,
        text: message,
        allowOutsideClick: allowOutside,
      });
    },

    /**
     * Get alert error witch footer view
     *
     * @param String html
     * @param Bool txt
     * @param String titleModal
     * @return void
     */
    errorFooter(html, txt, titleModal, allowOutside) {
      Swal.fire({
        icon: "error",
        title: titleModal,
        text: txt,
        allowOutsideClick: allowOutside,
        footer: html,
      });
    },

    /**
     * Get alert success view
     *
     * @param String title
     * @param Bool showConfirm
     * @param String time
     * @return void
     */
    success(title, showConfirm, time) {
      Swal.fire({
        icon: "success",
        title: title,
        showConfirmButton: showConfirm,
        timer: time,
      });
    },
  },
};
</script>
