<template>
  <div>
    <Loading
      :active.sync="isLoading"
      :can-cancel="false"
      :is-full-page="true"
    />
    <div class="main" v-if="status">
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
    <div v-else-if="!isLoading">qrcode</div>
  </div>
</template>

<script>
import axios from "axios";
import MainLeft from "./LeftSide/MainLeftComponent";
import MainRight from "./RightSide/MainRightComponent";
import ImagePreview from "./modals/ImagePreview";
import SendImage from "./modals/sendImage";
import Loading from "vue-loading-overlay";
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
import "vue-loading-overlay/dist/vue-loading.css";
export default {
  components: { MainLeft, MainRight, ImagePreview, SendImage, Loading },
  data() {
    return {
      messages: null,
      select_contact: null,
      status: false,
      today: new Date().toISOString().split("T")[0],
      isLoading: false,
    };
  },
  beforeMount() {
    this.isLoading = true;
    this.setDialogs();
    this.setUser();
    this.setCred().then(() => {
      axios
        .get(this.userCred.instance + "status?token=" + this.userCred.token)
        .then((e) => {
          if (e.data.accountStatus == "authenticated") {
            console.log("ok");
            this.status = true;
          } else {
            console.log("not ok");
          }
          this.isLoading = false;
        });
    });
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
      userCred: "cred/getCred",
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