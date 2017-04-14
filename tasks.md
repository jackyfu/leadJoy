lottery:
    router/web.php
    resource/views/lottery/index.blade.php
    app/Models/Lottery.php
    app/Http/Controller/LotteryController.php
    
＃＃＃＃＃＃ laravel  environment

    //当前环境是否是参数中的环境
    App::environment('local');
    App::environment('local', 'staging');
    
    //当前环境
    App::environment();
    app()->environment();

    //读取.env中的配置，如果没有就使用第二个参数作为默认值 
    env('APP_DEBUG', false);
    
    生成系统的所有缓存到当个文件，提升速度
    php artisan config:cache

