<template>
  <div class="contact" v-if="dialogs">
    <div class="d-flex" v-for="(dial, index) in dialogs" :key="index">
      <avatar username="Jane Doe" :src="dial.image" :size="40"></avatar>
      <div>{{ dial.name }}</div>
      <div v-if="dial.latest_message.type != 'image'">
        {{ dial.latest_message.body }}
      </div>
      <div v-else>Photo</div>
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
};
</script>
<style lang="scss" scoped>
.contact {
  max-height: 70vh;
  overflow-y: auto;
}
</style>