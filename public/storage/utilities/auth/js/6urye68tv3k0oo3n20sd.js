// Preloader
$(window).on('load', function () {
	$('.lds-ellipsis').fadeOut(); // will first fade out the loading animation
	$('.preloader').delay(333).fadeOut('slow'); // will fade out the white DIV that covers the website.
	$('body').delay(333);
});

document.addEventListener("DOMContentLoaded", function () {
    const submitButton = document.getElementById("submit");
    const loader = document.getElementById("loader");
    const form = document.getElementById("authentication");
    submitButton.addEventListener("click", function () {
        // Check if input fields are filled
        const inputs = form.querySelectorAll("input");
        let allFilled = true;

        inputs.forEach(function (input) {
            if (input.value.trim() === "") {
                allFilled = false;
            }
        });
        if (allFilled) {
            // Change button style to spinner loader
            submitButton.innerHTML = 'Just a moment <i class="icofont-spinner-alt-2 icofont-spin"></i>';
            // Display the loader for 5 seconds before submitting
            loader.style.visibility = "visible";
            loader.style.opacity = "1";

            setTimeout(function () {
                // Submit the form
                form.submit();
            }, 500000); // 5 seconds
        } else {
            console.log("ERROR: Please fill in all input fields.");
        }
    });
});

// function fadeOut(element, duration) {
//     let opacity = 1;
//     const interval = 50;
//     const steps = duration / interval;
//     const deltaOpacity = 1 / steps;
//     const fadingInterval = setInterval(() => {
//         opacity -= deltaOpacity;
//         element.style.opacity = opacity;
//         if (opacity <= 0) {
//             clearInterval(fadingInterval);
//             element.style.display = 'none';
//         }
//     }, interval);
// }
document.getElementById('dismiss').addEventListener('click', function () {
    document.getElementById('wrapper').style.display = 'none';
});
// setTimeout(() => {
//     const wrapper = document.getElementById('wrapper');
//     if (wrapper.style.display !== 'none') {
//         fadeOut(wrapper, 500);
//     }
// }, 5000);
