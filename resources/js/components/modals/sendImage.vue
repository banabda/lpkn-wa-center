<template>
  <modal name="modal-image" height="auto" width="80%">
    <div class="p-5">
      <h1 class="mb-3">Send Images</h1>
      <UploadImages
        class="mb-3"
        @change="handleImages"
        :max="5"
        maxError="Max files exceed"
      />
      <button type="button" class="btn btn-outline-primary" @click="sendImages">
        Send
      </button>
    </div>
    <div
      slot="top-right"
      class="ct-top-right"
      @click="$modal.hide('modal-image')"
    >
      X
    </div>
  </modal>
</template>

<script>
import UploadImages from "vue-upload-drop-images";
import Swal from "sweetalert2";
import axios from "axios";
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
export default {
  components: { UploadImages },
  computed: {
    ...mapGetters({ selectedContact: "dialogs/getSelectedDialogs" }),
  },
  methods: {
    ...mapActions({
      send: "messages/sendMessage",
    }),
    handleImages(files) {
      let _imgsDetails = [];
      let _imgsFiles = [];
      files.forEach((element) => {
        _imgsFiles.push(element);
        _imgsDetails.push({
          name: element.name,
          size: element.size,
          type: element.type,
          lastModified: element.lastModified,
        });
      });
      this.imagesDetails = _imgsDetails;
      this.imagesFiles = _imgsFiles;
    },
    sendImages() {
      //   var _file = event.target.files[0];
      //   var _Ufile = {};
      //   _Ufile.name = _file.name;
      //   _Ufile.size = _file.size;
      //   _Ufile.type = _file.type;
      Swal.fire({
        title: "Sending Images!",
        html: "Please kindly to wait :)",
        didOpen: () => {
          Swal.showLoading();
        },
      });

      this.imagesFiles.forEach((el, id) => {
        const formData = new FormData();
        formData.append("file", el);
        //   formData.append("details", this.imagesDetails);
        console.log("a");
        axios
          .post("/chat/upload", formData, {
            headers: { "Content-Type": "multipart/form-data" },
          })
          .then((e) => {
            console.log("b");
            axios
              .post("/chat-api/message/file", {
                url: e.data.url,
                filename: e.data.name,
                chatId: this.selectedContact.id,
              })
              .then(() => {
                let data = {
                  id: new Date(),
                  time: new Date(),
                  type: "image",
                  body: e.data.url,
                  from_me: true,
                };
                this.send(data);

                if (id == this.imagesFiles.length - 1) {
                  Swal.close();
                  this.$modal.hide("modal-image");
                  Swal.fire({
                    icon: "success",
                    title: "File sended!",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    background: "#FFEDE1",
                  });
                }
              });
          });
      });
    },
  },
  data: () => ({
    imagesDetails: null,
    imagesFiles: null,
  }),
};
</script>
<style lang="scss" scoped>
.ct-top-right {
  cursor: pointer;
  margin: 20px;
  padding: 10px 20px;
  font-weight: 600;
  color: white;
  text-shadow: 0 0px 20px black;
  background: #555;
  border-radius: 100px;
}
</style>