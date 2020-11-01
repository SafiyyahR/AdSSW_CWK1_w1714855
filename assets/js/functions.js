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

function toggleChooseOptionBtn(btn_id, div_id) {
    console.log(document.getElementById(div_id));
    if (document.getElementById(div_id).style.display == 'block') {
        document.getElementById(div_id).style.display = 'none';
        document.getElementById(btn_id).innerText = 'Choose Option';
    } else {
        document.getElementById(div_id).style.display = 'block';
        document.getElementById(btn_id).innerText = 'Hide Options';
    }
}

function displayPizzaPrice(index) {
    console.log(document.getElementById("pizza_" + index).value);
}

function increaseHeight() {
    console.log(window.innerHeight);
    console.log(document.getElementById('custom_content').offsetHeight);
    console.log(window.innerHeight - 150);
    if ((document.getElementById('custom_content').offsetHeight + 150) < window.innerHeight) {
        document.getElementById('custom_content').style.height = window.innerHeight - 102;
    } else {
        document.getElementById('custom_content').style.minHeight = window.innerHeight - 102;
    }

    var x = document.getElementsByClassName("choose_options_div");
    var i;
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
}
