<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body d-flex">
            <MainLeft :dialogs="dialogs" />
            <MainRight />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import MainLeft from "./LeftSide/MainLeftComponent";
import MainRight from "./RightSide/MainRightComponent";
export default {
  components: { MainLeft, MainRight },
  data() {
    return {
      dialogs: [{ name: "bagas" }],
    };
  },
  beforeMount() {
    axios.get("/chat/contact").then((e) => {
      this.dialogs = e.data;
      console.log(typeof e.data);
    });
  },
  mounted() {
    console.log("Component mounted.");
  },
  watch: {
    dialogs(dialogs) {
      this.dialogs = dialogs;
    },
  },
};
</script>
<style lang="scss" scoped>
</style>