<template>
  <section class="signup pt-0 pb-0">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <div
            class="
              h-100
              d-flex
              justify-content-center
              align-content-center
              flex-column
              signup-section
               py-5
            "
          >
          <a href="/"><img
              :src="url + '/assets/images/sign-up-logo.png'"
              class="logo"
              alt=""
            /></a>

            <h1 class="fw-bold my-4 text-primary">
                  {{$t('signup_form_section.label_9')}}
               <img src="/assets/images/arrow.png" alt="" class="ps-3">
            </h1>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link active me-3 mt-md-0 mt-2"
                  id="pills-home-tab"
                  data-bs-toggle="pill"
                  data-bs-target="#pills-home"
                  type="button"
                  role="tab"
                  aria-controls="pills-home"
                  aria-selected="true"
                  @click="changeRole('Mentee')"
                >
                  {{$t('signup_form_section.button_1')}}
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link mt-md-0 mt-2"
                  id="pills-profile-tab"
                  data-bs-toggle="pill"
                  data-bs-target="#pills-profile"
                  type="button"
                  role="tab"
                  aria-controls="pills-profile"
                  aria-selected="false"
                  @click="changeRole('Mentor')"
                >
                  {{$t('signup_form_section.button_2')}}

                </button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div
                class="tab-pane fade show active"
                id="pills-home"
                role="tabpanel"
                aria-labelledby="pills-home-tab"
              >
                <input type="hidden" id="mentee_fbId" />
                <div class="form-signup">
                    <div class="row">
                        <div class="col-lg-6">
  <input
                    type="text"
                    name="mentee_first_name"
                    id="mentee_first_name"
                    :placeholder="$t('signup_form_section.label_1')"
                    class="form-control mt-4"
                  />
                        </div>
                        <div class="col-lg-6">
                               <input
                    type="text"
                    name="mentee_last_name"
                    id="mentee_last_name"
                    :placeholder="$t('signup_form_section.label_2')"

                    class="form-control mt-4"
                  />
                        </div>
                    </div>


                  <input
                    type="email"
                    name="mentee_email"
                    id="mentee_email"
                    :placeholder="$t('signup_form_section.label_3')"

                    class="form-control mt-4"
                  />
                  <div class="position-relative">
                    <input
                      :type="type"
                      name="mentee_password"
                      id="mentee_password"
                    :placeholder="$t('signup_form_section.label_4')"

                      class="form-control mt-4"
                    />
                    <i
                      class="fa-solid fa-eye position-absolute"
                      id="togglePassword"
                       @click="showPassword"
                    ></i>
                  </div>
                  <div class="position-relative">
                    <input
                      :type="type"
                      name="mentee_confirm_password"
                      id="mentee_confirm_password"
                    :placeholder="$t('signup_form_section.label_5')"

                      class="form-control mt-4"
                    />
                    <i
                      class="fa-solid fa-eye position-absolute"
                      id="togglePassword"
                      @click="showPassword"
                    ></i>
                  </div>
                  <button
                    class="btn btn-secondary text-white w-100 mt-5"
                    @click="registerMentee()"
                  >
                  {{$t('signup_form_section.button_3')}}

                  </button>
                </div>
                <p class="text-center mt-4 signin">
                  {{$t('signup_form_section.label_6')}}

                  <a href="/login" class="text-decoration-none">
                  {{$t('signup_form_section.label_7')}}

                  </a>
                </p>
                <hr />
                <p class="text-center">
                  {{$t('signup_form_section.label_8')}}

                </p>
                <div
                  class="
                    social-signup
                    d-flex
                    justify-content-center
                    align-items-center
                    flex-lg-row flex-column
                  "
                >
                  <button
                    class="btn btn-fb me-lg-3 text-white mt-1"
                    @click="redirectFB()"
                  >
                    <i class="fa-brands fa-facebook-f"></i> Facebook
                  </button>
                  <button class="btn btn-insta me-lg-3 text-white mt-1">
                    <i class="fa-brands fa-twitter"></i> Twitter
                  </button>
                  <button class="btn btn-g text-white mt-1"
                   @click="redirectGoogle()"
                  >
                    <i class="fa-brands fa-google-plus-g"></i> Google
                  </button>
                </div>
              </div>
              <div
                class="tab-pane fade"
                id="pills-profile"
                role="tabpanel"
                aria-labelledby="pills-profile-tab"
              >
                <input type="hidden" id="mentor_fbId" />
                <div class="form-signup">
                    <div class="row">
                        <div class="col-lg-6">
  <input
                    type="text"
                    name="mentor_first_name"
                    id="mentor_first_name"
                    placeholder="First Name here"
                    class="form-control mt-4"
                  />
                        </div>
                        <div class="col-lg-6">
                               <input
                    type="text"
                    name="mentor_last_name"
                    id="mentor_last_name"
                    placeholder="Last Name here"
                    class="form-control mt-4"
                  />
                        </div>
                    </div>
                  <input
                    type="email"
                    name="mentor_email"
                    id="mentor_email"
                    placeholder="Email address here"
                    class="form-control mt-4"
                  />
                  <div class="position-relative">
                    <input
                      :type="type"
                      name="mentor_password"
                      id="mentor_password"
                      placeholder="Password"
                      class="form-control mt-4"
                    />
                    <i
                      class="fa-solid fa-eye position-absolute"
                      id="togglePassword"
                      @click="showPassword"
                    ></i>
                  </div>
                  <div class="position-relative">
                    <input
                      :type="type"
                      name="mentor_confirm_password"
                      id="mentor_confirm_password"
                      placeholder="Repeat Password"
                      class="form-control mt-4"
                    />
                    <i
                      class="fa-solid fa-eye position-absolute"
                      id="togglePassword"
                      @click="showPassword"
                    ></i>
                  </div>
                  <button
                    class="btn btn-secondary text-white w-100 mt-5"
                    @click="registerMentor()"
                  >
                    Sign Up
                  </button>
                </div>
                <p class="text-center mt-4 signin">
                  Already have an account?
                  <a href="/login" class="text-decoration-none">Sign In</a>
                </p>
                <hr />
                <p class="text-center">Or Sign up with social media</p>
                <div
                  class="
                    social-signup
                    d-flex
                    justify-content-center
                    align-items-center
                    flex-lg-row flex-column
                  "
                >
                  <button
                    class="btn btn-fb me-lg-3 text-white mt-1"
                    @click="redirectFB()"
                  >
                    <i class="fa-brands fa-facebook-f"></i> Facebook
                  </button>
                  <button class="btn btn-insta me-lg-3 text-white mt-1">
                    <i class="fa-brands fa-twitter"></i> Twitter
                  </button>
                  <button class="btn btn-g text-white mt-1"
                   @click="redirectGoogle()"
                   >
                    <i class="fa-brands fa-google-plus-g"></i> Google
                  </button>
                </div>
              </div>
              <div
                class="tab-pane fade"
                id="pills-contact"
                role="tabpanel"
                aria-labelledby="pills-contact-tab"
              >
                ...
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-12 px-0">
          <img
            :src="url + '/assets/images/sign-up-side-img.png'"
            alt=""
            class="img-fluid signup-wrapper w-100 d-md-block d-none"
          />
        </div>
      </div>
    </div>
  </section>
