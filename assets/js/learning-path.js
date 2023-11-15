// Counter variable.
let resourceCount = 1;
const counter = document.getElementById("counter");

document.getElementById("add-button").onclick = function() {
    // Place DOM elements into variables.
    const pathResources = document.getElementById("resources");
    const inputText = document.createElement("input");
    const br = document.createElement("br");

    // Make input type text.
    inputText.type = "text";

    // Resource counter to submit with form (not editable by user).
    counter.setAttribute("value", resourceCount);

    // Add a text input followed by a <br> element each time user clicks "Add".
    for (let i = 0; i < resourceCount; i++) {
        let nameExists = document.getElementById("given-resources" + resourceCount);

        if (nameExists) {
            pathResources.appendChild(inputText).setAttribute("id", ("given-resources" + resourceCount));
            pathResources.appendChild(inputText).setAttribute("name", ("given-resources") + resourceCount);
            pathResources.appendChild(br);
        } else {
            pathResources.appendChild(inputText).setAttribute("id", ("given-resources" + resourceCount));
            pathResources.appendChild(inputText).setAttribute("name", ("given-resources" + resourceCount));
            pathResources.appendChild(br);
        }
        return resourceCount++;
    }
}

// Ensuring valid resource url.
const regEx = /^[a-z0-9]+\..[a-z]$/;

