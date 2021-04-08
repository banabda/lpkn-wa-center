<template>
  <div class="chat">
    <div v-if="messages">
      <div class="chat-container" v-for="(msg, index) in messages" :key="index">
        <p>{{ msg.body }}</p>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    messages: { require: true },
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
}
</style>