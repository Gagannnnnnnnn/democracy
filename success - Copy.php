<?php

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "india";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>



<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,intial-scale=1">
<link rel="stylesheet" href="styles.css">
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
padding:0px;
width:100%;
height:100px;
}
aside
{
float:left;
background-color:yellow;
padding:20px;
width:50%;
height:auto;
}
article
{
float:right;
background-color:yellow;
padding:20px;
width:50%;
height:auto;
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
@madia (max-width:600px)
{
nav,article{
width:100%;
height:auto;
}}






 /* Popup image */
    .popup {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.7);
        width: 100%;
        height: 100%;
        justify-content: center;
        align-items: center;
    }

    .popup img {
        max-width: 80%;
        max-height: 80%;
        border: 2px solid white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }






</style>





    <title>UNSOLVED PROBLEMS </title>
<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        h2 {
            color: #555;
        }

        button {
            margin-top: 10px;
            padding: 8px 16px;
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
        }

        button a {
            text-decoration: none;
            color: white;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<header>
    <h1>CHOOSE YOUR LEADERS KEEPING ALL THESE PROBLEMS IN YOUR MIND </h1>
</header>
   <hr>
<hr>

<nav>
<fieldset style="background-color:black">
 <button style="float:right;height:40px;width:80px"> <a href="logout.php">LOG OUT</a></button>                                               
  
</fieldset>
</nav>
<aside>
    <h2>User Details</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>Village</th>
            <th>District</th>
            <th>Taluk</th>
        </tr>
        <?php
        // Retrieve user details from the 'user_details' table
        $userDetailsQuery = "SELECT * FROM user_details";
        $userDetailsResult = $conn->query($userDetailsQuery);

        if ($userDetailsResult->num_rows > 0) {
            while ($row = $userDetailsResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='et1'>" . $row["username"] . "</td>";
                echo "<td class='et2'>" . $row["village"] . "</td>";
                echo "<td class='et3'>" . $row["district"] . "</td>";
                echo "<td class='et4'>" . $row["taluk"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No user details found.</td></tr>";
        }
        ?>
    </table>
</aside>


<article>
    <h2>Complaints</h2>
    <table>
        <tr>
            <th>complaints</th>
            <th>candidate discription</th>
            <th>images</th>
       
        </tr>
        <?php
        // Retrieve complaints from the 'complaints' table
        $complaintsQuery = "SELECT * FROM complaints";
        $complaintsResult = $conn->query($complaintsQuery);

        if ($complaintsResult->num_rows > 0) {
            while ($row = $complaintsResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='et5'>" . $row["message"] . "</td>";
                echo "<td>" . $row["candidate"] . "</td>";
                echo "<td><a class='popup-image' data-image='" . $row["image__path"] . "'>View Image</a></td>";
             
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No complaints found.</td></tr>";
        }
        ?>
    </table>

<!-- Popup Image -->
    <div class="popup" id="popup">
        <img id="popupImage" src="" alt="Popup Image">
    </div>



</article>




<!-- JavaScript for popup functionality -->
<script>
    const imagePaths = document.querySelectorAll('.popup-image');

    imagePaths.forEach(path => {
        path.addEventListener('mouseover', (event) => {
            const imagePath = event.target.getAttribute('data-image');
            if (imagePath) {
                const popupImage = document.getElementById('popupImage');
                popupImage.src = imagePath;
                document.getElementById('popup').style.display = 'flex';
            }
        });

        path.addEventListener('mouseout', () => {
            document.getElementById('popup').style.display = 'none';
        });
    });
</script>





  
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

