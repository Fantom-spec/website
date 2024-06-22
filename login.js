// JavaScript function to validate the form inputs
function validateForm() {
    var userId = document.getElementById("userid").value;
    var password = document.getElementById("password").value;

    // Check if the userId and password match your criteria (e.g., hardcoded for demo)
    if (userId === "user" && password === "pass") {
        // Redirect to the welcome page if credentials are correct
        window.location.href = "index.html";
        return false; // Prevent the form from submitting
    } else {
        alert("Incorrect username or password. Please try again.");
        return false; // Prevent the form from submitting
    }
}