<template>
  <div class="main">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body p-0 d-flex">
            <MainLeft
              :dialogs="dialogs"
              :user="user"
              @selectedContact="selectedContact"
            />
            <MainRight
              :selectedContact="select_contact"
              :messages="messages"
              @close="close"
              @send="send"
            />
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
  props: {
    user: { require: true },
  },
  data() {
    return {
      dialogs: [],
      messages: null,
      select_contact: null,
      today: new Date().toISOString().split("T")[0],
    };
  },
  beforeMount() {
    axios.get("/chat/contact").then((e) => {
      // this.dialogs = _.sortBy(this.dialogs, "name");
      this.dialogs = _.sortBy(e.data, [
        function (o) {
          return o.latest_message.time;
        },
      ]).reverse();
      console.log(typeof e.data);
    });
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
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
  watch: {
    dialogs(dialogs) {
      this.dialogs = dialogs;
    },
    select_contact(select_contact) {
      this.select_contact = select_contact;
    },
  },
};
</script>
<style lang="scss" scoped>
.card-body {
  height: 85vh;
}
</style>