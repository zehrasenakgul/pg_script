<template>
    <div>
        <hero-section></hero-section>
        <AppointmentScreen v-bind:berk="berk">
        </AppointmentScreen>
        <section class="section piemenuContainer" id="piemenuContainer">
            <div class="Container">
                <div id="bg_pie-1"></div>
                <div id="bg_pie-2"></div>
                <div id='piemenu' data-wheelnav data-wheelnav-slicepath='PieSlice' data-wheelnav-marker
                    data-wheelnav-markerpath='TriangleMarker' data-wheelnav-navangle='0' data-wheelnav-cssmode
                    data-wheelnav-init>
                    <div id="letsTest" @onmousedown="idSetter(2)" data-wheelnav-navitemtext='Human Resources'></div>
                    <div data-wheelnav-navitemtext='Legal' @click='idSetter(1)'></div>
                    <div data-wheelnav-navitemtext='Sales & Channels' v-on:mouseup='idSetter(1)'></div>
                    <div data-wheelnav-navitemtext='Software Development' @click='idSetter(3)'></div>
                    <div data-wheelnav-navitemtext='Cloud' @click='idSetter(4)'></div>
                    <div data-wheelnav-navitemtext='Marketing' @click='idSetter(5)'></div>
                    <div data-wheelnav-navitemtext='Finance' @click='idSetter(6)'></div>
                </div>
                <div class="piemenu_middleContainer d-flex flex-column align-items-center">
                    <div class="infoContainer" style="display: none;width:500px;">
                        <img src="./images/infoIcon.svg" id="infoContIcon" alt="">
                        <div class="infoContainer_Header">
                            <span class="giveninfo_Title">Web Development</span>
                        </div>
                        <div class="infoContainer_Paragraph">
                            <p class="giveninfo_Paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Delectus maiores necessitatibus quaerat mollitia asperiores temporibus quia sapiente,
                                sint cupiditate reiciendis officia possimus velit fugit eveniet impedit unde numquam
                                assumenda eius optio enim ab ea. Sunt perspiciatis est atque omnis beatae voluptas dicta
                                qui odit earum, impedit labore, eum officiis quos, pariatur itaque hic quasi nisi
                                deleniti ad illo? Iste molestias saepe dicta doloribus deleniti voluptas dolores fuga
                                quisquam? Voluptatibus et non totam reiciendis dolorem voluptate repellat modi, aperiam
                                aliquid laborum excepturi debitis recusandae beatae explicabo, laboriosam doloremque
                                suscipit eligendi impedit voluptatem laudantium facere soluta quisquam dolor! Labore
                                incidunt, delectus possimus non, magni unde ducimus explicabo dolorum, veritatis nihil
                                cumque corporis hic? Ea quaerat corrupti voluptatem quod, amet reiciendis animi nobis
                                quas! Quasi, ducimus esse. Distinctio eligendi eum, necessitatibus eos vero incidunt
                                nemo, voluptatum nam perspiciatis repudiandae facere? Facilis autem explicabo labore
                                beatae ad magni quae nostrum odio maxime unde cupiditate optio, odit quod quo at
                                doloremque omnis deserunt vero non molestias nam! A illo voluptates magnam itaque. In
                                voluptatem possimus nulla rerum ut consectetur ratione error praesentium placeat! Fuga,
                                in ea? Veritatis eum totam sunt quas fugiat eligendi inventore fugit dolores, repellat
                                commodi. Voluptates magnam exercitationem iusto. Nobis, voluptatem laborum.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center flex-row-reverse">
                        <div class="list-group linkMenu">

                        </div>
                        <div class="list-group infoMenu">

                        </div>
                    </div>
                </div>
                <form action="" id="myForm">
                    <div class="GrupLeft">
                        <label for="somethingSelection">Seçenekler</label>
                        <select id="somethingSelection" class="form-select form-select-lg mb-3"
                            aria-label=".form-select-lg example">
                            <option selected>Open this select menu</option>
                        </select>
                        <div class="optionInfo_Container">
                            <span class="optionInfo" id="optionInfo">Laravel is an PHP based backend framework</span>
                        </div>
                        <textarea placeholder="Pitgrowth ile ..." name="" id="formTextArea" cols="10"
                            rows="10"></textarea>
                    </div>
                </form>
            </div>
        </section>
        <section-buttons>
            <div class="Buttons">
                <button type="button" @click="idSetter(191)">Go to User1</button>
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
import './berkay/SerkanBey.css'
import runpie from './berkay/SerkanBey'
export default {
    props: ["url", "givenID"],
    data() {
        return {
            berk: 191,
        }
    },
    methods: {
        idSetter(e) {
            console.log("vue clicked ->", e)
            this.berk = e
        },
        pieFunc(e) {
            console.log('pie clicked');
        }
    },
    components: {
        AppointmentScreen
    },
    mounted() {
        console.log('start  1 -> ', document.querySelector('#piemenu'))
        var piemenu = new wheelnav('piemenu');
        piemenu.clockwise = false;
        piemenu.animatetime = 500;
        piemenu.animateeffect = 'linear';
        piemenu.wheelRadius = piemenu.wheelRadius * 1.3;
        if (screen.width < 600) {
            piemenu.wheelRadius = piemenu.wheelRadius * 0.75;
        }
        piemenu.createWheel();

        console.log('------');
        console.log(piemenu)
        console.log(piemenu.getSliceId())
        console.log('------');

        console.log('step 4')
        var listEl = document.querySelectorAll('#piemenu svg *')
        var _this = this
        listEl.forEach(function (e) {
            e.onmouseup = function () {
                console.log('in success -> ')
                var id = e.getAttribute('id').split('wheelnav-piemenu-slice-')[1]
                _this.berk = id
                //this.idSetter(id)
                console.log('berk -> ', _this.berk )
                console.log('id -> ', id )
            }
        })
        console.log('step 5');


    }
};

</script>
