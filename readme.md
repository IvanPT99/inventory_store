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
