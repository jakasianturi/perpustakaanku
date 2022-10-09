// Navbar Scroll Effect
document.addEventListener("DOMContentLoaded", function () {
    let fixedNav = document.querySelector("#fixed-nav");
    // Window Scrolled
    window.addEventListener("scroll", function () {
        if (window.scrollY > 150) {
            fixedNav.classList.add("fixed-top");
            navbar_height = fixedNav.offsetHeight;
            document.body.style.paddingTop = navbar_height + "px";
        } else {
            fixedNav.classList.remove("fixed-top");
            document.body.style.paddingTop = "0";
        }
    });
});
