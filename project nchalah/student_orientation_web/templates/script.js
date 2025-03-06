const messages = [
    "Hello Student!",
    "Welcome to the program made by Jasser and Maram to help you in orientation.",
    "Would you like to start?"
];

let currentIndex = 0;
const messageElement = document.getElementById("message");
const buttonGroup = document.getElementById("startButtonGroup");

function showNextMessage() {
    messageElement.classList.add("fade-out");
    setTimeout(() => {
        currentIndex++;
        if (currentIndex < messages.length) {
            messageElement.innerText = messages[currentIndex];
            messageElement.classList.remove("fade-out");
            messageElement.classList.add("fade-in");
        } else {
            messageElement.style.display = "none";
            buttonGroup.style.display = "block";
        }
    }, 2000);
}

setInterval(() => {
    if (currentIndex < messages.length - 1) {
        showNextMessage();
    }
}, 4000);

function startProgram() {
    window.location.href = "/";
}

function exitProgram() {
    alert("Thank you for visiting! Goodbye.");
}
