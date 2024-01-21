// ================== Sidebar Toggle ==================

// $(document).ready(function () {
//     var $el = $('#wrapper');
//     var $toggleButton = $('#menu-toggle');

//     $toggleButton.on('click', function () {
//         $el.toggleClass('toggled');
//     });
// });


const el = document.querySelector('#wrapper');
const toggleButton = document.querySelector('#menu-toggle');

toggleButton.addEventListener('click', function () {
    el.classList.toggle('toggled');
});

// ================== Sidebar Toggle ==================
