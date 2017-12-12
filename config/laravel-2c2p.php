<?php

return [
    'merchant_id' => 'JT05',
    'secret_key'  => 'B6LkVg5k07yg',

    'private_key_pass' => '2c2p',
    'private_key_path' => storage_path('cert/private.pem'),
    'public_key_path'  => storage_path('cert/public.crt'),

    'redirect_access_url' => 'https://demo2.2c2p.com/2C2PFrontEnd/RedirectV3/payment',

    'access_url'        => 'https://demo2.2c2p.com/2C2PFrontEnd/SecurePayment/PaymentAuth.aspx',
    'secure_pay_script' => 'https://demo2.2c2p.com/2C2PFrontEnd/SecurePayment/api/my2c2p.1.6.6.min.js',

    'currency_code' => 608, // Ref: http://en.wikipedia.org/wiki/ISO_4217
    'country_code'  => 'PH',
    'version' => '7.2',

    //QuickPay
    'direct_api'   => 'http://demo2.2c2p.com/2C2PFrontEnd/QuickPay/DirectAPI',
    'delivery_api' => 'http://demo2.2c2p.com/2C2PFrontEnd/QuickPay/DeliveryAPI',
];
