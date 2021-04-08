<template>
  <div class="contact" v-if="dialogs">
    <div v-for="(dial, index) in dialogs" :key="index">
      <div
        class="d-flex contact-container py-2 px-3 mb-1"
        @click="$emit('selectedContact', dial)"
      >
        <div class="contact-left w-25">
          <avatar :username="dial.name" :src="dial.image" :size="40"></avatar>
        </div>
        <div class="contact-right w-75">
          <div class="name">{{ dial.name }}</div>
          <div class="message" v-if="dial.latest_message.type == 'chat'">
            <span v-if="regex.test(dial.latest_message.body)">
              {{
                dial.latest_message.body.length > 25
                  ? dial.latest_message.body
                      .replaceAll(regex, regexTo)
                      .substr(0, 21) + "..."
                  : dial.latest_message.body.replaceAll(regex, regexTo)
              }}
            </span>
            <span v-else>
              {{
                dial.latest_message.body.length > 25
                  ? dial.latest_message.body.substr(0, 21) + "..."
                  : dial.latest_message.body
              }}
            </span>
          </div>
          <div class="message" v-else-if="dial.latest_message.type == 'image'">
            <i class="bi bi-file-earmark-image"></i> Photo
          </div>
        </div>
        <timeago
          class="small text-right"
          :datetime="dial.latest_message.time"
          :auto-update="60"
        ></timeago>
      </div>
    </div>
  </div>
</template>
<script>
import Avatar from "vue-avatar";
export default {
  components: {
    Avatar,
  },
  props: {
    dialogs: { require: true },
  },
  data() {
    return {
      regex: /\*(.*?)\*/g,
      regexTo: "",
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
.contact {
  max-height: 75vh;
  overflow-y: auto;
  .contact-container {
    align-items: center;
    cursor: pointer;
    &:hover {
      background-color: lightcyan;
    }
  }
  &-right {
    -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
    -khtml-user-select: none; /* Konqueror HTML */
    -moz-user-select: none; /* Old versions of Firefox */
    -ms-user-select: none; /* Internet Explorer/Edge */
    user-select: none; /* Non-prefixed version, currently
                                  supported by Chrome, Edge, Opera and Firefox */
    .name {
      font-weight: bold;
    }
    .message {
      font-weight: 500;
    }
  }
}
</style>