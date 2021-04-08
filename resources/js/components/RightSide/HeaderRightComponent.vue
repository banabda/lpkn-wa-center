<template>
  <div class="header">
    <div class="me d-flex px-4">
      <span class="name" v-if="selectedContact">{{
        selectedContact.name
      }}</span>
      <span class="name" v-else>No User</span>

      <i class="bi bi-x" @click="$emit('close')"></i>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    selectedContact: { require: true },
  },
};
</script>
<style lang="scss" scoped>
.header {
  height: 10vh;
  .me {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-weight: bold;
    .name {
      font-size: 1.1rem;
    }
    .bi {
      font-size: 20px;
    }
    .bi:hover {
      cursor: pointer;
    }
  }
}
</style>