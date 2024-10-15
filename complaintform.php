<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,intial-scale=1">
<style>
*{
box-sizing:border-box;
}
header
{
padding:0px;
width:100%;
height:100px;
}
nav
{
padding:20px;
width:100%;
height:100px;
}
aside
{
float:left;
padding:0px;
width:50%;
height:300px;
}
article
{
float:right;
padding:35px;
width:40%;
height:300px;
}
section::after
{
content:"";
display:table;
clear:both;
}
footer
{
padding:10px;
text-align:center;
}
@media (max-width:600px)
{
nav,article{
width:100%;
height:auto;
}}
</style>


<!DOCKTYPE html>
<html>
<title>COMPLAINT</title>
<style>
body
{
background-image:url('comp.jpg');
background-repeat:no repeat;
background-attachment:fixed;
background-size:100% 100%;
}
<script>
    function validateForm() {
      var inputs = document.getElementsByTagName("input");
      for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].value === "") {
          alert("Please fill in all fields.");
          return false;
        }
      }
      return true;
    }
  </script>
</style>
<body>
<header>
<h2 style="font-size:300%;color:white;text-align:center"><i>SHARE YOUR COMPLAINTS HERE<i></h2>
</header>
<nav>
<hr>
<hr>
<p style="font-size:150%;color:white;">VALIED COMPLAINTS ARE ONLY CONSIDERED</p>
<nav>
<fieldset>
<aside>
<form action="complaint.php"onsubmit="return validateForm()"method="POST"enctype="multipart/form-data">

<legend style="color:white;text-align:center"><b><i>fill the form<i><b></legend>
<label for="message"style="color:white;font-size:20px"><b>Discription<b></label>
  <textarea name="message" rows="10" cols="100"required></textarea>
  <br><br>
<h2 style="color:white;font-size:156%;">UPLODE THE IMAGE HERE</h2>
 <label for="myfile"; style="color:white;">Select a image:</label>
  <input type="file" id="myfile" name="myfile"required><br><br>
 
<input type="submit">
 

</form>
</aside>
<h1 style="color:white;float:right"><b>What do you think about the candidate<b></h1>
<h2 style="color:white;float:right">
<article style="color:white">
 <input type="radio" id="Humble" name="candidate" value="Humble" required>
<label for="Humble">Humble</label><br>
<input type="radio" id="Currupted" name="candidate" value="Currupted" required>
<label for="Currupted">Currupted</label><br>
<input type="radio" id="Lazy" name="candidate" value="Lazy" required>
<label for="Lazy">Lazy</label><br><br>
<label for="username" style="color:white"><strong>Username<strong>:</label><br>
<input type="text" id="db_username" name="db_username"reqiured><br>

</article>
</h2>
 
</fieldset>
<hr>
<marquee behaviour="scroll";direction="right">
<h3 style="font-size:350%;color:white;">COMPLAINT REGISTRATION COMPLETED</h3></marquee>


</body>


</html>