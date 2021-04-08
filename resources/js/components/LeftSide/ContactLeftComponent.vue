<template>
  <div class="contact">
    <div class="d-flex" v-for="(dial, index) in dialogs" :key="index">
      <div>{{ dial.name }}</div>
      <div v-if="dial.latest_message.type !== 'image'">
        {{ dial.latest_message.body }}
      </div>
      <div v-else>Photo</div>
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