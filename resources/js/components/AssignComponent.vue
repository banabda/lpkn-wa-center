<template>
  <div class="card rounded-lg border-none shadow-md">
    <div class="card-body">
      <div class="table-responsive">
        <div class="grid">
          <div
            class="btn border-1 border-green-400 text-green-400 hover:text-white hover:bg-green-400"
            @click="showModalCreate(roles)"
          >
            add
          </div>
      </div>
        <table class="table table-striped table-hover table-auto">
          <thead>
            <tr class="text-center">
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Credential</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(usr, inx) in users" :key="inx">
              <th scope="row">{{ inx + 1 }}</th>
              <td>
                <p class="w-40">{{ usr.name }}</p>
              </td>
              <td>
                <p class="w-40">{{ usr.email }}</p>
              </td>
              <td>
                <select
                  v-model="credByUser[inx]"
                  class="form-select"
                  style="width: 15rem"
                >
                  <option disabled :value="null">Select Credential</option>
                  <option v-for="cred in creds" :key="cred.id" :value="cred.id">
                    {{ cred.name }}
                  </option>
                </select>
              </td>
              <td class="d-flex action-container">
                <button
                  class="btn transition duration-300 ease-in-out bg-red_cus-400 text-white hover:bg-red_cus-500 w-20"
                  @click="showModal(usr, roles)"
                >
                  Edit
                </button>
                <button
                  class="btn transition duration-300 ease-in-out bg-orange_cus-400 text-white hover:bg-orange_cus-500 w-20"
                  @click="assign(usr, inx)"
                >
                  Assign
                </button>
                <button
                  @click="active(usr)"
                  class="btn w-20 transition duration-300 ease-in-out"
                  :class="[
                    usr.active
                      ? 'bg-green_cus-300 text-white hover:bg-green_cus-400'
                      : 'bg-pink_cus-default text-white hover:bg-pink_cus-dark',
                    usr.cred ? '' : 'disabled',
                  ]"
                >
                  {{ usr.active ? "Active" : "Inactive" }}
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</template>
<script>
import Credential from "./modals/Authentication";
import Swal from "sweetalert2";
export default {
  components: { Credential },
  data: () => ({
    users: null,
    creds: null,
    credByUser: [],
    roles: null,
  }),
  methods: {
    active(user) {
      axios.get("/assign/active/" + user.id).then(() => {
        const index = _.findIndex(this.users, function (o) {
          return o.id == user.id;
        });
        let icon = "warning";
        let title = "Credential Deactived!";
        this.users[index].active = !user.active;
        if (this.users[index].active) {
          icon = "success";
          title = "Credential Actived!";
        }
        this.swalToast(icon, title);
      });
    },
    assign(user, index) {
      // console.log(this.users[index].id, this.credByUser[index]);
      axios
        .post("/assign", {
          user: this.users[index].id,
          cred: this.credByUser[index],
          active: false,
        })
        .then(() => {
          const index = _.findIndex(this.users, function (o) {
            return o.id == user.id;
          });
          this.users[index].cred = this.credByUser[index];
          this.swalToast("success", "Success assign credential!");
        });
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
    showModal(user, roles) {
      console.log(roles);
      console.log(user);
      this.$modal.show(
        Credential,
        {
          cred: user,
          roles: roles
        },
        { height: "auto", width: "90%" }
      );
    },
    showModalCreate(roles) {
      console.log(roles);
      this.$modal.show(
        Credential,
        {
          roles: roles
        },
        { height: "auto", width: "90%" }
      );
    },
  },
  beforeMount() {
    axios.get("/assign").then((e) => {
      this.users = e.data.users;
      this.creds = e.data.creds;
      this.roles = e.data.roles;
      this.users.forEach((usr) => {
        this.credByUser.push(usr.cred);
      });
    });
  },
};
</script>
<style lang="scss" scoped>
    .action-container {
    justify-content: space-evenly;
    }
</style>
