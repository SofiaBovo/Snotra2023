// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here, other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
var firebaseConfig = {
  apiKey: "AIzaSyDdldSMDmYufKOsNUX9zZQED1PVpR84kw8",
  authDomain: "snotra-6c452.firebaseapp.com",
  projectId: "snotra-6c452",
  storageBucket: "snotra-6c452.appspot.com",
  messagingSenderId: "581742987840",
  appId: "1:581742987840:web:99a01d410ce9270d18ada5"
};

firebase.initializeApp(config);
var db = firebase.firestore();
db.settings({
  timestampsInSnapshots: true
});