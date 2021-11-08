
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";



CREATE TABLE `products` (
  `Id` int(8) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Sku` int(10) NOT NULL,
  `Price` double(10,2) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `products` (`Id`, `Name`, `Sku`, `Price`, `Description`, `image`) VALUES
(1, 'Black purse', 400, 700.00, 'It is very attractive and soft to use', 'images/1.jpg'),
(2, 'Brown Glasses', 401, 450.00, 'Stylish and attractive purse', 'images/2.jpg'),
(3, 'Brown bag', 402, 1500.00, 'Easy for travelling purposes', 'images/3.jpg'),
(4, 'Tourister bag', 403, 2000.00, 'More quantity to put inside the bag', 'images/4.jpg'),
(5, 'Brown Tourister', 404, 2500.00, 'A stylish bag which gives a cool look', 'images/5.jpg'),
(6, 'Colored wires', 405, 100.00, 'A combo of wires', 'images/6.jpg'),
(7, 'Wires colored combo', 407, 150.00, 'Silicon wire with combos', 'images/7.jpg'),
(8, 'Wire', 408, 200.00, 'High quality wire', 'images/8.jpg'),
(9, 'Light wires', 409, 175.00, 'Different wires with high protection', 'images/9.jpg'),
(10, 'Combo of three wires', 410, 200.00, 'Combo of three high quality wires', 'images/10.jpg'),
(11, 'Cream shirt', 411, 300.00, 'A perfect combination for a black pant', 'images/11.jpg'),
(12, 'Blue shirt', 412, 300.00, 'An attractive color and a perfect dress for men', 'images/12.jpg'),
(13, 'White shirt', 413, 300.00, 'Suits with just all the pants', 'images/13.jpg'),
(14, 'Green shirt', 414, 300.00, 'Comfortable to use', 'images/14.jpg'),
(15, 'Dark blue shirt', 415, 300.00, 'A nice formal one to wear in office', 'images/15.jpg'),
(16, 'Whirlpool oven', 416, 14000.00, 'Easy to cook', 'images/16.jpg'),
(17, 'Kashmiri oven', 417, 15000.00, 'Cooks a pizza in few minutes', 'images/17.jpg'),
(18, 'Whirlpool fridge', 418, 20000.00, 'Can store many amounts of food', 'images/18.jpg'),
(19, 'Lenovo fridge', 419, 25000.00, 'An high quality fridge', 'images/19.jpg'),
(20, 'Samsung fridge', 420, 12000.00, 'A well known brand which is trustable.', 'images/20.jpg');

ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Sku` (`Sku`);

