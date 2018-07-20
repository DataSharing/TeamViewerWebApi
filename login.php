<?php include('traitement/auth.php');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>TeamViewer</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<script src="http://localhost/test/assets/js/app.js"></script>
</head>
<body>
	<form action="" method="post">
		<div class="container" style="margin: 2em auto;">
			<div class="row">
				<div class="col-12">
					<h1>TeamViewerWebApi</h1>
				</div>
				<div class="col-12 col-lg-9" style="margin: 2em auto;">

					<input type="text" name="recherche" class="form-control" value="<?php echo $_POST['recherche'] ?? "";?>">
				</div>
				<div class="col-12 col-lg-3" style="margin: 2em auto;">
					<button type="submit" name="go" class="btn btn-primary">
						Rechercher
					</button>
					<a href='http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>' class="btn btn-danger">
						Reset
					</a>
				</div>
				<div class="col-12" style="margin-bottom: 0.3em">
					<button type="submit" name="supprimer" class="btn btn-sm btn-danger">Supprimer définitivement</button>
				</div>
				<div class="col-12">
					<?php
							//var_dump($ordinateurs->devices);
							//var_dump($_POST);
					echo "<table class='table table-striped' id='tableau'>";
					echo "<tr>";
					echo "<th>";
					echo "<div class='custom-control custom-checkbox'>";
					echo "<input type='checkbox' name='checkall' class='custom-control-input' id='checkall' onclick='cocherOuDecocherTout(this)'>";
					echo "<label class='custom-control-label' for='checkall'>";
					echo "Alias";
					echo "</label>";
					echo "</div>";
					echo "</th>";
					echo "<th>id session</th>";
					echo "<th>id groupe</th>";
					echo "<th>Statut</th>";
					echo "</tr>";
					$count=0;

					if(!empty($ordinateurs->devices)){
						foreach($ordinateurs->devices as $ordinateur){	
							if(isset($_POST['recherche']) && !empty($_POST['recherche'])){
								$pos = stripos($ordinateur->alias,$_POST['recherche']);
								if($pos === false){
									continue;
								}
							}
							echo "<tr>";
							echo "<td>";		
							echo "<div class='custom-control custom-checkbox'>";			
							echo "<input type='checkbox' name='ordinateurs[]' class='custom-control-input' id='".$ordinateur->device_id."' value='".$ordinateur->device_id."'>";
							echo "<label class='custom-control-label' for='".$ordinateur->device_id."'>";
							echo $ordinateur->alias;
							echo "</label>";
							echo "</div>";
							echo "</td>";
							echo "<td>";
							echo $ordinateur->remotecontrol_id;
							echo "</td>";
							echo "<td>";
							echo $ordinateur->groupid;
							echo "</td>";
							echo "<td>";
							$statut = $ordinateur->online_state;
							if($statut == "Offline"){
								echo "<span class='badge badge-danger'>".$statut."</span>";
							}else{
								echo "<span class='badge badge-success'>".$statut."</span>";
							}
							echo "</td>";
							echo "</tr>";
							if(!$_POST || isset($_POST['supprimer'])){
								if($count == 10){
									echo "<tr><td colspan=4><center><input type='submit' name='all' value='Tous les ordinateurs' class='btn btn-sm btn-dark'></center></td></tr>";
									break;
								}
							}
							$count++;
						}
					}
					if($count != 0){
						echo "<tr><td colspan=4><center><span class='badge badge-primary'>".$count." ordinateur(s)</span></center></td></tr>";
					}
					echo "</table>";
					if($count == 0){
						echo "<div class='alert alert-warning'>Aucun résultat pour cette recherche</div>";
					}
					?>
				</div>
			</div>
		</div>
	</form>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>