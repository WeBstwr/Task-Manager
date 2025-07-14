# Task Manager

## What is this project?

**Task Manager** is a web-based application for managing users and tasks. It allows administrators to manage users and assign tasks with deadlines, while users can view and update the status of their assigned tasks. The app also sends email notifications when new tasks are assigned.

---

## What does the app do?

- **Admin Features:**
  - Add, edit, and delete users.
  - Assign tasks to users and set deadlines.
  - View all tasks and their statuses.

- **User Features:**
  - View tasks assigned to them.
  - Update the status of their tasks (Pending, In Progress, Completed).
  - Receive email notifications when a new task is assigned.

- **General Features:**
  - Clean, modern UI for all forms and pages.
  - Responsive and user-friendly interface.
  - Secure authentication and role-based access.

---

## Technologies and Frameworks Used

- **Language:** PHP (Backend), JavaScript (Frontend)
- **Framework:** Laravel (PHP framework, MVC architecture)
- **Frontend:** Blade templating (Laravel), Vanilla JavaScript, Custom CSS
- **Database:** **PostgreSQL** (configurable in `.env` and `config/database.php`)
- **ORM:** Eloquent (Laravel’s built-in ORM for database interaction)
- **Authentication:** **Custom implementation** (no Breeze, no Jetstream, no scaffolding package)
- **Notifications:** Laravel Notification System (for email notifications)
- **Testing:** PestPHP (for automated tests)
- **Build Tools:** No Vite, no Mix, no frontend JS framework—just custom CSS and JS in `public/`
- **Dependency Management:** Composer (PHP), NPM (for JS/CSS dependencies)

---

## How does it work?

- **MVC Structure:**  
  - Models represent data (User, Task).
  - Controllers handle business logic (TaskController, UserManagementController).
  - Views (Blade templates) render the UI.

- **Eloquent ORM:**  
  - Interacts with the PostgreSQL database using PHP classes and relationships.
  - Example: `$user->assignedTasks()` gets all tasks assigned to a user.

- **Authentication & Authorization:**  
  - Users must log in.
  - Admins have special permissions (middleware-protected routes).
  - All authentication logic is custom, not from Breeze or Jetstream.

- **Notifications:**  
  - When a task is assigned, the user receives an email (logged or sent, depending on config).

---

## How to Install and Run Locally

### 1. Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js and NPM
- **PostgreSQL** (or your preferred DB, but PostgreSQL is default)
- Git (optional, for cloning)

### 2. Clone the Repository
```sh
git clone <your-repo-url>
cd task-manager
```

### 3. Install PHP Dependencies
```sh
composer install
```

### 4. Install JS/CSS Dependencies
```sh
npm install
```

### 5. Set Up Environment
- Copy `.env.example` to `.env`:
  ```sh
  cp .env.example .env
  ```
- Set your database credentials in `.env`:
  ```
  DB_CONNECTION=pgsql
  DB_HOST=127.0.0.1
  DB_PORT=5432
  DB_DATABASE=your_db_name
  DB_USERNAME=your_db_user
  DB_PASSWORD=your_db_password
  ```
- Set mail settings for notifications (log or smtp).

### 6. Generate App Key
```sh
php artisan key:generate
```

### 7. Run Migrations
```sh
php artisan migrate
```

### 8. (Optional) Seed the Database
```sh
php artisan db:seed
```

### 9. Build Frontend Assets
- No Vite or Mix is used.  
- All CSS and JS are in `public/css/styles.css` and `public/js/scripts.js` and are loaded directly.

### 10. Start the Server
```sh
php artisan serve
```
Visit [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser.

---

## How to Use the App

- **Register or log in as an admin.**
- **Add users** via the admin dashboard.
- **Create and assign tasks** to users.
- **Users log in** to view and update their tasks.
- **Email notifications** are sent/logged when tasks are assigned.

---

## Database

- **Tables:** users, tasks, password_reset_tokens, sessions, jobs, job_batches, failed_jobs, cache, cache_locks
- **Migrations:** All included in `database/migrations/`
- **Seeders:** Example users and tasks in `database/seeders/DatabaseSeeder.php`
- **ORM:** Eloquent models for all main entities
- **Default DB:** PostgreSQL (see `config/database.php`)

---

## Other Notes

- **No unnecessary comments or code**—the codebase is clean and production-ready.
- **Modern CSS** for a polished UI.
- **No CMS, no JS frameworks, no Vite, no Mix**—just Laravel, Blade, and vanilla JS.
- **Ready for deployment**—just configure your production environment and mail settings.

---

## Contact / Contribution

- For questions or contributions, see the repository or contact the maintainer.
