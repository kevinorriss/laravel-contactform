# ContactForm
A simple contact form where a user enters their email address, message and passes
a Google reCAPTCHA robot test. The message is then sent to the configured email
address.

## How it works
This library adds contact form functionality to your Laravel application. Two new
routes (get and post) are set up under the "contact" url. A view needs to be set
up, but this library provides a partial containing the form HTML, or you may create
your own view with application specific layout and CSS styles.

## Installation

1. Add ContactForm to your composer.json file under `require`:

  `"kevinorriss\contactform": "1.1.*"`

2. Add the ContactFormServiceProvider to your app.php file:

  `KevinOrriss\ContactForm\ContactFormServiceProvider::class,`

4. Run `composer update`

## Usage

### Google reCAPTCHA

This library makes use of Google's reCAPTCHA to help stop the contact form being
spammed. In order to use this follow these steps:

1. Follow the `Usage` section from [Google's reCAPTCHA READMME file](https://packagist.org/packages/google/recaptcha#1.1.2),
to generate a site key and secret for your application.

2. Add your reCAPTCHA secret and key to your application environment file, for example:
  
  ```
  RECAPTCHA_SECRET=my_recaptcha_secret
  RECAPTCHA_SITE_KEY=my_recaptcha_site_key
  ```

### Email configuration

You must first set up your mail driver, please refer to the Laravel documentation for this.

1. Add the following to your application's environment file
  
  ```
  CONTACT_FORM_EMAIL=example@myapplication.com
  CONTACT_FORM_NAME="Example Name"
  ```

This is the email address that the users message will be sent to.

2. Add these optional settings to your environment file

  ```
  CONTACT_FORM_SUBJECT="<YOUR SUBJECT>"
  CONTACT_FORM_SUCCESS="<YOUR SUCCESS MESSAGE>"
  ```

These allow you to override the subject of the email and also the flash message that the users sees when the email is sent successfully.
  
## Example

### A simple view

To get going, create a file named `contact.blade.php` in the `resources/views` folder and
add the following:

```
<!DOCTYPE html>
<html>
    <head>
        <title>Contact Form</title>
        @include('contactform::stylesheet')
    </head>
    <body>
        <div class="container">
            <div class="content">
                @include('contactform::form', ['heading' => 'Contact Me'])
            </div>
        </div>
        @include('contactform::javascript')
    </body>
</html>
```

This form uses Bootstrap for style which is included in the `contactform::stylesheet`
partial.

When including the form itself, you can provide an optional array with a heading key
which overrides the panel heading (defaults to "Contact Form").

By default, the contact form controller will look for `contact.blade.php`, you can
override this by creating an entry in your application's environment file such as:

`CONTACT_FORM_VIEW="mycontactformview"`

You will then need to name your view file to match this.

### Javascript

The `contactform::javascript` partial includes three extra partials, one each for:

  1. jQuery (contactform::jquery)
  2. Bootstrap (contactform::bootstrap)
  3. reCAPTCHA (contactform::recaptcha)

If your template already includes jQuery or bootstrap, or you simply do not want to
use bootstrap then you can replace the `contactform::javascript` partial and use
only the ones you need.

## Authors

* **Kevin Orriss** - [Website](http://kevinorriss.com)

See also the list of [contributors](https://github.com/kevinorriss/contactform/graphs/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE.md) file for details
