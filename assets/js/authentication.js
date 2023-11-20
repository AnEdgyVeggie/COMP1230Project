const register = (firstName, lastName, email, password, confirmPass) => {
    const nameRegex = /^[a-zA-Z]*$/;
    const emailRegex = /^[a-zA-Z0-9.-_]+@[a-zA-Z.-_]+\.[a-z]*/

    let error = false;

    var expiry = new Date();

    expiry.setTime(expiry.getTime()+30* 1000);
    


    initializeErrorTags("register");

    if (!nameRegex.test(firstName) || firstName === "") {
        document.getElementById("error-fname").innerText = 
        "FIRST NAMES SHOULD CONTAIN LETTERS ONLY";

        error = true;
    }
    if (!nameRegex.test(lastName) || lastName === "") {
        document.getElementById("error-lname").innerText = 
        "LAST NAMES SHOULD CONTAIN LETTERS ONLY";

        error = true;
    }
     if (!emailRegex.test(email.toLowerCase())) {
         document.getElementById("error-email").innerText = 
         "PLEASE ENTER A VALID EMAIL";

         error = true;
     }


    if (password !== confirmPass) {
        document.getElementById("error-confirmpw").innerText = 
        "PASSWORDS NEED TO MATCH";
        error = true;
    }

    // uses if error instead of returning after first detected error, because if 
    // returned too early, only the first error is displayed
    if (error) return;

    // LOCALHOST
    document.cookie = `firstName=${firstName}; expires=${expiry.toUTCString}; path=/dashboard/projects/project/pages/loading`;
    document.cookie = `lastName=${lastName}; expires=${expiry.toUTCString};  path=/dashboard/projects/project/pages/loading`;
    document.cookie = `email=${email}; expires=${expiry.toUTCString};  path=/dashboard/projects/project/pages/loading`;
    document.cookie = `password=${password}; expires=${expiry.toUTCString}; path=/dashboard/projects/project/pages/loading`;


    // SERVERSIDE
    // document.cookie = `firstName=${firstName}; expires=${expiry.toUTCString}; path=/comp1230/assignments/project/pages/loading`;
    // document.cookie = `lastName=${lastName}; expires=${expiry.toUTCString};  path=/comp1230/assignments/project/pages/loading`;
    // document.cookie = `email=${email}; expires=${expiry.toUTCString};  path=/comp1230/assignments/project/pages/loading`;
    // document.cookie = `password=${password}; expires=${expiry.toUTCString}; path=/comp1230/assignments/project/pages/loading`;
    // document.cookie = `register=true; expires=${expiry.toLocaleTimeString};path=/comp1230/assignments/project/pages/loading`;

    window.location.href = "loading/loadingScreen.php?register=true"
}

const login = (email, password) => {
    
    initializeErrorTags("login");

    var expiry = new Date();

    expiry.setTime(expiry.getTime()+30* 1000);

    document.cookie = `email=${email}; expires=${expiry.toUTCString};  path=/dashboard/projects/project/pages/learningPaths.php`;
    document.cookie = `password=${password}; expires=${expiry.toUTCString}; path=/dashboard/projects/project/pages/loading`;

    location.href = 'loading/loadingscreen.php';

}

const getFormValues = selector => {
    // this handles scraping forms for values in one function and then calls other functions accordingly
    let firstName = "" , lastName = "", email = "", password = "",  confirmPass = "";


    if (document.getElementById("firstname")){
        firstName = document.getElementById("firstname").value;
    }

    if (document.getElementById("lastname")) {
        lastName = document.getElementById("lastname").value;
    }

    if (document.getElementById("email")) {
        email = document.getElementById("email").value;
    }

    if (document.getElementById("password")) {
        password = document.getElementById("password").value;
    }

    if (document.getElementById("confirm_password")) {
        confirmPass = document.getElementById("confirm_password").value;
    }

    switch (selector) {
        case "register":
            register(firstName, lastName, email, password, confirmPass);
            break;
        case "login": 
            login(email, password)
            break;
    }

}

// used to initialize errors as empty strings. This is for 
// 'per-line' errors 
const initializeErrorTags = selector => {
    switch (selector) {
    case "register":
        const firstname = document.getElementById("error-fname");
        const lastname = document.getElementById("error-lname");
        const email = document.getElementById("error-email");
        const password = document.getElementById("error-password");
        const confirmpw = document.getElementById("error-confirmpw");
    
        firstname.innerHTML = "";
        lastname.innerHTML = "";
        email.innerHTML = "";
        password.innerHTML = "";
        confirmpw.innerHTML = "";
        break;
    case "login":
        const error = document.getElementById("error");
        error.innerHTML = "";
        break;
    }

}
