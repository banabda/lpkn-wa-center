<template>
  <div class="credential">
    <div class="card">
      <div class="card-body">
        {{ creds }}
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    creds: { require: true },
  },
};
</script>