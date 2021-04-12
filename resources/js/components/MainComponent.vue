<template>
  <div class="main">
    <ImagePreview />
    <SendImage />
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body p-0 d-flex">
            <MainLeft />
            <MainRight />
            <!-- <button @click="handleinc">{{ aGet }}</button> -->
            <!-- <button @click="$modal.show('image-preview')">show</button> -->
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
import ImagePreview from "./modals/ImagePreview";
import SendImage from "./modals/sendImage";
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
export default {
  components: { MainLeft, MainRight, ImagePreview, SendImage },
  data() {
    return {
      messages: null,
      select_contact: null,
      today: new Date().toISOString().split("T")[0],
    };
  },
  beforeMount() {
    this.setDialogs();
    this.setUser();
    this.setCred();
  },
  mounted() {},
  computed: {
    ...mapState({
      cn: "count",
    }),
    ...mapGetters({
      done: "doneTodos",
      doneCount: "doneTodosCount",
      doneId: "getTodoById",
      aGet: "a/doubleCount",
      cUser: "user/currentUser",
      gDialogs: "dialogs/getDialogs",
    }),
  },
  methods: {
    ...mapActions({
      inc: "increment",
      setUser: "user/setUser",
      setDialogs: "dialogs/setDialogs",
      setCred: "cred/setCred",
    }),
    ...mapMutations({ minc: "increment", mincA: "a/increment" }),
    handleinc() {
      this.minc();
      this.mincA();
    },
    handleinc2() {
      this.inc();
      console.log("count : ", this.cn);
    },
  },
  watch: {},
};
</script>
<style lang="scss" scoped>
.card-body {
  height: 85vh;
}
</style>