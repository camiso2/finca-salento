

<script>
const serverSrc = "www.baidu.com";
const token = "12345678";
const hasEnter = false;
const userSite = "Islas Diaoyu de China";
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
        //footer: '<a href="">Why do I have this issue?</a>',
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
