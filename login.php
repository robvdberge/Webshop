<?php 
include $_SERVER['DOCUMENT_ROOT'].'/webshop/inc/header.php'; 
$loggedIn = Session::get('userLogin');

if ( $loggedIn ){
	header('location: order.php');
	exit();
}

if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) ){
    $insertUser = $ur->userRegistrate($_POST);
}

if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login']) ){
	 $loginUser = $ur->userLogin($_POST);
}

?>

<div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Ik heb al een account</h3>
        	<p>Inloggen</p>
			<?php if ( isset($loginUser)){echo $loginUser;}?>
        	<form action="" method="post" id="member">
            	<input name="naam" type="text" placeholder="naam/email">
                <input name="pwd" type="password" placeholder="wachtwoord">
            
            <p class="note">Help, ik ben mijn wachtwoord <a href="#">vergeten</a></p>
			<div class="buttons"><div><input type="submit" name="login" class="grey" value="Log in"/></div>
			</form>
		</div>
	</div>
	<div class="register_account">
		<h3>Registeer een nieuw account</h3>
		<?php if ( isset($insertUser)){echo $insertUser;}?>
		<form action="" method="post">
			<table>
				<tbody>
				<tr>
					<td>
					<div>
						<input type="text" Name="naam" placeholder="Naam"/>
					</div>
					<div>
						<input type="text" Name="woonplaats" placeholder="Woonplaats"/>
					</div>
					<div>
						<input type="text" Name="postcode" placeholder="Postcode"/>
					</div>
					<div>
						<input type="text" Name="email" placeholder="Emailadres"/>
					</div>
					</td>
					<td>
					<div>
						<input type="text" Name="adres" placeholder="Postadres"/>
					</div>
					<div>
						<select id="country" name="land" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Selecteer uw land</option>         
							<option value="NL">Nederland</option>
							<option value="BE">België</option>
							<option value="LX">Luxemburg</option>
							<option value="DE">Duitsland</option>
							<option value="FR">Frankrijk</option>
						</select>
					</div>		        
					<div>
						<input type="text" Name="telnummer" placeholder="Telefoonnummer"/>
					</div>
					<div>
						<input type="text" Name="pwd" placeholder="Nieuw Wachtwoord"/>
					</div>
					</td>
				</tr> 
				</tbody>
			</table> 
			<div class="search">
				<div>
					<input type="submit" name="submit" Value="Maak aan" Class="grey" />
				</div>
			</div>
			<p class="terms">Door te klikken ga je akkoord met onze <a href="#">voorwaarden &amp; condities</a>.</p>
			<div class="clear"></div>
		</form>
	</div>  	
	<div class="clear"></div>
</div>
</div>
</div>


<?php include './inc/footer.php'; ?>