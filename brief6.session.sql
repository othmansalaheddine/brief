-- @block
DROP DATABASE ELECTROTHMAN ; 
-- @block
CREATE DATABASE ELECTROTHMAN ; 
USE ELECTROTHMAN ; 
CREATE TABLE users (
   id int PRIMARY KEY AUTO_INCREMENT, 
   username varchar(25),
   email varchar(25),
   phone varchar(25),
   password varchar(25),
   type ENUM('unverified', 'user', 'admin') DEFAULT 'unverified'
);


CREATE TABLE product (
   id int PRIMARY KEY AUTO_INCREMENT, 
   name varchar(255),
   old_price float,
   new_price float,
   image varchar (255),
   stock int,
   country varchar(255),
   city varchar(255),
   category int 
);

INSERT INTO product (name, old_price, new_price, category, image, stock, country, city) VALUES
("LED", 0.5, 0.25, 1, "LED.jpg", 12, "USA", "New York"),
("Resistor", 0.1, 0.05, 3, "Resistor.jpg", 5, "Canada", "Toronto"),
("Arduino", 10.0, 5.0, 2, "arduino.jpg", 4, "Germany", "Berlin"),
("Raspberry Pi", 35.0, 17.5, 2, "Raspberry_Pi.jpg", 1, "France", "Paris"),
("Capacitor", 0.2, 0.1, 1, "Capacitor.jpg", 0, "Australia", "Sydney"),
("Transistor", 0.3, 0.15, 1, "Transistor.jpg", 3, "Japan", "Tokyo"),
("Diode", 0.2, 0.1, 1, "Diode.jpg", 7, "Brazil", "Rio de Janeiro"),
("Potentiometer", 1.0, 0.5, 3, "Potentiometer.jpg", 19, "India", "Mumbai"),
("Relay", 2.0, 1.0, 2, "Relay.jpg", 102, "China", "Shanghai"),
("IC", 1.5, 0.75, 1, "IC.jpg", 45, "Spain", "Madrid"),
("Breadboard", 5.0, 2.5, 2, "Breadboard.jpg", 5, "United Kingdom", "London"),
("Motor", 8.0, 4.0, 2, "Motor.jpg", 60, "South Korea", "Seoul"),
("Sensor", 3.0, 1.5, 1, "Sensor.jpg", 12, "Mexico", "Mexico City"),
("Switch", 0.5, 0.25, 1, "Switch.jpg", 45, "Italy", "Rome"),
("Battery", 2.0, 1.0, 2, "Battery.jpg", 300, "Russia", "Moscow"),
("Power Supply", 10.0, 5.0, 2, "Power_Supply.jpg", 4, "Sweden", "Stockholm"),
("Wire", 0.1, 0.05, 1, "Wire.jpg", 1000, "Netherlands", "Amsterdam"),
("Connector", 0.3, 0.15, 3, "Connector.jpg", 30, "Switzerland", "Zurich"),
("PCB", 5.0, 2.5, 2, "PCB.jpg", 4, "Belgium", "Brussels"),
("Oscillator", 1.5, 0.75, 1, "Oscillator.jpg", 20, "Argentina", "Buenos Aires");