</template>


<script>
import axios from "axios";

export default {
  props: ["url", "fbemail", "fbid"],

  data() {
    return {
      is_mentor: false,
      type:'password'
    };
  },
  methods: {
      showPassword() {
       if(this.type === "password") {
          this.type = 'text'
       } else {
          this.type = 'password'
       }
     },
    redirectFB() {
      if (this.is_mentor) {
        localStorage.setItem("role", "Mentor");
      } else {
        localStorage.setItem("role", "Mentee");
      }
      window.location.href = "/auth/facebook";
    },
    redirectGoogle() {
      if (this.is_mentor) {
        localStorage.setItem("role", "Mentor");
      } else {
        localStorage.setItem("role", "Mentee");
      }
      window.location.href = "auth/google";
    },
    changeRole(role) {
      if (role == "Mentor") {
        this.is_mentor = true;
      } else if (role == "Mentee") {
        this.is_mentor = false;
      }
    },

    registerMentor() {
      var toast = this.$toasted;
      let email = document.getElementById("mentor_email").value;
      let password = document.getElementById("mentor_password").value;
      let confirm_password = document.getElementById(
        "mentor_confirm_password"
      ).value;
      let mentor_last_name=document.getElementById('mentor_last_name').value;
      let mentor_first_name=document.getElementById('mentor_first_name').value;

      let mentor_fbId = document.getElementById("mentor_fbId").value;
      console.log(email, password, confirm_password, mentor_fbId);
      const params = {
        role: "Mentor",
        email: email,
        password: password,
        password_confirmation: confirm_password,
        fb_id: mentor_fbId,
        first_name:mentor_first_name,
        last_name:mentor_last_name

      };
      axios
        .post("/api/signup-email", params)
        .then((response) => {
          if (response.data.Status) {

              let user_id = response.data.data.user.id;
            // toast.success(response.data.msg);
            var User = {
              role: "Mentor",
              user_id: user_id,
              _token: 123,
              AccessToken: response.data.AccessToken,
            };
            localStorage.setItem("User", JSON.stringify(User));
            toast.success(response.data.msg);
            window.location.href = "/mentor-profile";
          }
          for (const property in response.data.errors) {
            toast.error(response.data.errors[property][0]);
          }
        })
        .catch((error) => {
          toast.error(error);
        });
    },
    registerMentee() {
      var toast = this.$toasted;
      let email = document.getElementById("mentee_email").value;
      let password = document.getElementById("mentee_password").value;
      let confirm_password = document.getElementById(
        "mentee_confirm_password"
      ).value;
      let mentee_last_name=document.getElementById('mentee_last_name').value;
      let mentee_first_name=document.getElementById('mentee_first_name').value;
      let mentee_fbId = document.getElementById("mentee_fbId").value;
      console.log(email, password, confirm_password);
      const params = {
        role: "Mentee",
        email: email,
        password: password,
        password_confirmation: confirm_password,
        fb_id: mentee_fbId,
        first_name:mentee_first_name,
        last_name:mentee_last_name
      };
      console.log(params);
      axios
        .post("/api/signup-email", params)
        .then((response) => {
          if (response.data.Status) {
              let user_id = response.data.data.user.id;
            // toast.success(response.data.msg);
            var User = {
              role: "Mentee",
              user_id: user_id,
              _token: 123,
              AccessToken: response.data.AccessToken,
            };
            localStorage.setItem("User", JSON.stringify(User));
            toast.success(response.data.msg);
            window.location.href = "/";
          }
          for (const property in response.data.errors) {
            toast.error(response.data.errors[property][0]);
          }
        })
        .catch((error) => {
          toast.error(error);
        });
    },
  },
  created() {
    // console.log(this.fbemail);
    // console.log(document.getElementById('pills-profile-tab'));
    // document.getElementById('pills-profile-tab').click();
  },
  mounted() {
    let role = localStorage.getItem("role");

    // console.log(this.fbemail);
    if (this.fbemail) {
      if (role == "Mentor") {
        document.getElementById("pills-profile-tab").click();
        document.getElementById("mentor_email").value = this.fbemail;
        document.getElementById("mentor_fbId").value = this.fbid;
      } else if (role == "Mentee") {
        document.getElementById("pills-home-tab").click();
        document.getElementById("mentee_email").value = this.fbemail;
        document.getElementById("mentee_fbId").value = this.fbid;
      }
    }
  },
};
</script>
