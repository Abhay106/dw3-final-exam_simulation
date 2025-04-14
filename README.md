## 📝 Final Exam SIMULATION – 20 Multiple Choice Questions  
**Difficulty:** Easy to Intermediate  
**Each question has one correct answer.**  
**Answer key is at the bottom.**

---

### **Part I – PHP Basics & Development Environment**

1. Which PHP function is used to display text on the screen?  
   **a) echo  
   b) printText  
   c) show  
   d) printString  

2. Which superglobal contains data sent via the GET method?  
   a) $_POST  
   **b) $_GET  
   c) $_SESSION  
   d) $_SERVER  

3. What does `isset($_POST['name'])` check?  
   a) If the variable is a string  
   **b) If the variable exists and is not null  
   c) If the variable is empty  
   d) If the variable is a number  

4. Which function starts a PHP session?  
   a) start_session()  
   b) begin_session()  
   **c) session_start()  
   d) session_open()  

5. Which command connects to MySQL using MySQLi?  
   **a) mysqli_connect()  
   b) mysql_connect()  
   c) db_connect()  
   d) connect_mysql()  

---

### **Part II – Logic and Control Structures**

6. Which control structure repeats code while a condition is true?  
   a) if  
   b) switch  
   **c) while  
   d) foreach  

7. What does the `empty()` function return when the value is `0`?  
   **a) true  
   b) false  
   c) null  
   d) empty string  

8. How do you define an associative array in PHP?  
   **a) array("key" => "value")  
   b) ["key", "value"]  
   c) ("key" = "value")  
   d) array("value" => "key")  

9. What is the purpose of the `fopen()` function?  
   a) Open a database  
   b) Open a connection  
   **c) Open a file  
   d) Open a session  

10. Which JavaScript function performs an AJAX request?  
   **a) fetch()  
   b) request()  
   c) sendRequest()  
   d) ajaxPost()  

---

### **Part III – Databases & PHP Integration**

11. Which SQL command inserts data into a table?  
   a) ADD  
   **b) INSERT INTO  
   c) UPDATE  
   d) APPEND  

12. In PDO, which command is used to prevent SQL injection?  
   **a) prepare()  
   b) validate()  
   c) filter()  
   d) querySecure()  

13. Which function closes a MySQLi connection?  
   a) mysql_close()  
   **b) mysqli_close()  
   c) db_disconnect()  
   d) close_connection()  

14. What does the `htmlspecialchars()` function do?  
   a) Remove spaces  
   **b) Escape HTML characters  
   c) Remove HTML tags  
   d) Check if it's a string  

15. What is the best way to validate a required form field?  
   **a) isset() and empty()  
   b) validate()  
   c) secure()  
   d) post_check()  

---

### **Part IV – OOP and Security in PHP**

16. What keyword is used to create an object from a class in PHP?  
   a) include  
   **b) new  
   c) open  
   d) class  

17. What is polymorphism in PHP?  
   a) Functions with the same name in different scopes  
   b) Classes with multiple names  
   c) Objects with multiple identities  
   **d) Methods with different behaviors in subclasses  

18. How is a constructor defined in modern PHP classes?  
   a) function construct()  
   **b) function __construct()  
   c) constructor()  
   d) init()  

19. Which function sets a cookie in PHP?  
   **a) setcookie()  
   b) cookie_set()  
   c) create_cookie()  
   d) cookie()  

20. Which function checks if a file was uploaded via a form?  
   **a) is_uploaded_file()  
   b) file_exists()  
   c) upload_check()  
   d) form_file()  


---

## 💻 Project – *Mini Product Catalog with Image Upload*

### 🕒 Estimated Time: ~2 hours  
### 🧰 Stack: PHP, MySQL, HTML/CSS, XAMPP, PDO, Sessions, File Upload

---

### 🎯 Goal

Create a basic product catalog system where the user can:

- Log in  
- Add products (name, description, price, and image)  
- View a list of their own products  
- Delete products  
- Log out  

---

### 🖼️ Extra Feature: Image Upload

- Users can **upload a product image** when adding a new product  
- Image is saved locally in the `/uploads` folder  
- Image path is saved in the MySQL database  
- Only `.jpg`, `.jpeg`, `.png` files are allowed  
- Maximum file size: **2MB**

---

### 🗃️ Database Structure

```sql
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  name VARCHAR(100) NOT NULL,
  description TEXT,
  price DECIMAL(10,2),
  image_path VARCHAR(255),
  FOREIGN KEY (user_id) REFERENCES users(id)
);
```

---

### 📁 Folder Structure

