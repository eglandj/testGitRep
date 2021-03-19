<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Update Employee</title>

        <!-- a little snippet of Cascading Style Sheet style of formatting for the data table -->
        <!-- create a 1 pixel border, with a collapsed single border -->
        <style>
                table, th, td {
                border: 1px solid black;
                border-collapse: collapse
                }
        </style>

</head>

<body>
        <h2>Update an Employee Record</h2>
        <hr>
        <?php
                //php code is used to generate the html when the page is requested.
                //html is create using the 'echo' (similar to print) command
                echo "<h3>PHP Code Generates This:</h3>";

                //some variables
                $servername = "localhost";  //mysql is on the same host as apache (not realistic but whatevs)
                //really bad stuff here - password in plain text
                //$username = "<put your db username here>";    //username for database
                //$password = "<put your db password here";             //password for the user
                $username = "eglandj";
                $password = "{f4YbHR6";
                $dbname = "employees";          //which db you're going to use

                //this is the php object oriented style of creating a mysql connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                //check for connection success
                if ($conn->connect_error) {
                        die("MySQL Connection Failed: " . $conn->connect_error);
                }
                echo "MySQL Connection Succeeded<br><br>";

                //pull the attribute that was passed with the html form GET request and put into a local variable.
                $number = $_GET["number"];
                echo "Searching for: " . $number;

                echo "<br><br>";

                //create the SQL select statement, notice the funky string concat at the end to variablize the query
                //based on using the GET attribute
                $sql = "SELECT emp_no,birth_date,first_name,last_name,gender,hire_date FROM employees where emp_no = '".$number."'";


                //put the resultset into a variable, again object oriented way of doing things here
                $result = $conn->query($sql);

                //if there were no records found say so, otherwise create a while loop that loops through all rows
                //and echos each line to the screen. You do this by creating some crazy looking echo statements
                // in the form of HTMLText . row[column] . HTMLText . row[column].   etc...
                // the dot "." is PHP's string concatenator operator
                // here HTML Table tags are used to create a table and table rows.
                echo "<strong>Employee Information</strong><br><br>";
                echo "<table style=\"width:45%\">";
                echo "<tr><td><strong>Employee Number</strong></td><td><strong>Birth Date</strong></td><td><strong>First Name</strong></td><td><strong>Last Name</strong></td><td><strong>Gender</strong></td><td><strong>Hire Date</strong></td></tr>";
                if ($result->num_rows > 0){
                        //print rows
                        while($row = $result->fetch_assoc()){
                                echo "<tr><td>" . $row["emp_no"]. "</td><td>" . $row["birth_date"]. "</td><td>" . $row["first_name"]. "</td><td>" . $row["last_name"]. "</td><td>" . $row["gender"]. "</td><td>" . $row["hire_date"]. "</td></tr>";
                        }
			$sql2 = "DELETE FROM employees where emp_no = '".$number."'";
			$conn->query($sql2);
			echo "Deleted Employee";
		} else {
                        echo "No Records Found";
                }
                echo "</table>";
                //always close the DB connections, don't leave 'em hanging
                $conn->close();

        ?>
</body>
</html>
