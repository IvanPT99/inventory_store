# PHP and MySQL Inventory Management - Class Assignment

## Description

This is a class assignment that involves creating a **MariaDB** database with a **PHP** backend to manage an inventory system for a store. The database contains two main tables: **products** and **categories**, with a relationship between them to associate products with a specific category.

The project also includes a PHP backend to add, list, update, and delete products in the database. Additionally, a simple frontend using **HTML** and **CSS** is provided to interact with the system.

## Features

1. **Add a new product**: Form to capture product details and store them in the database.
2. **List products**: Page to display all products with details such as name, price, quantity, and category.
3. **Update product information**: Form to modify the price or quantity of a product.
4. **Delete a product**: Functionality to delete a specific product by `product_id`.

## Database Structure

The database is named **`inventory_store`** and contains two main tables:

### Table: **categories**
```sql
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);
```

### Table: **products**
```sql
CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2),
    quantity INT,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
);
```
## Initial Data Insertion

For initial testing, some data is inserted into the categories and products tables:

```sql
INSERT INTO categories (name) VALUES ('Electronics');
INSERT INTO categories (name) VALUES ('Clothing');
INSERT INTO categories (name) VALUES ('Home Appliances');

INSERT INTO products (name, description, price, quantity, category_id) 
VALUES ('Smartphone', 'Latest model with 5G support', 699.99, 50, 1);

INSERT INTO products (name, description, price, quantity, category_id) 
VALUES ('Jeans', 'Comfortable denim jeans', 39.99, 100, 2);

INSERT INTO products (name, description, price, quantity, category_id) 
VALUES ('Microwave', 'High power microwave oven', 129.99, 30, 3);
```

## PHP Backend

The **PHP** backend interacts with the database through SQL queries. The following scripts implement the mentioned functionalities:

1. **Add product**: `add_product.php`
   - A form that captures the details of a new product (name, description, price, quantity, and category) and stores them in the database.
   
2. **List products**: `list_products.php`
   - A page that displays all the products in the database in a table format. It includes details such as the product name, price, quantity, and associated category.
   
3. **Update product**: `update_product.php`
   - A form that allows users to modify the price or quantity of an existing product. This form retrieves the current product data, allows updates, and saves the changes to the database.
   
4. **Delete product**: `delete_product.php`
   - A function that allows users to delete a specific product from the database by specifying its `product_id`.

## Frontend

A simple frontend is implemented using **HTML** and **Bootstrap** to interact with the system, ensuring that the process of adding, updating, and deleting products is user-friendly and clear.

## Installation

1. Clone this repository to your local machine:
   ```bash
   git clone https://github.com/IvanPT99/inventory_store.git
   ```

2. Make sure you have **MariaDB** and **PHP** installed on your server. If you haven't installed them yet, you can follow the official installation guides for each:

   - [MariaDB Installation Guide](https://mariadb.org/download/)
   - [PHP Installation Guide](https://www.php.net/manual/en/install.php)

   Ensure your server is set up to run PHP and connect to MariaDB. You can check if PHP is installed by running the following command:
   ```bash
   php -v
   ```
3. Create the database using the provided SQL in this README. You can execute the SQL commands in your MariaDB client or phpMyAdmin:
    ```sql
    CREATE DATABASE inventory_store;
    USE inventory_store;
    ```
4. Set up the database tables by running the provided SQL queries for creating the categories and products tables and inserting initial data.

5. **Configure the database credentials in the PHP files.**

   - Open the `connection.php` file, which is used to establish a connection to the MariaDB database.
   - Inside this file, set the database credentials such as the `username`, `password`, and `dbname` to match your MariaDB server settings. For example:

     ```php
     <?php
     $servername = "localhost";       // Database server, usually 'localhost' if running locally
     $username = "your_username";     // Your MariaDB username
     $password = "your_password";     // Your MariaDB password
     $dbname = "inventory_store";     // The name of your database

     // Create connection
     $conn = mysqli_connect($servername, $username, $password, $dbname);

     // Check connection
     if (!$conn) {
         die("Connection failed: " . mysqli_connect_error());
     }
     ?>
     ```

     - Replace `your_username` and `your_password` with your actual MariaDB credentials.
     - If you're using **XAMPP** or **WAMP** (local server environments), the default username is usually `root` and the password is often left blank (i.e., `""`).

   Once you have updated the credentials, the PHP backend will be able to connect to the MariaDB database and perform the required operations (add, list, update, delete products).


# NOTE

This project was created as part of a class assignment. I took the opportunity to share the code on GitHub, which allowed me to practice working with databases and PHP.