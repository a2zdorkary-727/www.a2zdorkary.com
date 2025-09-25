<?php 
$host = "localhost";
$user = "root";
$pass = "";
$db   = "robotics_shop";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT * FROM robotics_shop_product WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    echo "Product not found!";
    exit;
}
?>

<?php include("header.php"); ?>

<div class="product-details content" itemscope itemtype="http://schema.org/Product">
    <meta itemprop="sku" content="50101">
    <div class="product-details-summary">
        <div class="container">
            <div class="basic row">
                <!-- Left Side Images -->
                <div class="col-md-5 left">
                    <div class="images product-images">
                        <div class="product-img-holder">
                            <a class="thumbnail" href="https://www.a2zdorkary.com/product-image/arduino/arduino-uno-r3-500x500.webp" title="Arduino Uno R3 Microcontroller Board">
                                <img class="main-img" src="https://www.a2zdorkary.com/product-image/arduino/arduino-uno-r3-500x500.webp" alt="Arduino Uno R3 Microcontroller Board" width="500" height="500"/>
                            </a>
                        </div>
                        <ul class="thumbnails">
                            <li><a class="thumbnail" href="https://www.a2zdorkary.com/product-image/arduino/arduino-uno-r3-front-500x500.webp" title="Arduino Uno R3 Front"><img src="https://www.a2zdorkary.com/product-image/arduino/arduino-uno-r3-front-74x74.webp" alt="Arduino Uno R3 Front" width="74" height="74"/></a></li>
                            <li><a class="thumbnail" href="https://www.a2zdorkary.com/product-image/arduino/arduino-uno-r3-back-500x500.webp" title="Arduino Uno R3 Back"><img src="https://www.a2zdorkary.com/product-image/arduino/arduino-uno-r3-back-74x74.webp" alt="Arduino Uno R3 Back" width="74" height="74"/></a></li>
                        </ul>
                    </div>
                </div>

                <!-- Right Side Info -->
                <div class="col-md-7 right" id="product">
                    <div class="pd-summary">
                        <div class="product-short-info">
                            <h1 itemprop="name" class="product-name">Arduino Uno R3 Microcontroller Board</h1>
                            <table class="product-info-table">
                                <tr class="product-info-group">
                                    <td class="product-info-label">Price</td>
                                    <td class="product-info-data product-price">950৳</td>
                                </tr>
                                <tr class="product-info-group">
                                    <td class="product-info-label">Regular Price</td>
                                    <td class="product-info-data product-regular-price">1,050৳</td>
                                </tr>
                                <tr class="product-info-group">
                                    <td class="product-info-label">Status</td>
                                    <td class="product-info-data product-status">In Stock</td>
                                </tr>
                                <tr class="product-info-group">
                                    <td class="product-info-label">Product Code</td>
                                    <td class="product-info-data product-code">50101</td>
                                </tr>
                                <tr class="product-info-group" itemprop="brand" itemscope itemtype="http://schema.org/Thing">
                                    <td class="product-info-label">Brand</td>
                                    <td class="product-info-data product-brand" itemprop="name">Arduino</td>
                                </tr>
                            </table>
                        </div>

                        <div class="short-description">
                            <h2>Key Features</h2>
                            <ul>
                                <li>Model: Arduino Uno R3</li>
                                <li>Microcontroller: ATmega328P</li>
                                <li>Operating Voltage: 5V</li>
                                <li>Digital I/O Pins: 14 (6 PWM output)</li>
                                <li>Analog Input Pins: 6</li>
                                <li>Flash Memory: 32 KB</li>
                                <li>SRAM: 2 KB, EEPROM: 1 KB</li>
                                <li>Clock Speed: 16 MHz</li>
                                <li class="view-more" data-area="specification" style="cursor:pointer;color:#007bff;">View More Info</li>
                            </ul>
                        </div>

                        <div class="cart-option">
                            <label class="quantity">
                                <span class="ctl"><i class="material-icons">remove</i></span>
                                <span class="qty"><input type="text" name="quantity" id="input-quantity" value="1" size="2"></span>
                                <span class="ctl increment"><i class="material-icons">add</i></span>
                                <input type="hidden" name="product_id" value="50101" />
                            </label>
                            <button id="button-cart" class="btn submit-btn" data-loading-text="Loading...">Buy Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>

<!-- Specification Section -->
<div id="specification" class="product-specification" style="display:none; margin:30px auto; width:80%;">
    <h2>Specification</h2>
    <table border="1" cellspacing="0" cellpadding="8" width="100%">
        <tr><td>Model</td><td>Arduino Uno R3</td></tr>
        <tr><td>Microcontroller</td><td>ATmega328P</td></tr>
        <tr><td>Operating Voltage</td><td>5V</td></tr>
        <tr><td>Digital I/O Pins</td><td>14 (6 PWM)</td></tr>
        <tr><td>Analog Input Pins</td><td>6</td></tr>
        <tr><td>Flash Memory</td><td>32 KB</td></tr>
        <tr><td>SRAM</td><td>2 KB</td></tr>
        <tr><td>EEPROM</td><td>1 KB</td></tr>
        <tr><td>Clock Speed</td><td>16 MHz</td></tr>
    </table>
</div>

<!-- Toggle Script -->
<script>
document.addEventListener("DOMContentLoaded", function(){
    document.querySelectorAll(".view-more").forEach(function(btn){
        btn.addEventListener("click", function(){
            var target = document.getElementById(btn.dataset.area);
            if(target.style.display === "none"){
                target.style.display = "block";
                btn.innerText = "Hide Info";
            } else {
                target.style.display = "none";
                btn.innerText = "View More Info";
            }
        });
    });
});
</script>

<?php include("footer.php"); ?>
