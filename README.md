# car-insurance-web

Car Insurance Management system

# ERD

// note: forgot to put password in the client tables
![ERD](https://github.com/HyGlobalHD/car-insurance-web/blob/main/res/ERD%20LATEST%20FIXED.jpg?raw=true)

# Data Dictionary

// note: there has been some changes, and the following dictionary are not absolute

## EMPLOYEE

![EMPLOYEE](https://github.com/HyGlobalHD/car-insurance-web/blob/main/res/EMPLOYEE.JPG)

## CLIENT

![CLIENT](https://github.com/HyGlobalHD/car-insurance-web/blob/main/res/CLIENT.JPG)

## INSURANCE

![INSURANCE](https://github.com/HyGlobalHD/car-insurance-web/blob/main/res/INSURANCE.JPG)

## CAR

![CAR](https://github.com/HyGlobalHD/car-insurance-web/blob/main/res/CAR.JPG)

## ADMIN

![ADMIN](https://github.com/HyGlobalHD/car-insurance-web/blob/main/res/ADMIN.JPG)

## CHOOSE

![CHOOSE](https://github.com/HyGlobalHD/car-insurance-web/blob/main/res/CHOOSE.JPG)

## UPDATE

![UPDATE](https://github.com/HyGlobalHD/car-insurance-web/blob/main/res/UPDATE.JPG)

Project Structure

Folder & File Breakdown

1. /Admin

Purpose: Contains all the files and scripts for the admin panel. The admin panel allows the system administrator to manage the platform, including insurance policies, users, and claims.

Files:
dashboard.php – Admin dashboard page.
manage_policies.php – Page for adding, editing, and deleting insurance policies.
manage_users.php – Page for managing user accounts.
manage_claims.php – Page for reviewing and approving/rejecting claims.

2. /Config
   Purpose: Contains configuration files that are used globally in the project.

Files:
db_config.php – Contains database connection settings (e.g., host, username, password).

3. /db
   Purpose: Database Schema.

4. /includes
   Purpose: Stores reusable components and utility scripts used across multiple pages.

Files:
header.php – Contains the top navigation bar and branding.
footer.php – Contains the footer section with contact information.
sidebar.php – Sidebar menu for navigation (if needed).

5.  /pages
    Purpose: Houses all user-facing frontend pages.

Files:

policies.php – Displays a list of available insurance policies.
purchase_policy.php – Page for purchasing insurance policies.
claims.php – Page for filing insurance claims.
profile.php – Displays and allows users to manage their profile.
renew_policy.php – Page for renewing expired or soon-to-expire policies.

6.  /public
    Purpose: Contains public-facing assets such as CSS, images, and JavaScript files.

/public/css
Files:
styles.css – Main stylesheet for the website.
admin.css – Styles specific to the admin panel.

### Note
- This is super beautiful, Kudos!!!!!!
