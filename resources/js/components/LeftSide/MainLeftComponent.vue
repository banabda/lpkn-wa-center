<template>
  <div class="main-left">
    <Header />
    <Contact :dialogs="dialogs" />
  </div>
</template>
<script>
import Header from "./HeaderleftComponent";
import Contact from "./ContactLeftComponent";
export default {
  components: { Header, Contact },
  props: {
    dialogs: { require: true },
  },
};
</script>
<style lang="scss" scoped>
.main-left {
  flex: 1.5;
}
</style>