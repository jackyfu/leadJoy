<%@page contentType="text/html;charset=GBK"%>
<%@page import="java.lang.*"%>
<%@ page language="java" import="java.sql.*"%>
<%@ page language="java" import="org.jdiy.core.Rs"%>
<%@ page language="java" import="com.suneasy.web.dao.t_dao"%>
<%@ page language="java" import="com.suneasy.web.mod.*"%>
<%@ include file="/config.jsp"%>
<%
		util util = new util();
		t_dao t_dao = new t_dao();
		t_dao.setDao("cloud-01");
		Rs rs = null;
		String json = "";
		String error = "";
		String userid = util.get("userid");
		String type = util.get("type");//接口标示字段
		String appdate = Tools.getDate().substring(0, 10);//当天日期
		if("".equals(userid) || userid == null){
			error += "userid为空";
			json = "{\"result\":\"参数为空\"}";
		}
		if("".equals(type) || type == null){
			error += "type为空";	
			json = "{\"result\":\"参数为空\"}";
		}
		if("".equals(error)){
			//获取剩余抽奖次数接口
			if("getnum".equals(type)){
				int n = 0;
				n = t_dao.getNum("t_appuser", "userid='"+userid+"'");
				//若用户为空，向表中填写用户，默认抽奖次数和分享次数都为1
				if(n == 0){
					rs = t_dao.getRs("t_appuser");
					rs.set("userid", userid);
					rs.set("num", 2);
					rs.set("share",1);
					rs.set("appdate", appdate);
					t_dao.save(rs);
					json = "{\"userid\":\""+userid+"\",\"num\":\"2\",\"share\":\"1\"}";
				} else {
					rs = t_dao.getRs("t_appuser","userid='"+userid+"'");
					if(rs.get("appdate").equals(appdate)){
						json = "{\"userid\":\""+userid+"\",\"num\":\""+rs.get("num")+"\",\"share\":\""+rs.get("share")+"\"}";
					} else {
						rs.set("userid", userid);
						rs.set("num", 2);
						rs.set("share",1);
						rs.set("appdate", appdate);
						t_dao.save(rs);
						json = "{\"userid\":\""+userid+"\",\"num\":\"2\",\"share\":\"1\"}";
					}
				}
			}
			//分享接口
		    if("addnum".equals(type)){
		    	rs = t_dao.getRs("t_appuser","userid='"+userid+"'");
		    	String num = rs.get("num");
		    	String share = rs.get("share");
				//若分享次数为1，抽次数奖加1分享次数变为0；若分享次数为0则不进行任何操作
		    	if("1".equals(share)){
		    		rs.set("num", Tools.isNumber(num)+1);
			    	rs.set("share", 0);
			    	t_dao.save(rs);
					json = "{\"userid\":\""+userid+"\",\"num\":\""+(Tools.isNumber(num)+1)+"\",\"share\":\"0\"}";
		    	}else{
					json = "{\"userid\":\""+userid+"\",\"num\":\""+num+"\",\"share\":\"0\"}";
				}
		    	
		    	
		    }
				
				
		}
			
		
	util.out(json);
	out.clear();  
    out = pageContext.pushBody();  
	util = null;
	t_dao = null;


%>
