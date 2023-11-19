// Counter variable.
let resourceCount = 1;
const counter = document.getElementById("counter");

document.getElementById("add-button").onclick = function() {
    // Place DOM elements into variables.
<<<<<<< HEAD
<<<<<<< HEAD
    const pathResources = document.getElementById("given_resources");
=======
    const pathResources = document.getElementById("resources");
>>>>>>> 4860f6b19bd1b203151a7534047a37383004ba0e
=======
    const pathResources = document.getElementById("given_resources");
>>>>>>> d6ac8411d6e728d4ae35768fb1d84da1da1901d0
    const inputText = document.createElement("input");
    const br = document.createElement("br");

    // Make input type text.
    inputText.type = "text";

    // Resource counter to submit with form (not editable by user).
    counter.setAttribute("value", resourceCount);

    // Add a text input followed by a <br> element each time user clicks "Add".
    for (let i = 0; i < resourceCount; i++) {
<<<<<<< HEAD
<<<<<<< HEAD
        let nameExists = document.getElementById("given_resources" + resourceCount);

        if (nameExists) {
            pathResources.appendChild(inputText).setAttribute("id", ("given_resources" + resourceCount));
            pathResources.appendChild(inputText).setAttribute("name", ("given_resources" + resourceCount));
            pathResources.appendChild(br);
        } else {
            pathResources.appendChild(inputText).setAttribute("id", ("given_resources" + resourceCount));
            pathResources.appendChild(inputText).setAttribute("name", ("given_resources" + resourceCount));
=======
        let nameExists = document.getElementById("given-resources" + resourceCount);
=======
        let nameExists = document.getElementById("given_resources" + resourceCount);
>>>>>>> d6ac8411d6e728d4ae35768fb1d84da1da1901d0

        if (nameExists) {
            pathResources.appendChild(inputText).setAttribute("id", ("given_resources" + resourceCount));
            pathResources.appendChild(inputText).setAttribute("name", ("given_resources" + resourceCount));
            pathResources.appendChild(br);
        } else {
<<<<<<< HEAD
            pathResources.appendChild(inputText).setAttribute("id", ("given-resources" + resourceCount));
            pathResources.appendChild(inputText).setAttribute("name", ("given-resources" + resourceCount));
>>>>>>> 4860f6b19bd1b203151a7534047a37383004ba0e
=======
            pathResources.appendChild(inputText).setAttribute("id", ("given_resources" + resourceCount));
            pathResources.appendChild(inputText).setAttribute("name", ("given_resources" + resourceCount));
>>>>>>> d6ac8411d6e728d4ae35768fb1d84da1da1901d0
            pathResources.appendChild(br);
        }
        return resourceCount++;
    }
}

<<<<<<< HEAD
<<<<<<< HEAD
// Ensuring valid resource url.
const regEx = /^[a-z0-9]+\..[a-z]$/;
=======



>>>>>>> 4860f6b19bd1b203151a7534047a37383004ba0e
=======
// Ensuring valid resource url.
const regEx = /^[a-z0-9]+\..[a-z]$/;
>>>>>>> d6ac8411d6e728d4ae35768fb1d84da1da1901d0

