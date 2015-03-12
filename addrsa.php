<html><head><title>Add RSA token information</title></head>
<body>
<div style="border: 2px solid black; width: 500px; margin-left: auto; margin-right: auto; padding:20px; background-color: #eee;">
<form action="addrsa-process.php" method="post" enctype="multipart/form-data">

AM Username: <input type="text" id="username" name="username" /><br />
SDTID token file: <input type="file" name="fileToUpload" id="fileToUpload"><br />
SDTID file password: <input type="text" id="password" name="password" /><br />
Desired PIN: <input type="text" id="pin" name="pin" /><br />
<br />
<input type="submit" value="Submit" />

</form>
</div>
</body>
</html>