=== Wordpress Passwordless Auth plugin ===
Contributors: sawolabs
Donate link: https://sawolabs.com/
Tags: Login,Authentication, Single sign-on, Security
Requires at least: 4.7
Tested up to: 5.8
Stable tag: 3.0.0
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

SAWO - Providing Secure Authentication solutions to your Apps and Websites eliminating Passwords and OTPs for a seamless user experience.

== Description ==

**Understanding the plugin:**

The SAWO WordPress plugin is an easy-to-integrate passwordless authentication plugin that lets you build, deploy and manage your user authentication in under 6 minutes. This plugin is as easy as it gets, compared to a traditional login user flow, it is fast, seamless and it quickly plugs into your existing application. 

- **Features of the plugin:**
    -Passwordless Authentication
    -Customised Frontend Forms
    -Data Autonomy - Secure your data and trust
    -Improved customer onboarding 

Data Autonomy makes SAWO one of the best WordPress plugins for user authentication. Your data is end-to-end encrypted, which enables you to secure your user’s data and trust and gives you complete control over your security. 

Our plugin makes your user’s experience fast, seamless and hassle-free!

-**Understanding the User-flow**
    -The user flow is lean, simple and no-frills attached, exactly how we would want it in the products that we use.
    -User signs up using an email address and a one time code to authenticate . In this case, the OTP is literally just this once. 
    for every subsequent login your user can quickly login using their biometric sensors, face ID depending on the device.

[Demo Video](https://youtu.be/YDYiPbTWCps)

For a detailed explanation on how the SAWO passwordless authentication plugin works refer to our [Documents](https://docs.sawolabs.com/sawo/no-code/wordpress) .

We would love to hear from you and get your thoughts/feedback. You can join our Discord community by visiting our [Discord](https://discord.com/invite/TpnCfMUE5P) 

You will be part of over 10,000+ developers and businesses that are moving towards building a passwordless future

== Installation ==

**This section describes how to install the plugin and get it working.**

-**Configuration with Sawo dashboard:**
To get started with this integration, we have to configure and sign up on the [Sawo Dashboard](https://dev.sawolabs.com/).
1.Login to sawo dev console – [Login](https://dev.sawolabs.com/)
2.Create a new project and copy the API key

-**Installation of WordPress:**
1.On the WP admin panel, click on plugins and select add new
2.Search for SAWO and click Install
3.Activate the plugin by going to the Plugins page

-**Integration with WordPress after Activation:**
1.Click Appearance, and then the Widgets, then add the SAWO widget wherever you want the Login button to be on your website
2.In the sawo widget, Paste the API key you copied earlier in step #2
3.Select login type email, phone_number or email_phone_email.
4.You can adjust container height as per your need. ex. If you want to add custom fields then you can increase container height. (default 400px)
3.If you want to activate a ‘Success’ redirect page, then select ‘Activate’ and enter the URL to which you want your user to be redirected to.
4.Customize the text you want to display on your LOGIN button and click save.

-**Customising the Login form:**
The login form can be customised accordingly from the sawo dashboard itself. You can add custom fields, change the identifier type, update the advanced configuration and customize the design of the fields as well. 
1.Login to SAWO Dev console - [Login](https://dev.sawolabs.com/)
2.You can start by visiting the “forms” tab and selecting the project for which you want to customise the form and make the changes accordingly. 
3.You can also redesign the form by checking the design tab and making the necessary changes. 
4.Save the changes, and you can see the custom form on your website.

== Frequently Asked Questions ==

= Is the plugin free to install and activate? =

Yes, this plugin is free to use. You don’t need to pay anything in order to install and integrate this plugin.

= How many authentications are available with this plugin? =

With the free plan , you will get 5000 authentications. If you want to upgrade the number of auths, you can always choose the one that works for you. [Take a look at our pricing plans here](https://sawolabs.com/pricing)

= Can I access the registered users data? =

Yes, you can access the registered users data from your WordPress Admin panel. For any help, reach out to our support. 

= Can I customise the Login form? =

Yes, you can customise the Login form from the [SAWO Dev Console](https://dev.sawolabs.com/). You can style the form with any component you like from the Design field in the Dashboard.

= Can I redirect the user to any external url after registration? =

Yes, you have an option of activating a success redirect page. You can do this by selecting ‘Activate’  while integrating your SAWO widget with WordPress. You can add a link or any external URL to which you want your user to get redirected.

= My question is not answered here, where can I find support? =

You can always join [our community](https://discord.com/invite/TpnCfMUE5P) and ask for help. You can also reach us out with specific queries over here: support@sawo.dev


== Screenshots ==

1. Admin Panel Widget
2. E-Mail authentication
3. Phone Number authentication
4. Both email/phone authentication
5. OTP Screen

== Upgrade Notice ==

= 3.0.0 =
* added phone_number and both_email_phone login types, redirection fix, added option to change login modal height, support for additional custom fields.

= 2.0.4 =
* Updated the plugin description included customistion steps and sample integration video.

= 2.0.3 =
* Updated the FAQ section under plugin description.

= 2.0.2 =
* Updated the plugin installation steps in readme.

= 2.0.1 =
* Updated the plugin installation steps in readme.

= 2.0 =
* Added plugin information in readme.

= 1.0 =
This version allows a hassle-free swift, secure, and standardized, One-click process to authenticate the end user.

== Changelog ==

= 3.0.0 =
* Version 3.0.0

= 2.0.4 =
* Version 2.0.4

= 2.0.3 =
* Version 2.0.3

= 2.0.2 =
* Version 2.0.2

= 2.0.1 =
* Version 2.0.1

= 2.0 =
* Version 2.0

= 1.0 =
* Version 1.0

`<?php code(); // goes in backticks ?>`
