<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="author" content="Azhar Uddin - getazharuddin@gmail.com">
	<title>Resizer</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/style.js"></script>
</head>
<body>

	<h3 class="col-10 text-center mx-auto pt-5">Image Resizer</h5>
	<section class="col-10 mx-auto row justify-content-center">
	
		<div class="col-5 card mx-auto mt-5 py-4" >
			<div class="mx-auto d-flex justify-content-around" style="width:350px;">
				<button class="px-2 btn btn-sm btn-outline-dark mb-3" onclick="return(addMore());">Add more images <b>+</b></button>
				<a href="refresh.php" class="px-2 btn btn-sm btn-outline-info mb-3">Refresh Plugin</a>
			<!-- <button class="btn btn-sm m-3" onclick="return(removeLast());">Remove image <b>-</b></button> -->
			</div>
			<form class="mx-auto" id="resizer-form" action="" method="post" enctype="multipart/form-data" style="width:350px;" onsubmit="return(validate());">
							
				<!-- <div class="form-group">
					<label for="fileToUpload">Provide upload folder link</label>
					<input class="form-control-file" type="text" name="uploadFolder" id="uploadFolder" placeholder="uploads/">
				</div> -->
				
				
				<div id="filesToUpload">
					<div class="form-group">
						<label for="fileToUpload">Select image to resize:</label>
						<input class="form-control-file" type="file" name="fileToUpload[]" id="fileToUpload">
					</div>
				</div>
				
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
				
				<div class="form-group">
					<input class="form-control btn btn-outline-dark col-12 mx-auto" type="submit" id="submit" value="Upload Image" name="submit">
					<div style="display:none;position:relative;z-index:9999;" class="col-12 text-center" id="loader" ><img style="width:50px;" src="loader.gif" alt=""></div>
				</div>
				
			</form>
		</div>

		<div class="col-5 card mx-auto mt-5 py-4">
			<h5>Click On Images To Download</h5>
			<div id="image-box" class="d-flex flex-row justify-content-around"></div>
			
		</div>
		
	</section>


</body>
</html>

<?php
include "resize.php";

