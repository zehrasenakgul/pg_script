<template>
    <div>
        <hero-section></hero-section>
        <AppointmentScreen id="2">
         </AppointmentScreen>
        <section-buttons>
            <div class="Buttons">
                <button type="button" @click="idSetter(1)">Go to User1</button>
                <button type="button" @click="idSetter(2)">Go to User2</button>
            </div>
        </section-buttons>
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
    props: ["url","givenID"],
    data(){
        this.givenID = idNumber
    },
    methods :{
        idSetter(idNum){
            console.log("BERKAY",idNum)
        },
    },
    components : {
        AppointmentScreen
    }
};
</script>
