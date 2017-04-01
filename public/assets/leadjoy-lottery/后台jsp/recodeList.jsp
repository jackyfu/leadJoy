<%@page contentType="text/html;charset=GBK"%>
<%@page import="java.lang.*"%>
<%@ page language="java" import="java.sql.*"%>
<%@ page language="java" import="com.suneasy.web.mod.*"%>
<%@ include file="/config.jsp"%>
<%
	util util = new util();
	int n = Tools.isNumber(util.get("n"));	
	
try{
	T T= new T();
	T.setDao("cloud-01");
	util.out(T.getLsJson("t_recode","rid>0",10,n,"name,phonenum,idnum,address,lotterytime,type"));
	T=null;
	out.clear();  
    out = pageContext.pushBody();  
}catch(Exception ex){
	 System.out.println(ex.getMessage());
}finally	{
     
}
%>
