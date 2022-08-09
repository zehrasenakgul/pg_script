<!DOCTYPE html>
<html lang="en">
<head>
    <title>Consultant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" id="bootstrap-css"> --}}
    {{-- <link rel="stylesheet" href="{{asset('assets/intel/css/intlTelInput.css')}}"> --}}
    {{-- <link href="{{asset('css/custom.css')}}" rel="stylesheet"> --}}
    {{-- <link href="{{asset('css/style.css')}}" rel="stylesheet"> --}}
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdCdcUtLMgTMNOc0c_KrXxVhWnVUAaJYw&libraries=places" ></script>
    <script>
        //old keys
    //     var firebaseConfig = {
    //     apiKey: "AIzaSyAu3p1Rf_w6ztCvLh4uSJ0VNkjyqFJLw0A",
    //     authDomain: "mahvra-9b105.firebaseapp.com",
    //     projectId: "mahvra-9b105",
    //     storageBucket: "mahvra-9b105.appspot.com",
    //     messagingSenderId: "452006378117",
    //     appId: "1:452006378117:web:bf1304f9499df19eb587ec",
    //     measurementId: "G-T3W6XWXMFP"
    // };
    const firebaseConfig = {
        apiKey: "AIzaSyB1q4WX9YcG6BOcFuZsx_dTsrFWUEeKqeg",
        authDomain: "consultant-40a1f.firebaseapp.com",
        projectId: "consultant-40a1f",
        storageBucket: "consultant-40a1f.appspot.com",
        messagingSenderId: "883597025671",
        appId: "1:883597025671:web:7461e9670e422dfcab7322",
        measurementId: "G-82DKX2F5XT"
        };
    firebase.initializeApp(firebaseConfig);





    if(localStorage.getItem('User')!=null){

        var navigator_info = window.navigator;
        var screen_info = window.screen;
        var uid = navigator_info.mimeTypes.length;
        uid += navigator_info.userAgent.replace(/\D+/g, '');
        uid += navigator_info.plugins.length;
        uid += screen_info.height || '';
        uid += screen_info.width || '';
        uid += screen_info.pixelDepth || '';
        var user=JSON.parse(localStorage.getItem('User'));
        //console.log(uid);
        //document.write(uid);
        const messaging = firebase.messaging();

    messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function (response) {
                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                // });
                console.log(response);
                $.ajax({
                    url: '{{ route("store.token") }}',
                    type: 'POST',
                    data: {
                        fcm_token: response,
                        token:123,
                        device_id:uid,
                        user_id:user.user_id


                    },
                    dataType: 'JSON',
                    success: function (response) {
                        console.log('Token stored.');
                    },
                    error: function (error) {
                        console.log(error);
                    },
                });

            }).catch(function (error) {
                alert(error);
            });
            messaging.onMessage(function (payload) {
            const title = payload.notification.title;
            const options = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(title, options);

        });
    }
    </script>
</head>
<body>
