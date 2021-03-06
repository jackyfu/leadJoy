<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>幸运大奖涂出来</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/assets/lottery/css/base.css">
    <link rel="stylesheet" href="/assets/lottery/css/lottery.css">
    <script type="text/javascript" src="/assets/lottery/js/fontsize.js"></script>
    <script type="text/javascript" src="/assets/lottery/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/assets/lottery/js/jquery.rotate.min.js"></script>
	<script type="text/javascript" src="/assets/lottery/js/lottery.js"></script>
</head>
<body>
	<!-- 转盘区域 -->
	<div class="lottery">		
        <p class="jihui" style="display:none1">你有<span id="num">{{$num}} </span>次抽奖机会</p>
		<div class="choujiang">
	        <img src="/assets/lottery/images/zhuanpan.png">
	            <!--转盘开始-->
	        <a id="plateBtn" href="javascript:" title=""></a>
	            <!--转盘结束-->
	        <div id="lijichou"><img src="/assets/lottery/images/lijichoujiang.png"></div>
			<!--<div class="shadow"><img src="images/zhuanpany.png"></div>-->
	    </div>
<!--
	    <a class="sharebtn">分享再抽一次</a>
	    <div class="zhiyin"><img src="images/zhiyin.png"></div>	
		-->
	</div>
	<!-- 奖品列表 -->
	<div class="prize-list">
	    <div class="prize-info">
	    	<span>手机号</span><span>奖品</span>
	    </div>
	    <div class="maquee">		
			<ul>
				<li>
					<span>133****2015</span> <span>话费50元</span>
				</li>
				<li>
					<span>180****3358</span> <span>话费50元</span>
				</li>
				<li>
					<span>136****9877</span> <span>500M全球流量</span>
				</li>
				<li>
					<span>138****5258</span> <span>精美儿童图书一份</span>
				</li>
				<li>
					<span>188****2397</span> <span>话费50元</span>
				</li>
				<li>
					<span>158****3959</span> <span>话费100元</span>
				</li>						
			</ul>
		</div>
		<div class="prize-title">获奖名单</div>
	</div>
	<!-- 获奖规则 -->
	<div class="prize-rule">
		<div class="prize-title rule-title">活动规则</div>
		<p>1.  本活动仅适用于下载了奇幻画笔涂涂乐的用<br/>
     &nbsp;&nbsp;&nbsp;&nbsp;户参与；</p>
        <p>2.  在活动期间每个用户每日可到微信公众号参
<br/>
     &nbsp;&nbsp;&nbsp;&nbsp;与抽奖1次；<br/>
		 </p>
			     <p>3.  中奖玩家需提供手机号以便客服联系发放奖<br/>
		     &nbsp;&nbsp;&nbsp;&nbsp;品；
		 </p>
			     <p>4.  奖品将在活动结束后五个工作日内统一由官
<br/>
		     &nbsp;&nbsp;&nbsp;&nbsp;方发放；
		 </p>
			     <p>5.  抽奖过程中若遇到手机网络异常情况，请<br/>
		     &nbsp;&nbsp;&nbsp;&nbsp;联系公众号客服处理；
		 </p>
			     <p>6.  本活动与苹果公司无关，最终解释权归悠优<br/>
		     &nbsp;&nbsp;&nbsp;&nbsp;库APP所有（ios显示）
		 </p>
	</div>
	<!-- 弹框内容开始-->
	<div class="dialogbg"></div>
    <!-- 中奖10元弹框 -->
    <div class="prize-diologimg" id="prize-diologsy500">
    	<h2>恭喜中奖啦</h2>
    	<span>获得500M流量</span>
    	<p>赶快去领取奖品吧~</p>
    	<a class="btn" id="getprizewybtn500">去领奖</a>
    </div>
	<!--&lt;!&ndash; 中奖5元弹框 &ndash;&gt;-->
      <div class="prize-diologimg" id="prize-diologsy100">
    	<h2>恭喜中奖啦</h2>
    	<span>获得100元话费</span>
    	<p>赶快去领取奖品吧~</p>
    	<a class="btn" id="getprizewybtn100">去领奖</a>
    </div>
	<!--&lt;!&ndash; 中奖100元话费弹框 &ndash;&gt;-->
     <div class="prize-diologimg" id="prize-diologsy50">
    	<h2>恭喜中奖啦</h2>
    	<span>获得50元话费</span>
    	<p>赶快去领取奖品吧~</p>
    	<a class="btn" id="getprizewybtn50">去领奖</a>
    </div>
	<!--&lt;!&ndash; 中奖50元话费弹框 &ndash;&gt;-->
	<div class="prize-diologimg" id="prize-diologwy">
		<h2>恭喜中奖啦</h2>
		<span>获得精美图书一套</span>
		<p>赶快去领取奖品吧~</p>
		<a class="btn" id="getprizewybtn">去领奖</a>
	</div>
	<!-- 领奖弹框 -->
	<div class="getprize-diolog">
		<p>领奖啦，请填写手机号，客服会和您主动联系~</p>
		<input type="text" id="mobile" placeholder="请输入电话号码">
		<div class="paybtn">
			<a class="btn" id="surebtn">确定</a>
			<a class="btn" id="abandon">不要啦</a>
		</div>
	</div>
	<!--&lt;!&ndash; 未中奖弹框 &ndash;&gt;-->
	<div class="prize-diologimg" id="noprize-diolog">
		<h2>很遗憾</h2>
		<span>没抽中</span>
		<p>送你一个么么哒~</p>
		<a class="btn">朕知道了</a>
	</div>
	<!-- 分享微博微信弹框-->
	<!--<div class="prize-diologimg" id="sharediolog">-->
		<!--<h2>分享到</h2>-->
		<!--<div class="shareimg">-->
		    <!--<a id="blog"   onclick="sendInfoToJava('wb')"><img src="../../../assets/lottery/images/wb.png"></a>-->
			<!--<a id="wechat" onclick="sendInfoToJava('wx')"><img src="../../../assets/lottery/images/wx.png"></a>-->
		<!--</div>-->
		<!--<p class="fxtxt">每天分享到微博和朋友圈，分别可以增加<br/>-->
			<!--一次抽奖机会噢~</p>-->
		<!--<a class="btn" id="cancelbtn">取消</a>-->
	<!--</div>-->
     <!--弹框结束-->
</body>
</html>
