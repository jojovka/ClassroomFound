<?php
    require 'db.php';
    
    $query = "SELECT * FROM class_rooms";
    if(isset($_GET['action']))
            $action = $_GET['action'];
        else
            $action = "";
    
    if($action == "search"){
        $query = $query." WHERE";
        if(isset($_POST['search']) && $_POST['search'] != "")
            $query = $query." name = ".$_POST['search']; 
        else{
            if(isset($_POST['seats'])) $query = $query." capacity >= ".strval($_POST['seats']);
            if(isset($_POST['proj'])) $query = $query." AND projector = 1";
            if(isset($_POST['moun'])) $query = $query." AND mountain = 1";
            if(isset($_POST['boar'])) $query = $query." AND intdesk = 1";
        }
    }
    if($action == "edit"){
        if(isset($_POST['proj'])) $proj = 1; else $proj = 0;
        if(isset($_POST['moun'])) $moun = 1; else $moun = 0;
        if(isset($_POST['boar'])) $boar = 1; else $boar = 0;
		R::exec("UPDATE class_rooms SET name=".$_POST['name'].", capacity=".$_POST['cap'].", projector=".$proj.", mountain=".$moun.", intdesk=".$boar." WHERE id=".$_GET['id']);
	}
    if($action == "del"){
		R::exec("DELETE FROM class_rooms WHERE id=".$_GET['id']);
    }
    
    if($action == "add"){
        if(isset($_POST['proj'])) $proj = 1; else $proj = 0;
        if(isset($_POST['moun'])) $moun = 1; else $moun = 0;
        if(isset($_POST['boar'])) $boar = 1; else $boar = 0;
		R::exec("INSERT INTO class_rooms (name, capacity, projector, mountain, intdesk) VALUES ('".$_POST['name']."', '".$_POST['cap']."', '".$proj."', '".$moun."','".$boar."')");
	}

	$rooms = R::getAll($query);
?>

<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="topbar">
        <?php if (!isset ($_SESSION['logged_user']) ){ ?>
            <div class="footer"><p>Classrooms booking</p></div>
            <div class="footer">
                <a href="login.php">Login</a>
                <a href="signup.php">Signup</a>
            </div>
        <?php }?>
        
        <?php if ( isset ($_SESSION['logged_user']) ) : ?>
            <div class="footer">You are in admin mode</div>
            <div class="footer">  <a href="logout.php">Logout</a></div>
        <?php endif; ?>
    </div>
    <div class="main">
            <div class="navbar">
                <form class="form-inline" method="POST" action="admin.php?action=search">
                    <div class="search">
                        <input name="search" class="form-control" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </div>
                    <div class="dropdown-menu">
                        <p>Additional features:</p>
                        <p><input type="checkbox" name="proj" value="1" >Projector<Br>
                        <input type="checkbox" name="moun" value="1">Mountain View<Br>
                        <input type="checkbox" name="boar" value="1">Interactive board<Br> 
                    </div>
                    <div class="form-group">
                            <label for="seats">Seats</label>
                            <input name="seats" type="number" class="form-control" id="seats" placeholder="seats" value="0">
                    </div>
                
                </form>
            </div>
        

<div class="tablediv">	
<table class="service_table" >
        <thead>
            <tr>
                <th><p>Room ID</p></th>
                <th><p>Projector</p></th>
                <th><p>Mountain view</p></th>
                <th><p>Interactive board</p></th>
                <th><p>Capacity</p></th>
                <th><p></p></th>
                <th><p></p></th>
            </tr>
        </thead>
        <tbody>
             <form id="add" method="post" action="admin.php?action=add">
                <tr>
                    <td><input type="number" name="name" ></td>
                    <td><input type="checkbox" name="proj" value="1"></td>
                    <td><input type="checkbox" name="moun" value="1"></td>
                    <td><input type="checkbox" name="boar" value="1"></td>
                    <td><input type="number" name="cap"></td>
                    <td><input form="add" type='submit' value='Add'></td>
                </tr>
            </form>
    <?php foreach($rooms as $r): ?>
                <tr>
			<form id="<?=$r['id']?>" method="post" action="admin.php?action=edit&id=<?=$r['id']?>">
                    <td><input size="5" type="number" name="name" value="<?=$r['name']?>"></td>
                    <td><input type="checkbox" name="proj" value="1" <?php if($r['projector'] == 1) echo "checked" ?>></td>
                    <td><input type="checkbox" name="moun" value="1" <?php if($r['mountain'] == 1)  echo "checked" ?>></td>
                    <td><input type="checkbox" name="boar" value="1" <?php if($r['intdesk'] == 1)  echo "checked" ?>></td>
                    <td><input size="5" type="number" name="cap" value="<?=$r['capacity']?>"></td>
                    <td><input form="<?=$r['id']?>" type='submit' value='Edit'></td>
					<td><a href='admin.php?action=del&id="<?=$r['id']?>"'>Delete</a></td>
                </tr>
			</form>
    <?php endforeach?>
        </tbody>
</table>
</div>