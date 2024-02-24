<?php

$Bid = base64_decode(strval($_GET['Bid']));
// Set the content type to PDF
header('Content-type: application/pdf');

include 'databaseConnection.php';

$query = "SELECT * FROM booking";
$result = $conn->query($query);
while ($row = mysqli_fetch_array($result)) {
    $bookingId = $row['Booking_Id'];
    $Email_id = $row['Email'];
    $Booking_start_date = $row['Start_Date'];
    $Booking_end_date = $row['End_Date'];
    $Start_meter = $row['Start_Meter'];
    $End_meter = $row['End_Meter'];
    $Start_time = $row['Start_Time'];
    $End_time = $row['End_Time'];
    $Security_deposit = $row['Security_Deposit'];
    $Booking_amount = $row['Amount'];
    $R_no = $row['Registration_No'];
    $CheckP = $conn->prepare("SELECT * FROM car WHERE Registration_No = ?");
    $CheckP->bind_param("s", $R_no);
    $result1 = $CheckP->execute();
    $result1 = $CheckP->get_result()->fetch_all(MYSQLI_ASSOC);
    foreach ($result1 as $row1) {
        $img = $row1['Image'];
    }
}


// Set the file name
$filename = $bookingId . '.pdf';

// Set the download disposition
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Load the HTML template for the invoice
$html = file_get_contents('./invoice.html');

// Replace the placeholder values in the template with actual data
// For example:
$html = str_replace('{{order_number}}', $bookingId, $html);
$html = str_replace('{{customer_name}}', $Email_id, $html);
$html = str_replace('{{order_SDate}}', $Booking_start_date, $html);
$html = str_replace('{{order_EDate}}', $Booking_end_date, $html);
$html = str_replace('{{order_Date}}', $Security_deposit, $html);
$html = str_replace('{{order_TotalAmount}}', $Booking_amount, $html);
//order_TotalAmount
// Add more replacements for other invoice data
// Convert HTML to PDF using an external library like pdf, Dompdf, etc.
// Make sure to include the library files in the appropriate location
// Example using pdf
require_once('pdf/tcpdf.php');
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Ecommerce Invoice');
$pdf->SetHeaderData('', 0, '', '', array(0, 0, 0), array(255, 255, 255));
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('dejavusans', '', 10, '', true);
$pdf->AddPage();
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output($filename, 'D');
