// ----------------------------- load Navbar -----------------------------

function loadNavbar() {
    $.ajax({
        url: 'ajaxHandler.php',
        type: 'POST',
        data: {
            loadNavbarData: "loading"
        },
        success: function (loadNavbarResponse) {
            $('.navbarData').html(loadNavbarResponse);
        },
        error: function () {
            alert("Error");
        }
    });
}