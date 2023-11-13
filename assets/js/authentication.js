const register = (firstName, lastName, email, password, confirmPass) => {
    const nameRegex = /^[a-zA-Z]*$/;
    // const emailRegex = /^[a-z0-9]+@[a-z]*\.[a-z]*/
    let error = false;

    // initializeErrorTags();

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
    // if (!email.match(emailRegex)) {
    //     document.getElementById("error-email").innerText = 
    //     "PLEASE ENTER A VALID EMAIL";

    //     error = true;
    // }

    if (password !== confirmPass) {
        document.getElementById("error-confirmpw").innerText = 
        "PASSWORDS NEED TO MATCH";
        error = true;
    }

    // uses if error instead of returning after first detected error, because if 
    // returned too early, only the first error is displayed
    if (error) return;


    document.cookie = "firstName=" + firstName;
    document.cookie = "lastName=" + lastName;
    document.cookie = "email=" + email;
    document.cookie = "password=" + password;
    console.log(document.cookie);
}

const login = (email, password) => {
    let cookieMap = new Map();

    // convert JS cookies to an array [firstname=name, lastname=name] etc
    // and trims the whitespace
    let cookieArray = document.cookie.split(";");
    for (let i = 0; i < cookieArray.length; i++) {
        cookieArray[i] = cookieArray[i].trimStart();
    }

    // converts each array element into a key/value and stores in a map
    cookieArray.forEach(element => {
        let newElement = element.split("=");
        console.log(newElement)
        cookieMap.set(newElement[0], newElement[1])
    });

    if (email === cookieMap.get("email")) {
        console.log("Email match");
    }
    if (password === cookieMap.get("password")) {
        console.log("Password match")
    }
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
const initializeErrorTags = () => {
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
}