<html>
<head>
    <title>upload data to firebase</title>
</head>
<body>
<center>
    <h2>name:</h2>
    <input type="text" id="name" required="required"><br>
    <h2>Gender:</h2>
    <input type="text" id="gender" required="required"><br>
    <h2>Country:</h2>
    <input type="text" id="country" required="required"><br>

    <button type="button" onclick="insert();">Upload</button>
</center>



<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#config-web-app -->

<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyBiCasLzsPZTObojflj5FmbdR56FwEsT-8",
    authDomain: "iotfirebaseproject-760c1.firebaseapp.com",
    databaseURL: "https://iotfirebaseproject-760c1.firebaseio.com",
    projectId: "iotfirebaseproject-760c1",
    storageBucket: "iotfirebaseproject-760c1.appspot.com",
    messagingSenderId: "461152123840",
    appId: "1:461152123840:web:87a2fe8378c166c6322625"
  };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
</script>
<script src="js/upload.js" type="text/javascript"></script>
</body>
</html>