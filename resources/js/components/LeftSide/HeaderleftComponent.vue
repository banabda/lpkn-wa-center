<template>
  <div class="header">
    <div class="me d-flex px-4">
      <span class="name">{{ user.name }}</span>
      <i class="bi bi-three-dots-vertical"></i>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    user: { require: true },
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
    .bi:hover {
      cursor: pointer;
    }
  }
}
</style>