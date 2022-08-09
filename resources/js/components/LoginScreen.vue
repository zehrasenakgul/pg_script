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
          <a href="/">
            <img
              :src="url + '/assets/images/sign-up-logo.png'"
              class="logo"
              alt=""
            /></a>

            <h1 class="fw-bold my-4 text-primary">
                    {{$t('login_form_section.button_3')}}

               <img src="/assets/images/arrow.png" alt="" class="ps-3">
            </h1>

            <ul class="nav nav-pills py-3" id="pills-tab" role="tablist">
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
                   {{$t('login_form_section.button_1')}}

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
                 {{$t('login_form_section.button_2')}}

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
                <div class="form-signup">
                  <input
                    type="email"
                    name="mentee_email"
                    id="mentee_email"
                    :placeholder="$t('login_form_section.label_1')"

                    class="form-control mt-4"
                  />
                  <div class="position-relative">
                    <input
                      :type="type"
                      name="mentee_password"
                      id="mentee_password"
                     :placeholder="$t('login_form_section.label_2')"

                      class="form-control mt-4"
                      v-on:keyup.enter="doMenteeLogin"
                    />
                    <i
                      class="fa-solid fa-eye position-absolute"
                      id="togglePassword"
                      @click="showPassword"
                    ></i>
                  </div>
                  <div class="d-flex justify-content-end mt-1">
                  <a href="/forgot-password" class="small fst-italic">
                   {{$t('login_form_section.label_3')}}

                  </a>
                  </div>

                  <button
                    class="btn btn-secondary text-white w-100 mt-5"
                    @click="doMenteeLogin()"

                  >
                    {{$t('login_form_section.button_3')}}

                  </button>
                </div>
                <p class="text-center mt-4 signin">
                    {{$t('login_form_section.label_4')}}

                  <a href="/signup" class="text-decoration-none" type="button">
                    {{$t('login_form_section.label_5')}}

                  </a>
                </p>
                <hr />
                <p class="text-center">
                    {{$t('login_form_section.label_6')}}

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
                  <button
                    class="btn btn-g text-white mt-1"
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
                <div class="form-signup">
                  <input
                    type="email"
                    name="mentor_email"
                    id="mentor_email"
                     :placeholder="$t('login_form_section.label_1')"

                    class="form-control mt-4"
                  />
                  <div class="position-relative">
                    <input
                      :type="type"
                      name="mentor_password"
                      id="mentor_password"
                       :placeholder="$t('login_form_section.label_2')"

                      class="form-control mt-4"
                      v-on:keyup.enter="doMenteeLogin"
                    />
                    <i
                      class="fa-solid fa-eye position-absolute"
                      id="togglePassword"
                      @click="showPassword"
                    ></i>
                  </div>
                  <div class="d-flex justify-content-end mt-1">
                   <a href="/forgot-password" class="small fst-italic">{{$t('login_form_section.label_3')}}</a>

                  </div>

                  <button
                    class="btn btn-secondary text-white w-100 mt-5"
                    @click="doMentorLogin()"

                  >
                    {{$t('login_form_section.button_3')}}
                  </button>
                </div>
                <p class="text-center mt-4 signin">
                    {{$t('login_form_section.label_4')}}

                  <a href="/signup" class="text-decoration-none" type="button">
                    {{$t('login_form_section.label_5')}}

                  </a>
                </p>
                <hr />
                <p class="text-center">
                    {{$t('login_form_section.label_6')}}

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
                    @click="redirectFB()"
                    class="btn btn-fb me-lg-3 text-white mt-1"
                  >
                    <i class="fa-brands fa-facebook-f"></i> Facebook
                  </button>
                  <button class="btn btn-insta me-lg-3 text-white mt-1">
                    <i class="fa-brands fa-twitter"></i> Twitter
                  </button>
                  <button
                    class="btn btn-g text-white mt-1"
                    @click="redirectGoogle()"
                  >
                    <i class="fa-brands fa-google-plus-g"></i> Google
                  </button>
                </div>
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
import loginMixin from "../mixins/loginMixin.js";
export default {
  props: ["url", "user_id", "access_token"],
  mixins: [loginMixin],
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
    changeRole(role) {
      if (role == "Mentor") {
        this.is_mentor = true;
      } else if (role == "Mentee") {
        this.is_mentor = false;
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
    doMenteeLogin() {
      var toast = this.$toasted;
      let email = document.getElementById("mentee_email").value;
      let password = document.getElementById("mentee_password").value;

      // console.log(email,password);
      const params = {
        role: "Mentee",
        email: email,
        password: password,
      };
      // console.log(params);
      axios
        .post("/api/login-email", params)
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
            console.log(response.data.data);
            //Device token
            const messaging = firebase.messaging();
            messaging
              .requestPermission()
              .then(function () {
                return messaging.getToken();
              })
              .then(function (response) {
                var fcm_token = response;
                const params = {
                  token: 123,
                  fcm_token: fcm_token,
                  device_id: "web",
                  user_id: user_id,
                };
                axios.post("/api/fcm-store-token", params).then((response) => {
                  if (response.data && response.data.Status == true) {
                  }
                });
              });
            window.location.href = "/";
          } else if (!response.data.Status && response.data.errors) {
            for (const property in response.data.errors) {
              toast.error(response.data.errors[property][0]);
            }
          } else {
            toast.error(response.data.msg);
          }
        })
        .catch((error) => {
          console.log(error);
          toast.error(error);
        });
    },
    doMentorLogin() {
      var toast = this.$toasted;
      let email = document.getElementById("mentor_email").value;
      let password = document.getElementById("mentor_password").value;

      const params = {
        role: "Mentor",
        email: email,
        password: password,
      };
      axios
        .post("/api/login-email", params)
        .then((response) => {
          if (response.data.Status) {
            let user_id = response.data.data.user.id;
            var User = {
              role: "Mentor",
              user_id: user_id,
              _token: 123,
              AccessToken: response.data.AccessToken,
            };
            localStorage.setItem("User", JSON.stringify(User));

            toast.success(response.data.msg);
            console.log(response.data.data);
            //Device token
            const messaging = firebase.messaging();
            messaging
              .requestPermission()
              .then(function () {
                return messaging.getToken();
              })
              .then(function (response) {
                var fcm_token = response;
                const params = {
                  token: 123,
                  fcm_token: fcm_token,
                  device_id: "web",
                  user_id: user_id,
                };
                axios.post("/api/fcm-store-token", params).then((response) => {
                  if (response.data && response.data.Status == true) {
                  }
                });
              });
            window.location.href = "/";
          } else if (!response.data.Status && response.data.errors) {
            for (const property in response.data.errors) {
              toast.error(response.data.errors[property][0]);
            }
          } else {
            toast.error(response.data.msg);
          }
        })
        .catch((error) => {
          toast.error(error);
        });
    },
  },
  created() {
    this.checkLoggedIn();
    if (this.is_loggedIn) {
      window.location.href = this.url;
    }
  },
  mounted() {
    var toast = this.$toasted;
    console.log(this.user_id, this.access_token, localStorage.getItem("role"));
    if (this.user_id) {
      let role = localStorage.getItem("role");
      let user;
      if (role == "Mentor") {
        user = {
          role: "Mentor",
          user_id: this.user_id,
          _token: 123,
          AccessToken: this.access_token,
        };
        localStorage.setItem("User", JSON.stringify(user));

        toast.success("Successfully Login");
        localStorage.removeItem("role");
        window.location.href = "/";
      } else if (role == "Mentee") {
        user = {
          role: "Mentee",
          user_id: this.user_id,
          _token: 123,
          AccessToken: this.access_token,
        };
        localStorage.setItem("User", JSON.stringify(user));

        toast.success("Successfully Login");
        localStorage.removeItem("role");
        window.location.href = "/";
      }
    }
  },
};
</script>
