<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
        <script type="text/javascript" src="jquery.min.js"></script>
        <script type="text/javascript">
            window.addEventListener('load', async() => {
                if (web3) {
                    web3 = new Web3(web3.currentProvider);
                    ethereum.enable();

                    var address;
                    const accounts = await web3.eth.requestAccounts();
                    address = accounts[0]

                    document.getElementById('wallet').value = address

                    return true;
                }
                return false;
            })
            $(document).ready(function() {
                $('#convert').click(function() {
                    $.ajax({ url: "https://api.coingecko.com/api/v3/simple/price?ids=ethereum&vs_currencies=krw", dataType: "text", success: function(result){ 
                        result = JSON.parse(result).ethereum;
                        var cap = parseFloat(result.krw);
                        document.getElementById('priceETH').value = Math.ceil((parseInt(document.getElementById('priceKRW').value) / cap) * 100000000) / 100000000;
                    }});
                    document.getElementById('generate').disabled = false;
                });
            });
        </script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="https://cubedot.kr/qr">BlockPay</a>
            </div>
        </nav>

        <div class="alert alert-dismissible alert-warning" style="margin: 20px 5px">
            <h4 class="alert-heading">판매자 페이지</h4>
            <p class="mb-0">판매자의 지갑 주소가 정확한지 확인해주세요.</p>
        </div>

        <form method="get" action="seller.php">
            <div class="form-group" style="margin: 20px 5px">
                <label class="form-label" for="wallet">나의 지갑 주소</label>
                <input type="text" class="form-control" id="wallet" placeholder="주소" name="address"> 
            </div>

            <div class="form-group" style="margin: 20px 5px">
                <label class="form-label">받을 금액</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="priceKRW" aria-label="가격">
                    <span class="input-group-text">원</span>
                </div>
            </div>

            <div class="form-group" style="text-align:center">
                <button type="button" class="btn btn-secondary btn" id="convert">단위 변환</button>
            </div>

            <div class="form-group" style="margin: 20px 5px">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="priceETH" name="price" readonly>
                    <span class="input-group-text">ETH</span>
                </div>
            </div>

            <div class="form-group" style="text-align:center">
                <button type="submit" class="btn btn-primary btn-lg" id="generate" disabled>QR 생성</button>
            </div>
        </form>
    </body>
</html>