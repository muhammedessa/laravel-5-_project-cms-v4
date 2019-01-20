<?php



// return array(
//     "driver" => "smtp",
//     "host" => "smtp.mailtrap.io",
//     "port" => 2525,
//     "from" => array(
//         "address" => "from@example.com",
//         "name" => "Example"
//     ),
//     "username" => "b445364fa8f3dc",
//     "password" => "555d3739b7880b",
//     "sendmail" => "/usr/sbin/sendmail -bs",
//     "pretend" => false
//   );

// MAIL_DRIVER=smtp
// MAIL_HOST=smtp.mailtrap.io
// MAIL_PORT=2525
// MAIL_USERNAME=b445364fa8f3dc
// MAIL_PASSWORD=555d3739b7880b
// MAIL_ENCRYPTION=tls

// end mailtrap config

  





// MAIL_DRIVER=smtp
// MAIL_HOST=smtp.sendgrid.net
// MAIL_PORT=587
// MAIL_USERNAME=muhammed.essa@codeforiraq.org
// MAIL_PASSWORD=Muhammed1984
// MAIL_ENCRYPTION=tls
// MAIL_FROM_NAME="muhammed essa"
// MAIL_FROM_ADDRESS='muhammed.essa@codeforiraq.org'

 






return [
 

    'driver' => env('MAIL_DRIVER', 'smtp'),
    'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
    'port' => env('MAIL_PORT', 587),
 
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],
 
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
 
    'username' => env('MAIL_USERNAME'),

    'password' => env('MAIL_PASSWORD'),
 
    'sendmail' => '/usr/sbin/sendmail -bs',
 
    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

    'log_channel' => env('MAIL_LOG_CHANNEL'),

];
