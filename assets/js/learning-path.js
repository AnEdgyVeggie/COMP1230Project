// Counter variable.
let resourceCount;
let edit = document.getElementById("edit").value;

console.log(edit);
if (edit == 'false') {
    resourceCount = 2;
} else {
    resourceCount = parseInt(document.getElementById("counter").value);
}


const counter = document.getElementById("counter");

document.getElementById("add-button").onclick = function() {
    // Place DOM elements into variables.
    const pathResources = document.getElementById("append");
    const inputText = document.createElement("input");
    const br = document.createElement("br");

    // Make input type text.
    inputText.type = "text";

    // Resource counter to submit with form (not editable by user).
    counter.setAttribute("value", resourceCount);

    // Add a text input followed by a <br> element each time user clicks "Add".
    for (let i = 0; i < resourceCount; i++) {
        let nameExists = document.getElementById("given_resources" + resourceCount);
        let counterUp = resourceCount + 1;

        if (nameExists) {
            pathResources.appendChild(inputText).setAttribute("id", ("given_resources" + counterUp));
            pathResources.appendChild(inputText).setAttribute("name", ("given_resources" + counterUp));
            pathResources.appendChild(br);
        } else {
            pathResources.appendChild(inputText).setAttribute("id", ("given_resources" + resourceCount));
            pathResources.appendChild(inputText).setAttribute("name", ("given_resources" + resourceCount));
            pathResources.appendChild(br);
        }
        console.log(resourceCount)
        return resourceCount++;
    }
}

// Ensuring valid resource url.
const regEx = /^[a-z0-9]+\..[a-z]$/;
