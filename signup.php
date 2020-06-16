<?php 
	require 'db.php';

	$data = $_POST;


	if ( isset($data['do_signup']) )
	{
		$errors = array();
		if ( trim($data['login']) == '' )
		{
			$errors[] = 'empty field';
		}

		if ( trim($data['email']) == '' )
		{
			$errors[] = 'empty field';
		}

		if ( $data['password'] == '' )
		{
			$errors[] = 'empty fiels';
		}

		if ( $data['password_2'] != $data['password'] )
		{
			$errors[] = 'incorrect password';
		}

		if ( R::count('users', "login = ?", array($data['login'])) > 0)
		{
			$errors[] = 'user with that username already exists!';
		}
    
		if ( R::count('users', "email = ?", array($data['email'])) > 0)
		{
			$errors[] = 'user with that email already exists!';
		}

	


		if ( empty($errors) )
		{
			$user = R::dispense('users');
			$user->login = $data['login'];
			$user->email = $data['email'];
			$user->password = password_hash($data['password'], PASSWORD_DEFAULT); 
			R::store($user);
			echo '<div style="color:dreen; text-align: center">You are now siguped!</div><hr>';
			header('Location: index.php');
		}else
		{
			echo '<div id="errors" style="color:red; text-align: center">' .array_shift($errors). '</div><hr>';
		}

	}

?>

<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="topbar"><div class="footer"><p>Sigup form</p></div></div>
	<div class="formdiv">
		<form style="text-align: center" action="signup.php" method="POST">
			<h1><strong>Username</strong></h1>
			<input style="text-align: center; font-size: 15px" type="text" name="login" value="<?php echo @$data['login']; ?>"><br/>

			<h1><strong>Email</strong></h1>
			<input style="text-align: center; font-size: 15px" type="email" name="email" value="<?php echo @$data['email']; ?>"><br/>

			<h1><strong>Password</strong></h1>
			<input style="text-align: center; font-size: 15px" type="password" name="password" value="<?php echo @$data['password']; ?>"><br/>

			<h1><strong>Password</strong></h1>
			<input style="text-align: center; font-size: 15px" type="password" name="password_2" value="<?php echo @$data['password_2']; ?>"><br/>
			<br>
			<button style="text-align: center; font-size: 20px;" type="submit" name="do_signup">Sigup</button>
		</form>
	</div>
</body>