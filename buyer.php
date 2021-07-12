<?php
    $address = $_GET['address'];
    $price = $_GET['price'];
?>
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
                    address = accounts[0];

                    document.getElementById('from').value = address;
                    
                    var wei, balance;
                    try { web3.eth.getBalance(address, function (error, wei) { 
                        if (!error) { 
                            var balance = web3.utils.fromWei(wei, 'ether'); 
                            document.getElementById("wallet").innerHTML = balance + " ETH";

                            balance_after = balance - parseFloat(<?php echo $price ?>)
                            document.getElementById("wallet_after").innerHTML = balance_after + " ETH"

                            if (balance_after >= 0) {
                                document.getElementById('pay').disabled = false;
                            }
                        } 
                        }); 
                    } catch (err) { 
                        document.getElementById("wallet").innerHTML = err; 
                    }
                    return true;
                }
                return false;
            })
            $(document).ready(function() {
                $('#pay').click(function() {
				    var _from = $('#from').val();
			        var _to = $('#to').val();
				    var _Amount = $('#priceETH').val();
				    var txnObject = {
					    "from":_from,
					    "to": _to,
					    "value": web3.utils.toWei(_Amount,'ether'),
				    }
				    web3.eth.sendTransaction(txnObject, function(error, result){
					    if(error){
						    alert("결제에 실패하였습니다.")
					    }
					    else{
                            alert("결제에 성공하였습니다.")
					    }
				    });
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
            <h4 class="alert-heading">결제 페이지</h4>
            <p class="mb-0">결제 정보가 정확한지 확인해주세요.</p>
        </div>

        <div class="form-group" style="margin: 20px 5px">
            <label class="form-label" for="from">나의 지갑 주소</label>
            <input type="text" class="form-control" id="from" placeholder="주소"> 
        </div>

        <div class="form-group" style="margin: 20px 5px">
            <label class="form-label" for="to">판매자의 지갑 주소</label>
            <input type="text" class="form-control" id="to" placeholder="주소" value="<?php echo $address ?>" readonly> 
        </div>

        <div class="form-group" style="margin: 20px 5px">
            <label class="form-label">결제 금액</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="priceETH" value="<?php echo $price ?>" readonly>
                <span class="input-group-text">ETH</span>
            </div>
        </div>

        <div class="alert alert-dismissible alert-light" style="margin: 20px 5px; padding:10px 0px!important">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center" style="border:0px solid!important; background-color:transparent!important">
                    결제 전 잔고
                    <span class="badge bg-warning rounded-pill" id="wallet"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center" style="border:0px solid!important; background-color:transparent!important">
                    가격
                    <span class="badge bg-warning rounded-pill"><?php echo $price ?> ETH</span>
                </li>
                <hr style="margin: 10px 5px">
                <li class="list-group-item d-flex justify-content-between align-items-center" style="border:0px solid!important; background-color:transparent!important">
                    결제 후 잔고
                    <span class="badge bg-warning rounded-pill" id="wallet_after"></span>
                </li>
            </ul>
        </div>

        <div class="form-group" style="text-align:center">
            <button type="submit" class="btn btn-primary btn-lg" id="pay" disabled>결제</button>
        </div>

    </body>
</html>