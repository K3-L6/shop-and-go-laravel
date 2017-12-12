@extends('layouts.app')
@section('content')
<?php 
    //Merchant's account information
    $merchant_id = "JT01";          //Get MerchantID when opening account with 2C2P
    $secret_key = "7jYcp4FxFdf0";   //Get SecretKey from 2C2P PGW Dashboard


    //Transaction information
    $payment_description  = 'Purchase From Techshop 28';
    $order_id  = $order->id;
    $currency = "608";
    $amount  = str_pad($order->total , 10, '0', STR_PAD_LEFT) . '00';
    
// You will be leaving the site temporarily. You will will be forwarded to 2c2p payment page for credit card. Click Proceed.

    //Request information
    $version = "7.2";   
    $payment_url = "https://demo2.2c2p.com/2C2PFrontEnd/RedirectV3/payment";
    $result_url_1 = "http://localhost/2c2p/result.php";
    
    //Construct signature string
    $params = $version.$merchant_id.$payment_description.$order_id.$currency.$amount.$result_url_1;
    $hash_value = hash_hmac('sha1',$params, $secret_key,false); //Compute hash value
    
    
    echo '<html> 
    <body>
    <div class = "container text-center" style="margin-top:2%;">
        <div class="jumbotron">
            <h2>You will be leaving the site temporarily. You will will be forwarded to 2c2p payment page for credit card. Click Proceed.</h2>
            <form id="myform" method="post" action="'.$payment_url.'">
                <input type="hidden" name="version" value="'.$version.'"/>
                <input type="hidden" name="merchant_id" value="'.$merchant_id.'"/>
                <input type="hidden" name="currency" value="'.$currency.'"/>
                <input type="hidden" name="result_url_1" value="'.$result_url_1.'"/>
                <input type="hidden" name="hash_value" value="'.$hash_value.'"/>
                <input type="hidden" name="payment_description" value="'.$payment_description.'"  readonly/><br/>
                <input type="hidden" name="order_id" value="'.$order_id.'"  readonly/><br/>
                <input type="hidden" name="amount" value="'.$amount.'" readonly/><br/>
                <input type="submit" name="submit" class="btn btn-warning btn-lg" value="Proceed" />
            </form>  
        </div>
    </div>
    
    <script type="text/javascript">
        document.forms.myform.submit();
    </script>
    </body>
    </html>';    
?>
@endsection