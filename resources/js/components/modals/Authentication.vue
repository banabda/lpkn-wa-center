<template>
  <div class="px-5 pt-4 pb-4 edit-cred">
    <h3 class="mb-5 text-center">Authentikasi User</h3>

    <div class="mb-3 row form-group">
      <label for="name" class="col-md-3 col-form-label text-md-end">
        Fullname
      </label>
      <div class="col-md-8">
        <input
          id="name"
          type="text"
          class="form-control"
          v-model.trim="name"
          required
        />
        <div class="error" v-if="!$v.name.required">Field is required</div>
      </div>
    </div>

    <div class="mb-3 row form-group">
      <label for="name" class="col-md-3 col-form-label text-md-end">
        Email
      </label>
      <div class="col-md-8">
        <input
          id="email"
          type="text"
          class="form-control"
          v-model.trim="email"
          required
        />
        <div class="error" v-if="!$v.email.required">Field is required</div>
      </div>
    </div>

    <div class="mb-3 row form-group">
      <label for="name" class="col-md-3 col-form-label text-md-end">
        Password
      </label>
      <div class="col-md-8">
        <input
          id="password"
          type="password"
          class="form-control"
          v-model.trim="password"
          required
        />
        <div class="error" v-if="!$v.password.required">Field is required</div>
      </div>
    </div>

    <div class="mb-3 row form-group">
      <label for="name" class="col-md-3 col-form-label text-md-end">
        Confirm Password
      </label>
      <div class="col-md-8">
        <input
          id="confirmpassword"
          type="password"
          class="form-control"
          v-model.trim="confirmpassword"
          required
        />
        <div class="error" v-if="!$v.confirmpassword.required">Field is required</div>
      </div>
    </div>

    <div class="mb-3 row form-group">
      <label for="name" class="col-md-3 col-form-label text-md-end">
        Pilih Role
      </label>
      <div class="col-md-8">
        <select
            class="form-control"
            id="role"
            v-model.trim="role"
            required
        >
            <option disabled :value="null">Pilih Role</option>
            <option v-for="role in roles" :key="role.id" :value="role.name">
            {{ role.name }}
            </option>
        </select>
        <!-- <input
          id="confirmpassword"
          type="password"
          class="form-control"
          v-model.trim="confirmpassword"
          required
        /> -->
        <div class="error" v-if="!$v.confirmpassword.required">Field is required</div>
      </div>
    </div>


    <div class="btn-container mt-5">
      <button
        type="button"
        class="btn btn-outline-primary"
        @click="updateOrCreateCredential"
      >
        Save
      </button>
    </div>
  </div>
</template>
<script>
import Swal from "sweetalert2";
import { required, minLength } from "vuelidate/lib/validators";
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
export default {
  props: {
    cred: { require: true },
    roles: { require: true }
  },
  data: () => ({
    name: "",
    email: "",
    password: "",
    confirmpassword: "",
    act: "add",
    role: ""
  }),
  mounted() {
    if (this.cred) {
      this.name = this.cred.name;
      this.email = this.cred.email;
      this.act = "edit";
    }
  },
  validations: {
    name: {
      required,
    },
    email: {
      required,
    },
    password: {
      required,
    },
    confirmpassword: {
      required,
    },
    role: {
      required,
    },
  },
  methods: {
    ...mapActions({
      updateCreds: "authentication/updateAuthentication",
      addCreds: "authentication/addAuthentication",
    }),
    updateOrCreateCredential() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        // console.log("any error");
      } else if (this.act == "edit") {
        axios
          .put("/assign/update/" + this.cred.id, {
            name: this.name,
            email: this.email,
            password: this.password,
            confirmpassword: this.confirmpassword,
            role: this.role
          })
          .then((e) => {
            this.updateCreds(e.data);
            this.swalToast("success", "Credential Updated");
            this.$modal.hideAll();
            location.reload();


          })
          .catch((err) => {
            this.swalToast("warning", err);
            console.error(err);
          });
      } else if (this.act == "add") {
        axios
          .post("/assign/store", {
            name: this.name,
            email: this.email,
            password: this.password,
            confirmpassword: this.confirmpassword,
            role: this.role
          })
          .then((e) => {
            console.log(e);
            this.addCreds(e.data);
            this.swalToast("success", "Credential Added");
            this.$modal.hideAll();
            location.reload();

          })
          .catch((err) => {
            this.swalToast("warning", err);
            console.error(err);
          });
      }
    },
    swalToast(icon, title) {
      Swal.fire({
        icon: icon,
        title: title,
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
      });
    },
  },
};
</script>
<style lang="scss" scoped>
.error {
  color: red;
}
.edit-cred {
  height: auto;
}
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
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type="number"] {
  -moz-appearance: textfield;
}
</style>
