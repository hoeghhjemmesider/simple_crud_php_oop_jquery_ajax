<html>
<head>
	<title>Data</title>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
	<!-- https://github.com/heryvandoro/simple-crud-php-oop-jquery-ajax -->
</head>
<style type="text/css">
	table img{
		width: 200px;
	}
</style>
<body>
	
	<p id="loading" style="display:none">
	Loading..............
	</p>
	
	<table border="1" cellpadding="5" cellspacing="0">
		<thead>
			<tr style="color:blue">
				<td>Tune Save</td>
				<td>TuneTitle<input type="text" name="name"></td>
				<td>TuneComposer<input type="text" name="desk"></td>
				<td>
					<select name="kategori">
						<option value="-1">==</option>
					</select>
				</td>
				<td><input type="file" name="tune_img"></td>
				<td><input type="submit" id="save" value="add"></td>
			</tr>

			<tr style="color:red;">
				<th>Tune Nr.</th>
				<th>TuneTitle</th>
				<th>Category</th>
				<th>TuneComposer</th>
				<th>Picture</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
	
</body>
</html>