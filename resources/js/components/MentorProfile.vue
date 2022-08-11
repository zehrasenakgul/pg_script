<template>
  <section class="mentor-profile">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="tab-content" id="pills-tabContent">
            <!-- general info -->
            <div
              class="tab-pane fade show active"
              id="pills-general"
              role="tabpanel"
              aria-labelledby="pills-general-tab"
            >
              <div class="row">
                <div class="col-md-3 border-end-c">
                  <div class="info">
                    <span class="text-primary fw-bold mt-5 mt-md-0"
                      >
                            {{$t('mentor.profile.general.welcome')}}
                      </span
                    >
                    <h4 class="text-primary fw-bold mb-4">
                      {{ profile.first_name }} {{ profile.last_name }}
                    </h4>
                  </div>
                  <div class="profile-img-shape">
                    <div class="shape"></div>

                    <div

                      class="
                        file-upload-div
                        d-flex
                        justify-content-center
                        align-items-center
                        position-relative
                        flex-column
                      "
                    ><i class="fas fa-trash text-danger"  v-if="profile.image_view" @click="removeImage"></i>
                    <img
                      v-if="profile.image_view"
                        :src="profile.image_view"
                        width="100px"
                        height="82px"
                        alt=""
                        @click="previewImage"
                        class="img-fluid"
                      />
                      <img
                      v-else
                        src="/assets/images/mentor-profile-img.png"
                        alt=""
                        class="img-fluid"
                      />
                      <div class="upload-btn-wrapper mt-3">
                        <button
                          class="
                            btn btn-upload
                            d-flex
                            justify-content-center
                            border-0
                            bg-transparent
                          "
                        >
                          <!-- Upload File -->
                            {{$t('mentor.profile.general.upload_file')}}

                        </button>
                        <input
                          type="file"
                          id="picture"
                          ref="picture"
                          @change="processFile($event)"
                          name="picture"
                        />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-9">
                  <form
                    action=""
                    class="px-md-4 mt-md-0 mt-5"
                    @submit="submitProfileInfo"
                  >
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                          <toggle-button
                            v-model="profile.online_status"
                            @change="onStatusChangeEventHandler"
                            :color="{
                              checked: '#73bd49',
                              unchecked: '#6c757d',
                            }"
                          />
                          <label
                            class="form-check-label ms-2"
                            for="flexSwitchCheckDefault"
                            >
                            {{$t('mentor.profile.general.status')}}
                            </label
                          >
                        </div>
                      <div class="col-md-6">
                        <label for="" class="text-primary mb-2">
                            {{$t('mentor.profile.general.place_holder.first_name')}}
                          </label
                        >
                        <input
                          type="text"
                          placeholder="Enter your first name"
                          class="form-control border"
                          v-model="profile.first_name"
                        />
                      </div>
                      <div class="col-md-6">
                        <label for="" class="text-primary mb-2 mt-md-0 mt-4">
                            {{$t('mentor.profile.general.place_holder.last_name')}}

                          </label
                        >
                        <input
                          type="text"
                          placeholder="Enter your last name"
                          class="form-control border"
                          v-model="profile.last_name"
                        />
                      </div>
                      <div class="col-md-6">
                        <label for="" class="text-primary mb-2 mt-4">
                            {{$t('mentor.profile.general.place_holder.father_name')}}
                          </label
                        >
                        <input
                          type="text"
                          placeholder="Enter your Father name"
                          class="form-control border"
                          v-model="profile.f_name"
                        />
                      </div>
                    </div>

                    <div class="d-flex justify-content-end mt-5">
                      <button
                        class="btn btn-secondary px-4 text-white"
                        type="submit"
                      >
                        <!-- Continue -->
                  {{ $t("mentor.profile.general.btn_continue") }}
                        <i class="fa-solid fa-angles-right ms-1"></i>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import loginMixin from "../mixins/loginMixin.js";
