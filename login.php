<?php 
	require 'db.php';

	$data = $_POST;
	if ( isset($data['do_login']) )
	{
		$user = R::findOne('users', 'login = ?', array($data['login']));
		if ( $user )
		{
			if ( password_verify($data['password'], $user->password) )
			{
				$_SESSION['logged_user'] = $user;
				if($_SESSION['logged_user']->isadmin == 1)
					header('Location: admin.php');
				else
					header('Location: index.php');
			}else
			{
				$errors[] = 'Wrong password!';
			}

		}else
		{
			$errors[] = 'User not found!';
		}
		
		if ( ! empty($errors) )
		{
			echo '<div id="errors" style="color:red;">' .array_shift($errors). '</div><hr>';
		}

	}

?>


<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="topbar"> <div class="footer"><p>Login</p></div></div>
	<div class="formdiv">
		<form  style="text-align: center" action="login.php" method="POST">
			<h1 style="text-align: center"><strong>Username</strong></h1>
			<input style="align-self: center; font-size: 15px" size="30" type="text" name="login" value="<?php echo @$data['login']; ?>"><br/>

			<h1 style="text-align: center"><strong>Password</strong></h1>
			<input style="text-align: center; font-size: 15px" size="30" type="password" name="password" value="<?php echo @$data['password']; ?>"><br/>
			<br>
			<button style="text-align: center; font-size: 20px;" type="submit" name="do_login">Log in</button>
		</form>
	</div>
</body>