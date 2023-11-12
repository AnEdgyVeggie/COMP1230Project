const register = (firstName, lastName, email, password, confirmPass) => {


    if (password !== confirmPass) {
        return;
    }

    document.cookie = "firstName=" + firstName;
    document.cookie = "lastName=" + lastName;
    document.cookie = "email=" + email;
    document.cookie = "password=" + password;
    document.cookie = "confirmPass=" + confirmPass;
    console.log(document.cookie);
}

const login = (email, password) => {
    // if (email === document.cookie["email"] &&)
    console.log(document.cookie);
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
        document.getElementById("email").value;
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