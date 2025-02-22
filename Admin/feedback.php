<?php
session_start();
if (!isset($_SESSION['idz'])) {
  header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <script src="confirm.js"></script>
  <script src="../display/sweetalert.min.js"></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Dashboard/feedback.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <title>Admin Panel</title>
  <!-- Include SheetJS for Excel export -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
  <!-- Include jsPDF for PDF export -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>
  <!-- Custom CSS for Export Buttons -->
  <style>
    .export_button {
      border: none;
      color: white;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    /* Green button */
    .export_button.green {
      background-color: #4CAF50;
      /* Green */
    }

    /* Blue button */
    .export_button.blue {
      background-color: #2196F3;
      /* Blue */
    }

    .export_button.green:hover {
      background-color: #45a049;
      /* Darker Green */
    }

    .export_button.blue:hover {
      background-color: #1e88e5;
      /* Darker Blue */
    }

    .export_button.green:active {
      background-color: #3e8e41;
      /* Even Darker Green */
    }

    .export_button.blue:active {
      background-color: #1976d2;
      /* Even Darker Blue */
    }

    /* Adjust spacing between buttons and search box */
    .title {
      display: flex;
      align-items: center;
      gap: 10px;
      /* Space between elements */
    }

    .search_box {
      margin-right: auto;
      /* Pushes search box to the left */
    }

    .button-group {
      display: flex;
      gap: 5px;
      /* Decreased space between buttons */
    }
  </style>
</head>

<body>
  <?php
  require_once "../Backend/getCount.php";
  if (isset($_SESSION['mssg'])) {
    echo '<script>swal("' . $_SESSION['mssg'] . '", {icon: "success"})</script>';
    unset($_SESSION['mssg']);
  }
  ?>
  <div class="Dassh">
    <div class="hype">
      <img src="../logo.png" href="#" class="logo" alt="Logo" title="Holiday Hype" onclick="window.location.reload();">
      <span>Holiday Hype</span>
    </div>
    <ul>
      <li><a href="dashboard.php"><img src="img/dashboard.png">Dashboard</a></li>
    </ul>
    <ul>
      <li><a href="Package.php"><img src="img/package.png">Package</a> </li>
    </ul>
    <ul>
      <li><a href="feedback.php" class="active"><img src="img/feedback.png">Feedback</a></li>
    </ul>
    <ul>
      <li><a href="Bookings.php"><img src="img/bookings.png">Bookings</a> </li>
    </ul>
    <ul>
      <li><a href="hotel.php"><img src="img/hotel.png">Hotel</a> </li>
    </ul>
    <ul>
      <li><a onclick="toLogout()"><img src="img/logout.png">Logout</a> </li>
    </ul>
  </div>
  <div class="container">
    <div class="header">
      <div class="nav">
        <div class="user">
          <a>Feedback</a>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="content-2">
        <div class="pack">
          <div class="title">
            <h2>All Feedbacks</h2>
            <div class="search_box">
              <input type="text" placeholder="Search.." id="find" onkeyup="search()">
            </div>
            <div class="button-group">
              <input type="button" value="Export to Excel" class="export_button blue" onclick="exportToExcel()">
              <input type="button" value="Export to PDF" class="export_button green" onclick="exportToPDF()">
            </div>
          </div>

          <table id="feedbackTable">
            <tr>
              <th>Feedback By</th>
              <th>Feedback</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            <?php
            require_once "../Backend/getData.php";
            $result = fetchFeedbacks();
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>" . $row['Username'] . "</td>";
              echo "<td>" . $row['Feed'] . "</td>";
              echo "<td>" . $row['status'] . "</td>";
              $id = $row['FeedbackId'];
              echo "<td><a onClick=\"forAction('You want to approve the Feedback','../Backend/Approve/approveFeedback.php?id=" . $id . "&approve=yes')\"><i class='fas fa-check'></i></a>";
              echo "<a onClick=\"forAction('You want to reject the Feedback','../Backend/Approve/approveFeedback.php?id=" . $id . "&approve=no')\"><i class='fas fa-times'></i></a></td>";
              echo "</tr>";
            }
            ?>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
function search() {
    let input, filter, table, tr, td, txtValue;
    input = document.getElementById("find");
    filter = input.value.toUpperCase();
    table = document.getElementById("feedbackTable");
    tr = table.getElementsByTagName("tr");

    for (let i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

// Function to export table data to Excel
function exportToExcel() {
    const table = document.getElementById("feedbackTable");
    const wb = XLSX.utils.table_to_book(table, {sheet: "Feedbacks"});
    XLSX.writeFile(wb, "Feedbacks.xlsx");
}

// Function to export table data to PDF
function exportToPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Add title to the PDF
    doc.setFontSize(18);
    doc.setFont("helvetica", "bold");
    doc.setTextColor(41, 128, 185); // Blue color for title
    doc.text("Holiday Hype - Feedbacks", 14, 22);

    // Add subtitle with current date
    const date = new Date().toLocaleDateString();
    doc.setFontSize(12);
    doc.setFont("helvetica", "normal");
    doc.setTextColor(0, 0, 0); // Black color for subtitle
    doc.text(`Generated on: ${date}`, 14, 30);

    // Add table using autoTable plugin
    doc.autoTable({
        html: '#feedbackTable',
        startY: 40, // Start below the title
        theme: 'grid', // Use grid theme for visible borders
        headStyles: { 
            fillColor: [41, 128, 185], // Header background color (blue)
            textColor: [255, 255, 255], // Header text color (white)
            fontStyle: 'bold', // Bold header text
            halign: 'center', // Center align header text
            lineColor: [0, 0, 0], // Black borders for headers
            lineWidth: 0.2 // Border width
        },
        bodyStyles: {
            textColor: [0, 0, 0], // Body text color (black)
            cellPadding: 5, // Cell padding
            halign: 'center', // Center align body text
            lineColor: [0, 0, 0], // Black borders for body
            lineWidth: 0.2 // Border width
        },
        alternateRowStyles: {
            fillColor: [245, 245, 245] // Alternate row color (light gray)
        },
        columnStyles: {
            0: { cellWidth: 30 }, // Adjust column width for Booked By
            1: { cellWidth: 30 }, // Adjust column width for Package Name
            2: { cellWidth: 30 }, // Adjust column width for Booked Date
            3: { cellWidth: 20 }, // Adjust column width for Status
            4: { cellWidth: 20 } // Adjust column width for Action
        }
    });

    // Save the PDF
    doc.save("Feedbacks.pdf");
}
</script>
</body>
</html>
