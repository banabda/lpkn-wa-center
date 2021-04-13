<template>
  <div class="qr-code container" v-if="getSrc">
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
        <img :src="getSrc" />
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
};
</script>
<style lang="scss" scoped>
.qrcode-container {
  justify-content: center;
}
.right-side {
  align-self: center;
}
</style>