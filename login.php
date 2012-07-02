<?php
include("config.php");
include("function.php");
//checkLogin();

//if the login form is submitted 
if (isset($_POST['submit'])) { // if form has been submitted
	// makes sure they filled it in
 	if(!$_POST['username'] | !$_POST['pass']) {
		die('Please file every required fields');
 	}

 	// checks it against the database
 	$check = mysql_query("SELECT * FROM users WHERE username = '".mysql_real_escape_string($_POST['username'])."'")or die(mysql_error());

	//Gives error if user dosen't exist
	$check2 = mysql_num_rows($check);
	
	if ($check2 == 0) {
 		die('No such person... <a href=addUser.php>please register first! </a>');
 	}

	while($info = mysql_fetch_array( $check )) {
		$_POST['pass'] = md5($_POST['pass']);
//		echo $_POST['pass']. "<BR>" .$info['password'].'<BR>';
		
		
		

		//gives error if the password is wrong
		if ($_POST['pass'] != $info['password']) {
			ErrorMessage::log2DB(ErrorMessage::$MSG_LOGIN,(mysql_real_escape_string($_POST['username'])." login failed"));
			die('<a href=login.php>Incorrect password, please try again.</a>');
		}else { 
			ErrorMessage::log2DB(ErrorMessage::$MSG_LOGIN,(mysql_real_escape_string($_POST['username'])." login successfully"));
			// if login is ok then we add a cookie 
			$hour = time() + 3600; 		
			$_SESSION['username']= $_POST['username'] ; 
			$_SESSION['ID']= $info['ID'];	 			
			//then redirect them to the members area 
			mysql_query('update users set login_counts = login_counts+1  ,login_date = NOW() where ID = '.$info['ID']);
			header("Location: home.php"); 

		} 
	} 

}else{	 
	ErrorMessage::log2DB(ErrorMessage::$MSG_VISIT,$_SERVER['PHP_SELF']);
	// if they are not logged in 
?> 
<html>
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
 <body>
 <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post"> 
 <div style="position:absolute; top:50; left:300; width:200px;"><font color =red>最近想再<a href='http://www.asos.com/'>ASOS</a>上面買東西,有人有興趣一起買看看嗎??</font>
<BR>有意者請站內信~~謝謝~~</div>
 <table border="0"> 
	<tr><td colspan=2><h1>登入</h1></td></tr> 
	<tr><td>Username:</td>
		<td> <input type="text" name="username" maxlength="40"> </td>
		</tr> 
	<tr><td>Password:</td>
		<td><input type="password" name="pass" maxlength="30"> </td>
		</tr> 
	<tr><td colspan="2" align="right"> <input type="submit" name="submit" value="Login"> </td>
		</tr>
 </table>
 </form> 
<a href="addUser.php">還沒有帳號?</a> or <a href='forgetPassword.php'>忘記密碼</a> <a href="https://sites.google.com/site/stpgroupon/">團購規則(必讀)</a><BR> 

<?php 
} 
?>
<BR>

<BR><BR>
<table border=1>
<TR>
	<TD align=center colspan=3>版本清單</TD></TR>
<TR>
	<TD>版本號</TD>
	<TD>上線日期</TD>
	<TD>修改內容</TD></TR>
<TR>
	<TD>0.8</TD>
	<TD>2012-05-29</TD>
	<TD>1.新增討論區 2. 功能還不齊全,慢慢修改中</TD></TR>
<TR>
	<TD>0.7.1</TD>
	<TD>2012-05-12</TD>
	<TD>1.新增[別人買啥]當中的[<a href='allItems.php?action=watchHot'>最多人買</a>]功能,可以看最多人買啥<BR>2.[<a href='http://stpgroupon.com/addSales.php'>我要賣這個</a>]新增字型排版功能<BR>3.修正[別人買啥]當中的[我也要買]功能</TD></TR>
<TR>
	<TD>0.7</TD>
	<TD>2012-05-06</TD>
	<TD>新增拍賣功能</TD></TR>

<TR>
	<TD>0.6</TD>
	<TD>2012-05-03</TD>
	<TD>1.修改交貨方式,付尾款才填寫<BR>2.修改報價綁定最新團號<BR>3.修改訂單明細提示語<BR>4.修改功能列:[登出][回到主頁]</TD></TR>
<TR>
	<TD>0.5.1</TD>
	<TD>2012-04-29</TD>
	<TD>1.修改訂單列表介面,點選訂單明細即可進入該筆訂單,(改用GET)<BR>2.修正下一筆跳頁功能只限於管理員權限<BR>3.新增面交預約功能(deprecated)</TD></TR>
<TR>
	<TD>0.5</TD>
	<TD>2012-04-26</TD>
	<TD>1.新增面交掛號功能<BR>2.對帳功能(管理員功能)</TD></TR>
<TR>
	<TD>0.4.2</TD>
	<TD>2012-04-23</TD>
	<TD>1.修改顯示尾款功能<BR>2.尾款小計(管理員功能)</TD></TR>
<TR>
	<TD>0.4.1</TD>
	<TD>2012-04-21</TD>
	<TD>1.訂單列表新增團號選擇<BR>2.在[別人買啥]下新增[我也要買]功能<BR>3.新增頁面/登入計數器</TD></TR>
<TR>
	<TD>0.4</TD>
	<TD>2012-04-20</TD>
	<TD>1.新增更新最後訂購金額功能,訂貨總額小計(管理員權限)<BR>2.置換進度圖檔,感謝網友提供<BR>3.修改訂單列表主要資訊<BR>4.新增報價提醒</TD></TR>
<TR>
	<TD>0.3.4</TD>
	<TD>2012-04-15</TD>
	<TD>1.新增尾款明細(status=3才會顯示)<BR> 2.新訂單直接套用最新團號<BR>3.新增訂單快選功能(管理員權限)<BR>4.新增會原資料快選功能(管理員權限)<BR>5.欄位資安統一使用mysql_real_escape</TD></TR>

<TR>
	<TD>0.3.3</TD>
	<TD>2012-04-14</TD>
	<TD>1.新增使用者清單(管理員權限)<BR> 2.密碼移出Session(管理員權限)<BR>3.修正無法報價問題<BR>4.若一直無法登入,請使用stpgroupon.99k.org登入,謝謝 </TD></TR>
<TR>
	<TD>0.3.2</TD>
	<TD>2012-04-14</TD>
	<TD>1.新增從新訂單(全灰色)移除物品功能<BR> 2.調整管理員版面</TD></TR>

<TR>
	<TD>0.3.1</TD>
	<TD>2012-04-13</TD>
	<TD>1.新增忘記密碼功能,輸入原本申請資料就可以重設密碼<BR>2.新增出團資訊(管理員權限)</TD></TR>
<TR>
	<TD>0.3</TD>
	<TD>2012-04-11</TD>
	<TD>1.新增修改個人資訊功能<BR>2.隱藏好物分享清單內的購買人ID </TD></TR>
<TR>
	<TD>0.2</TD>
	<TD>2012-04-10</TD>
	<TD>1.註冊時加入個人資訊<BR>2.新增置底公告區<BR>3.<a href=allItems.php target=_blank>好物分享</a>開放無登入瀏覽</TD></TR>
<TR>
	<TD>0.1</TD>
	<TD>2012-04-08</TD>
	<TD>主要功能上線,希望修改10次內可以功能完整0rz</TD></TR>
</table>
</body>
</html>