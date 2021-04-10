<template>
  <div class="main-left">
    <Header />
    <Contact />
  </div>
</template>
<script>
import Header from "./HeaderleftComponent";
import Contact from "./ContactLeftComponent";
export default {
  components: { Header, Contact },
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