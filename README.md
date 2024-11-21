# **Submit Package**

<p align="center">
    <img src="screenshots/screenshot-1.png" alt="Screenshot 1" width="30%">
    <img src="screenshots/screenshot-2.png" alt="Screenshot 2" width="30%">
    <img src="screenshots/screenshot-3.png" alt="Screenshot 3" width="30%">
</p>
Simple and customizable system for managing submissions. Designed for Laravel applications, it offers essential tools to streamline assignment submission processes with minimal setup.

## **Installation**

### Step 1: Install the Package
```bash
composer require al-rimi/submit
```

### Step 2: Run the Installation Command
```bash
php artisan submit:install
```
This command performs the following tasks:
1. Publishes assets, views, and configuration files.
2. Installs necessary Node.js dependencies.
3. Updates the `vite.config.js` file with Submit assets (`submit.css` and `submit.js`).
4. Builds assets using `npm run build`.
5. Runs database migrations.
6. Seeds the database with example data.

## **Features**
- **Submission Management**: Collect, validate, and store student submissions effectively.
- **Email Notifications**: Rreceive notifications after each submission.
- **Customizable Views**: Easily adjust the user interface to suit your needs.
- **Public table**: Notify users upon submission completion.

## **Customization**

### env
Add those two in your .env file:
```env
NOTIFICATION_EMAIL=
SUBMISSION_DEADLINE=    #in ISO 8601 format (e.g., "YYYY-MM-DDTHH:MM:SS")
```

### Routes
Routes file is published to `routes/submit.php`. Modify it to customize:
- View paths

### Views
The submissions and the email is published to `resources/views/submissions.blade.php` and `resources/views/emails/submissions_email.blade.php`.

### CSS and JavaScript
- CSS: `resources/css/submit.css`
- JavaScript: `resources/js/submit.js`

### Database
The package provides migrations and a seeder (`database/Seeders/sedStudentsTableSeeder.php`). You can extend or adjust these as needed.


## **Troubleshooting**

### Vite Configuration
The package automatically adds `resources/css/submit.css` and `resources/js/submit.js` to `vite.config.js`. If this step fails, manually update your `vite.config.js` file:
```javascript
export default defineConfig({
    input: [
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/css/submit.css',
        'resources/js/submit.js'
    ],
    // other Vite configuration
});
```

### Build Issues
If you encounter build issues, ensure Node.js and npm are properly installed. Then rerun:
```bash
npm install
npm run build
```


## **Uninstallation**

### Step 1: Remove all traces of the Submit package:
```bash
php artisan submit:uninstall
```
### Step 2: remove the package:
```bash
composer remove al-rimi/submit
```


## **Requirements**
- PHP 8.0 or higher
- Laravel 10.x or 11.x
- Node.js (for Vite asset compilation)

## **Support**
For questions or issues, please visit the [issues page](https://github.com/Al-rimi/submit-pak/issues).

## **License**
This package is open-source and licensed under the [MIT License](LICENSE).
