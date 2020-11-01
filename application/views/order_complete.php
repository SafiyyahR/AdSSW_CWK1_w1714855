<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">

<body class="text-white" onload="increaseHeight()" onresize="increaseHeight()">
    <div class="py-5 text-center text-white mx-auto px-2" id="custom_content">
        <h2 class="custom-heading my-5">Given the current timezone <?php echo $data['current_timezone'] ?>.</h1>
            <h2 class="my-5"> Your food will be delivered by <?php echo  $data['data_time'] ?>.</h2>
            <h3 class="custom-heading my-5">
                Make another
                <span>
                    <a href="<?php echo  base_url() ?>index.php/order" class="text-white">
                        <u>order</u>
                    </a>
                </span>
            </h3>
    </div>
</body>