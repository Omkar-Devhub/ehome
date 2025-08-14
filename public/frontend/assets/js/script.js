// Property Card Swiper
var swiper = new Swiper(".swiper-container", {
    slidesPerView: "auto", // Automatically adjust the number of slides per view
    spaceBetween: 20, // Space between slides
    freeMode: false, // Disable free mode (snap to steps)
    loop: false, // Disable infinite loop
    breakpoints: {
        320: {
            slidesPerView: 1, // Show 1 card on mobile
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 3, // Show 3 cards on tablets
            spaceBetween: 20,
        },
        1024: {
            slidesPerView: 5, // Show 5 cards on desktop
            spaceBetween: 30,
        },
    },
});
// Facility Select 2
$(document).ready(function () {
    $(".select_facility").select2({
        placeholder: "Select Facilities",
        allowClear: true,
    });
});

// Description Editor
// var editor = new Jodit('#property_description');
// Agent Modal
let agent_modal = document.querySelector("#agent-modal");
let agent_details = document.querySelector("#agent-details");
if (agent_details) {
    agent_modal.innerHTML = agent_details.innerHTML;
}
// Dashboard
let dashboard_menu = document.querySelector("#dashboard-menus");
let dashboard_links = document.querySelector("#dashboard-links");
if (dashboard_menu) {
    dashboard_links.innerHTML = dashboard_menu.innerHTML;
}
// Google Map
let street_view_btn = document.querySelector("#street_view");
let satellite_view_btn = document.querySelector("#satellite_view");

// Multi-Step Form
// $(document).ready(function () {
//     // Track the current step (0-indexed)
//     let currentStep = 0;
//     const steps = $(".form-step");
//     const totalSteps = steps.length;

//     // Function to show the specified step and update the progress bar
//     function showStep(step) {
//         steps.removeClass("active");
//         $(steps[step]).addClass("active");
//     }

//     // Next button click handler
//     $(".next-btn").click(function () {
//         // You can add validation here before moving to the next step
//         if (currentStep < totalSteps - 1) {
//             currentStep++;
//             showStep(currentStep);
//         }
//     });

//     // Previous button click handler
//     $(".prev-btn").click(function () {
//         if (currentStep > 0) {
//             currentStep--;
//             showStep(currentStep);
//         }
//     });
// });
