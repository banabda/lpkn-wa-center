<template>
  <div class="header">
    <div class="me d-flex px-4">
      <span class="name">{{ user.name }}</span>

      <i class="bi bi-box-arrow-right"></i>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    user: { require: true },
  },
  data() {
    return {
      arrayOfObjects: [1, 2, 3],
      object: {
        name: "Object Name",
      },
    };
  },
  methods: {
    methodToRunOnSelect(payload) {
      this.object = payload;
    },
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