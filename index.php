<?php
include_once"header.php";
require 'vendor/autoload.php';
?>

<div class="main-content">
	<div class="top-content" style="padding-left: 5em; padding-right:5em; ">
		<?php//check if user is logged in/session active here. if so  call home page else display log in info  ?>
		<div class="ui grid">
			<div class="two column row">
				<div class="white column">bllaahhh</div>
				<div class="ui vertical divider"></div>
				<div class="teal column">blueeeee</div>
			</div>
		</div>

	</div>
</div>


<?php ///include_once"footer.php"; ?>

<?php
$app = new \Slim\Slim(array('mode' => 'development',
							'debug' => true
							));

$app->get('/', 'slimTest');

function slimTest(){
	echo "<br><br><br>tets page. App initialized :)";
}
$app->run();
?>

ui two column middle aligned relaxed fitted stackable grid