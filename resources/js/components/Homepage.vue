<template>
    <div>
        <hero-section></hero-section>
        <AppointmentScreen v-bind:berk="berk">
        </AppointmentScreen>
        <section-buttons>
            <div class="Buttons">
                <button type="button" @click="idSetter(1)">Go to User1</button>
                <button type="button" @click="idSetter(2)">Go to User2</button>
                <button type="button" @click="idSetter(9)">Go to User3</button>
            </div>
        </section-buttons>
        <!-- <consultant-section :url=url></consultant-section> -->
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
        return{
            berk:1
        }
    },
    methods :{
        idSetter(e){
            this.berk = e
            console.log("yeni deger -> ",this.berk)
        },
    },
    components : {
        AppointmentScreen
    }
};

</script>
