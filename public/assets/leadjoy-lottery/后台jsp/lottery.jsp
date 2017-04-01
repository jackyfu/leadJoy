<%@page contentType="text/html;charset=GBK"%>
<%@page import="java.lang.*"%>
<%@ page language="java" import="java.sql.*"%>
<%@ page language="java" import="org.jdiy.core.Rs"%>
<%@ page language="java" import="com.suneasy.web.dao.t_dao"%>
<%@ page language="java" import="com.suneasy.web.mod.*"%>
<%@ include file="/config.jsp"%>
<%
	    //抽奖接口，随机生成中奖序号，返回中奖序号和剩余抽奖次数
		util util = new util();
		t_dao t_dao = new t_dao();
		t_dao.setDao("cloud-01");
		Rs rs = null;
		String json = "";
		String error = "";
		String result = "0";
		int lotteryNum = 0;//剩余抽奖次数
		String userid = util.get("userid");
		String type = util.get("type");//接口标识字段，判断是微信还是app
		if("".equals(userid) || userid == null){
			error += "userid为空";
		}
		if("".equals(type) || type == null){
			error += "type为空";
		}
		if("".equals(error)){
		   //随机生成0~1000
		  int num = (int) Math.floor(Math.random()*1000);
		  //num为0，中奖序号为1，概率千分之一
	      if(num == 1000){        
	    	  result = "1";
	      }
		  else if(num == 0){        
	    	  result = "8";
	      } 
		  else {
	      
	        int[] data = {1, 2, 3, 4, 5, 6, 7};
			//floor方法为四舍五入
			int n = data[(int) Math.floor(Math.random()*data.length)];
			switch(n){
				case 1: result = "2";
					break;
				case 2: result = "2";
					break;
				case 3: result = "3";
					break;
				case 4: result = "4";
					break;
				case 5: result = "5";
					break;
				case 6: result = "6";
					break;
				case 7: result = "7";
					break;
			
				default:result = "2";
			}
	    }
	      //app端的操作，微信端不进行任何操作
	  	if("app".equals(type)){
			rs = t_dao.getRs("t_appuser","userid='"+userid+"'");
			String n = rs.get("num");
			rs.set("num", Tools.isNumber(n)-1);
			lotteryNum = Tools.isNumber(n)-1;
			t_dao.save(rs);
			t_dao = null;
			//中奖序号为2~7时金币加10
			if(!("1".equals(result)||"8".equals(result))){
				t_dao t_dao1 = new t_dao();
				Rs rs1 = t_dao1.getRs("t_user","c_userid='"+userid+"'");
				int jinbi = Tools.isNumber(rs1.get("c_jinbi"))+10;
				rs1.set("c_jinbi", jinbi);
				t_dao1.save(rs1);
				t_dao1 = null;
			}
		}	
		}
		
	json = "{\"error\":\""+error+"\",\"result\":\""+result+"\",\"num\":\""+lotteryNum+"\"}";
	util.out(json);
	out.clear();  
    out = pageContext.pushBody();  
	util = null;


%>