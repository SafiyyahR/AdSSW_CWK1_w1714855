<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">


<body onload="increaseHeight()" onresize="increaseHeight()">
	<div class="container w-100 text-white" id="custom-content">
		<div class="row w-100">
			<h1 class="text-center w-100">MENU</h1>
		</div>
		<div>
			<ul class="nav justify-content-center h4">
				<li class="nav-item">
					<a class="nav-link" href="#pizza">Pizza</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#toppings">Toppings</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#sides">Sides</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#drinks">Drinks</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#deals">Deals</a>
				</li>
			</ul>
		</div>
		<div class="row mt-3">
			<div class="col-4 p-0 col-md-6">
				<h2 class="text-warning border-bottom border-warning border-medium" id="pizza">Pizza</h2>
			</div>
		</div>
		<div class="row w-100 mb-3">
			<div class="col-3 col-md-6"></div>
			<div class="col-3 p-0 col-md-2">
				<h3 class="text-warning text-right ">S</h3>
			</div>
			<div class="col-3 p-0 col-md-2">
				<h3 class="text-warning text-right">M</h3>
			</div>
			<div class="col-3 p-0 col-md-2">
				<h3 class="text-warning text-right">L</h3>
			</div>
		</div>
		<?php
		for ($i = 0; $i < count($data['pizza']); $i++) {
			$pizza_data = $data['pizza'][$i];
			echo '<div class="row border-bottom border-warning w-100">';
			echo '<div class="col-3 col-md-6 p-0">';
			echo '<div class="row">';
			echo '<h5 class="heading">' . $pizza_data['pizza_name'] . '</h5>';
			echo '</div>';
			echo '</div>';
			echo '<div class="col-3 p-0 col-md-2">';
			echo '<h5 class=" text-right">&#163;' . $pizza_data['pizza_pr_small'] . '</h5>';
			echo '</div>';
			echo '<div class="col-3 p-0 col-md-2">';
			echo '<h5 class=" text-right">&#163;' . $pizza_data['pizza_pr_medium'] . '</h5>';
			echo '</div>';
			echo '<div class="col-3 p-0 col-md-2">';
			echo '<h5 class=" text-right">&#163;' . $pizza_data['pizza_pr_large'] . '</h5>';
			echo '</div>';
			echo '</div>';
			echo '<div class="row w-100 mb-3"><h6>' . $pizza_data['pizza_description'] . '</h6></div>';
		}
		?>
		<div class="row mt-3">
			<div class="col-6 p-0">
				<h2 class="text-warning border-bottom border-warning border-medium" id="toppings">Toppings</h2>
			</div>
		</div>
		<div class="row w-100 mb-3">
			<div class="col-3 col-md-6"></div>
			<div class="col-3 p-0 col-md-2">
				<h3 class="text-warning text-right ">S</h3>
			</div>
			<div class="col-3 p-0 col-md-2">
				<h3 class="text-warning text-right">M</h3>
			</div>
			<div class="col-3 p-0 col-md-2">
				<h3 class="text-warning text-right">L</h3>
			</div>
		</div>
		<?php
		for ($i = 0; $i < count($data['toppings']); $i++) {
			$topping_data = $data['toppings'][$i];
			echo '<div class="row border-bottom border-warning w-100 mb-3">';
			echo '<div class="col-3 col-md-6 p-0">';
			echo '<div class="row ">';
			echo '<h5 >' . $topping_data['topping_name'] . '</h5>';
			echo '</div>';
			echo '</div>';
			echo '<div class="col-3 p-0 col-md-2">';
			echo '<h5 class=" text-right">&#163;' . $topping_data['topping_pr_small'] . '</h5>';
			echo '</div>';
			echo '<div class="col-3 p-0 col-md-2">';
			echo '<h5 class=" text-right">&#163;' . $topping_data['topping_pr_medium'] . '</h5>';
			echo '</div>';
			echo '<div class="col-3 p-0 col-md-2">';
			echo '<h5 class=" text-right">&#163;' . $topping_data['topping_pr_large'] . '</h5>';
			echo '</div>';
			echo '</div>';
		} ?>
		<div class="row mt-4">
			<div class="col-8 p-0">
				<h2 class="text-warning border-bottom border-warning border-medium" id="sides">Sides</h2>
			</div>
		</div>
		<div class="row w-100 mb-3">
			<div class="col-8"></div>
			<div class="col-4 p-0">
				<h3 class="text-warning text-right ">Price</h3>
			</div>
		</div>
		<?php
		for ($i = 0; $i < count($data['sides']); $i++) {
			$side_data = $data['sides'][$i];
			echo '<div class="row border-bottom border-warning w-100 mb-3">';
			echo '<div class="col-8 p-0">';
			echo '<div class="row"><h5 >' . $side_data['side_name'] . '</h5></div></div>';
			echo '<div class="col-4 p-0">';
			echo '<h5 class="text-right">&#163;' . $side_data['side_price'] . '</h5></div>';
			echo '</div>';
		}
		?>
		<div class="row mt-4">
			<div class="col-8 p-0">
				<h2 class="text-warning border-bottom border-warning border-medium" id="drinks">Drinks</h2>
			</div>
		</div>
		<div class="row w-100 mb-3">
			<div class="col-8"></div>
			<div class="col-4 p-0">
				<h3 class="text-warning text-right ">Price</h3>
			</div>
		</div>
		<?php
		for ($i = 0; $i < count($data['drinks']); $i++) {
			$drink_data = $data['drinks'][$i];
			echo '<div class="row border-bottom border-warning w-100 mb-3">';
			echo '<div class="col-8 p-0">';
			echo '<div class="row"><h5 >' . $drink_data['drink_name'] . '</h5></div></div>';
			echo '<div class="col-4 p-0">';
			echo '<h5 class="text-right">&#163;' . $drink_data['drink_price'] . '</h5></div>';
			echo '</div>';
		}
		?>
		<div class="row mt-4">
			<div class="col-8 p-0 col-md-6">
				<h2 class="text-warning border-bottom border-warning border-medium" id="deals">Combo Meal Deals</h2>
			</div>
		</div>
		<div class="row w-100 mb-3">
			<div class="col-8 col-md-6"></div>
			<div class="col-4 p-0 col-md-6">
				<h3 class="text-warning text-right ">Price</h3>
			</div>
		</div>
		<?php
		for ($i = 0; $i < count($data['combo_meals']); $i++) {
			$cm_data = $data['combo_meals'][$i];
			echo '<div class="row border-bottom border-warning w-100">';
			echo '<div class="col-6 p-0">';
			echo '<div class="row ">';
			echo '<h5 >' . $cm_data['cm_name'] . '</h5>';
			echo '</div>';
			echo '</div>';
			echo '<div class="col-6 p-0">';
			echo '<h5 class="text-right">&#163;' . $cm_data['cm_price'] . '</h5>';
			echo '</div>';
			echo '</div>';
			echo '<div class="row w-100 mb-3"><h6>' . $cm_data['cm_description'] . '</h6></div>';
		} ?>
	</div>
</body>

</html>