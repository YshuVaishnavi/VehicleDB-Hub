<h4>ENTER THE BUDGET YEAR</h4>
    <form action="" method="GET">

        <input type="text" 
               name="code" 
               value="<?php if(isset($_GET['code'])) { echo $_GET['code']; } ?>"
               class="form-control">

         <button type="submit" class="btn btn-primary">Search</button>
    </form>
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

         if (isset($_GET['code'])) {
                                $code = $_GET['code'];
                                // Use prepared statements or sanitize $code before using it in the query
                                $query = "SELECT DISTINCT b.head_cd, a.des
                                          FROM m_param a, m_bud_dtl b
                                          WHERE b.bud_yr ='$code'
                                          AND  b.head_cd=a.cd";
                                $query_run = mysqli_query($conn, $query);

         if (mysqli_num_rows($query_run) > 0) {
 ?>
        <style>
                 table, th, td {
                                  border: 1px solid black;
                               }
        </style>
        <table class="table table-bordered">
         <tr>
                <th>HEAD_CD</th>
                <th>DES</th>
                <th>AJY</th>
                <th>BHI</th>
                <th>ARJ</th>
         </tr>
    <?php
     $headCodes = array(); // Array to store unique head_cd values
     while ($row = mysqli_fetch_assoc($query_run)) {
       if (!in_array($row['head_cd'], $headCodes)) {
          // Display the row only if head_cd is unique
              $headCodes[] = $row['head_cd']; // Add head_cd to the array
    ?>

        <tr>
                    <td><?php echo $row['head_cd']; ?></td>
                    <td><?php echo $row['des']; ?></td>
                         <?php
                            $hd1 = $row['head_cd'];

                            $sql = "SELECT COUNT(b.sec_cd) AS AJY   
                                    FROM m_param a, m_bud_dtl b
                                    WHERE b.veh_cd = 'AJY' 
                                    AND a.cd = b.head_cd 
                                    AND  b.bud_yr ='$code'
                                    AND b.head_cd = '$hd1'";

                                    $que_run = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($que_run) > 0) {
                                        $secondary_row = mysqli_fetch_assoc($que_run);
                           ?>
                     <td><a href="fyear2.php?row=<?php echo $hd1; ?>
                                         &column='AJY'
                                         &code=<?php echo $code; ?>"> 
                                         <?php echo $secondary_row['AJY']; ?></a></td>
                            <?php
                                 } else {
                                     echo "<td></td>";
                            }?>
                        <?php
                            $sql = "SELECT COUNT(b.sec_cd) AS BHI
                                    FROM m_param a, m_bud_dtl b
                                    WHERE b.veh_cd = 'BHI' 
                                    AND a.cd = b.head_cd
                                    AND  b.bud_yr ='$code'
                                    AND b.head_cd = '$hd1'";

                                    $que_run = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($que_run) > 0) {
                                         $secondary_row = mysqli_fetch_assoc($que_run);
                         ?>
                     <td><a href="fyear2.php?row=<?php echo $hd1; ?>
                                         &column='BHI' 
                                         &code=<?php echo $code; ?>">
                                         <?php echo $secondary_row['BHI']; ?></a></td>
                             <?php
                                                            } else {
                                                                echo "<td></td>";
                                                            }

                                 $sql = "SELECT DISTINCT COUNT(b.sec_cd) AS ARJ
                                   FROM m_param a, m_bud_dtl b
                                   WHERE b.veh_cd = 'ARJ' 
                                   AND a.cd = b.head_cd
                                   AND  b.bud_yr ='$code'
                                   AND b.head_cd = '$hd1'";

                                   $que_run = mysqli_query($conn, $sql);
                                   if (mysqli_num_rows($que_run) > 0) {
                                        $secondary_row = mysqli_fetch_assoc($que_run);
                             ?>
                        <td><a href="fyear2.php?row=<?php echo $hd1; ?>
                                            &column='ARJ' 
                                            &code=<?php echo $code; ?>">
                                            <?php echo $secondary_row['ARJ']; ?></a></td>
                             <?php
                                                            } else {
                                                                echo "<td></td>";
                                                            }
                              ?>

        </tr>
                    <?php
                      }
                      }
                    ?>
              </table>
                             <?php
                                                             } else {
                                                               echo "No records found";
                                                              }
                            } // Close the connection
                            mysqli_close($conn);
                            ?>
        <button><a href="navi.php" style="text-decoration: none;">Back</a></button>                
