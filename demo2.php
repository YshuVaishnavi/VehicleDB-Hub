<div class="row">
<hr>
 <?php
$host = "localhost"; // Replace with your database server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "bill"; // Replace with your database name

// Create a connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());         //syntax
}

if (isset($_GET['code'])) {
    $code = $_GET['code'];
$query = "SELECT b.head_cd, a.des headdes, b.bud_yr, b.veh_cd, b.sec_cd, c.des secdes, b.tot_alot, b.act_cons 
              FROM m_param a,m_bud_dtl b, m_param c
              WHERE b.head_cd = '$code' 
              AND a.cd = b.head_cd
              AND a.typ = 'head_cd' 
              AND c.typ = 'sec_cd'
              AND c.cd = b.sec_cd  ";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) >= 0) {
        ?>
        <div class="row">
            <div class="col-md-12">              
<style>
table, th, td {
  border: 1px solid black;
}</style>
<table class="table table-bordered">
                    <tr>
                        <th>head_cd</th>
                        <th>description</th>
                        <th>budget yr</th>
                        <th>vechical_cd</th>
                        <th>section_cd</th>
                        <th>section_description</th>
                        <th>total</th>
                        <th>account_consumed</th>
                    </tr>
                    <?php
                    foreach($query_run as $row) {
                        ?>
                        <tr>
                            <td><?php echo $row['head_cd']; ?></td>
                            <td><?php echo $row['headdes']; ?></td>
                            <td><?php echo $row['bud_yr']; ?></td>
                            <td><?php echo $row['veh_cd']; ?></td>
                            <td><?php echo $row['sec_cd']; ?></td>
                            <td><?php echo $row['secdes']; ?></td>
                            <td><?php echo $row['tot_alot']; ?></td>
                            <td><?php echo $row['act_cons']; ?></td>
                        </tr>
                        <?php     }     ?>
                </table>
            </div>
        </div>
        <?php
    }
     else {
        echo "No records found";}}
mysqli_close($conn);
?>
<button><a href="demo.php" style="text-decoration: none;">Back</a></button>