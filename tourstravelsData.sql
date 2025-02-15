-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 09, 2023 at 01:11 PM
-- Server version: 10.5.16-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id20527415_tourstravels`
--

-- --------------------------------------------------------

--
-- Table structure for table `Bookings`
--

CREATE TABLE `Bookings` (
  `BookingsId` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `BookedDate` date DEFAULT curdate(),
  `Package_id` int(11) DEFAULT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Bookings`
--



-- --------------------------------------------------------

--
-- Table structure for table `Feedback`
--

CREATE TABLE `Feedback` (
  `FeedbackId` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `Feed` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Feedback`
--


-- --------------------------------------------------------

--
-- Table structure for table `Hotel`
--

CREATE TABLE `Hotel` (
  `HotelId` int(11) NOT NULL,
  `HotelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HotelLocation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HotelImage` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `HotelPrice` bigint(20) DEFAULT NULL,
  `HotelDescription` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact` bigint(20) NOT NULL DEFAULT 9875641230
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Hotel`
--

INSERT INTO `Hotel` (`HotelId`, `HotelName`, `HotelLocation`, `HotelImage`, `HotelPrice`, `HotelDescription`, `Contact`) VALUES
(1, 'The Everest Hotel', 'Kathmandu', 'https://pix8.agoda.net/hotelImages/9820752/-1/548705e1ca2fec38bb0893cdc66d2bb9.jpg?ca=14&ce=1&s=1024x768', 5000, 'Luxury hotel located in the heart of Kathmandu, offering breathtaking views of the city and the Himalayas.', 9875641230),
(2, 'Annapurna Hotel', 'Pokhara', 'https://assets-api.kathmandupost.com/thumb.php?src=https://assets-cdn.kathmandupost.com/uploads/source/news/2020/money/annapurnahotel-1608561353.jpg&w=900&height=601', 4000, 'Charming hotel located in the scenic lakeside city of Pokhara, with comfortable rooms and stunning views of the Annapurna mountain range.', 9875641230),
(3, 'Himalayan Lodge', 'Namche', 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/0e/94/02/1a/himalayan-lodge.jpg?w=1200&h=-1&s=1', 2000, 'Rustic lodge located in the heart of Namche Bazaar, offering comfortable rooms and stunning views of the Himalayas.', 9875641230),
(4, 'Gokarna Forest Resort', 'Kathmandu', 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/19/8f/6a/fb/main-courtyard.jpg?w=1200&h=-1&s=1', 6000, 'Luxury resort located in the tranquil forests of Gokarna, just a short drive from the bustling city of Kathmandu.', 9875641230),
(6, 'Tiger Mountain Pokhara Lodge', 'Pokhara', 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/01/cd/a0/af/main-lodge-terrace-in.jpg?w=1200&h=-1&s=1', 4500, 'Charming eco-lodge located on a hilltop near Pokhara, with stunning views of the Himalayas and personalized service.', 9875641230);

-- --------------------------------------------------------

--
-- Table structure for table `Package`
--

CREATE TABLE `Package` (
  `Package_id` int(11) NOT NULL,
  `PackageName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Days` int(11) DEFAULT NULL,
  `LocationName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ImageLink` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Price` bigint(20) DEFAULT NULL,
  `Difficulty` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Transportation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Accomodation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `About` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `Itinerary` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Package`
--

INSERT INTO `Package` (`Package_id`, `PackageName`, `Days`, `LocationName`, `ImageLink`, `Rating`, `Price`, `Difficulty`, `Transportation`, `Accomodation`, `About`, `Itinerary`) VALUES
(1, 'Himalayan Trek', 10, 'Nepal', 'https://www.muchbetteradventures.com/magazine/content/images/2021/09/GettyImages-1193774981--1-.jpg', 4, 3500, 'Challenging', 'Foot', 'Teahouse', 'Embark on a challenging trek through the Himalayas and witness stunning vistas and rugged landscapes.      ', 'Day 1: Arrival in Kathmandu\r\nDay 2: Drive to Pokhara\r\nDay 3-9: Trek to Annapurna Base Camp\r\nDay 10: Return to Pokhara\r\nDay 11: Departure from Kathmandu'),
(2, 'Jungle', 5, 'Chitwan', 'https://www.vivaanadventure.com/wp-content/uploads/2018/07/76909341_554038845166656_3920037840554818945_n-1080x540.jpg', 3, 1200, 'Easy', 'jeep', 'Lodge', 'Explore the lush jungles of Nepal and get up close with exotic wildlife on a thrilling safari adventure.   ', 'Day 1: Arrival in Kathmandu\r\nDay 2: Drive to Chitwan National Park\r\nDay 3-4: Jungle Safari and Nature Walks\r\nDay 5: Return to Kathmandu\r\nDay 6: Departure from Kathmandu'),
(3, 'Cultural Tour', 7, 'Bhaktapur', 'https://media.tacdn.com/media/attractions-splice-spp-674x446/0b/27/89/2a.jpg', 4, 2000, 'Easy', 'Bus', 'Hotel', 'Discover the rich culture and heritage of Nepal with visits to ancient temples, palaces, and historic landmarks.  ', 'Day 1: Arrival in Kathmandu\r\nDay 2: Sightseeing in Kathmandu\r\nDay 3: Drive to Pokhara\r\nDay 4: Sightseeing in Pokhara\r\nDay 5-6: Explore the Temples of Bhaktapur\r\nDay 7: Departure from Kathmandu'),
(4, 'White Water Rafting', 3, 'Sindupalchowk', 'https://www.thirdrockadventures.com/assets-back/images/blog/rafting-in-nepal.jpgHpB.jpg', 3, 800, 'Moderate', 'Boat', 'Camping', 'Experience the thrill of white water rafting on the roaring rivers of Nepal and camp under the stars in the wilderness.      ', 'Day 1: Arrival in Kathmandu\r\nDay 2: Drive to the River Camp\r\nDay 3: White Water Rafting\r\nDay 4: Return to Kathmandu\r\nDay 5: Departure from Kathmandu'),
(7, 'Ruby Valley Trek', 5, 'Ganesh', 'https://himalayantrekkers.com/uploads/trips/March2021/Ruby-Valley-Trek-ganesh-himal-region.jpg', 3, 40000, 'Challenging', 'Flight', 'Tea House', 'Ruby Valley Trek is a relatively new and less-crowded trekking route that offers a unique blend of natural beauty, cultural encounters, and panoramic mountain vistas. The trail takes you through lush forests, terraced fields, charming villages, and pristine rivers, providing an immersive experience of rural Nepalese life. The region is known for its abundant ruby deposits, hence the name \"Ruby Valley.\" ', 'Day 1: Arrival in Kathmandu\r\nDay 2: Sightseeing and trek preparation in Kathmandu\r\nDay 3: Drive from Kathmandu to Syabrubesi (1,550m)\r\nDay 4: Trek from Syabrubesi to Gatlang (2,238m)\r\nDay 5: Trek from Gatlang to Somdang (3,270m)\r\nDay 6: Trek from Somdang to Pangsang Pass Base Camp (3,842m)\r\nDay 7: Trek from Pangsang Pass Base Camp to Tipling (2,420m)\r\nDay 8: Trek from Tipling to Chalish Gaon (1,670m)\r\nDay 9: Trek from Chalish Gaon to Jharlang (1,600m)\r\nDay 10: Trek from Jharlang to Kintang Phedi (1,700m)\r\nDay 11: Trek from Kintang Phedi to Darkha Gaon (1,230m)\r\nDay 12: Trek from Darkha Gaon to Dhading Besi (830m) and drive back to Kathmandu\r\nDay 13: Departure from Kathmandu\r\n'),
(8, 'Langtang Trek', 8, 'Rasuwa', 'https://source.unsplash.com/1200x600/?langtang', 5, 55000, 'Moderate', 'Bus', 'Motels', 'Langtang Trek takes you through the pristine Langtang Valley, located to the north of Kathmandu. The trail offers breathtaking views of snow-capped peaks, picturesque landscapes, and encounters with the warm-hearted Tamang and Tibetan communities. The region is also home to Langtang National Park, which is renowned for its unique wildlife and beautiful rhododendron forests.', 'Day 1: Arrival in Kathmandu\r\nDay 2: Sightseeing and trek preparation in Kathmandu\r\nDay 3: Drive from Kathmandu to Syabrubesi (1,550m)\r\nDay 4: Trek from Syabrubesi to Lama Hotel (2,380m)\r\nDay 5: Trek from Lama Hotel to Langtang Village (3,430m)\r\nDay 6: Trek from Langtang Village to Kyanjin Gompa (3,870m)\r\nDay 7: Acclimatization day in Kyanjin Gompa (optional hike to Tserko Ri - 4,984m)\r\nDay 8: Trek from Kyanjin Gompa to Lama Hotel (2,380m)\r\nDay 9: Trek from Lama Hotel to Syabrubesi (1,550m)\r\nDay 10: Drive from Syabrubesi to Kathmandu\r\nDay 11: Departure from Kathmandu');

-- --------------------------------------------------------

--
-- Table structure for table `Rating`
--

CREATE TABLE `Rating` (
  `RatingId` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `Ratings` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Rating`
--


--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `User_Id` int(11) NOT NULL,
  `Username` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Role` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `User`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `Bookings`
--
ALTER TABLE `Bookings`
  ADD PRIMARY KEY (`BookingsId`),
  ADD KEY `User_Id` (`User_Id`),
  ADD KEY `Package_id` (`Package_id`);

--
-- Indexes for table `CustomPackage`
--
-- ALTER TABLE `CustomPackage`
--   ADD PRIMARY KEY (`Package_id`),
--   ADD KEY `User_Id` (`User_Id`);

--
-- Indexes for table `Feedback`
--
ALTER TABLE `Feedback`
  ADD PRIMARY KEY (`FeedbackId`),
  ADD KEY `User_Id` (`User_Id`);

--
-- Indexes for table `Hotel`
--
ALTER TABLE `Hotel`
  ADD PRIMARY KEY (`HotelId`);

--
-- Indexes for table `Package`
--
ALTER TABLE `Package`
  ADD PRIMARY KEY (`Package_id`);

--
-- Indexes for table `Rating`
--
ALTER TABLE `Rating`
  ADD PRIMARY KEY (`RatingId`),
  ADD KEY `User_Id` (`User_Id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`User_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Bookings`
--
ALTER TABLE `Bookings`
  MODIFY `BookingsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `CustomPackage`
--
-- ALTER TABLE `CustomPackage`
--   MODIFY `Package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Feedback`
--
ALTER TABLE `Feedback`
  MODIFY `FeedbackId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Hotel`
--
ALTER TABLE `Hotel`
  MODIFY `HotelId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Package`
--
ALTER TABLE `Package`
  MODIFY `Package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Rating`
--
ALTER TABLE `Rating`
  MODIFY `RatingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Bookings`
--
ALTER TABLE `Bookings`
  ADD CONSTRAINT `Bookings_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `User` (`User_Id`),
  ADD CONSTRAINT `Bookings_ibfk_2` FOREIGN KEY (`Package_id`) REFERENCES `Package` (`Package_id`) ON DELETE CASCADE;

--
-- Constraints for table `CustomPackage`
--
-- ALTER TABLE `CustomPackage`
--   ADD CONSTRAINT `CustomPackage_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `User` (`User_Id`);

--
-- Constraints for table `Feedback`
--
ALTER TABLE `Feedback`
  ADD CONSTRAINT `Feedback_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `User` (`User_Id`);

--
-- Constraints for table `Rating`
--
ALTER TABLE `Rating`
  ADD CONSTRAINT `Rating_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `User` (`User_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- <?php 
-- session_start();
-- if(!isset($_SESSION['idz'])){
--     header("Location: ../index.php");
-- }
-- require_once "../Backend/getCount.php";
-- ?>
-- <!DOCTYPE html>
-- <html lang="en">
-- <head>
--     <script src="../display/sweetalert.min.js"></script>
--     <script src="confirm.js"></script>
--     <meta charset="UTF-8">
--     <meta http-equiv="X-UA-Compatible" content="IE=edge">
--     <meta name="viewport" content="width=device-width, initial-scale=1.0">
--     <link rel="stylesheet" href="Dashboard/dash.css">
--     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
--     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
--     <title>Admin Panel</title>
--     <style>
--         .cards {
--             display: grid;
--             grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
--             gap: 20px;
--             margin-bottom: 30px;
--         }
--         .card {
--             background: white;
--             padding: 20px;
--             border-radius: 10px;
--             box-shadow: 0 0 10px rgba(0,0,0,0.1);
--             display: flex;
--             justify-content: space-between;
--             align-items: center;
--             transition: transform 0.3s;
--         }
--         .card:hover {
--             transform: translateY(-5px);
--         }
--         .analytics-grid {
--             display: grid;
--             grid-template-columns: repeat(2, 1fr);
--             gap: 20px;
--             margin-top: 30px;
--         }
--         .analytics-card {
--             background: white;
--             padding: 20px;
--             border-radius: 10px;
--             box-shadow: 0 0 10px rgba(0,0,0,0.1);
--         }
--         .analytics-card h2 {
--             margin-bottom: 20px;
--             color: #333;
--             font-size: 1.2em;
--         }
--         .list-item {
--             display: flex;
--             justify-content: space-between;
--             padding: 10px 0;
--             border-bottom: 1px solid #eee;
--         }
--         .list-item:last-child {
--             border-bottom: none;
--         }
--         .chart-container {
--             height: 300px;
--             margin-top: 20px;
--         }
--         .badge {
--             background: #e3f2fd;
--             color: #1976d2;
--             padding: 5px 10px;
--             border-radius: 20px;
--             font-size: 0.8em;
--         }
--     </style>
-- </head>
-- <body>
--     <!-- Your existing sidebar code remains the same -->
    
--     <div class="container">
--         <div class="header">
--             <div class="nav">
--                 <div class="user">
--                     <a>Admin Dashboard</a>
--                 </div>
--             </div>
--         </div>
        
--         <div class="content">
--             <!-- Summary Cards -->
--             <div class="cards">
--                 <div class="card">
--                     <div class="box">
--                         <h1><?php echo getUserCount();?></h1>
--                         <h3>Total Users</h3>
--                     </div>
--                     <div class="icon-case">
--                         <i class="fas fa-users fa-2x" style="color: #1976d2;"></i>
--                     </div>
--                 </div>
--                 <div class="card">
--                     <div class="box">
--                         <h1><?php echo getBookingCount();?></h1>
--                         <h3>Total Bookings</h3>
--                     </div>
--                     <div class="icon-case">
--                         <i class="fas fa-calendar-check fa-2x" style="color: #388e3c;"></i>
--                     </div>
--                 </div>
--                 <div class="card">
--                     <div class="box">
--                         <h1><?php echo getPackageCount();?></h1>
--                         <h3>Total Packages</h3>
--                     </div>
--                     <div class="icon-case">
--                         <i class="fas fa-box fa-2x" style="color: #f57c00;"></i>
--                     </div>
--                 </div>
--             </div>

--             <!-- Analytics Grid -->
--             <div class="analytics-grid">
--                 <!-- Most Booked Packages -->
--                 <div class="analytics-card">
--                     <h2>Most Popular Packages</h2>
--                     <?php
--                     $popular_packages = getMostBookedPackages();
--                     while($package = mysqli_fetch_assoc($popular_packages)) {
--                         echo '<div class="list-item">
--                                 <span>'.$package['PackageName'].'</span>
--                                 <span class="badge">'.$package['booking_count'].' bookings</span>
--                               </div>';
--                     }
--                     ?>
--                 </div>

--                 <!-- Top Customers -->
--                 <div class="analytics-card">
--                     <h2>Top Customers</h2>
--                     <?php
--                     $top_customers = getTopCustomers();
--                     while($customer = mysqli_fetch_assoc($top_customers)) {
--                         echo '<div class="list-item">
--                                 <span>'.$customer['Username'].'</span>
--                                 <span class="badge">'.$customer['booking_count'].' bookings</span>
--                               </div>';
--                     }
--                     ?>
--                 </div>

--                 <!-- Recent Signups -->
--                 <div class="analytics-card">
--                     <h2>Recent Signups</h2>
--                     <?php
--                     $recent_signups = getRecentSignups();
--                     while($user = mysqli_fetch_assoc($recent_signups)) {
--                         echo '<div class="list-item">
--                                 <span>'.$user['Username'].'</span>
--                               </div>';
--                     }
--                     ?>
--                 </div>

--                 <!-- Monthly Bookings Chart -->
--                 <div class="analytics-card">
--                     <h2>Monthly Bookings</h2>
--                     <div class="chart-container">
--                         <canvas id="bookingsChart"></canvas>
--                     </div>
--                 </div>
--             </div>
--         </div>
--     </div>

--     <script>
--     // Initialize Monthly Bookings Chart
--     <?php
--     $monthly_bookings = getMonthlyBookings();
--     $labels = [];
--     $data = [];
--     while($row = mysqli_fetch_assoc($monthly_bookings)) {
--         $labels[] = date('M Y', strtotime($row['month'].'-01'));
--         $data[] = $row['booking_count'];
--     }
--     ?>

--     new Chart(document.getElementById('bookingsChart'), {
--         type: 'line',
--         data: {
--             labels: <?php echo json_encode(array_reverse($labels)); ?>,
--             datasets: [{
--                 label: 'Number of Bookings',
--                 data: <?php echo json_encode(array_reverse($data)); ?>,
--                 borderColor: '#1976d2',
--                 tension: 0.1,
--                 fill: true,
--                 backgroundColor: 'rgba(25, 118, 210, 0.1)'
--             }]
--         },
--         options: {
--             responsive: true,
--             maintainAspectRatio: false,
--             plugins: {
--                 legend: {
--                     display: false
--                 }
--             },
--             scales: {
--                 y: {
--                     beginAtZero: true,
--                     ticks: {
--                         stepSize: 1
--                     }
--                 }
--             }
--         }
--     });
--     </script>
-- </body>
-- </html>