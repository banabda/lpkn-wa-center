<template>
  <div class="input-right">
    <textarea
      placeholder="Type something ..."
      autofocus
      v-model="text"
      @keydown.enter.exact.prevent="send"
    ></textarea>
  </div>
</template>
<script>
export default {
  methods: {
    send() {
      this.$emit("send", this.text);
      this.text = "";
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