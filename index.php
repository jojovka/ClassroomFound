<?php 
	require 'db.php';
?>


<?php
	if(isset($_POST['calendar'])) $curr_date = $_POST['calendar']; else	$curr_date = date('Y-m-d');	
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
		R::exec("INSERT INTO calendar (date, room_id, user_id) VALUES ('".$_GET['date']."', ".$_GET['id'].", ".$_SESSION['logged_user']->id.")");
		$curr_date = $_GET['date'];
	}

	$rooms = R::getAll($query);
	$calendar = R::getAll("SELECT * FROM calendar WHERE date = '".$curr_date."'");
	$users = R::getAll('SELECT login, id FROM users');
	$calendar_users = array();
	foreach($calendar as $c){
		$user_key = array_search($c['user_id'], array_column($users, "id"));
		$c['user_id'] = $users[$user_key]['login'];
		array_push($calendar_users, $c);
	}
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
            <div class="footer">Hi, <?php echo $_SESSION['logged_user']->login; ?>!<br/></div>
            <div class="footer">  <a href="logout.php">Logout</a></div>
        <?php endif; ?>
    </div>
    <div class="main">
            <div class="navbar">
                <form class="form-inline" method="POST" action="index.php?action=search">
                    <div class="search">
                        <input name="search" class="form-control" type="search" placeholder="Search" aria-label="Search">
                        <?php if(isset($_SESSION['logged_user'])) echo "<input type='date' name='calendar' value='".$curr_date."'>" ?>    
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
                    <?php 
                            if(isset($_SESSION['logged_user'])) echo " <th><p>Booking</p></th>"
                    ?>
                
                </tr>
            </thead>
            <tbody>
        <?php foreach($rooms as $r): ?>
                    <tr class="trt">
                        <form id="<?=$r['id']?>" method="post" action="index.php?action=edit&id=<?=$r['id']?>&date=<?=$curr_date?>">    
                        <td><?=$r['name']?></td>
                        <td><?php if($r['projector'] == 1) $res="Yes"; else $res="No" ?><?=$res?></td>
                        <td><?php if($r['mountain'] == 1) $res="Yes"; else $res="No" ?><?=$res?></td>
                        <td><?php if($r['intdesk'] == 1) $res="Yes"; else $res="No" ?><?=$res?></td>
                        <td><?=$r['capacity']?></td>
                        <?php 
                            if(isset($_SESSION['logged_user'])){
                                $key = array_search($r['id'], array_column($calendar, "room_id"));
                                if($key !== false){
                                    $key = array_search($calendar[$key]['user_id'], array_column($users, "id"));
                                    echo "<td>booked by '".$users[$key]['login']."'</td>";
                                
                                }else	
                                    echo "<td><input form=".$r['id']." type='submit' value='Book it!'></td>";
                            }	
                        ?>
                        </form>
                    </tr>
        <?php endforeach?>
            </tbody>
    </table>
    </div>
    </div>
</body>