<?php

if(!Illuminate\Support\Facades\App::runningInConsole()) {
    set_local_in_http_env();
}

// Routs
$app->post('/form-contact', 'FormContactController@store');
$app->post('/form-callback', 'FormCallbackController@store');


// Debug mail template:
// $app->get('/email', function() {
//     return view('mail.contact-form', [
//         'name' => 'John Doe',
//         'email' =>'john@doe.com',
//         'message' => 'Macaroon marshmallow halvah marshmallow candy canes apple pie I love. I love wypas gingerbread. Topping ice cream I love gummies jelly I love. I love topping toffee candy pie pastry. I love candy canes chocolate bar halvah pie gummi bears caramels chocolate cake. Cupcake bear claw candy canes cheesecake. Lollipop marshmallow sweet roll jujubes toffee donut wypas candy canes I love. Cupcake jelly beans danish pudding carrot cake bonbon cookie. Sugar plum cupcake muffin icing wafer tiramisu halvah pastry donut. Sweet sweet jelly beans cotton candy. I love cookie sesame snaps gummies carrot cake. Bear claw pie I love liquorice sugar plum I love gummi bears. Chocolate cake pie sugar plum candy canes bonbon chocolate bar candy marzipan. Chocolate I love bonbon carrot cake wafer macaroon faworki.',
//         'image'=> get_wordpress_url() . 'assets/img/logo-mail.png'
//     ]);
// });
