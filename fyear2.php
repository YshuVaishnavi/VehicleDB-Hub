<html>
    <style>
        ul {        /*unordered (bullet list) list*/
            list-style-type: none;
            display: flex;
            justify-content: center;
            font-size: larger;
        }

        li {
            padding: 0px 2px;
        }

        nav {
        
            size: 40px;
            width: 50%; /* Adjust the width value as per your preference */
            margin-left: auto;
            margin-right: auto;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            background-color: rgb(103, 207, 103);
            text-decoration: none;
        }

        body {
            background-color: whitesmoke;
        }
        table {
            width: 50%; /* Adjust the width value as per your preference */
            margin: 0 auto;
            border-collapse: collapse;
        }
        table, th, td {
  border: 1px solid black;
}
        </style>
<body>
     <center>
<h4></h4>
<form action="fyear.php" method="GET">
<?php
 $code1 = $_GET['code'];
 $veh_cd1=$_GET['column'];
 $head_cd1=$_GET['row'];
?>
 <table class="table table-bordered">
                  <ul>  <tr> 
                        <th>Financial year</th>
                        <th>Vehicle code</th>
                        <th>Head code</th>
                                        </tr>
                 <tr>
                 <nav>
                  
                        <td style="text-align:center;"><?php $code ?> </td>

                        <tr>
                            <td><?php echo $code1; ?></td>
                            <td><?php echo $veh_cd1; ?></td>
                            <td><?php echo $head_cd1; ?></td>
                            
                        </tr>
</ul>
                        
    </nav>
                </tr>
    </table> <br> <br>
<?php
                            $host = "localhost"; // Replace with your database server name
                            $username = "root"; // Replace with your database username
                            $password = ""; // Replace with your database password
                            $dbname = "bill"; // Replace with your database name

                            // Create a connection
                            $conn = mysqli_connect($host, $username, $password, $dbname);

                            // Check connection
                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }
$sql2 = "SELECT b.sec_cd, a.des, b.tot_alot, b.act_cons
FROM m_param a, m_bud_dtl b
WHERE  b.bud_yr = '$code1'
AND b.sec_cd = a.cd
AND b.veh_cd = $veh_cd1
and b.head_cd = '$head_cd1'
";

                                                                
                                                               
 $query_run = mysqli_query($conn, $sql2);

if (mysqli_num_rows($query_run) >= 0) {
    
 ?>
        <table class="table table-bordered">
                    <tr>
                        <th>section_cd</th>
                        <th>section_description</th>
                        <th>total</th>
                        <th>account_consumed</th>
                    </tr>

                    <?php 
                    foreach($query_run as $row) {
                        ?>
                        <tr>
                            
                            <td><?php echo $row['sec_cd']; ?></td>
                            <td><?php echo $row['des']; ?></td>
                            <td><?php echo $row['tot_alot']; ?></td>
                            <td><?php echo $row['act_cons']; ?></td>
                        </tr>
                        
                        <?php     }     ?>
                    </table>
    <?php
    }else {
             echo "No Records found";
    }                                                
?>
                            </form>
</center>
</body>
</html>
<button><a href="fyear.php" style="text-decoration: none;">Back</a></button>