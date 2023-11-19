// Counter variable.
let resourceCount = 1;
const counter = document.getElementById("counter");

document.getElementById("add-button").onclick = function() {
    // Place DOM elements into variables.
<<<<<<< HEAD
    const pathResources = document.getElementById("given_resources");
=======
    const pathResources = document.getElementById("resources");
>>>>>>> 4860f6b19bd1b203151a7534047a37383004ba0e
    const inputText = document.createElement("input");
    const br = document.createElement("br");

    // Make input type text.
    inputText.type = "text";

    // Resource counter to submit with form (not editable by user).
    counter.setAttribute("value", resourceCount);

    // Add a text input followed by a <br> element each time user clicks "Add".
    for (let i = 0; i < resourceCount; i++) {
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

        if (nameExists) {
            pathResources.appendChild(inputText).setAttribute("id", ("given-resources" + resourceCount));
            pathResources.appendChild(inputText).setAttribute("name", ("given-resources") + resourceCount);
            pathResources.appendChild(br);
        } else {
            pathResources.appendChild(inputText).setAttribute("id", ("given-resources" + resourceCount));
            pathResources.appendChild(inputText).setAttribute("name", ("given-resources" + resourceCount));
>>>>>>> 4860f6b19bd1b203151a7534047a37383004ba0e
            pathResources.appendChild(br);
        }
        return resourceCount++;
    }
}

<<<<<<< HEAD
// Ensuring valid resource url.
const regEx = /^[a-z0-9]+\..[a-z]$/;
=======



>>>>>>> 4860f6b19bd1b203151a7534047a37383004ba0e

