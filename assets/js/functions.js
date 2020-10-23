window.addEventListener("scroll", this.changeNavBarBg);

function changeNavBarBg() {
    // var height = document.getElementById("header-custom").clientHeight;
    // height = height - 50;
    if (
        document.body.scrollTop > 50 ||
        document.documentElement.scrollTop > 50
    ) {
        document.getElementById("navbar-custom").style.backgroundColor =
            "#212529";
        document.getElementById("scroll-to-top-custom").style.display = "block";
    } else {
        document.getElementById("navbar-custom").style.backgroundColor =
            "transparent";
        document.getElementById("scroll-to-top-custom").style.display = "none";
    }
}

function backToTop() {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
}