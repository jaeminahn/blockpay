<?php
    $address = $_GET['address'];
    $price = $_GET['price'];
    $link = "https://cubedot.kr/qr/buyer.php?address=".$address."&price=".$price
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="qrcode.min.js"></script>
    <script type="text/javascript">
        window.onload = function() {
            var qrcode = new QRCode(document.getElementById("qrcode"), {
                text: "<?php echo $link ?>",
                width: 250,
                height: 250,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });
            $("#qrcode > img").css({"margin":"auto"});
        }
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="https://cubedot.kr/qr">BlockPay</a>
        </div>
    </nav>

    <div style="text-align:center">
        <div id="qrcode" style="margin-top:20px"></div>
        <br>
        <h6>위 QR코드를 스캔하면 결제됩니다.</h6>
    </div>
</body>
</html>