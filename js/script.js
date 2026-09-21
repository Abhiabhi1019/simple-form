const form = document.getElementById("registrationForm");
const result = document.getElementById("result");

form.addEventListener("submit", async function (event) {

    event.preventDefault();

    const formData = new FormData(form);

    try {

        const response = await fetch("api/submit.php", {
            method: "POST",
            body: formData
        });

        const data = await response.json();

        result.textContent = data.message;

        if (data.success) {
            form.reset();
        }

    } catch (error) {

        result.textContent = "Something went wrong.";

    }

});
