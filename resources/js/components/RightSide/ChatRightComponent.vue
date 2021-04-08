<template>
  <div class="chat" ref="chat">
    <div v-if="messages">
      <div
        class="chat-container"
        v-for="(msg, index) in reverseItems"
        :key="index"
      >
        <div class="chat-bubble">
          <div class="type-image" v-if="msg.type == 'image'">
            <img
              class="image-preview rounded mb-3"
              :src="msg.body"
              :alt="msg.type"
            />
            <p
              class="chat-message"
              v-if="regex.test(msg.caption)"
              v-html="msg.caption.replaceAll(regex, regexTo)"
            ></p>
            <p v-else>{{ msg.caption }}</p>
            <p>{{ msg.time }}</p>
          </div>
          <div class="type-chat" v-else-if="msg.type == 'chat'">
            <p
              class="chat-message"
              v-if="regex.test(msg.body)"
              v-html="msg.body.replaceAll(regex, regexTo)"
            ></p>
            <p v-else>{{ msg.body }}</p>
            <p>{{ msg.time }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    messages: { require: true },
  },
  mounted() {},
  data() {
    return {
      regex: /\*(.*?)\*/g,
      regexTo: "<b>$1</b>",
    };
  },
  watch: {
    messages(messages) {
      this.$nextTick(function () {
        const chat = this.$refs.chat;
        chat.scrollTop = chat.scrollHeight;
      });
    },
  },
  computed: {
    reverseItems() {
      return this.messages.slice().reverse();
    },
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
.chat {
  max-height: 75vh;
  overflow-y: auto;
  .chat-bubble {
    background-color: burlywood;
    max-width: 400px;
    margin: 20px 10px;
    padding: 10px;
    .chat-message {
      white-space: pre-line;
    }
    .type-image {
      .image-preview {
        width: 380px;
        height: 380px;
      }
    }
  }
}
</style>