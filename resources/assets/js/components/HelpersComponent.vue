

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
     * Get all dat form Data Object
     *
     * @param String $obj
     * @return object
     */
    toFormData(obj) {
      var formData = new FormData();
      for (var key in obj) {
        formData.append(key, obj[key]);
        console.log(key, obj[key]);
      }
      return formData;
    },
    /**
     * Get alert error  view
     *
     * @param String $message
     * @param Bool $allowOutside
     * @param String $titleModal
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
     * @param String $html
     * @param Bool $txt
     * @param String $titleModal
     * @return void
     */
    errorFooter(html, txt, titleModal,allowOutside,) {
     Swal.fire({
          icon: "error",
          title: titleModal,
          text: txt,
          allowOutsideClick: allowOutside,
          footer:html,
        });
    },

     /**
     * Get alert success  view
     *
     * @param String $message
     * @param Bool $allowOutside
     * @param String $titleModal
     * @return void
     */
    success(message, allowOutside, titleModal) {
      Swal.fire({
        icon: "error",
        title: titleModal,
        text: message,
        allowOutsideClick: allowOutside,
        //footer: '<a href="">Why do I have this issue?</a>',
      });
    },
  },
};
</script>
