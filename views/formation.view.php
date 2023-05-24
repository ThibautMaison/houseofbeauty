<?php
ob_start();
?>

<div id="intro" class="text-center bg-image shadow-1-strong vh-100">
    <div class="mask text-center">
        <div class="d-flex justify-content-center align-items-center h-75">
            <div class="text-wdark pt-4">
                <h1 class="mb-3">Coming Soon!</h1>

                <!-- Time Counter -->

                <p>We're working hard to finish the development of this webpage.</p>
            </div>
        </div>
    </div>
</div>


<?php
$content = ob_get_clean();
require "template.php";
?>