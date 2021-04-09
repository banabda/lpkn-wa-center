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