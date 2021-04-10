<template>
  <div class="contact" v-if="dialogs">
    <div v-for="(dial, index) in dialogs" :key="index">
      <div
        class="d-flex contact-container py-2 px-3 mb-1"
        @click="selectedUser(dial)"
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
        <div class="time">
          <span
            class="small text-right"
            v-if="
              new Date(dial.latest_message.time).toDateString() ==
              new Date().toDateString()
            "
            >{{
              new Date(dial.latest_message.time).toTimeString().substr(0, 5)
            }}</span
          >
          <span
            class="small text-right"
            v-else-if="
              new Date(dial.latest_message.time).toDateString() ==
              tomorrowGen(new Date())
            "
            >yesterday</span
          >
          <span v-else>
            <timeago
              class="small text-right to-right"
              :datetime="dial.latest_message.time"
              :auto-update="60"
            ></timeago>
          </span>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Avatar from "vue-avatar";
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
export default {
  components: {
    Avatar,
  },
  computed: {
    ...mapGetters({
      dialogs: "dialogs/getDialogs",
      selected: "dialogs/getSelectedDialogs",
    }),
  },
  mounted() {},
  methods: {
    tomorrowGen(date) {
      var currentDate = new Date(date);
      currentDate.setDate(currentDate.getDate() - 1);
      return currentDate.toDateString();
    },
    ...mapActions({
      selectedUser: "dialogs/setSelectedDialog",
    }),
  },
  data() {
    return {
      tomorrow: null,
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
  .time {
    text-align: right !important;
  }
  .contact-container {
    align-items: center;
    cursor: pointer;
    &:hover {
      background-color: lightcyan;
    }
  }
  &-right {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    .name {
      font-weight: bold;
    }
    .message {
      font-weight: 500;
    }
  }
}
</style>