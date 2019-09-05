<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Resizer</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/style.js"></script>
</head>
<body>

	<section class="col-12">
	<div class="card px-0 col-3 mx-auto mt-5 p-5">
		<div class="mx-auto" >
			<button class="btn btn-sm btn-outline-dark mb-3" onclick="return(addMore());">Add more images <b>+</b></button>
		<!-- <button class="btn btn-sm m-3" onclick="return(removeLast());">Remove image <b>-</b></button> -->
		</div>
		<form class="mx-auto" id="resizer-form" action="" method="post" enctype="multipart/form-data" style="width:350px;" onsubmit="return(validate());">
		<div style="display:none;position:relative;" id="loader" ><img src="loader.gif" alt=""></div>
			<div class="row">
				<div class="form-group col">
					<label for="fileToUpload">Set width</label>
					<div class="input-group mb-2 mr-sm-2">
						<div class="input-group-prepend">
							<div class="input-group-text">px</div>
						</div>
						<input type="number" class="form-control" id="width" name="width" placeholder="700">
					</div>
					<!-- <input class="form-control" type="number" name="width" id="width" required> -->
				</div>
				
				<div class="form-group col">
					<label for="fileToUpload">Set height</label>
					<div class="input-group mb-2 mr-sm-2">
						<div class="input-group-prepend">
							<div class="input-group-text">px</div>
						</div>
						<input type="number" class="form-control" id="height" name="height" placeholder="0">
					</div>
					<!-- <input class="form-control" type="number" name="height" id="height" required> -->
				</div>
			</div>
			
			
			<div id="filesToUpload">
				<div class="form-group">
					<label for="fileToUpload">Select image to resize:</label>
					<input class="form-control-file" type="file" name="fileToUpload[]" id="fileToUpload">
				</div>
			</div>
			
			
			
			<div class="form-group">
				<input class="form-control btn btn-outline-dark" type="submit" id="submit" value="Upload Image" name="submit">
			</div>
			
		</form>
	</div>
		
	</section>


</body>
</html>

<?php
include "resize.php";

