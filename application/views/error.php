<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">

<body class="text-white" onload="increaseHeight()" onresize="increaseHeight()">
    <div class="py-5 text-center text-white mx-auto px-2" id="custom_content">
        <h1 class="custom-heading my-5">OOPS</h1>
        <h2 class="my-5"> <?php echo  $err_message ?></h2>
        <h3 class="custom-heading my-5">
            Go back to the
            <span>
                <a href="<?php echo  base_url() ?>" class="text-white">
                    <u>home page</u>
                </a>
            </span>
        </h3>
    </div>
</body>
</html>