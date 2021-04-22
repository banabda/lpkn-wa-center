<template>
  <div class="qr-code container">
    <div class="card">
      <div class="d-flex qrcode-container">
        <div class="right-side">
          <h3>Scan QR Code for login to Whatsapp:</h3>
          <h4 class="mt-5 mb-4">
            {{ userCred.name }}
          </h4>
          <h4>
            {{ userCred.phone }}
          </h4>
        </div>
        <div class="left-side">
          <img :src="getSrc" v-if="getSrc && showQr" />
          <h2 v-else>
            {{ message }}
          </h2>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
export default {
  computed: {
    ...mapGetters({
      userCred: "cred/getCred",
      getSrc: "qrcode/getSrc",
    }),
  },
  data: () => ({
    showQr: false,
    message: "Getting the QrCode!",
  }),
  methods: {
    ...mapActions({
      setSrc: "qrcode/setSrc",
    }),
  },
  mounted() {
    axios
      .get(this.userCred.instance + "status?token=" + this.userCred.token)
      .then((res) => {
        this.setSrc(res.data.qrCode).then(() => (this.showQr = true));
      });
    Echo.private("status").listen("StatusChange", (e) => {
      if (e.status == "loading") {
        this.message = "Getting the QrCode!";
      } else if (e.status == "got qr code") {
        axios
          .get(this.userCred.instance + "status?token=" + this.userCred.token)
          .then((res) => {
            this.setSrc(res.data.qrCode).then(
              () => ((this.showQr = true), console.log(res.data.qrCode))
            );
          });
      } else {
        this.setSrc(e.status);
      }
    });
  },
};
</script>
<style lang="scss" scoped>
.qrcode-container {
  justify-content: center;
  min-height: 70vh;
  justify-content: space-evenly;
}
.right-side {
  align-self: center;
}
.left-side {
  align-self: center;
}
</style>