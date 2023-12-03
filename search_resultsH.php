<?php

require_once('tcpdf/tcpdf.php');


$servername = "localhost";
$username = "koi";
$password = "1234";
$dbname = "donors";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$search = '';
$needs = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $search = isset($_POST['search']) ? $_POST['search'] : '';
    $needs = isset($_POST['needs']) ? $_POST['needs'] : '';
}


$sql = "SELECT * FROM home WHERE Needs LIKE '%$search%'";

if (!empty($needs)) {
    $sql .= " AND Needs = '$needs'";
}

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo '<table border="1">';
    echo '<tr>';
    
    echo '<th>Homename</th>';
    echo '<th>Needs</th>';
    echo '<th>Description</th>';
    echo '<th>Address</th>';
    echo '<th>Contact</th>';

    echo '</tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        
        echo '<td>' . $row['Homename'] . '</td>';
        echo '<td>' . $row['Needs'] . '</td>';
        echo '<td>' . $row['Description'] . '</td>';
        echo '<td>' . $row['Address'] . '</td>';
        echo '<td>' . $row['Phonenumber'] . '</td>';
     
        echo '</tr>';
    }

    echo '</table>';

  
    echo '<form method="post" action="search_resultsH.php">';
    echo '<input type="hidden" name="generate_pdf" value="1">';
    echo '<button type="submit">Download PDF</button>';
    echo '</form>';

    if (isset($_POST['generate_pdf'])) {
       
        $pdf = new TCPDF();

        
        $pdf->SetCreator('Your Name');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Search Results PDF');

     
        $pdf->AddPage();

  
        if ($result->num_rows > 0) {
            $html = '<table border="1">
                        <tr>
                            <th>Homename</th>
                            <th>Needs</th>
                            <th>Description</th>
                            <th>Address</th>
                            <th>Contact</th>
                        </tr>';

            while ($row = $result->fetch_assoc()) {
                $html .= '<tr>
                            <td>' . $row['Homename'] . '</td>
                            <td>' . $row['Needs'] . '</td>
                            <td>' . $row['Description'] . '</td>
                            <td>' . $row['Address'] . '</td>
                            <td>' . $row['Phonenumber'] . '</td>
                        </tr>';
            }

            $html .= '</table>';

          
            $pdf->writeHTML($html, true, false, true, false, '');

            $pdf->Output('download.pdf', 'D');
            exit;
        }
    }
} else {
    echo "No data found";
}


$conn->close();
?>
