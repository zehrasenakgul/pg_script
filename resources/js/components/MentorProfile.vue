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
                            Company Name
                          </label
                        >
                        <input
                          type="text"
                          placeholder="Enter your Company name"
                          class="form-control border"
                          v-model="profile.f_name"
                        />
                      </div>
                    </div>
                    <div class="d-flex justify-content-end mt-5">                      
                      <button class="btn btn-secondary px-4 text-white"
                      @click="continueDashboard"
                      type="button">
                        <!-- Finish -->
                        {{ $t("mentor.profile.general.btn_finish") }}

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
        email: "",
        address: "",
        f_name: "",
        cnic: "",
        gender: "",
        religion: "",
        dob: "",
        occupation: "",
        country: "",
        city: "",
        picture: {},
        image_view: "",
        image_path: "",
        token: 123,
        online_status: true,
        go_live_status: false,
        image_loading:false,
        about:'',
      },
      countries: {},
      cities: {},
      occupations: {},
      education: {
        degree: "",
        institute: "",
        subject: "",
        period: "",
        image: {},
        token: 123,
        image_view: "",
      },
      experience: {
        company_name: "",
        date_from: "",
        date_to: "",
        experience_image: {},
        image_view: "",
        token: 123,
      },
      allExperiences: [],
      degrees: {},
      allEducations: [],
      allCategories: [],
      categoriesLoading: false,
      skills: {
        categories: "",
      },
      allBanks: {},
      bank: {
        name: "",
        account_title: "",
        account_number: "",
        id: "",
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
      backSkillTab(){
          document.getElementById('pills-skills-tab').click();
      },
      continueExperienceTab(){
          document.getElementById('pills-experience-tab').click();
      },
      continueDashboard(){
        window.location.href = "/dashboard";
      },
      backEducationTab(){
          document.getElementById('pills-educational-tab').click();
      },
      continueBankTab(){
          document.getElementById('pills-acc-tab').click();
      },
      ContinueSkillTab(){
          document.getElementById('pills-skills-tab').click();
      },
      BackGeneralTab(){
          document.getElementById('pills-general-tab').click();

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
    async addBankDetail() {
      var self = this;
      var toast = this.$toasted;
      if (this.bank.id) {
        var formData = {
          token: 123,
          mentor_id: this.User.user_id,
          bank: this.bank.name,
          account_title: this.bank.account_title,
          account_number: this.bank.account_number,

          id: this.bank.id,
        };
        const res = await axios
          .post("/api/mentor_card_update", formData)
          .then((res) => {
            if (res.data.Status) {
              toast.success(res.data.msg);
              self.updateProfileCompleteStatus();
            }
            if (!res.data.Status) {
              toast.error("Please Fill all Fields...");
            }
          });
      } else {
        var formData = {
          token: 123,
          mentor_id: this.User.user_id,
          account_title: this.bank.account_title,
          account_number: this.bank.account_number,
          bank: this.bank.name,
        };
        const res = await axios
          .post("/api/mentor_card", formData)
          .then((res) => {
            if (res.data.Status) {
              toast.success(res.data.msg);
              this.bank.id = res.data.data.card.id;
              self.updateProfileCompleteStatus();
            }
            if (!res.data.Status) {
              toast.error("Please Fill all Fields...");
            }
          });
      }
    },
    async fetchBankTabData() {
      const result = await axios.get("/api/bankslist", {
        params: { token: 123 },
      });
      if (result.data && result.data.Status) {
        this.allBanks = result.data.data.banks;
      }
      const params = {
        token: 123,
        mentor_id: this.User.user_id,
      };
      const res = await axios.get("/api/mentor_card_show", { params });
      console.log(res.data.data,res.data.Status);
      if (res.data && res.data.Status) {
        if(res.data.data.card){
          this.bank.name = res.data.data.card.bank;
          this.bank.account_title = res.data.data.card.account_title;
          this.bank.account_number = res.data.data.card.account_number;
          this.bank.id = res.data.data.card.id;
        }

      }
    },
    async fetchSubcategories(event, index) {
      this.categoriesLoading = true;
      var parent_id = event.target.value;
      const params = {
        token: 123,
        parent_id: parent_id,
      };
      const res = await axios.get("/api/mentorChildCategoriesList", { params });
      if (res.data && res.data.Status) {
        this.mentorSubCategory = res.data.data.mentorCategories;
        let tempCatArray = [];
        let tempSelectedCatArray = [];
        for (let i = 0; i <= index; i++) {
          tempCatArray.push(this.allCategories[i]);
          tempSelectedCatArray.push(this.selectedCategories[i]);
        }
        this.allCategories = tempCatArray;
        this.selectedCategories = tempSelectedCatArray;
        if (this.mentorSubCategory.length > 0) {
          var obj = {
            id: index++,
            items: this.mentorSubCategory,
          };
          this.allCategories.push(obj);
          this.selectedCategories.push(index);
        }
        this.categoriesLoading = false;
      }
    },
    async fetchAllSkills() {
      const params = {
        token: 123,
        mentor_id: this.User.user_id,
      };
      const res = await axios.get("/api/mentorSkillSelected", { params });
      if (res.data && res.data.Status) {
        this.skills.categories = res.data.data.category;
      }
    },

    async addSkill() {
      var self = this;
      var toast = this.$toasted;
      var formData = {
        token: 123,
        mentor_id: this.User.user_id,
        categories: this.selectedCategories,
      };
      const res = await axios.post("/api/mentorSkill", formData).then((res) => {
        if (res.data.Status) {
          toast.success(res.data.msg);
          //   document.getElementById("nav-accountinfo-tab").click();
          self.fetchAllSkills();
        }
        if (!res.data.Status) {
          toast.error("Please Fill all Fields...");
        }
      });
    },
    async fetchSkillsTabData() {
      this.allCategories = [];
      this.selectedCategories = [];
      const params = {
        token: 123,
      };
      const res = await axios.get("/api/mentorCategoriesList", { params });
      if (res.data && res.data.Status) {
        this.mentorCategories = res.data.data.mentorCategories;

        var obj = {
          id: 0,
          items: this.mentorCategories,
        };
        this.allCategories.push(obj);
        this.fetchAllSkills();
      }
    },
    async fetchAllExperiences() {
      const params = {
        token: 123,
        mentor_id: this.User.user_id,
      };
      const res = await axios.get("/api/mentorExperienceList", { params });
      if (res.data && res.data.Status) {
        this.allExperiences = res.data.data.experiences;
      }
    },
    accTab() {
      $("#pills-educational-tab").addClass("active");
      $("#pills-experience-tab").addClass("active");
      $("#pills-general-tab").addClass("active");
      $("#pills-skills-tab").addClass("active");
      $("#pills-experience-tab").addClass("active");
      $("#pills-acc-tab").addClass("active");
      $("#pills-acc").addClass("show");
      $("#pills-acc").addClass("active");
      $("#pills-schedule-tab").removeClass("active");
      $("#pills-schedule").removeClass("show");
      $("#pills-schedule").removeClass("active");

      this.fetchBankTabData();
    },
    skillsTab() {
      $("#pills-educational-tab").addClass("active");
      $("#pills-general-tab").addClass("active");
      $("#pills-experience-tab").addClass("active");
      $("#pills-skills-tab").addClass("active");
      $("#pills-skills").addClass("show");
      $("#pills-skills").addClass("active");
    $("#pills-experience-tab").addClass("active");
      $("#pills-schedule-tab").removeClass("active");
      $("#pills-schedule").removeClass("show");
      $("#pills-schedule").removeClass("active");
       $("#pills-acc-tab").removeClass("active");
      $("#pills-acc").removeClass("show");
      $("#pills-acc").removeClass("active");
      this.fetchSkillsTabData();
    },


    async fetchDegrees() {
      const params = {
        token: 123,
      };
      const res = await axios.get("/api/degreeList", {
        params,
      });
      if (res.data && res.data.Status) {
        this.degrees = res.data.data.mentorDegrees;
      }
    },
    async fetchAllEducations() {
      const params = {
        token: 123,
        mentor_id: this.User.user_id,
      };
      const res = await axios.get("/api/mentorEducationList", { params });
      if (res.data && res.data.Status) {
        this.allEducations = res.data.data.educations;
      }
    },
    educationalTab() {
      $("#pills-general-tab").addClass("active");
      $("#pills-educational").addClass("show");
      $("#pills-educational").addClass("active");
      $("#pills-experience-tab").removeClass("active");
      $("#pills-experience").removeClass("active");
      $("#pills-experience").removeClass("show");
      $("#pills-schedule-tab").removeClass("active");
      $("#pills-schedule").removeClass("show");
      $("#pills-schedule").removeClass("active");
       $("#pills-acc-tab").removeClass("active");
      $("#pills-acc").removeClass("show");
      $("#pills-acc").removeClass("active");
       $("#pills-skills-tab").removeClass("active");
      $("#pills-skills").removeClass("show");
      $("#pills-skills").removeClass("active");
      $("#pills-educational").addClass("active");
      $("#pills-educational").addClass("show");
       $('#pills-acc').removeClass('active');
      $('#pills-acc').removeClass('show');
      $('#pills-acc-tab').removeClass('active');
      $("#pills-skills-tab").removeClass("active");
      $("#pills-skills").removeClass("show");
      $("#pills-skills").removeClass("active");
      this.fetchDegrees();
      this.fetchAllEducations();
      this.fetchAllExperiences();
    },
    experienceTab() {
      $("#pills-general-tab").addClass("active");
      $("#pills-educational-tab").addClass("active");
      $("#pills-experience-tab").addClass("active");
      $("#pills-experience").addClass("active");
      $("#pills-experience").addClass("show");
      $("#pills-schedule-tab").removeClass("active");
      $("#pills-schedule").removeClass("show");
      $("#pills-schedule").removeClass("active");
       $("#pills-acc-tab").removeClass("active");
      $("#pills-acc").removeClass("show");
      $("#pills-acc").removeClass("active");
       $("#pills-skills-tab").removeClass("active");
      $("#pills-skills").removeClass("show");
      $("#pills-skills").removeClass("active");
      $("#pills-educational").removeClass("active");
      $("#pills-educational").removeClass("show");
       $('#pills-acc').removeClass('active');
      $('#pills-acc').removeClass('show');
      $('#pills-acc-tab').removeClass('active');
      $("#pills-skills-tab").removeClass("active");
      $("#pills-skills").removeClass("show");
      $("#pills-skills").removeClass("active");
    //   this.fetchDegrees();
    //   this.fetchAllEducations();
      this.fetchAllExperiences();
    },
    generalTab() {
      $("#pills-general").addClass("active");
      $("#pills-general").addClass("show");
      $("#pills-experience-tab").removeClass("active");
      $("#pills-experience").removeClass("active");
      $('#pills-acc').removeClass('active');
      $('#pills-acc').removeClass('show');
      $('#pills-acc-tab').removeClass('active');

      $("#pills-schedule-tab").removeClass("active");
      $("#pills-schedule").removeClass("show");
      $("#pills-schedule").removeClass("active");

      $("#pills-educational-tab").removeClass("active");
      $("#pills-educational").removeClass("show");
      $("#pills-educational").removeClass("active");

       $("#pills-experience-tab").removeClass("active");
      $("#pills-experience").removeClass("show");
      $("#pills-experience").removeClass("active");

      $("#pills-skills-tab").removeClass("active");
      $("#pills-skills").removeClass("show");
      $("#pills-skills").removeClass("active");
    },
    clearImage() {
      this.profile.image_view = "";
    },
    processFile(event) {

      this.profile.picture = event.target.files[0];
      this.profile.image_view = URL.createObjectURL(event.target.files[0]);

    },
    processEducationFile(event) {
      this.education.image = event.target.files[0];
      this.education.image_view = URL.createObjectURL(event.target.files[0]);
    },
    async submitEducationForm(e) {
      var self = this;
      var toast = this.$toasted;
      e.preventDefault();
      const headers = {
        "Content-Type": "multipart/form-data",
      };

      let formData = new FormData();
      formData.append("image", this.education.image);
      formData.append("token", this.education.token);
      formData.append("mentor_id", this.User.user_id);
      formData.append("institute", this.education.institute);
      formData.append("degree", this.education.degree);
      formData.append("subject", this.education.subject);
      formData.append("period", this.education.period);
      const res = await axios
        .post("/api/mentorEducation", formData, {
          headers: headers,
        })
        .then((res) => {
          if (res.data.Status) {
            toast.success(res.data.msg);
            self.allEducations.push(res.data.data.education);
            self.education.degree = "";
            self.education.institute = "";
            self.education.subject = "";
            self.education.period = "";
            self.education.image_view = "";
            $("#image_education").val("");
          }
          if (!res.data.Status) {
            toast.error("Please Fill all Fields...");
          }
        });
    },
    async deleteMentorEducation(id,index) {
      var self = this;
      var toast = this.$toasted;
      var params = {
        token: 123,
        id: id,
      };
      const res = await axios
        .post("/api/mentorEducationDelete", params)
        .then((res) => {
          if (res.data.Status) {
            toast.success(res.data.msg);
            this.fetchAllEducations();
            // this.allEducations.splice(this.allEducations.indexOf(index), 1);
          }
        });
    },

    async deleteMentorExperiences(id,index) {
      var self = this;
      var toast = this.$toasted;
      var params = {
        token: 123,
        id: id,
      };
      const res = await axios
        .post("/api/mentorExperienceDelete", params)
        .then((res) => {
          if (res.data.Status) {
            toast.success(res.data.msg);
            this.allExperiences.splice(this.allExperiences.indexOf(id), index);
          }
        });
    },

    processExperienceFile(event) {
      this.experience.experience_image = event.target.files[0];
      this.experience.image_view = URL.createObjectURL(event.target.files[0]);
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
        this.profile.email = res.data.data.userDetail.email
          ? res.data.data.userDetail.email
          : "";
        this.profile.address = res.data.data.userDetail.address
          ? res.data.data.userDetail.address
          : "";
        this.profile.f_name = res.data.data.userDetail.father_name
          ? res.data.data.userDetail.father_name
          : "";
        this.profile.cnic = res.data.data.userDetail.cnic
          ? res.data.data.userDetail.cnic
          : "";
        this.profile.gender = res.data.data.userDetail.gender
          ? res.data.data.userDetail.gender
          : "";
        this.profile.religion = res.data.data.userDetail.religion
          ? res.data.data.userDetail.religion
          : "";
        this.profile.dob = res.data.data.userDetail.dob
          ? res.data.data.userDetail.dob
          : "";
        this.profile.occupation = res.data.data.userDetail.occupation
          ? res.data.data.userDetail.occupation
          : "";
        this.profile.country = res.data.data.userDetail.country
          ? res.data.data.userDetail.country
          : "";
        this.profile.city = res.data.data.userDetail.city
          ? res.data.data.userDetail.city
          : "";
        this.profile.image_path = res.data.data.userDetail.image_path
          ? res.data.data.userDetail.image_path
          : "";
          this.profile.about = res.data.data.userDetail.about
          ? res.data.data.userDetail.about
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
    async fetchCountries() {
      const params = {
        token: 123,
      };
      const res = await axios.get("/api/countries", {
        params,
      });
      if (res.data && res.data.Status) {
        this.countries = res.data.data.countries;
      }
      if (this.profile.country) {
        this.fetchMountedCities(this.profile.country);
      }
    },
    async fetchOccupations() {
      const params = {
        token: 123,
      };
      const res = await axios.get("/api/occupationList", { params });
      if (res.data && res.data.Status) {
        this.occupations = res.data.data.mentorOccupation;
      }
    },
    async fetchCities(event) {
      var country_id = event.target.value;

      const params = {
        token: 123,
        country_id: country_id,
      };
      const res = await axios.get("/api/cities", {
        params,
      });
      if (res.data && res.data.Status) {
        this.cities = res.data.data.cities;
      }
    },
    async fetchMountedCities(event) {
      var country_id = event;

      const params = {
        token: 123,
        country_id: country_id,
      };
      const res = await axios.get("/api/cities", {
        params,
      });
      if (res.data && res.data.Status) {
        this.cities = res.data.data.cities;
      }
    },
    async submitProfileInfo(e) {
      if (this.profile.address == "") {
        this.profile.address = document.getElementById("map").value;
      }
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
      console.log(res)
    },
    //
    getAddressData: function (addressData, placeResultData, id) {
      this.profile.address = placeResultData.formatted_address;
    },
    async submitExperienceForm(e) {
      var self = this;
      var toast = this.$toasted;
      e.preventDefault();
      const headers = {
        "Content-Type": "multipart/form-data",
      };

      let formData = new FormData();
      formData.append("image", this.experience.experience_image);
      formData.append("token", this.experience.token);
      formData.append("mentor_id", this.User.user_id);
      formData.append("company", this.experience.company_name);
      formData.append("from", this.experience.date_from);
      formData.append("to", this.experience.date_to);
      const res = await axios
        .post("/api/mentorExperience", formData, {
          headers: headers,
        })
        .then((res) => {
          if (res.data.Status) {
            toast.success(res.data.msg);
            // document.getElementById('nav-contact-tab').click();
            self.allExperiences.push(res.data.data.experience);
            self.experience.company_name = "";
            self.experience.date_from = "";
            self.experience.date_to = "";
            self.experience.image_view='';
            $("#experience_image").val("");
          }
          if (!res.data.Status) {
            toast.error("Please Fill all Fields...");
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
    this.fetchCountries();
    this.fetchOccupations();

  },
};
</script>



