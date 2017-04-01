AppUpdateNewRegAnchor::class,
AnchorLiveStat::class,
        
// 更新每日观看小时数据的 每小时注册 和 新增主播数据以及峰值
$schedule->command('newRegAnchor hourly')->dailyAt('6:10');

//主播开播数据
$schedule->command('anchorLiveStat')->dailyAt('6:30');
        
        

＃ 自定义Guard
    
    //在控制器中定义guard方法，并返回guard实例
    use Illuminate\Support\Facades\Auth;
    protected function guard(){
        return Auth::guard('customGuard');
    }
    
# 自定义验证和存储

    要修改用户注册所必需的字段存储到数据库，可以修改RegiserController，该类复制为应用验证输入参数和创建新用户
    RegisterController的validator包含了验证规则，可以按需要自定义该方法
    RegisterController的create方法复制在数据库中创建新用户，可以按需要自定义该方法
    
＃ 获取用户认证

    1. 可以通过门面： $user   ＝   Auth::user();
    
    2. 用户通过认证后，可以通过 Illuminate\Http\Request实例访问认证用户：
        <?php
        namespace App\Http\Controller;
        
        use Illuminate\http\Request;
        use Illuminate\Routing\Controller;
        
        class ProfileController extends Controller{
            /**
             * 更新用户属性
             *
             * @param Request $request
             * @return Response
             */
             public function update(Request $request){
                $user = $request->user(); // 返回认证用户实例
             }
        }
        
＃ 判断当前用户是否通过认证
    
    use Illuminate\Support\Facades\Auth;
    
    if(Auth::check()){
        // logged in  验证成功登录
    }
    
＃ 路由保护 

路由中间件可用于只允许通过认证的用户访问给定路由。通过定义在app\Http\Middleware\Authenticate.php 中的auth
中间件来处理。

由于该中间件已经在Http kernel中定义，所以只需要将该中间件加到相应路由即可。

    Route::get('profile', function(){
    
    })->middleware('auth');
    
控制器中调用middleware：
    
    public function __construct(){
        $this->middle('auth')    
    }
    
# 指定 Guard
添加auth中间件到路由后， 需要指定使用哪个guard对应的文件auht.php中guards数组的某个建：

    public function __construct(){
        $this->middle('auth:api');
    }
   
    
# 登录失败次数限制

    可以使用 Illuminate\Foundation\Auth\ThrottlesLogins trait来限制用户登录失败的次数。
    
    默认情况下 用户登录失败后一分钟内不能再登录，这种限制基于用户的用户名／邮箱＋IP地址
    
    