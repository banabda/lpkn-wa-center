<template>
  <div class="card">
    <div class="card-header">User Approval</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
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
              <td>{{ usr.name }}</td>
              <td>{{ usr.email }}</td>
              <td>
                <select
                  style="min-width: 150px"
                  class="form-select"
                  v-model="credByUser[inx]"
                >
                  <option disabled :value="null">Select Credential</option>
                  <option v-for="cred in creds" :key="cred.id" :value="cred.id">
                    {{ cred.name }}
                  </option>
                </select>
              </td>
              <td class="d-flex action-container">
                <button
                  class="btn btn-outline-primary"
                  @click="assign(usr, inx)"
                >
                  Assign
                </button>
                <button
                  @click="active(usr)"
                  class="btn"
                  :class="[
                    usr.active ? 'btn-outline-success' : 'btn-outline-danger',
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
import Swal from "sweetalert2";
export default {
  data: () => ({
    users: null,
    creds: null,
    credByUser: [],
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
      console.log(this.users[index].id, this.credByUser[index]);
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
  },
  beforeMount() {
    axios.get("/assign").then((e) => {
      this.users = e.data.users;
      this.creds = e.data.creds;
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