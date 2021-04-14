<template>
  <div>
    <Loading
      :active.sync="isLoading"
      :can-cancel="false"
      :is-full-page="true"
    />
    <div class="main" v-if="cUser.status == 'authenticated'">
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
    <div v-else-if="!isLoading">
      <QrCodeComponent />
    </div>
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
import QrCodeComponent from "./QrCodeComponent.vue";
export default {
  components: {
    MainLeft,
    MainRight,
    ImagePreview,
    SendImage,
    Loading,
    QrCodeComponent,
  },
  data() {
    return {
      messages: null,
      select_contact: null,
      status: null,
      today: new Date().toISOString().split("T")[0],
      isLoading: false,
      qrCodeSrc: null,
    };
  },
  beforeMount() {
    this.isLoading = true;
    // this.setDialogs();
    this.setUser();
    this.setCred().then(() => {
      axios
        .get(this.userCred.instance + "status?token=" + this.userCred.token)
        .then((e) => {
          if (e.data.accountStatus == "authenticated") {
            console.log("ok");
            // this.status = e.data.accountStatus;
            this.setUserStatus(e.data.accountStatus);
          } else {
            this.setSrc(e.data.qrCode);
            console.log("not ok");
          }
          this.isLoading = false;
        });
    });
  },
  mounted() {
    console.log("e.data");
    Echo.private("test").listen("TestEvent", (e) => {
      console.log(e.data);
    });
    // Echo.private("chat").listen("NewMessage", (e) => {
    //   console.log(e);
    // });
  },
  computed: {
    ...mapState({
      cn: "count",
    }),
    ...mapGetters({
      // done: "doneTodos",
      // doneCount: "doneTodosCount",
      // doneId: "getTodoById",
      // aGet: "a/doubleCount",
      cUser: "user/currentUser",
      userCred: "cred/getCred",
      gDialogs: "dialogs/getDialogs",
      selectedDialogs: "dialogs/getSelectedDialogs",
    }),
  },
  methods: {
    ...mapActions({
      inc: "increment",
      setSrc: "qrcode/setSrc",
      setUser: "user/setUser",
      setUserStatus: "user/setStatus",
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
  watch: {
    selectedDialogs(selectedDialogs) {
      if (selectedDialogs) {
        console.log("entered");
        this.select_contact = selectedDialogs;
        console.log(this.select_contact.id);
      } else {
        // Echo.leave(`chat.${this.select_contact.id}`);
        this.select_contact = null;
      }
    },
  },
};
</script>
<style lang="scss" scoped>
.card-body {
  height: 85vh;
}
</style>