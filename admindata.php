<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // User is not logged in, redirect to the login page
    header("Location: index.html");
    exit();
}

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

// Function to delete a user record
function deleteUser($table, $column, $value) {
    global $conn;
    
    $deleteQuery = "DELETE FROM $table WHERE $column = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("s", $value);
    $stmt->execute();
    $stmt->close();
}

// Process search and delete actions
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["search"])) {
        $searchValue = $_POST["search"];
        
        // Search in user_details table
        $userDetailsQuery = "SELECT * FROM user_details WHERE username LIKE '%$searchValue%' OR email LIKE '%$searchValue%' OR phone LIKE '%$searchValue%'";
        $userDetailsResult = $conn->query($userDetailsQuery);
        
        // Search in complaints table
        $complaintsQuery = "SELECT * FROM complaints WHERE message LIKE '%$searchValue%' OR candidate LIKE '%$searchValue%'";
        $complaintsResult = $conn->query($complaintsQuery);
    } elseif (isset($_POST["delete"])) {
        $table = $_POST["table"];
        $column = $_POST["column"];
        $value = $_POST["value"];
        
        // Delete record from the selected table
        deleteUser($table, $column, $value);
    }
}
?>

<!DOCTYPE html>



<html lang="en">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width,intial-scale=1">
<link rel="stylesheet" href="styles.css">
<style>
<style>
*{
box-sizing:border-box;
}
header
{
padding:0px;
width:100%;
height:50px;
}
nav
{
padding:0px;
width:100%;
height:100%;
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
width:44%;
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
nav,article,aside,footer{
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




//table designe  

table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 2px solid black;
        }

        th {
            background-color: gray;
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
            padding: 10px 20px;
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
        }

        button a {
            text-decoration: none;
            color: white;
	    background-color: #lightblue;
        }

        button:hover {
            background-color: #45a049;
        }








</style>




    <title>Admin Page</title>
</head>
<body>
<header>
    <h1 style="text-align:center">Welcome Admin!</h1>
 
</header>

<fieldset style="background-color:black">
<nav >
<a href="database.php">
<button style="float:right;height:40px;width:120px">ALL COM</button>  </a> 
<a href="logout.php">        
<button style="float:right;height:40px;width:120px">LOGOUT</button> </a>       
</nav>
</fieldset>

<fieldset>

<aside style="background-color:yellow">
 <h2>User Details</h2>
    <form method="post" action="">
        <input type="text" name="search" placeholder="Search by username, email, or phone">
        <input type="submit" value="Search">
    </form>
    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Village</th>
            <th>District</th>
            <th>Taluk</th>
            <th>Action</th>
        </tr>
        <?php
        if (isset($userDetailsResult) && $userDetailsResult->num_rows > 0) {
            while ($row = $userDetailsResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='et1'>" . $row["username"] . "</td>";
                echo "<td class='et2'>" . $row["email"] . "</td>";
                echo "<td class='et3'>" . $row["phone"] . "</td>";
                echo "<td class='et4'>" . $row["village"] . "</td>";
                echo "<td class='et5'>" . $row["district"] . "</td>";
                echo "<td class='et6'>" . $row["taluk"] . "</td>";
                echo "<td><form method='post' action=''>
                    <input type='hidden' name='table' value='user_details'>
                    <input type='hidden' name='column' value='username'>
                    <input type='hidden' name='value' value='" . $row["username"] . "'>
                    <input type='submit' name='delete' value='Delete'>
                </form></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>search and delete option for user detsils.</td></tr>";
        }
        ?>
    </table>
</aside>




    <article style="background-color:yellow">
<h2>Complaints</h2> 
    <form method="post" action="">
        <input type="text" name="search" placeholder="Search by message or candidate">
        <input type="submit" value="Search">
    </form>
    <table>
        <tr>
            <th>Complaints</th>
            <th>Candidate Description</th>
            <th>Images</th>
         
            <th>Action</th>
        </tr>
        <?php
        if (isset($complaintsResult) && $complaintsResult->num_rows > 0) {
            while ($row = $complaintsResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='et7'>" . $row["message"] . "</td>";
                echo "<td>" . $row["candidate"] . "</td>";
               echo "<td><a class='popup-image' data-image='" . $row["image__path"] . "'>View Image</a></td>";

            
                echo "<td><form method='post' action=''>
                    <input type='hidden' name='table' value='complaints'>
                    <input type='hidden' name='column' value='message'>
                    <input type='hidden' name='value' value='" . $row["message"] . "'>
                    <input type='submit' name='delete' value='Delete'>
                </form></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>search and delete option for complaints.</td></tr>";
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





 </fieldset>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
