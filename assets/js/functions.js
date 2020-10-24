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

function toggleToppingsBtn(index) {
    console.log(document.getElementById("customise_topping_btn_" + index));
    if (document.getElementById("pizza_topping_btn_" + index).style.display == 'block') {
        document.getElementById("pizza_topping_btn_" + index).style.display = 'none';
        document.getElementById("customise_topping_btn_" + index).innerText = 'Add Toppings';
    } else {
        document.getElementById("pizza_topping_btn_" + index).style.display = 'block';
        document.getElementById("customise_topping_btn_" + index).innerText = 'Hide Toppings';
    }
}

function displayPizzaPrice(index) {
    console.log(document.getElementById("pizza_" + index).value);
}
