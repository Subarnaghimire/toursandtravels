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
    <link rel="stylesheet" href="Package/package.css">
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
                    <a>Packages</a>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="content-2">
                <div class="pack">
                    <div class="title">
                        <input type="button" value="Add Packages" class="add_package" onClick="document.location.href='Package/addPackage.php'">
                        <h2>All Packages</h2>
                        <div class="search_box">
                            <input type="text" placeholder="Search.." id="find" onkeyup="search()">
                        </div>
                        <div class="button-group">
                            <input type="button" value="Export to Excel" class="export_button blue" onclick="exportToExcel()">
                            <input type="button" value="Export to PDF" class="export_button green" onclick="exportToPDF()">
                        </div>
                    </div>

                    <table id="packageTable">
                        <tr>
                            <th>Package Name</th>
                            <th>Duration</th>
                            <th>Location</th>
                            <th>Price (in Rs)</th>
                            <th>Difficulty</th>
                            <th>Accommodation</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        require_once "../Backend/getData.php";
                        $result = fetchPackages();
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['PackageName'] . "</td>";
                            echo "<td>" . $row['Days'] . "</td>";
                            echo "<td>" . $row['LocationName'] . "</td>";
                            echo "<td>" . $row['Price'] . "</td>";
                            echo "<td>" . $row['Difficulty'] . "</td>";
                            echo "<td>" . $row['Accomodation'] . "</td>";
                            $id = $row['Package_id'];
                            echo "<td>
                                    <a onClick=\"forEditAction('You want to edit the Package','./Package/updatePackage.php?id=" . $id . "')\"><i class='fas fa-pencil-alt'></i></a>
                                    <a onClick=\"forAction('You want to delete the Package','../Backend/Package/delete.php?id=" . $id . "')\"><i class='fas fa-trash-alt'></i></a>
                                  </td>";
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
            table = document.getElementById("packageTable");
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
            const table = document.getElementById("packageTable");
            const wb = XLSX.utils.table_to_book(table, { sheet: "Packages" });
            XLSX.writeFile(wb, "Packages.xlsx");
        }

        function exportToPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Add title to the PDF
            doc.setFontSize(18);
            doc.setFont("helvetica", "bold");
            doc.setTextColor(41, 128, 185); // Blue color for title
            doc.text("Holiday Hype - Packages", 14, 22);

            // Add subtitle with current date
            const date = new Date().toLocaleDateString();
            doc.setFontSize(12);
            doc.setFont("helvetica", "normal");
            doc.setTextColor(0, 0, 0); // Black color for subtitle
            doc.text(`Generated on: ${date}`, 14, 30);

            // Add table using autoTable plugin with increased row height
            doc.autoTable({
                html: '#packageTable',
                startY: 40, // Start below the title
                theme: 'grid', // Use grid theme for visible borders
                headStyles: {
                    fillColor: [41, 128, 185], // Header background color (blue)
                    textColor: [255, 255, 255], // Header text color (white)
                    fontStyle: 'bold', // Bold header text
                    halign: 'center', // Center align header text
                    lineColor: [0, 0, 0], // Black borders for headers
                    lineWidth: 0.2, // Border width
                    fontSize: 10, // Font size for headers
                    cellPadding: 6 // Increased cell padding for headers
                },
                bodyStyles: {
                    textColor: [0, 0, 0], // Body text color (black)
                    cellPadding: 6, // Increased cell padding for body
                    halign: 'center', // Center align body text
                    lineColor: [0, 0, 0], // Black borders for body
                    lineWidth: 0.2, // Border width
                    fontStyle: 'normal', // Normal font for body
                    fontSize: 9, // Font size for body
                },
                alternateRowStyles: {
                    fillColor: [245, 245, 245] // Alternate row color (light gray)
                },
                columnStyles: {
                    0: { cellWidth: 30 }, // Adjust column width for Package Name
                    1: { cellWidth: 20 }, // Adjust column width for Duration
                    2: { cellWidth: 30 }, // Adjust column width for Location
                    3: { cellWidth: 20 }, // Adjust column width for Price
                    4: { cellWidth: 20 }, // Adjust column width for Difficulty
                    5: { cellWidth: 30 }, // Adjust column width for Accommodation
                    6: { cellWidth: 20 } // Adjust column width for Action
                },
                rowHeight: 25 // Explicitly set row height
            });

            // Save the PDF
            doc.save("Packages.pdf");
        }

        // Function for edit confirmation popup
        function forEditAction(message, url) {
            swal({
                title: "Are you sure?",
                text: message,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willEdit) => {
                if (willEdit) {
                    window.location.href = url;
                }
            });
        }

        // Function for delete confirmation popup
        function forAction(message, url) {
            swal({
                title: "Are you sure?",
                text: message,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = url;
                }
            });
        }
    </script>
</body>

</html>