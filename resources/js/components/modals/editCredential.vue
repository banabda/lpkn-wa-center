<template>
  <modal
    name="edit-credential"
    classes="edit-credential"
    transition="scale"
    height="auto"
  >
    <div class="px-5 pt-4 pb-4">
      <h3 class="mb-5 text-center">Edit Credential</h3>

      <div class="mb-3 row">
        <label for="name" class="col-md-4 col-form-label text-md-end"
          >Name</label
        >
        <div class="col-md-6">
          <input id="name" type="text" class="form-control" />
        </div>
      </div>

      <div class="mb-3 row">
        <label for="ChatId" class="col-md-4 col-form-label text-md-end"
          >ChatId</label
        >
        <div class="col-md-6">
          <input id="ChatId" type="text" class="form-control" disabled />
        </div>
      </div>

      <div class="mb-3 row">
        <label for="Phone" class="col-md-4 col-form-label text-md-end"
          >Phone</label
        >
        <div class="col-md-6">
          <input id="Phone" type="text" class="form-control" />
        </div>
      </div>

      <div class="mb-3 row">
        <label for="Instance" class="col-md-4 col-form-label text-md-end"
          >Instance</label
        >
        <div class="col-md-6">
          <input id="Instance" type="text" class="form-control" />
        </div>
      </div>

      <div class="mb-3 row">
        <label for="Token" class="col-md-4 col-form-label text-md-end"
          >Token</label
        >
        <div class="col-md-6">
          <input id="Token" type="text" class="form-control" />
        </div>
      </div>
      <div class="btn-container mt-5">
        <button type="button" class="btn btn-outline-primary">Save</button>
      </div>
    </div>
    <div
      slot="top-right"
      class="ct-top-right"
      @click="$modal.hide('edit-credential')"
    >
      X
    </div>
  </modal>
</template>
<style lang="scss" scoped>
.btn-container {
  display: flex;
  justify-content: flex-end;
}
.edit-credential {
  background-color: transparent;
  display: flex;
  justify-content: center;
  box-shadow: 0 2px 20px 0 rgba(0, 0, 0, 0.4);
  border: 1px solid rgba(255, 255, 255, 0.65);
}
.edit-credential img {
  max-height: 80vh;
  max-width: 80vw;
}
.ct-top-right {
  cursor: pointer;
  margin: 20px;
  padding: 10px 20px;
  font-weight: 600;
  color: white;
  text-shadow: 0 0px 20px black;
  background: #555;
  border-radius: 100px;
}
.scale-enter-active,
.scale-leave-active {
  transition: all 0.5s;
}
.scale-enter,
.scale-leave-active {
  opacity: 0;
  transform: scale(0.3) translateY(24px);
}
</style>