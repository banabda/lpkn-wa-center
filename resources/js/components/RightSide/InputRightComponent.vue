<template>
  <div class="input-right">
    <textarea
      placeholder="Type something ..."
      autofocus
      v-model="text"
      @keydown.enter.exact.prevent="sendMessage"
    ></textarea>
  </div>
</template>
<script>
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
export default {
  methods: {
    ...mapActions({
      send: "messages/sendMessage",
      get: "messages/setMessages",
    }),
    sendMessage() {
      let data = {
        id: new Date().toString(),
        time: new Date().toString(),
        type: "chat",
        body: this.text,
      };
      if (!/^\s+$/.test(this.text) && this.text != "") {
        this.send(data);
        this.get(this.cUser.id);
        this.text = "";
      }
    },
  },
  computed: {
    ...mapGetters({ cUser: "dialogs/getSelectedDialogs" }),
  },
  data() {
    return {
      text: "",
    };
  },
};
</script>
<style lang="scss" scoped>
::-webkit-scrollbar {
  width: 8px;
}
::-webkit-scrollbar-track {
  background: #f1f1f1;
}
::-webkit-scrollbar-thumb {
  background: #888;
}
::-webkit-scrollbar-thumb:hover {
  background: #555;
}
.input-right {
  height: 15vh;
  textarea {
    width: 60vw;
    margin: 10px;
    margin-right: 0;
    resize: none;
    border-radius: 6px;
    border: 1px solid lightgray;
    padding: 10px;
    overflow-y: scroll;
  }
}
</style>