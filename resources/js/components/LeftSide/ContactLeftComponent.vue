<template>
  <div class="contact">
    <div v-for="(dial, index) in dialogs" :key="index">
      <div>{{ dial.name }}</div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    dialogs: { require: true },
  },
};
</script>
<style lang="scss" scoped>
.contact {
  max-height: 70vh;
  overflow-y: auto;
}
</style>