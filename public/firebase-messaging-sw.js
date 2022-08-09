importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('./firebase-messaging-sw.js')
      .then(function(registration) {
        console.log('Registration successful, scope is:', registration.scope);
      }).catch(function(err) {
        console.log('Service worker registration failed, error:', err);
      });
    }
// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
        apiKey: "AIzaSyB1q4WX9YcG6BOcFuZsx_dTsrFWUEeKqeg",
        authDomain: "consultant-40a1f.firebaseapp.com",
        projectId: "consultant-40a1f",
        storageBucket: "consultant-40a1f.appspot.com",
        messagingSenderId: "883597025671",
        appId: "1:883597025671:web:7461e9670e422dfcab7322",
        measurementId: "G-82DKX2F5XT"
});


// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);

    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };

    return self.registration.showNotification(
        title,
        options,
    );
});
self.addEventListener("push", (event) => {

    let response = event.data && event.data.text();
    // console.log(response);
    let title = JSON.parse(response).notification.title;
    let body = JSON.parse(response).notification.body;
    let icon = JSON.parse(response).notification.image;
    let image = JSON.parse(response).notification.image;
    // let link = JSON.parse(response).data['gcm.notification.data'];

    if(JSON.parse(response).data)
    {
        let link = JSON.parse(response).data['gcm.notification.data'];
        event.waitUntil(
            self.registration.showNotification(title, { body, icon, image, data: { url: link } })
        )
    }
    else
    {
        event.waitUntil(
            self.registration.showNotification(title, { body, icon, image })
        )
    }
});

self.addEventListener('notificationclick', function(event) {
    //console.log(event);
    event.notification.close();
    event.waitUntil(
        clients.openWindow(event.notification.data.url)
    );
});