```
/mini-catalog/
├── login.php
├── logout.php
├── dashboard.php
├── add_product.php
├── delete_product.php
├── db.php
├── session.php
├── uploads/
│   └── (images go here)
├── css/
│   └── style.css
├── project-demo.mp4
└── README.md
```

---

### 💬 Features

1. **User Login**
   - Basic login system using sessions
   - Stores `$_SESSION['user_id']` after successful login

2. **Product Registration**
   - Form with fields: Name, Description, Price, and Image Upload
   - Uses `$_FILES` to handle uploaded image
   - Validates:
     - File type (`jpg`, `jpeg`, `png`)
     - File size (≤ 2MB)
   - Image is saved to `uploads/` and path is stored in DB

3. **Product Listing**
   - Displays user's products as a table or grid
   - Shows image thumbnail, name, description, and price
   - Includes a "Delete" button for each product

4. **Delete Product**
   - Deletes product from database
   - Also deletes associated image using `unlink()`

5. **Logout**
   - Destroys session and redirects to login

---

### 🧠 Key Concepts Practiced

- File uploads and handling with `$_FILES`  
- Validating and securing image uploads  
- Saving image paths to database  
- Deleting images from the server  
- Full CRUD using PHP + PDO  
- Using sessions for authentication  
- Clean separation of logic and layout

---

### 📽️ Submission Rule – Required Video Demo

- You must include a **short video demo** of your project in action  
- **Max duration: 30 seconds**  
- Show the following:
  - Login
  - Product creation with image upload
  - Product listing
  - Product deletion

  And place it in the **root of your GitHub repository**

---
## 📄 **Extra Requirement – Project README**

The `README.md` file in the GitHub repository **must contain this final exam** (both parts I and II).

- Students must **highlight their selected answers** in the multiple-choice questions by surrounding the chosen option with `**` (markdown bold).
  
  ### Example:
  ```markdown
  1. What is Docker?  
     - A) A relational database  
     - **B) A container platform for creating and managing environments**  
     - C) A web server  
     - D) A frontend framework  
  ```
  
---

### 📊 **Grading Criteria**

| Section                                  | Points | Notes                                                              |
|------------------------------------------|--------|--------------------------------------------------------------------|
| **Structure + MCQ submission**           | 4.0    | Just having the full structure + answered questions (right or wrong) |
| **Project implementation**              | 5.0    | Final Project – "To-Do List with Login"                     |
| **GitHub + README**                      | 1.0    | Proper structure, includes this full exam in README               |
| **TOTAL**                                | 10.0   |                                                                    |


---

## 🛠️ **Step-by-Step: Creating a GitHub Repository**

Follow these steps to create your project repository and submit your work:

### ✅ 1. **Create a GitHub Account (if you don’t have one)**
Go to [https://github.com](https://github.com) and sign up.

---

### ✅ 2. **Create a New Repository**

1. Log in to GitHub  
2. Click the **"+" icon** in the top right corner → **New repository**  
3. Fill in the repository details:
   - **Repository name:** `dw3-final-exam_simulation` or something similar
   - **Description:** e.g., *To-Do List with Login using PHP, MySQL, XAMPP*
   - **Public** (or Private, but you must invite your teacher if private)
   - **Do NOT** check “Initialize this repository with a README”
4. Click **Create repository**

---

### ✅ 3. **Set Up Your Local Project Folder**

In your local machine:

```bash
mkdir todo-project
cd todo-project
```

Place your project files inside this folder.

---

### ✅ 4. **Initialize Git and Push to GitHub**

Make sure Git is installed. Then:

```bash
git init
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO_NAME.git
git add .
git commit -m "Initial commit - final project"
git branch -M main
git push -u origin main
```

> 💡 Replace `YOUR_USERNAME` and `YOUR_REPO_NAME` with your actual GitHub username and repository name.

---

### ✅ 5. **Add the README.md File**

Inside your project folder, create a `README.md` file:

```bash
touch README.md
```

Paste the full **Final Exam** (Parts I & II) into the README and mark your selected answers using `**` bold markdown.

---

### ✅ 6. **Push README to GitHub**

```bash
git add README.md
git commit -m "Add final exam answers to README"
git push
```

---

### ✅ 7. **Confirm on GitHub**

Visit your repository on GitHub to ensure:

- All files are uploaded  
- README includes the final exam with highlighted answers  
- Project runs correctly if cloned 

---

# 🚨 Submit only the link to your GitHub repository  
# ❌ Not following the repository structure = Automatic elimination  
# ✅ This document must be included and completed in `README.md`