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
      <button type="button" class="btn btn-outline-primary">Send</button>
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
export default {
  components: { UploadImages },
  methods: {
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