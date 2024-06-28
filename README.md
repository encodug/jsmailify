# JSMailify
![JSMailify](/assets/images/jsmailify.png)

JSMailify is an open-source JavaScript library that simplifies the process of sending emails directly from client-side code using SMTP. It offers a hassle-free solution for integrating email functionality into your web applications without the need for a back-end server or a separate email service provider.

## Features
- Send emails directly from client-side JavaScript code
- Securely encrypt SMTP credentials for enhanced security
- Option to use a secure token instead of credentials for added protection
- Supports sending emails with attachments, HTML content, and more
- Easy integration with existing JavaScript projects
- Free to use with no hidden fees or charges

## Getting started
To start using JSMailify in your projects, follow these simple steps:
1. Include the JSMailify library in your HTML file:

```html
<script src="https://jsmailify.com/mailify.js"></script>
```

2. Use the Mailify.send() function to send emails from your JavaScript code:

```javascript
Mailify.send({
    host: "smtp.example.com",
    username: "your_username@example.com",
    password: "your_app_password",
    port: 587,
    toEmail: "recipient@example.com",
    fromEmail: "you@example.com",
    fromName: "Your Name",
    subject: "This is the subject",
    body: "And this is the body"
}).then(response => {
    if (response.success) {
        console.log('Email sent successfully');
    } else {
        console.error('Email not sent: ', response.error);
    }
})
.catch(error => {
    console.error('Error: ', error.error);
})
```
***Replace the placeholder values with your actual SMTP server, username, password, recipient's email address, sender's email address, subject, and body.***

That's it! You can now send emails directly from your client-side code using JSMailify.

## Encryption of SMTP Credentials

If you're concerned about the security of your SMTP credentials, JSMailify offers the option to encrypt your credentials for enhanced security. With this feature, you can securely store and use your SMTP credentials without exposing them in your client-side code.

To encrypt your SMTP credentials, follow these steps:
* Navigate to the 'Generate Secure Token' button on the website <http://www.jsmailify.com>.
* Click the button to initiate the process.
* Accurately fill in all the required SMTP Settings.<br> *<span style="font-size:0.825rem">When you fill out the form please be assured that your data is secure with us. We prioritize your data and security, so no personal information is stored, cached or copied on our servers.Our encryption process ensures that your details remain confidential and are used solely for the intended purpose without any risk of unauthorized access or storage.</span>*
* Click the 'Encrypt' button to complete the encryption process.
* Once Completed, a secure Token will be generated.<br> ***Copy this token immediately, for your Secure SMTP transactions and will not be displayed again for security reasons.***

```javascript
Mailify.send({
    secureToken: "60dd8e55a63f945f5c7ed61a1d139336-6adf8f57d72f9f5b4360db12563099230727346f64559e4208-6adf8f57d73b9c4e6e7edb0c400793299f-2688cd",
    toEmail: "recipient@example.com",
    fromEmail: "you@example.com",
    fromName: "Your Name",
    subject: "This is the subject",
    body: "And this is the body"
}).then(response => {
    if (response.success) {
        console.log('Email sent successfully');
    } else {
        console.error('Email not sent: ', response.error);
    }
})
.catch(error => {
        console.error('Error: ', error.error);
});
```

*By encrypting your SMTP credentials, you add an extra layer of protection to your email sending process, ensuring the security of your sensitive information.*

## Additional Configuration

If you have two-factor authentication enabled for your email provider, please refer to the documentation provided by your respective email provider for specific instructions on configuring SMTP connections. Each email provider may have different requirements and procedures for setting up SMTP connections with two-factor authentication enabled. 

* [GMail Documentation](https://support.google.com/mail/answer/185833?hl=en)
* [Yahoo! Mail Documentation](https://help.yahoo.com/kb/SLN15241.html)
* [AOL Mail Documentation](https://help.aol.com/articles/Create-and-manage-app-password)
* [iCloud Mail Documentation](https://support.apple.com/en-in/102525)
* [ProtonMail Documentation](https://proton.me/support/smtp-submission)
* [Zoho Mail Documentation](https://www.zoho.com/mail/help/zoho-smtp.html)



## Contributing
Contributions to JSMailify are welcome! To contribute, please fork this repository, make your changes, and submit a pull request. Be sure to follow the project's coding standards and guidelines.