<template>
    <div>
        <hero-section></hero-section>
        <AppointmentScreen :url=url :mentor-id=2></AppointmentScreen>
        <consultant-section :url=url></consultant-section>
        <top-guiders-section :url=url></top-guiders-section>
        <why-you-choose-section></why-you-choose-section>
        <book-appointment-section></book-appointment-section>
        <happy-clients-section></happy-clients-section>
        <become-consultant-section></become-consultant-section>
        <blog-section :url=url></blog-section>
    </div>
</template>

<script>
import AppointmentScreen from './AppointmentScreen.vue';
export default {
    props: ["url"],
    components : {
        AppointmentScreen
    }
};
</script>
