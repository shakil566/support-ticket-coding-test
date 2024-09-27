# Support Ticket System

## Description
- Installed UI auth package

- In this project multiple user group Admin and Customer.
- Admin and Customer can register from register page.
- They can login with their email and password.
- Customer can open support ticket for his or her issues with issue details.
- After create a issue admin got email from customer with issue details.
- Customer can see all his or her Issues and issue status remarks from issue page.

- Admin can only see all customers issues with details and he or she can give remarks for the issues and also closed the issues.
- If issue closed from Admin, then customer get a email from admin.

## Installation
- For clone this project run this command: git clone .......
- Create a database
- Then rename .env.example file to .env file and add database name

- Then run these command: 
- composer update
- npm install
- npm run dev
- php artisan key:generate
- php artisan migrate (with seed: php artisan migrate:fresh --seed)
- php artisan optimize:clear (optional)
- php artisan serve

- For Email send with Queue:
- php artisan queue:work

- if you want existing data, then need to run seeder command (User and Issues seeder added in project).
- php artisan db:seed

- After installation you can login with these credentials if you want. Or you can signup as Admin.

- Admin credentials:
- email:admin@gmail.com
- password:Admin123@

- Customer credentials:
- email:customer@gmail.com
- password:Customer123@


## Thank You
