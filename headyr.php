<html>
    <center>
        <h3>Head codewise Financial Year Summary</h3>
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

        $query = "SELECT DISTINCT b.head_cd, a.des
                  FROM m_param a, m_bud_dtl b
                  WHERE  b.head_cd=a.cd";
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
                    <?php
                    $recentYears = range(date('Y') - 2, date('Y')); // Generate an array of recent years (e.g., 2021, 2022, 2023)
                    foreach ($recentYears as $yearValue) {
                        $yearStart = intval($yearValue);
                        $yearEnd = intval($yearValue) + 1;
                        echo "<th>$yearStart-$yearEnd</th>";
                    }
                    ?>
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
                            foreach ($recentYears as $yearValue) {
                                $yearStart = intval($yearValue);
                                $yearEnd = $yearStart + 1;

                                $sql = "SELECT SUM(b.tot_alot) AS `{$yearStart}-{$yearEnd}_tot_alot`, SUM(b.act_cons) AS `{$yearStart}-{$yearEnd}_act_cons`
                                        FROM m_param a, m_bud_dtl b
                                        WHERE b.bud_yr = '{$yearStart}-{$yearEnd}'
                                        AND a.cd = b.head_cd 
                                        AND b.head_cd = '$hd1'";
                                $que_run = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($que_run) > 0) {
                                    $secondary_row = mysqli_fetch_assoc($que_run);
                                    $value = nl2br('Total allotment:'.$secondary_row["{$yearStart}-{$yearEnd}_tot_alot"] . " \n" .'Total consumed :'. $secondary_row["{$yearStart}-{$yearEnd}_act_cons"]);
                                    ?>
                                    <td><a href="headyr2.php?year='<?php echo $yearStart; ?>-<?php echo $yearEnd; ?>'&headcode=<?php echo $hd1; ?>"> <?php echo $value; ?></a></td>
                                <?php } else {
                                    echo "<td></td>";
                                }
                            }
                            ?>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            <?php
        }

        // Close the connection
        mysqli_close($conn);
        ?>
    </center>
</html>
<button><a href="navi.php" style="text-decoration: none;">Back</a></button>