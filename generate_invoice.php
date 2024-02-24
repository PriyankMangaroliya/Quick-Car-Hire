<?php

include "./databaseConnection.php";

$Bid = base64_decode(strval($_GET['Bid']));

// Load the HTML template for the invoice
$html = file_get_contents('invoice_bill_template.html');

$query = "SELECT * FROM booking WHERE Booking_Id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $Bid);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

$stmt->close();

$bookingId = $result['Booking_Id'];
$Booking_start_date = $result['Start_Date'];
$Booking_end_date = $result['End_Date'];
$Start_time = $result['Start_Time'];
$End_time = $result['End_Time'];
$Security_deposit = $result['Security_Deposit'];
$Selected_Kms = $result['Selected_Kms'];
$Booking_Amount = $result['Booking_Amount'];
$Offer = $result['Offer'];
$Total_amount = $result['Total_Amount'];

$R_no = $result['Registration_No'];
$Email_id = $result['Email'];

$query1 = "SELECT * FROM car WHERE Registration_No = '$R_no'";
$result1 = $conn->query($query1);
$row1 = $result1->fetch_assoc();
$img = $row1['Image'];
$name = $row1['Name'];
$Brand = $row1['Brand'];
$charge = $row1['Charge_Cost'];

$city = $row1['City_Id'];

$query2 = "SELECT * FROM customer WHERE Email = '$Email_id'";
$result2 = $conn->query($query2);
$row2 = $result2->fetch_assoc();
$cname = $row2['Name'];
$cphone = $row2['Mobile'];
$dl = $row2['Driving_Licence'];
$an = $row2['AadharCard'];

$query3 = "SELECT * FROM city WHERE City_Id = '$city'";
$result3 = $conn->query($query3);
$row3 = $result3->fetch_assoc();
$City = $row3['City'];
$ciMobile = $row3['Mobile'];
$ciEmail = $row3['Email'];
$ciAddress = $row3['Address'];

// Replace placeholders in the HTML template with actual data
$html = str_replace('{{booking_id}}', $bookingId, $html);
$html = str_replace('{{start_date}}', $Booking_start_date, $html);
$html = str_replace('{{end_date}}', $Booking_end_date, $html);
$html = str_replace('{{start_time}}', $Start_time, $html);
$html = str_replace('{{end_time}}', $End_time, $html);
$html = str_replace('{{security_deposit}}', $Security_deposit, $html);
$html = str_replace('{{selected_kms}}', $Selected_Kms, $html);
$html = str_replace('{{offer}}', $Offer, $html);
$html = str_replace('{{total}}', $Total_amount, $html);
$html = str_replace('{{booking}}', $Booking_Amount, $html);

$html = str_replace('{{email}}', $Email_id, $html);
$html = str_replace('{{customer_name}}', $cname, $html);
$html = str_replace('{{customer_contact}}', $cphone, $html);
$html = str_replace('{{customer_an}}', $an, $html);
$html = str_replace('{{customer_dl}}', $dl, $html);

$html = str_replace('{{city}}', $City, $html);
$html = str_replace('{{city_mobile}}', $ciMobile, $html);
$html = str_replace('{{city_email}}', $ciEmail, $html);
$html = str_replace('{{city_address}}', $ciAddress, $html);

$html = str_replace('{{registration_no}}', $R_no, $html);
$html = str_replace('{{car_image}}', $img, $html);
$html = str_replace('{{car_name}}', $name, $html);
$html = str_replace('{{car_brand}}', $Brand, $html);
$html = str_replace('{{charge}}', $charge, $html);



// Load external CSS
$externalCss = "
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css' rel='stylesheet' />
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap' rel='stylesheet' />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css' rel='stylesheet' />
";

$html = $externalCss . $html;

// Convert HTML to PDF using TCPDF
require_once('./pdf/tcpdf.php');
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Quick Car Hire');
//$pdf->SetTitle('Ecommerce Invoice');
$pdf->SetHeaderData('Quick Car Hire', 0, '', '', array(0, 0, 0), array(255, 255, 255));
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('dejavusans', '', 10, '', true);
$pdf->AddPage();
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('QuickcarHire.pdf', 'D');
?>