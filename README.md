## Chisankho2019
#### Built on Laravel 5.7 with Email Registration Verification, Social Authentication, User Roles and Permissions, User Profiles, and Admin restricted user management system. Built with Bootstrap 4.

 
#### Table of contents
- [About](#about)
- [Features](#features)
- [Installation Instructions](#installation-instructions)
    - [Build the Front End Assets with Mix](#build-front-end-assets-with-mix)
    - [Optionally Build Cache](#optionally-build-cache)
- [Seeds](#seeds)
    - [Seeded Roles](#seeded-roles)
    - [Seeded Permissions](#seeded-permissions)
    - [Seeded Users](#seeded-users)
    - [Themes Seed List](#themes-seed-list)
- [Routes](#routes)
- [Socialite](#socialite)
    - [Get Socialite Login API Keys](#get-socialite-login-api-keys)
    - [Add More Socialite Logins](#add-more-socialite-logins)
- [Other API keys](#other-api-keys)
- [Environment File](#environment-file)
- [Updates](#updates)
- [Screenshots](#screenshots)
- [File Tree](#file-tree)
- [Opening an Issue](#opening-an-issue)
- [Laravel Auth License](#laravel-auth-license)

### About
Laravel 5.7 with user authentication, registration with email confirmation, social media authentication, password recovery, and captcha protection. Uses official [Bootstrap 4](https://getbootstrap.com). This also makes full use of Controllers for the routes, templates for the views, and makes use of middleware for routing. Project can be stood up in minutes.

### Features
#### A [Laravel](https://laravel.com/) 5.7.x with minimal [Bootstrap](https://getbootstrap.com) 4.0.x project (Requires PHP 7.2 Version).

|  Features  |
| :------------ |
|Built on [Laravel](https://laravel.com/) 5.7|
|Built on [Bootstrap](https://getbootstrap.com/) 4|
|Uses [MySQL](https://github.com/mysql) Database (can be changed)|
|Uses [Artisan](https://laravel.com/docs/5.7/artisan) to manage database migration, schema creations, and create/publish page controller templates|
|Dependencies are managed with [COMPOSER](https://getcomposer.org/)|
|Laravel Scaffolding **User** and **Administrator Authentication**.|
|User [Socialite Logins](https://github.com/laravel/socialite) ready to go - See API list used below - OFF |
|[Google Maps API v3](https://developers.google.com/maps/documentation/javascript/) for User Location address lookup and Geocoding to find Lat Long|
| Leaflet Openstreet Maps used in website for Clustered map pointers |

|CRUD (Create, Read, Update, Delete) User Management|
|Robust [Laravel Logging](https://laravel.com/docs/5.7/errors#logging) with admin UI using MonoLog|
|Google [reCaptcha Protection with Google API](https://developers.google.com/recaptcha/) - OFF|
|User Registration with email verification - OFF|
|Makes use of Laravel [Mix](https://laravel.com/docs/5.7/mix) to compile assets (npm run dev) |
|Makes use of [Language Localization Files](https://laravel.com/docs/5.7/localization) - OFF|
|Active Nav states using [Laravel Requests](https://laravel.com/docs/5.7/requests) |
|Restrict User Email Activation Attempts - OFF|
|Capture IP to users table upon signup|
|Uses [Laravel Debugger](https://github.com/barryvdh/laravel-debugbar) for development|
|Makes use of [Password Strength Meter](https://github.com/elboletaire/password-strength-meter) - OFF|
|Makes use of [hideShowPassword](https://github.com/cloudfour/hideShowPassword) |
|User Avatar Image AJAX Upload with [Dropzone.js](https://www.dropzonejs.com/#configuration)|
|User Gravatar using [Gravatar API](https://github.com/creativeorange/gravatar)|
|User Password Reset via Email Token|
|User Login with remember password|
|User [Roles/ACL Implementation](https://github.com/jeremykenedy/laravel-roles)|
|Makes use of [Laravel's Soft Delete Structure](https://laravel.com/docs/5.7/eloquent#soft-deleting)|
|Soft Deleted Users Management System|
|Permanently Delete Soft Deleted Users|
|User Delete Account with Goodbye email|
|User Restore Deleted Account Token|
|Restore Soft Deleted Users|
|View Soft Deleted Users|
|Captures Soft Delete Date|
|Captures Soft Delete IP|
|Admin Routing Details UI|
|Admin PHP Information UI|
|Eloquent user profiles|
|User Themes|
|404 Page|
|403 Page|
|Configurable Email Notification via [Laravel-Exception-Notifier](https://github.com/jeremykenedy/laravel-exception-notifier)|
|User Delete with Goodbye email|
|User Restore Deleted Account|
|Activity Logging using [Laravel-logger](https://github.com/jeremykenedy/laravel-logger)|
|Optional 2-step account login verfication with [Laravel 2-Step Verification](https://github.com/jeremykenedy/laravel2step) - OFF|
|Uses [Laravel PHP Info](https://github.com/jeremykenedy/laravel-phpinfo) package|

### Installation Instructions
1. Run `git clone [repoURL]`
2. Create a MySQL database for the project
    * ```mysql -u root -p```, if using Vagrant: ```mysql -u homestead -psecret```
    * ```create database laravelAuth;```
    * ```\q```
3. From the projects root run `cp .env.example .env`
4. Configure your `.env` file
5. Run `composer install` from the projects root folder
6. From the projects root folder run:
```
php artisan vendor:publish --tag=laravelroles &&
php artisan vendor:publish --tag=laravel2step


```
7. From the projects root folder run `sudo chmod -R 755 ../laravel-auth`
8. From the projects root folder run `php artisan key:generate`
9. From the projects root folder run `php artisan migrate`
10. From the projects root folder run `composer dump-autoload`
11. From the projects root folder run `php artisan db:seed`

12. For Charts 
``` 
composer require consoletvs/charts:6.*

Register the service provider in the file located at: config/app.php in the providers key.

ConsoleTVs\Charts\ChartsServiceProvider::class,
php artisan vendor:publish --tag=charts_config

php artisan make:chart ReportChart Chartjs

in controller:
use App\Charts\ReportChart;
```
13. Get admin and a sample user with `php artisan db:seed`

14. Compile the front end assets with [npm run dev](#using-npm) or [yarn dev](#using-yarn).

#### Build the Front End Assets with Mix
##### Using NPM:
1. From the projects root folder run `npm install`
2. From the projects root folder run `npm run dev` or `npm run production`
  * You can watch assets with `npm run watch`

##### Using Yarn:
1. From the projects root folder run `yarn install`
2. From the projects root folder run `yarn run dev` or `yarn run production`
  * You can watch assets with `yarn run watch`

#### Optionally Build Cache
1. From the projects root folder run `php artisan config:cache`

###### And thats it with the caveat of setting up and configuring your development environment. I recommend [Laravel Homestead](https://laravel.com/docs/5.7/homestead)

### Seeds
##### Seeded Roles
  * Unverified - Level 0
  * User  - Level 1
  * Administrator - Level 5

##### Seeded Permissions
  * view.users
  * create.users
  * edit.users
  * delete.users

##### Seeded Users

|Email|Password|Access|
|:------------|:------------|:------------|
|user@user.com|password|User Access|
|admin@admin.com|password|Admin Access|

### Socialite

#### Get Socialite Login API Keys:
* [Google Captcha API](https://www.google.com/recaptcha/admin#list)
* [Facebook API](https://developers.facebook.com/)
* [Twitter API](https://apps.twitter.com/)
* [Google &plus; API](https://console.developers.google.com/)
* [GitHub API](https://github.com/settings/applications/new)
* [YouTube API](https://developers.google.com/youtube/v3/getting-started)
* [Twitch TV API](https://www.twitch.tv/kraken/oauth2/clients/new)
* [Instagram API](https://instagram.com/developer/register/)
* [37 Signals API](https://github.com/basecamp/basecamp-classic-api)

  6. Add the social media login link:
      * Example:
      In file ```/resources/views/auth/login.blade.php``` add ONE of the following:
         * Conventional HTML:
        ```
        <a href="{{ route('social.redirect', ['provider' => 'twitch']) }}" class="btn btn-lg btn-primary btn-block twitch">Twitch</a>
        ```
         * Use Laravel HTML Facade with [Laravel Collective](https://laravelcollective.com/):

        ```
        {!! HTML::link(route('social.redirect', ['provider' => 'twitch']), 'Twitch', array('class' => 'btn btn-lg btn-primary btn-block twitch')) !!}
        ```

### Other API keys
* [Google Maps API v3 Key](https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key)
* [GOOGLE MAPS ADDRESS TO LAT-LONG Key]()
put in .env file

### Environment File
Example `.env.backup` file:

#### Laravel Developement Packages Used References
* https://laravel.com/docs/5.7/authentication
* https://laravel.com/docs/5.7/authorization
* https://laravel.com/docs/5.7/routing
* https://laravel.com/docs/5.7/migrations
* https://laravel.com/docs/5.7/queries
* https://laravel.com/docs/5.7/views
* https://laravel.com/docs/5.7/eloquent
* https://laravel.com/docs/5.7/eloquent-relationships
* https://laravel.com/docs/5.7/requests
* https://laravel.com/docs/5.7/errors

###### Updates:
* Update to Bootstrap 4
* Update to Laravel 5.7
* Added optional 2-step account login verfication with [Laravel 2-Step Verification](https://github.com/jeremykenedy/laravel2step)
* Added activity logging using [Laravel-logger](https://github.com/jeremykenedy/laravel-logger)
* Added Configurable Email Notification using [Laravel-Exception-Notifier](https://github.com/jeremykenedy/laravel-exception-notifier)
* Update to Laravel 5.5
* Added User Delete with Goodbye email
* Added User Restore Deleted Account from email with secure token
* Added [Soft Deletes](https://laravel.com/docs/5.7/eloquent#soft-deleting) and Soft Deletes Management panel
* Added User Account Settings to Profile Edit
* Added User Change Password to Profile Edit
* Added User Delete Account to Profile Edit
* Added [Password Strength Meter](https://github.com/elboletaire/password-strength-meter)
* Added [hideShowPassword](https://github.com/cloudfour/hideShowPassword)
* Added Admin Routing Details
* Admin PHP Information
* Added Robust [Laravel Logging](https://laravel.com/docs/5.7/errors#logging) with admin UI using MonoLog
* Added Active Nav states using [Laravel Requests](https://laravel.com/docs/5.7/requests)
* Added [Laravel Debugger](https://github.com/barryvdh/laravel-debugbar) with Service Provider to manage status in `.env` file.
* Updated Capture IP not found IP address
* Added User Avatar Image AJAX Upload with [Dropzone.js](http://www.dropzonejs.com/#configuration)
* Added User Gravatar using Gravatar API
* Added Themes Management.
* Add user profiles with seeded list and global view
* Major overhaul on Laravel 5.4
* Update from Laravel 5.1 to 5.2
* Added eloquent editable user profile
* Added IP Capture
* Added Google Maps API v3 for User Location lookup
* Added Google Maps API v3 for User Location Input Geocoding
* Added Google Maps API v3 for User Location Map with Options
* Added CRUD(Create, Read, Update, Delete) User Management


### Rough File Tree
```
laravel-auth
├── .env.example
├── .env.travis
├── .gitattributes
├── .gitignore
├── .travis.yml
├── CODE_OF_CONDUCT.md
├── LICENSE
├── README.md
├── app
│   ├── Console
│   │   ├── Commands
│   │   │   └── DeleteExpiredActivations.php
│   │   └── Kernel.php
│   ├── Exceptions
│   │   └── Handler.php
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── AdminDetailsController.php
│   │   │   ├── Auth
│   │   │   │   ├── ActivateController.php
│   │   │   │   ├── ForgotPasswordController.php
│   │   │   │   ├── LoginController.php
│   │   │   │   ├── RegisterController.php
│   │   │   │   ├── ResetPasswordController.php
│   │   │   │   └── SocialController.php
│   │   │   ├── Controller.php
│   │   │   ├── ProfilesController.php
│   │   │   ├── RestoreUserController.php
│   │   │   ├── SoftDeletesController.php
│   │   │   ├── ThemesManagementController.php
│   │   │   ├── UserController.php
│   │   │   ├── UsersManagementController.php
│   │   │   └── WelcomeController.php
│   │   ├── Kernel.php
│   │   ├── Middleware
│   │   │   ├── Authenticate.php
│   │   │   ├── CheckCurrentUser.php
│   │   │   ├── CheckIsUserActivated.php
│   │   │   ├── EncryptCookies.php
│   │   │   ├── RedirectIfAuthenticated.php
│   │   │   ├── TrimStrings.php
│   │   │   ├── TrustProxies.php
│   │   │   └── VerifyCsrfToken.php
│   │   └── ViewComposers
│   │       └── ThemeComposer.php
│   ├── Logic
│   │   ├── Activation
│   │   │   └── ActivationRepository.php
│   │   └── Macros
│   │       └── HtmlMacros.php
│   ├── Mail
│   │   └── ExceptionOccured.php
│   ├── Models
│   │   ├── Activation.php
│   │   ├── Profile.php
│   │   ├── Social.php
│   │   ├── Theme.php
│   │   └── User.php
│   ├── Notifications
│   │   ├── SendActivationEmail.php
│   │   └── SendGoodbyeEmail.php
│   ├── Providers
│   │   ├── AppServiceProvider.php
│   │   ├── AuthServiceProvider.php
│   │   ├── BroadcastServiceProvider.php
│   │   ├── ComposerServiceProvider.php
│   │   ├── EventServiceProvider.php
│   │   ├── LocalEnvironmentServiceProvider.php
│   │   ├── MacroServiceProvider.php
│   │   └── RouteServiceProvider.php
│   └── Traits
│       ├── ActivationTrait.php
│       ├── CaptchaTrait.php
│       └── CaptureIpTrait.php
├── artisan
├── bootstrap
│   ├── app.php
│   ├── autoload.php
│   └── cache
│       ├── .gitignore
│       ├── packages.php
│       └── services.php
├── composer.json
├── composer.lock
├── config
│   ├── app.php
│   ├── auth.php
│   ├── broadcasting.php
│   ├── cache.php
│   ├── database.php
│   ├── debugbar.php
│   ├── exceptions.php
│   ├── filesystems.php
│   ├── gravatar.php
│   ├── hashing.php
│   ├── laravel2step.php
│   ├── laravelPhpInfo.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── roles.php
│   ├── services.php
│   ├── session.php
│   ├── settings.php
│   ├── usersmanagement.php
│   └── view.php
├── database
│   ├── .gitignore
│   ├── factories
│   │   └── ModelFactory.php
│   ├── migrations
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2014_10_12_100000_create_password_resets_table.php
│   │   ├── 2016_01_15_105324_create_roles_table.php
│   │   ├── 2016_01_15_114412_create_role_user_table.php
│   │   ├── 2016_01_26_115212_create_permissions_table.php
│   │   ├── 2016_01_26_115523_create_permission_role_table.php
│   │   ├── 2016_02_09_132439_create_permission_user_table.php
│   │   ├── 2017_03_09_082449_create_social_logins_table.php
│   │   ├── 2017_03_09_082526_create_activations_table.php
│   │   ├── 2017_03_20_213554_create_themes_table.php
│   │   ├── 2017_03_21_042918_create_profiles_table.php
│   │   └── 2017_12_09_070937_create_two_step_auth_table.php
│   └── seeds
│       ├── ConnectRelationshipsSeeder.php
│       ├── DatabaseSeeder.php
│       ├── PermissionsTableSeeder.php
│       ├── RolesTableSeeder.php
│       ├── ThemesTableSeeder.php
│       └── UsersTableSeeder.php
├── license.svg
├── package-lock.json
├── package.json
├── phpunit.xml
├── public
│   ├── .htaccess
│   ├── css
│   │   ├── app.css
│   │   └── laravel2step
│   │       ├── app.css
│   │       └── app.min.css
│   ├── favicon.ico
│   ├── fonts
│   │   ├── fontawesome-webfont.eot
│   │   ├── fontawesome-webfont.svg
│   │   ├── fontawesome-webfont.ttf
│   │   ├── fontawesome-webfont.woff
│   │   ├── fontawesome-webfont.woff2
│   │   ├── glyphicons-halflings-regular.eot
│   │   ├── glyphicons-halflings-regular.svg
│   │   ├── glyphicons-halflings-regular.ttf
│   │   ├── glyphicons-halflings-regular.woff
│   │   └── glyphicons-halflings-regular.woff2
│   ├── images
│   │   ├── wink.png
│   │   └── wink.svg
│   ├── index.php
│   ├── js
│   │   ├── app.99230f42ad184f498ce6.js
│   │   └── app.js
│   ├── mix-manifest.json
│   ├── robots.txt
│   └── web.config
├── resources
│   ├── assets
│   │   ├── js
│   │   │   ├── app.js
│   │   │   ├── bootstrap.js
│   │   │   └── components
│   │   │       ├── ExampleComponent.vue
│   │   │       └── UsersCount.vue
│   │   └── sass
│   │       ├── _avatar.scss
│   │       ├── _badges.scss
│   │       ├── _buttons.scss
│   │       ├── _forms.scss
│   │       ├── _helpers.scss
│   │       ├── _hideShowPassword.scss
│   │       ├── _lists.scss
│   │       ├── _logs.scss
│   │       ├── _margins.scss
│   │       ├── _mixins.scss
│   │       ├── _modals.scss
│   │       ├── _panels.scss
│   │       ├── _password.scss
│   │       ├── _socials.scss
│   │       ├── _typography.scss
│   │       ├── _user-profile.scss
│   │       ├── _variables.scss
│   │       ├── _visibility.scss
│   │       ├── _wells.scss
│   │       └── app.scss
│   ├── lang
│   │   ├── en
│   │   │   ├── auth.php
│   │   │   ├── emails.php
│   │   │   ├── forms.php
│   │   │   ├── modals.php
│   │   │   ├── pagination.php
│   │   │   ├── passwords.php
│   │   │   ├── permsandroles.php
│   │   │   ├── profile.php
│   │   │   ├── socials.php
│   │   │   ├── themes.php
│   │   │   ├── titles.php
│   │   │   ├── usersmanagement.php
│   │   │   └── validation.php
│   │   └── fr
│   │       ├── auth.php
│   │       ├── emails.php
│   │       ├── forms.php
│   │       ├── modals.php
│   │       ├── pagination.php
│   │       ├── passwords.php
│   │       ├── permsandroles.php
│   │       ├── profile.php
│   │       ├── socials.php
│   │       ├── titles.php
│   │       ├── usersmanagement.php
│   │       └── validation.php
│   └── views
│       ├── auth
│       │   ├── activation.blade.php
│       │   ├── exceeded.blade.php
│       │   ├── login.blade.php
│       │   ├── passwords
│       │   │   ├── email.blade.php
│       │   │   └── reset.blade.php
│       │   └── register.blade.php
│       ├── emails
│       │   └── exception.blade.php
│       ├── errors
│       │   ├── 403.blade.php
│       │   ├── 404.blade.php
│       │   ├── 500.blade.php
│       │   └── 503.blade.php
│       ├── home.blade.php
│       ├── layouts
│       │   └── app.blade.php
│       ├── modals
│       │   ├── modal-delete.blade.php
│       │   ├── modal-form.blade.php
│       │   └── modal-save.blade.php
│       ├── pages
│       │   ├── admin
│       │   │   ├── active-users.blade.php
│       │   │   ├── home.blade.php
│       │   │   └── route-details.blade.php
│       │   ├── status.blade.php
│       │   └── user
│       │       └── home.blade.php
│       ├── panels
│       │   └── welcome-panel.blade.php
│       ├── partials
│       │   ├── errors.blade.php
│       │   ├── form-status.blade.php
│       │   ├── nav.blade.php
│       │   ├── search-users-form.blade.php
│       │   ├── socials-icons.blade.php
│       │   ├── socials.blade.php
│       │   ├── status-panel.blade.php
│       │   └── status.blade.php
│       ├── profiles
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       ├── scripts
│       │   ├── check-changed.blade.php
│       │   ├── datatables.blade.php
│       │   ├── delete-modal-script.blade.php
│       │   ├── form-modal-script.blade.php
│       │   ├── gmaps-address-lookup-api3.blade.php
│       │   ├── google-maps-geocode-and-map.blade.php
│       │   ├── save-modal-script.blade.php
│       │   ├── search-users.blade.php
│       │   ├── toggleStatus.blade.php
│       │   ├── tooltips.blade.php
│       │   └── user-avatar-dz.blade.php
│       ├── themesmanagement
│       │   ├── add-theme.blade.php
│       │   ├── edit-theme.blade.php
│       │   ├── show-theme.blade.php
│       │   └── show-themes.blade.php
│       ├── usersmanagement
│       │   ├── create-user.blade.php
│       │   ├── edit-user.blade.php
│       │   ├── show-deleted-user.blade.php
│       │   ├── show-deleted-users.blade.php
│       │   ├── show-user.blade.php
│       │   └── show-users.blade.php
│       └── welcome.blade.php
├── routes
│   ├── api.php
│   ├── channels.php
│   ├── console.php
│   └── web.php
├── server.php
├── webpack.mix.js
└── yarn.lock
```

* Tree command can be installed using brew: `brew install tree`
* File tree generated using command `tree -a -I '.git|node_modules|vendor|storage|tests'`

### Opening an Issue
Before opening an issue there are a couple of considerations:
* A **star** on this project shows support and is way to say thank you to all the contributors. If you open an issue without a star, *your issue may be closed without consideration.* Thank you for understanding and the support. You are all awesome!
* **Read the instructions** and make sure all steps were *followed correctly*.
* **Check** that the issue is not *specific to the development environment* setup.
* **Provide** *duplication steps*.
* **Attempt to look into the issue**, and if you *have a solution, make a pull request*.
* **Show that you have made an attempt** to *look into the issue*.
* **Check** to see if the issue you are *reporting is a duplicate* of a previous reported issue.
* **Following these instructions show me that you have tried.**
* If you have a questions send me an email to jeremykenedy@gmail.com
* Need some help, I can do my best on Slack: https://opensourcehelpgroup.slack.com
* Please be considerate that this is an open source project that I provide to the community for FREE when opening an issue.

Open source projects are the community’s responsibility to use, contribute, and debug.

### Laravel Auth License
Laravel-auth is licensed under the [MIT license](https://opensource.org/licenses/MIT). Enjoy!
