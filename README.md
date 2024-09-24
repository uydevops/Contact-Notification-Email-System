# Email Notification Script

## Overview

This PHP script is designed to send email notifications using the PHPMailer library. It takes input from a form submission, formats the data into a table, and sends it to a specified email address via SMTP. The email content includes company details and submission timestamp.

## Requirements

- PHP 7.0 or higher
- PHPMailer library
- SMTP server access (e.g., Yandex SMTP)

## Installation

1. **Download PHPMailer**:
   - You can download PHPMailer from [GitHub](https://github.com/PHPMailer/PHPMailer) or install it via Composer:
     ```bash
     composer require phpmailer/phpmailer
     ```

2. **Include the PHPMailer class**:
   - Ensure you include the `class.phpmailer.php` file in your project as shown in the script.

3. **Configure SMTP settings**:
   - Update the SMTP settings in the script with your email provider's details:
     ```php
     $mail->Host = 'smtp.yandex.com.tr'; // Your SMTP server
     $mail->Username = 'mail@mail.com'; // Your email address
     $mail->Password = 'your_password'; // Your email password
     ```

## Usage

1. **HTML Form**:
   - Create an HTML form that submits data via POST method. Ensure the form includes the necessary fields such as `company_name`, `title`, and any other parameters you want to send.

2. **Submit the Form**:
   - On form submission, the script processes the input data, sanitizes it, formats it into an HTML table, and sends the email.

3. **Redirect on Success**:
   - After successful email sending, the script redirects the user to a specified URL. You can set the `return_url` parameter in your form.

## Developer Information

[![GitHub](https://img.shields.io/badge/GitHub-181717?style=flat&logo=github&logoColor=white)](https://github.com/uydevops/)
- Developer: Uğurcan Yaş
- GitHub Account: [uydevops](https://github.com/uydevops/)

[![LinkedIn](https://img.shields.io/badge/LinkedIn-0A66C2?style=flat&logo=linkedin&logoColor=white)](https://tr.linkedin.com/in/ugrcny)
- LinkedIn Profile: [ugrcny](https://tr.linkedin.com/in/ugrcny)
