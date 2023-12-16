<head>
    <style>
        ul {                                          /*unordered (bullet list) list*/
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
</head>
<body>
    <center>
             <table class="table table-bordered">
                    <tr> 
                        <th>SNO</th>
                        <th>INDEX</th>
                 </tr>
                 <tr>
    <nav>
                  <ul><tr>
                        <td style="text-align:center;"> 01</td>
                        <td  style="text-align:center;"><li><a href="demo.php">Head code details</a></li></td>
                        </tr>
                  </ul>

                   <ul>
                     <tr><td style="text-align:center;"> 02</td>
                     <td  style="text-align:center;"><li><a href="fyear.php">Financial Year details</a></li></td>
                    </tr>
                   </ul>

                   <ul>
                    <tr>
                    <td style="text-align:center;"> 03</td>
                     <td style="text-align:center;"><li><a href="headyr.php">Head codewise Financial Year Summary</a></li></td>
                    </tr>
                    </ul>

                    <ul><tr>
                        <td style="text-align:center;"> 04</td>
                        <td  style="text-align:center;"><li><a href="billhd.php">Head code cum with bill details</a></li></td>
                        </tr>
                  </ul>
    </nav>
                </tr>
    </table>
</center>
    </body>
        
                   








    