<template>
  <div class="input-right d-flex">
    <textarea
      id="area"
      placeholder="Type something ..."
      v-model="text"
      @keydown.enter.exact.prevent="sendMessage"
    ></textarea>
    <twemoji-picker
      pickerWidth="#area"
      :emojiData="emojiDataAll"
      :emojiGroups="emojiGroups"
      :skinsSelection="false"
      :searchEmojisFeat="true"
      searchEmojiPlaceholder="Search here."
      searchEmojiNotFound="Emojis not found."
      isLoadingLabel="Loading..."
      @emojiUnicodeAdded="emojiUnicodeAdded"
    ></twemoji-picker>
  </div>
</template>
<script>
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
import { TwemojiTextarea } from "@kevinfaguiar/vue-twemoji-picker";
import { TwemojiPicker } from "@kevinfaguiar/vue-twemoji-picker";
import EmojiAllData from "@kevinfaguiar/vue-twemoji-picker/emoji-data/en/emoji-all-groups.json";
import EmojiDataAnimalsNature from "@kevinfaguiar/vue-twemoji-picker/emoji-data/en/emoji-group-animals-nature.json";
import EmojiDataFoodDrink from "@kevinfaguiar/vue-twemoji-picker/emoji-data/en/emoji-group-food-drink.json";
import EmojiGroups from "@kevinfaguiar/vue-twemoji-picker/emoji-data/emoji-groups.json";
export default {
  components: {
    "twemoji-picker": TwemojiPicker,
    "twemoji-textarea": TwemojiTextarea,
  },
  methods: {
    ...mapActions({
      send: "messages/sendMessage",
      get: "messages/setMessages",
    }),
    emojiUnicodeAdded(a) {
      this.text += a;
    },
    sendMessage(e) {
      let data = {
        id: new Date(),
        time: new Date(),
        type: "chat",
        body: this.text,
        from_me: true,
      };
      if (!/^\s+$/.test(this.text) && this.text != "") {
        this.send(data);
        // this.get(this.cUser.id);
        this.text = "";
        this.$refs.taEmoji.cleanText();
      }
    },
  },
  computed: {
    ...mapGetters({ cUser: "dialogs/getSelectedDialogs" }),
    emojiDataAll() {
      return EmojiAllData;
    },
    emojiGroups() {
      return EmojiGroups;
    },
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
  height: 12vh;
  align-items: center;
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