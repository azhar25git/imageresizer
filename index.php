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
		<form class="col-6 mx-auto mt-5" action="resize.php" method="post" enctype="multipart/form-data" style="width:350px;" onsubmit="return(validate());">
			<div class="form-group">
				<label for="fileToUpload">Select image to resize:</label>
				<input class="form-control-file" type="file" name="fileToUpload" id="fileToUpload" required>
			</div>
			<div class="form-group">
				<label for="fileToUpload">Select final width</label>
				<div class="input-group mb-2 mr-sm-2">
					<div class="input-group-prepend">
						<div class="input-group-text">px</div>
					</div>
					<input type="number" class="form-control" id="width" name="width" placeholder="width">
				</div>
				<!-- <input class="form-control" type="number" name="width" id="width" required> -->
			</div>
			
			<div class="form-group">
				<label for="fileToUpload">Select final height</label>
				<div class="input-group mb-2 mr-sm-2">
					<div class="input-group-prepend">
						<div class="input-group-text">px</div>
					</div>
					<input type="number" class="form-control" id="height" name="height" placeholder="height">
				</div>
				<!-- <input class="form-control" type="number" name="height" id="height" required> -->
			</div>
			<div class="form-group">
				<input class="form-control btn btn-outline-dark" type="submit" value="Upload Image" name="submit">
			</div>
			
		</form>
	</section>


</body>
</html>