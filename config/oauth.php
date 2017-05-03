<?php
return [
    'wechat' =>[
        'client_id'     => 'your-app-id',
        'client_secret' => ['your-component-appid', 'your-component-access-token'],
        'redirect'      => 'http://localhost/socialite/callback.php',
    ],
    'qq'    => [
        'client_id'     => '101399580',
        'client_secret' => '4a708965acf149bed6f15115c5884363',
        'redirect'      => 'http://passport.leadjoy.net/api/oauth/callback/qq',
    ],
    'weibo' => [
        'client_id'     => 'your-app-id',
        'client_secret' => 'your-app-secret',
        'redirect'      => 'http://localhost/socialite/callback.php',
    ],
];