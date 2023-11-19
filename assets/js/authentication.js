const register = (firstName, lastName, email, password, confirmPass) => {
    const nameRegex = /^[a-zA-Z]*$/;
<<<<<<< HEAD
    // const emailRegex = /^[a-z0-9]+@[a-z]*\.[a-z]*/
    let error = false;
=======
    const emailRegex = /^[a-zA-Z0-9]+@[a-zA-Z.-]+\.[a-z]*/

    let error = false;

    const tempDate = new Date();

    // expires in 1 hour
    const expiry = tempDate.getTime() + 1000 *36000 


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
>>>>>>> d6ac8411d6e728d4ae35768fb1d84da1da1901d0

    initializeErrorTags();

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


<<<<<<< HEAD
    document.cookie = "firstName=" + firstName;
    document.cookie = "lastName=" + lastName;
    document.cookie = "email=" + email;
    document.cookie = "password=" + password;
=======
    document.cookie = `firstName=${firstName}; expires=${expiry}; path=../pages/loading/loadingScreen.php`;
    document.cookie = `lastName=${lastName}; expires=${expiry};  path=/loading`;
    document.cookie = `email=${email}; expires=${expiry};  path=/`;
    document.cookie = `password=${password}; expires=${expiry}; path=/`;

>>>>>>> d6ac8411d6e728d4ae35768fb1d84da1da1901d0
    console.log(document.cookie);
    location.href = "loading/loadingScreen.php"


    const form = document.getElementById("register-form");
    form.setAttribute("method", "post")
}

const login = (email, password) => {
<<<<<<< HEAD
    let cookieMap = new Map();

=======
    
    initializeErrorTags("login");

    const tempDate = new Date();

    // expires in 1 hour
    const expiry = tempDate.getTime() + 1000 *36000 

    let cookieMap = new Map();

    let usernameMatch = false, passwordMatch = false;
>>>>>>> d6ac8411d6e728d4ae35768fb1d84da1da1901d0
    // convert JS cookies to an array [firstname=name, lastname=name] etc
    // and trims the whitespace
    let cookieArray = document.cookie.split(";");
    for (let i = 0; i < cookieArray.length; i++) {
        cookieArray[i] = cookieArray[i].trimStart();
    }

    // converts each array element into a key/value and stores in a map
    cookieArray.forEach(element => {
        let newElement = element.split("=");
<<<<<<< HEAD
        console.log(newElement)
        cookieMap.set(newElement[0], newElement[1])
    });

    if (email === cookieMap.get("email")) {
=======

        cookieMap.set(newElement[0], newElement[1])
    });

    if (email.toLowerCase() === cookieMap.get("email")) {
        usernameMatch = true;
>>>>>>> d6ac8411d6e728d4ae35768fb1d84da1da1901d0
        console.log("Email match");
    }
    if (password === cookieMap.get("password")) {
        console.log("Password match")
<<<<<<< HEAD
=======
        passwordMatch = true;
    } 
    
    if (usernameMatch && passwordMatch) {
        document.cookie = `loggedIn=true; expires=${expiry}; path=/`
        location.href = '../index.php'
    } else {
        const error = document.getElementById("error").innerHTML = 
        "ERROR: Username or password is incorrect. Try again."
>>>>>>> d6ac8411d6e728d4ae35768fb1d84da1da1901d0
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
<<<<<<< HEAD
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
=======
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
>>>>>>> d6ac8411d6e728d4ae35768fb1d84da1da1901d0
