<template>
  <div class="main-left">
    <Header :user="user" />
    <Contact :dialogs="dialogs" @selectedContact="selectedContact" />
  </div>
</template>
<script>
import Header from "./HeaderleftComponent";
import Contact from "./ContactLeftComponent";
export default {
  components: { Header, Contact },
  props: {
    dialogs: { require: true },
    user: { require: true },
  },
  methods: {
    selectedContact(contact) {
      this.$emit("selectedContact", contact);
    },
  },
};
</script>
<style lang="scss" scoped>
.main-left {
  flex: 1.5;
}
</style>