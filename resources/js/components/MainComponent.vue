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
  },
  mounted() {
    // console.log("Component mounted.");
  },
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
    send(text) {
      // console.log(text);
      // {"id":"false_6281311241362@c.us_16E6200DCAEE7C0BB0A37BCD3B2D2F91","user_id":null,"chatId":"6281311241362@c.us","body":"Mohon maaf kuitansi a.n. Sumardi dan Sri Bimo Adhi Yudhono apakah bisa dikirimkan kembali bu? Wa saya hilang semua. Trmksh sebelumnya 🙏🏻","from_me":0,"type":"chat","author":"6281311241362@c.us","caption":null,"sender_name":"Mardi Sumardi","time":"2021-04-08T19:29:47.000000Z","message_number":16153,"created_at":"2021-04-09T02:05:22.000000Z","updated_at":"2021-04-09T02:05:22.000000Z"}
      let data = {
        id: "false_6281311241362@c.us_16E6200DCAEE7C0BB0A37BCD3B2D2F91",
        user_id: null,
        chatId: "6281311241362@c.us",
        body: text,
        from_me: true,
        type: "chat",
        author: "6281311241362@c.us",
        caption: null,
        sender_name: "Mardi Sumardi",
        time: new Date(),
        message_number: 16153,
        created_at: "2021-04-09T02:05:22.000000Z",
        updated_at: "2021-04-09T02:05:22.000000Z",
      };
      for (let asd in this.messages) {
        if (asd == this.today) {
          this.messages[asd].push(data);
        }
      }
    },
    selectedContact(contact) {
      this.select_contact = contact;
      axios.get("/chat/contact/" + contact.id).then((e) => {
        this.messages = e.data;
      });
    },
    close() {
      this.select_contact = null;
      this.messages = null;
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