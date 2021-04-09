<template>
  <div class="chat" ref="chat">
    <div v-if="messages">
      <div
        class="chat-container"
        v-for="(message, index) in messages"
        :key="index"
      >
        <div class="time">
          <span class="small text-center font-weight-bold">
            {{ dateCheck(index) }}
          </span>
        </div>
        <div
          class="chat-list"
          v-for="(msg, ind) in message.slice().reverse()"
          :class="msg.from_me ? 'send' : ''"
          :key="ind"
        >
          <div class="chat-bubble">
            <div class="type-image" v-if="msg.type == 'image'">
              <img
                class="image-preview rounded mb-3"
                :src="msg.body"
                :alt="msg.type"
              />
              <div
                class="chat-message"
                v-if="regex.test(msg.caption)"
                v-html="msg.caption.replaceAll(regex, regexTo)"
              ></div>
              <div v-else class="chat-message">{{ msg.caption }}</div>
              <div class="chat-time">
                {{ new Date(msg.time).toTimeString().substr(0, 5) }}
              </div>
            </div>
            <div class="type-chat" v-else-if="msg.type == 'chat'">
              <div
                class="chat-message"
                v-if="regex.test(msg.body)"
                v-html="msg.body.replaceAll(regex, regexTo)"
              ></div>
              <div v-else class="chat-message">{{ msg.body }}</div>
              <div class="chat-time">
                {{ new Date(msg.time).toTimeString().substr(0, 5) }}
              </div>
            </div>
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
  methods: {
    dateCheck(date) {
      if (new Date(date).toDateString() == new Date().toDateString()) {
        return "today";
      } else if (
        new Date(date).toDateString() == this.tomorrowGen(new Date())
      ) {
        return "yesterday";
      } else {
        return new Date(date).toDateString().substr(0, 10);
      }
    },
    tomorrowGen(date) {
      var currentDate = new Date(date);
      currentDate.setDate(currentDate.getDate() - 1);
      return currentDate.toDateString();
    },
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
  padding-top: 10px;
  .chat-list {
    &.send {
      text-align: end;
      .chat-bubble {
        background-color: lightcoral;
        text-align: left;
      }
    }
  }
  .time {
    text-align: center;
    margin: 20px 0;
    span {
      padding: 8px;
      background-color: lightskyblue;
      border-radius: 10px;
    }
  }
  .chat-time {
    text-align: right;
    font-size: 0.6rem;
    margin-bottom: 0;
  }
  .chat-bubble {
    background-color: burlywood;
    border-radius: 8px;
    max-width: 500px;
    min-width: 100px;
    display: inline-block;
    margin: 2px 10px;
    padding: 5px;
    .chat-message {
      white-space: pre-line;
      padding: 0 5px;
      margin-bottom: 0;
    }
    .type-image {
      .image-preview {
        width: 390px;
        height: 390px;
      }
    }
  }
}
</style>