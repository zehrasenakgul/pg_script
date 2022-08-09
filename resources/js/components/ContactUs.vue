<template>
    <div>
        <header class="contact-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div
                            class="d-flex justify-content-center align-items-center flex-column"
                        >
                            <h1 class="text-white text-center head">
                                {{$t('contact_banner_section.heading')}}
                            </h1>
                            <p class="text-white text-center mt-3">
                               {{$t('contact_banner_section.paragraph')}}

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section class="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h1 class="head text-primary fw-bold">
                            {{$t('contact_us_section.heading')}}
                             <span class="text-secondary"> {{$t('contact_us_section.sub_heading')}}</span>

                        </h1>

                        <p class="sub-head mt-3">
                             {{$t('contact_us_section.paragraph_1')}}

                        </p>

                        <p class="sub-head mt-4">
                             {{$t('contact_us_section.paragraph_2')}}

                        </p>
                    </div>

                    <div class="col-lg-6">
                        <div
                            class="d-flex justify-content-center align-items-center h-100 mt-lg-0 mt-5"
                        >
                            <img
                                src="/assets/images/contactlogo.png"
                                alt=""
                                class="img-fluid"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white get-in-touch">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h1 class="head text-primary fw-bold">
                            {{$t('contact_get_in_section.heading')}}
                            <span class="text-secondary">{{$t('contact_get_in_section.sub_heading')}}</span>

                        </h1>
                        <p class="sub-head mt-3">
                            {{$t('contact_get_in_section.paragraph')}}

                        </p>

                        <div class="row">
                            <div class="col-md-6">
                                <div
                                    class="d-flex justify-content-center align-items-center flex-column mt-5"
                                >
                                    <img
                                        src="/assets/images/callus-icon.png"
                                        alt=""
                                    />

                                    <label
                                        for=""
                                        class="text-secondary contact-label fw-500 mt-2"
                                        >Call us</label
                                    >
                                    <span class="label-content"
                                        >(800) 123-6789</span
                                    >
                                    <span class="label-content"
                                        >(800) 123-6789</span
                                    >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="d-flex justify-content-center align-items-center flex-column mt-5"
                                >
                                    <img
                                        src="/assets/images/emailus-icon.png"
                                        alt=""
                                    />

                                    <label
                                        for=""
                                        class="text-secondary contact-label fw-500 mt-2"
                                        >Email us</label
                                    >
                                    <span class="label-content"
                                        >info@info.com</span
                                    >
                                    <span class="label-content"
                                        >info@info.com</span
                                    >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div
                                    class="d-flex justify-content-center align-items-center flex-column mt-5"
                                >
                                    <img
                                        src="/assets/images/address-icon.png"
                                        alt=""
                                    />

                                    <label
                                        for=""
                                        class="text-secondary contact-label fw-500 mt-2"
                                        >Address</label
                                    >
                                    <span class="label-content text-center px-4">
                                        234 Sample Ave. Sampling.FL USA
                                        2345</span
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-form ps-lg-5 mt-lg-4 mt-5">
                            <form action="">
                                <label
                                    for=""
                                    class="text-dark fw-400 mb-2 d-flex"
                                    >{{$t('contact_form_section.title_1')}}

                                    <div
                                        class="d-flex justify-content-center align-items-center mb-2 ms-1"
                                    >
                                        <i
                                            class="fa-solid fa-star text-success"
                                            style="font-size: 9px"
                                        ></i></div
                                ></label>
                                <input
                                    type="text"
                                    name=""
                                    id=""
                                    class="form-control rounded-0 px-4"
                                    :placeholder="$t('contact_form_section.place_holder_1')"

                                    v-model="name"
                                />

                                <label
                                    for=""
                                    class="text-dark fw-400 mb-2 mt-4 d-flex"
                                    >{{$t('contact_form_section.title_2')}}

                                    <div
                                        class="d-flex justify-content-center align-items-center mb-2 ms-1"
                                    >
                                        <i
                                            class="fa-solid fa-star text-success"
                                            style="font-size: 9px"
                                        ></i></div
                                ></label>
                                <input
                                    type="email"
                                    name=""
                                    id=""
                                    class="form-control rounded-0 px-4"
                                     :placeholder="$t('contact_form_section.place_holder_2')"

                                    v-model="email"
                                />

                                <label
                                    for=""
                                    class="text-dark fw-400 mb-2 mt-4 d-flex"
                                    > {{$t('contact_form_section.title_3')}}

                                    <div
                                        class="d-flex justify-content-center align-items-center mb-2 ms-1"
                                    >
                                        <i
                                            class="fa-solid fa-star text-success"
                                            style="font-size: 9px"
                                        ></i></div
                                ></label>
                                <input
                                    type="text"
                                    name=""
                                    id=""
                                    class="form-control rounded-0 px-4"
                                    :placeholder="$t('contact_form_section.place_holder_3')"

                                    v-model="subject"
                                />

                                <label
                                    for=""
                                    class="text-dark fw-400 mb-2 mt-4 d-flex"
                                    >{{$t('contact_form_section.title_4')}}

                                    <div
                                        class="d-flex justify-content-center align-items-center mb-2 ms-1"
                                    >
                                        <i
                                            class="fa-solid fa-star text-success"
                                            style="font-size: 9px"
                                        ></i></div
                                ></label>
                                <textarea
                                    type="text"
                                    name=""
                                    id=""
                                    rows="6"
                                    class="form-control rounded-0 px-4 py-3"
                                    :placeholder="$t('contact_form_section.place_holder_4')"

                                    v-model="message"
                                />

                                <button
                                    class="btn btn-secondary rounded-0 text-white mt-4 fw-400 px-4"
                                    type="button"
                                    v-on:click="sendContactFormData"
                                >
                                     {{$t('contact_form_section.button')}}

                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    props: ["url"],
    data() {
        return {
            name: "",
            email: "",
            subject: "",
            message: "",
        };
    },
    methods: {
        async sendContactFormData() {
            var self = this;
            var toast = this.$toasted;
            var params = {
                token: 123,
                name: this.name,
                email: this.email,
                message: this.message,
                subject: this.subject,
            };
            const res = await axios
                .post("/api/contactus", params)
                .then((res) => {
                    if (res.data.Status) {
                        toast.success(res.data.msg);
                        this.name = "";
                        this.email = "";
                        this.message = "";
                        this.subject = "";
                    }
                    if (!res.data.Status) {
                        for (const property in res.data.errors) {
                            toast.error(res.data.errors[property][0]);
                        }
                    }
                });
        },
    },
    //   created(){
    //       console.log(this.url);
    //   }
};
</script>
