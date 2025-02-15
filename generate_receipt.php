<?php
// Turn off output buffering
ob_clean();

// Prevent any unwanted output
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Start session without output
@session_start();

require_once('tcpdf/tcpdf.php');
require_once("Backend/connection.php");

// Check authentication
if (!isset($_SESSION['id'])) {
    header("HTTP/1.1 403 Forbidden");
    exit("Unauthorized access");
}

if (!isset($_GET['booking_id'])) {
    header("HTTP/1.1 400 Bad Request");
    exit("Booking ID not provided");
}

try {
    $booking_id = mysqli_real_escape_string($conn, $_GET['booking_id']);

// Fetch booking details
$query = "SELECT b.*, p.PackageName, p.Price, u.Username as CustomerName, u.Email 
          FROM bookings b 
          JOIN package p ON b.Package_id = p.Package_id 
          JOIN user u ON b.User_Id = u.User_Id 
          WHERE b.BookingsId = '$booking_id' AND b.User_Id = '{$_SESSION['id']}'";

    $result = mysqli_query($conn, $query);
    if (!$result || mysqli_num_rows($result) === 0) {
        throw new Exception("Booking not found");
    }

    $booking = mysqli_fetch_assoc($result);

    // Create new PDF document
    class MYPDF extends TCPDF {
        public function Header() {
            $image_file = 'logo.png';
            $this->Image($image_file, 15, 10, 30, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

            $this->SetFont('helvetica', 'B', 20);
            $this->Cell(0, 15, 'Holiday Hype', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Ln(10);
            $this->SetFont('helvetica', 'B', 15);
            $this->Cell(0, 15, 'Booking Receipt', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        }

        public function Footer() {
            $this->SetY(-15);
            $this->SetFont('helvetica', 'I', 8);
            $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        }
    }

    // Create new PDF instance
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator('Holiday Hype');
    $pdf->SetAuthor('Holiday Hype');
    $pdf->SetTitle('Booking Receipt #' . $booking_id);

    // Remove header/footer data as we're using custom header/footer
    $pdf->SetPrintHeader(true);
    $pdf->SetPrintFooter(true);

    // Set margins
    $pdf->SetMargins(15, 40, 15);
    $pdf->SetHeaderMargin(5);
    $pdf->SetFooterMargin(10);

    // Set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, 15);

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('helvetica', '', 12);

    // Add content
    $pdf->Ln(20);

    // Receipt Details
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'Receipt Details', 0, 1, 'L');
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(60, 10, 'Receipt Number:', 0, 0);
    $pdf->Cell(0, 10, 'RCP-' . str_pad($booking_id, 6, '0', STR_PAD_LEFT), 0, 1);
    $pdf->Cell(60, 10, 'Date:', 0, 0);
    $pdf->Cell(0, 10, date('F j, Y'), 0, 1);

    // Customer Details
    $pdf->Ln(5);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'Customer Information', 0, 1, 'L');
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(60, 10, 'Name:', 0, 0);
    $pdf->Cell(0, 10, $booking['CustomerName'], 0, 1);
    $pdf->Cell(60, 10, 'Email:', 0, 0);
    $pdf->Cell(0, 10, $booking['Email'], 0, 1);

    // Booking Details
    $pdf->Ln(5);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'Booking Information', 0, 1, 'L');
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(60, 10, 'Booking ID:', 0, 0);
    $pdf->Cell(0, 10, '#' . $booking_id, 0, 1);
    $pdf->Cell(60, 10, 'Package:', 0, 0);
    $pdf->Cell(0, 10, $booking['PackageName'], 0, 1);
    $pdf->Cell(60, 10, 'Booked Date:', 0, 0);
    $pdf->Cell(0, 10, date('F j, Y', strtotime($booking['BookedDate'])), 0, 1);
    $pdf->Cell(60, 10, 'Status:', 0, 0);
    $pdf->Cell(0, 10, ucfirst($booking['status']), 0, 1);

    // Payment Details
    $pdf->Ln(5);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'Payment Information', 0, 1, 'L');
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(60, 10, 'Amount Paid:', 0, 0);
    $pdf->Cell(0, 10, 'NPR ' . number_format($booking['Price'], 2), 0, 1);
    $pdf->Cell(60, 10, 'Payment Method:', 0, 0);
    $pdf->Cell(0, 10, 'Khalti', 0, 1);

    // Terms and conditions
    $pdf->Ln(10);
    $pdf->SetFont('helvetica', 'I', 10);
    $pdf->MultiCell(0, 10, 'Thank you for choosing Holiday Hype. This is a computer-generated receipt and does not require a physical signature.', 0, 'L', 0);

    // Clean any output buffers
    ob_end_clean();

    // Output PDF
    $pdf->Output('Receipt_Booking_' . $booking_id . '.pdf', 'D');
    exit();

} catch (Exception $e) {
    // Log error
    error_log($e->getMessage());
    header("HTTP/1.1 500 Internal Server Error");
    exit("Error generating receipt: " . $e->getMessage());
}
?>