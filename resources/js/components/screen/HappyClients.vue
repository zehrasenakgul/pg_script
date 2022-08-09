<template>
    <section class="happy-clients">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-primary fw-bold text-center head px-3">
                         {{$t('banner_meet_the_people.heading')}}

                        <span class="text-secondary"> {{$t('banner_meet_the_people.sub_text')}}</span>
                         {{$t('banner_meet_the_people.sub_text2')}}
                        <span class="text-secondary"> {{$t('banner_meet_the_people.sub_text1')}}</span>
                    </h1>
                    <p class="text-center mt-4 sub-head ">
                          {{$t('banner_meet_the_people.paragraph')}}

                    </p>
                </div>
            </div>
            <div class="row d-flex justify-content-center">

                <div class="col-lg-8">
                    <div class="clients-slick ">
                        <VueSlickCarousel v-bind="settings">
                            <!-- slider 1 -->
                            <div
                                class="happy-clients-card p-md-0 p-3"
                                style="width: fit-content"
                            >
                                <div class="card border-0 bg-primary px-5 py-3">
                                    <p class="p-0 text-white mb-0 text-clients">
                                       <span>
                                           Lorem ipsum dolor sit amet consectetur

                                        </span>
                                    </p>
                                    <h6 class="fw-bold text-white pb-3">
                                        John Doe & Sara
                                    </h6>
                                </div>
                                <div
                                    class="position-relative d-md-block d-none"
                                >
                                    <img
                                        src="/assets/images/testimonials.png"
                                        alt=""
                                        class="img-fluid"
                                    />
                                </div>
                            </div>
                            <!-- slider 2 -->
                            <div
                                class="happy-clients-card p-md-0 p-3"
                                style="width: fit-content"
                            >
                                <div class="card border-0 bg-primary px-5 py-3">
                                    <p class="p-0 text-white mb-0 text-clients">
                                       <span>
                                            Lorem ipsum dolor sit amet consectetur

                                        </span>
                                    </p>
                                    <h6 class="fw-bold text-white pb-3">
                                        John Doe & Sara
                                    </h6>
                                </div>
                                <div
                                    class="position-relative d-md-block d-none"
                                >
                                    <img
                                        src="/assets/images/testimonials.png"
                                        alt=""
                                        class="img-fluid"
                                    />
                                </div>
                            </div>
                            <!-- slider  3-->
                           <div
                                class="happy-clients-card p-md-0 p-3"
                                style="width: fit-content"
                            >
                                <div class="card border-0 bg-primary px-5 py-3">
                                    <p class="p-0 text-white mb-0 text-clients">
                                       <span>
                                            Lorem ipsum dolor sit amet consectetur

                                        </span>
                                    </p>
                                    <h6 class="fw-bold text-white pb-3">
                                        John Doe & Sara
                                    </h6>
                                </div>
                                <div
                                    class="position-relative d-md-block d-none"
                                >
                                    <img
                                        src="/assets/images/testimonials.png"
                                        alt=""
                                        class="img-fluid"
                                    />
                                </div>
                            </div>
                            <!-- slider 4 -->
                            <div
                                class="happy-clients-card p-md-0 p-3"
                                style="width: fit-content"
                            >
                                <div class="card border-0 bg-primary px-5 py-3">
                                    <p class="p-0 text-white mb-0 text-clients">
                                       <span>
                                            Lorem ipsum dolor sit amet consectetur

                                        </span>
                                    </p>
                                    <h6 class="fw-bold text-white pb-3">
                                        John Doe & Sara
                                    </h6>
                                </div>
                                <div
                                    class="position-relative d-md-block d-none"
                                >
                                    <img
                                        src="/assets/images/testimonials.png"
                                        alt=""
                                        class="img-fluid"
                                    />
                                </div>
                            </div>
                        </VueSlickCarousel>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import VueSlickCarousel from "vue-slick-carousel";
import "vue-slick-carousel/dist/vue-slick-carousel.css";
export default {
    name: "MyComponent",
    components: { VueSlickCarousel },
    props: ["url"],
    data() {
        return {
            settings: {
                dots: true,
                arrows: false,
                focusOnSelect: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: false,
            },
        };
    },
};
</script>