import VueGoogleAutocomplete from "vue-google-autocomplete";
export default {
  props: ["url"],
  mixins: [loginMixin],
  components: { VueGoogleAutocomplete },

  data() {
    return {
      loading: true,

      profile: {
        first_name: "",
        last_name: "",
        f_name: "",
        picture: {},
        image_view: "",
        image_path: "",
        token: 123,
        online_status: true,
        go_live_status: false,
        image_loading:false,
      },
      minDatetime:new Date().toLocaleDateString("en-US", {
    "year": "numeric",
    "month": "numeric"
})
    };
  },
  methods: {

    deleteExperienceImage(){
      this.experience.image_view='';
    },
    previewExperienceImage(){
      window.open(this.experience.image_view, '_blank').focus();
    },
      previewEducationImage(){
          window.open(this.education.image_view, '_blank').focus();
      },
      removeEducationImage(){
          this.education.image_view='';
      },
      previewImage(){
         window.open(this.profile.image_view, '_blank').focus();
      },
      removeImage(){
          this.profile.image_view='';
      },
      async onStatusChangeEventHandler() {
      var self = this;
      var toast = this.$toasted;
      if (this.profile.online_status) {
        localStorage.setItem("show_online", 1);
        var params = {
          token: 123,
          status: "online",
          user_id: this.User.user_id,
        };
      } else {
        localStorage.removeItem("show_online");
        var params = {
          token: 123,
          status: "offline",
          user_id: this.User.user_id,
        };
      }
      const res = await axios
        .post("/api/changeOnlineStatus", params)
        .then((res) => {
          if (res.data.Status) {
            toast.success(res.data.msg);
          }
          if (!res.data.Status) {
            toast.error(res.data.msg);
          }
        });
    },
      continueDashboard(){
        window.location.href = "/dashboard";
      },
      async updateProfileCompleteStatus() {
      var params = {
        token: 123,
        mentor_id: this.User.user_id,
      };
      const res = await axios
        .post("/api/mentorProfile", params)
        .then((res) => {});
      if (this.is_profile_completed == 0) {
        window.location.href = "/dashboard";
      }
    },

    clearImage() {
      this.profile.image_view = "";
    },


    async fatchUserData() {
      const params = {
        token: 123,
        user_id: this.User.user_id,
      };
      const res = await axios.get("/api/getUserById", {
        params,
      });

      if (res.data && res.data.Status) {
        this.profile.first_name = res.data.data.userDetail.first_name
          ? res.data.data.userDetail.first_name
          : "";
        this.profile.last_name = res.data.data.userDetail.last_name
          ? res.data.data.userDetail.last_name
          : "";
        this.profile.f_name = res.data.data.userDetail.father_name
          ? res.data.data.userDetail.father_name
          : "";
        this.is_profile_completed =
          res.data.data.userDetail.mentor.is_profile_completed;
        if (res.data.data.userDetail.online_status == "online") {
          this.profile.online_status = true;
        }
        if (res.data.data.userDetail.online_status == "offline") {
          this.profile.online_status = false;
        }
        if (res.data.data.userDetail.mentor.is_live == 1) {
          this.profile.go_live_status = true;
        } else {
          this.profile.go_live_status = false;
        }
        // if (res.data.data.userDetail.schedule.fee) {
        //   this.go_live_fee = res.data.data.userDetail.schedule.fee ? res.data.data.userDetail.schedule.fee : '';
        // }
        this.loading = false;
      }
    },
    async submitProfileInfo(e) {
      var self = this;
      var toast = this.$toasted;
      e.preventDefault();
      const headers = {
        "Content-Type": "multipart/form-data",
      };

      let formData = new FormData();
      formData.append("picture", this.profile.picture);
      formData.append("token", this.profile.token);
      formData.append("mentor_id", this.User.user_id);
      formData.append("first_name", this.profile.first_name);
      formData.append("last_name", this.profile.last_name);
      //   formData.append("email", this.profile.email);
      formData.append("father_name", this.profile.f_name);

      //   console.log(formData);
      const res = await axios
        .post("/api/updateMentorProfile", formData, {
          headers: headers,
        })
        .then((res) => {
          if (res.data.Status) {
            toast.success(res.data.msg);
          }
          if (!res.data.Status) {
            for (const property in res.data.errors) {
              this.$toasted.error(res.data.errors[property][0]);
            }
          }
        });
    },
  },
  created() {
    this.checkLoggedIn();
    this.mentor_id = this.User.user_id;
    // console.log(this.mentor_id);

    const dateFormatter = Intl.DateTimeFormat('sv-SE');

// Use the formatter to format the date
   this.minDatetime=dateFormatter.format(new Date());
   console.log(this.minDatetime);

  },
  mounted() {
    if (this.is_loggedIn && this.User.role == "Mentor") {
    } else {
      window.location.href = this.url + "/login";
      this.$toasted.error("Please Login First");
    }
    this.fatchUserData(); 

  },
};
</script>



