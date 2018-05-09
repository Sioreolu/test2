<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['logged'])){
  $_SESSION['logged'] = false;
}
?>
<html lang="en" >	
	<head>
		<meta charset="UTF-8">
		<title>2048 game</title>
		<link rel="stylesheet" href="css/style.css">
    <!--JS Scripts-->
    <script src="js/hammerjs.js"></script>
    <script src="js/index.js"></script>
    <script src="js/gen_validatorv4.js"></script>
	</head>
	<body>	
		<div class="container">
		  <?php 
			  if($_SESSION['logged']==true)
				{ 
				  echo "Username:";
				  echo $_SESSION["username"];
				  echo "______Top Score:";
				  echo $_SESSION['pscore'];
				  echo '<form method="post" action="php/logout.php">
					<button name="btnLogout" type="submit">Log Out</button>
					</form>';
				  echo '<form method="post" action="php/updatescore.php">
					<input type="hidden" name = "updatedscore" id="hiddenscore">
					<input type="hidden" name = "username" id="hiddenuser" value="'.$_SESSION['username'].'">
					<button name="btnUpdate" type="submit">Update Score</button>
					</form>';

				}
			  else
				{
					echo'
					<button class="SignUpbutton" onclick="document.getElementById(\'divSignup\').style.display=\'block\'; disableinput()" style="width:auto;">Sign up</button>
					<button class="LogInbutton" onclick="document.getElementById(\'divLogin\').style.display=\'block\'; disableinput()" style="width:auto;">Log In</button>		
					';
				};
			echo '<input type="hidden" id="hiddenscore">';
		  ?>
			<!-- Top Text -->
			<div>
				<div class="heading">
					<h1 class="title">2048</h1>
					<div  class="score-container" name="scorecon">0</div>
				</div>
				<p class="game-intro">Join the numbers and get to the 
					<strong>2048 tile!</strong>
				</p>
				<button class="HighScorebutton" onclick="document.getElementById('divHS').style.display='block'; disableinput()" style="width:auto;">High Score Board</button>
			</div>
			
			<!-- The Game -->
			<div class="game-container">
				<div class="game-message">
					<p></p>
					<div class="lower">
						<?php
							if($_SESSION['logged']==true)
							{
								echo '<a href="php/updatescore.php" class="retry-button"><span>Try again!</span></a>';
							}
							else
							{
								echo'<a href="php/updatescore.php" class="retry-button"><span>Try again!</span></a>';
							}
						?>
					</div>
				</div>
				<div class="grid-container">
					<div class="grid-row">
						<div class="grid-cell"></div>
						<div class="grid-cell"></div>
						<div class="grid-cell"></div>
						<div class="grid-cell"></div>
					</div>
					<div class="grid-row">
						<div class="grid-cell"></div>
						<div class="grid-cell"></div>
						<div class="grid-cell"></div>
						<div class="grid-cell"></div>
					</div>
					<div class="grid-row">
						<div class="grid-cell"></div>
						<div class="grid-cell"></div>
						<div class="grid-cell"></div>
						<div class="grid-cell"></div>
					</div>
					<div class="grid-row">
						<div class="grid-cell"></div>
						<div class="grid-cell"></div>
						<div class="grid-cell"></div>
						<div class="grid-cell"></div>
					</div>
				</div>
				<div class="tile-container"></div>
			</div>
			
			<!-- Bottom Text -->
			<div>
				<p class="game-explanation">
					<strong class="important">How to play:</strong> Use your 
					<strong>arrow keys</strong> to move the tiles. When two tiles with the same number touch, they 
					<strong>merge into one!</strong>
				</p>
			</div>
			
			<!--Sign Up Form-->
			<div id="divSignup" class="modal">
				<span onclick="document.getElementById('divSignup').style.display='none'; enableinput()" class="close" title="Close Modal">&times;</span>
				<form name ="frmSignUp" id="frm01" class="modal-content" action="php/register.php" method="post">
					<div class="container">
						<h1>Sign Up</h1>
						<p>Please fill in this form to create an account.</p>
						<hr>
						<label for="fname"><b>First Name</b></label>
							<input type="text" placeholder="First Name:" name="fname" maxlength="30" required>
						<label for="lname"><b>Last Name</b></label>
							<input type="text" placeholder="Last Name:" name="lname" maxlength="30" required>
						<label for="email"><b>Email</b></label>
							<input type="email" placeholder="Enter Email" name="email" maxlength="255" required>
						<label for="usr"><b>Username</b></label>
							<input type="text" placeholder="Username:" name="usr" maxlength="30" required>
						<label for="psw"><b>Password</b></label>
							<input type="password" placeholder="Password:" name="psw" maxlength="50" required>
						<label for="psw-repeat"><b>Repeat Password</b></label>
							<input type="password" placeholder="Repeat Password:" name="psw-repeat" maxlength="50" required>
						<div class="clearfix">
							<button type="button" onclick="document.getElementById('divSignup').style.display='none'; enableinput()" class="cancelbtn">Cancel</button>
							<button type="submit" class="registerbtn" onclick="return BothFieldsIdenticalCaseSensitive()" value="Click Me">Sign Up</button>
						</div>
					</div>
                </form>
            </div>
			
			<!--Log In Form-->
			<div id="divLogin" class="modal">
				<span onclick="document.getElementById('divLogin').style.display='none'; enableinput()" class="close" title="Close Modal">&times;</span>
				<form name ="frmLogIn" id="frm02" class="modal-content" action="php/login.php" method="post">
				    <div class="container">
				        <h1>Log in</h1>
						<hr>
                            <label for="usr">
                                <b>Username</b>
                            </label>
							     <input type="text" placeholder="Username:" name="usr" maxlength="30" required>
                        
                            <label for="psw">
                                <b>Password</b>
                            </label>
							     <input type="password" placeholder="Password:" name="psw" maxlength="50" required>
							<div class="clearfix">
							<button type="button" onclick="document.getElementById('divLogin').style.display='none'; enableinput()" class="cancelbtn">Cancel</button>
							<button type="submit" class="registerbtn" onclick="" value="Click Me">Log In</button>
							</div>
					</div>
				</form>
            </div>
			
			<!--High Score Container-->
			<div id="divHS" class="modal">
				<span onclick="document.getElementById('divHS').style.display='none'; enableinput()" class="close" title="Close Modal">&times;</span>
				<?php
					require_once("php/config.php");
					$sqlConn = dbConnect();
					$qry = "SELECT Users.userName 
						FROM Users 
						INNER JOIN Scores on Scores.userID=Users.userID 
						ORDER BY score desc 
						LIMIT 5";
					$result = mysqli_query($sqlConn, $qry);
					$topUsers = array();
					while ($row = mysqli_fetch_assoc($result))
					{
						$topUsers[] = $row;
					}
					$qry = "SELECT Scores.score 
						FROM Users 
						INNER JOIN Scores on Scores.userID=Users.userID 
						ORDER BY score desc 
						LIMIT 5";
					$result = mysqli_query($sqlConn, $qry);
					$topScores = array();
					while ($row = mysqli_fetch_assoc($result))
					{
						$topScores[] = $row;
					}
					for ($i=0; $i < 5; $i++){
						print_r($topUsers[$i]);
						print_r($topScores[$i]);
						echo "<br>";
					}
				?>
            </div>
        </div>
	</body>
</html>
