# Sales Management System

This project is a comprehensive sales management and financial analytics system that allows business owners to easily manage their sales, products, and revenue, while also providing in-depth insights into performance. The system enables you to track sales, manage products, and generate reports to make data-driven decisions.

## Key Features

- Product Management: 
  - Add, edit, and delete products with ease.
  
  - Search and sort products for quick access.
  
  - Record product details such as name, description, price, and quantity.

- Sales Registration:
  - Register new sales with complete details (customer name, date of sale, phone number, etc.).
  
  - Automatically calculate the total amount for each sale based on the purchased items.
  
  - Ability to register multiple products in a single sale and automatically calculate profit and revenue.

- Sales and Financial Reports:
  - View detailed sales reports filtered by week, month, or year.
  
  - Analyze profit and revenue using visually appealing charts and graphs.
  
  - Identify best-selling products, most profitable sales, and top customers.

- Graphs and Visual Analytics:
  - View top 5 best-selling products in a pie chart.
  
  - Revenue and profit graphs for weekly, monthly, and yearly comparisons.
  
  - Visual analysis of sales trends to make informed business decisions.

- Advanced Search and Filters:
  - Search and sort products, sales, and customers based on various criteria.

## How to Set Up the Project

To get started with the project, follow these steps:

### 1. Download the Project
   - First, clone or download the project files from the GitHub repository.
   - To clone the repository, use the following command:
    
   ```bash
   git clone https://github.com/MRSYTp/Sales-Management.git
   ``` 
     

### 2. Install Required Software
   - Install XAMPP to run the project on your local machine. XAMPP includes Apache, MySQL, and PHP, which are essential for the project to work locally.
   - You can download XAMPP from the official website: [XAMPP Download](https://www.apachefriends.org/index.html)

### 3. Set Up the Database
   - The project’s database structure is provided in the document file. You can import it into your MySQL server using phpMyAdmin or any MySQL client.
   - Once you have set up MySQL, create a new database and import the .sql file to generate the necessary tables and structure.

### 4. Configuration
   - After setting up the database, go to the config/ folder. There, you'll find configuration files for the project.
   - Open the database configuration file (db.php) and enter your database connection details (username, password, database name).
   - Make any other necessary configurations based on your setup.

### 5. Run the Project
   - After completing the setup, navigate to the htdocs folder in your XAMPP installation directory and place the project files there.
   - Start Apache and MySQL from the XAMPP control panel.
   - Open your browser and visit http://localhost/your_project_folder to access the project.

### 6. Access the Admin Panel
   - After logging in (using the credentials you registered with), you'll have access to the admin panel where you can manage products, sales, and view analytics.

## Folder Structure

The project is well-organized into the following folders:

- tpl/: Contains all the website templates.
- config/: Configuration files for the application.
- tests/: Unit and system tests for the application.
- process/: Contains all the AJAX request handling processes.
- app/: Logic of the application, including various subfolders.
- bootstrap/init.php: The file where initial configuration is loaded.

## Technologies Used

This project uses the following technologies:
- PHP: The primary language for the backend logic.
- jQuery: For handling user interactions and performing AJAX operations.
- MySQL: The database management system used to store data.
- PHPUnit: For unit testing and automated testing.
- Chart.js: For displaying charts and graphs.
- JWT: For implementing authentication and security.
- Verta: For handling accurate date and time management.
- Ajax: For asynchronous requests to enhance user experience.

## How to Use the System

Once you've logged in, you will have access to the admin panel, which contains three main sections:

### 1. Products Management:
   - Add new products, edit existing ones, and delete products when needed.
   - View and search products efficiently, with the ability to sort them based on various parameters.

### 2. Sales Management:
   - Register new sales with detailed customer information and product data.
   - Automatically calculate the total purchase amount and profit for each sale.
   - View a detailed list of past sales, including all relevant details such as customer name, products sold, and total revenue.

### 3. Analytics and Reports:
   - View detailed analytics and reports about sales, revenue, and profits over different time periods (weekly, monthly, yearly).
   - Analyze top-selling products, most profitable sales, and top customers.
   - View charts and graphs to get a visual representation of the data.

## Contact Information

For any questions or inquiries, feel free to contact me:

- LinkedIn: [Mohamadreza Salehi](https://www.linkedin.com/in/mohamadreza-salehi-5681a2339?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app)
- Email: mr.salehi.dev@gmail.com
- Website: [iammohamadrezasalehi.ir](https://iammohamadrezasalehi.ir/)
