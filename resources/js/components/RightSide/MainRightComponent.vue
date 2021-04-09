<template>
  <div class="right-side">
    <div v-if="selectedContact">
      <Header :selectedContact="selectedContact" @close="$emit('close')" />
      <Chat :messages="messages" />
      <InputRight v-if="messages" @send="(text) => $emit('send', text)" />
    </div>
    <div class="no-contact" v-else>Select contact to start chat</div>
  </div>
</template>
<script>
import Header from "./HeaderRightComponent";
import Chat from "./ChatRightComponent";
import InputRight from "./InputRightComponent";
export default {
  components: { Header, Chat, InputRight },
  props: {
    selectedContact: { require: true },
    messages: { require: true },
  },
};
</script>
<style lang="scss" scoped>
.right-side {
  flex: 4;
  .no-contact {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bolder;
    font-size: 2rem;
  }
}
</style>