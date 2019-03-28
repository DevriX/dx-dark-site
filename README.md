# DX Dark Site
This is the Git repository for DX Dark Site.

This is a plugin we first created for Escape Hunt, what is Dark Site you may check here: https://www.wiliam.com.au/wiliam-blog/what-is-a-dark-website
## Project Notes
The plugin should have two major features. A redirect field which redirects to selected URL, even if the URL is among the site. Else said there should not be infinite redirection loop if we redirect to a page of the site. Also, a banner in the header (non-dependant on any theme ) which should be enabled from the plugin's settings page.
Also, a cookie should be loaded for n hours when the banner is closed by the user and after that time the banner should open automatically.

Below you'll find important notes about the project, the git branching and the like.

## Project Documentation
For any other development related information, check the Git repository's Wiki page for tips and tricks or sync with the Project Owner of the project.

### Git Branching
We are using different branches when it comes to building new features. However, you should keep in mind two things: 
* `master` branch is the current representation of the production website

Do not forget to checkout from `master` branch when you start a new feature and properly name the new branch, based on the feature/bugfix/experimental/styling nature of your changes

### Localhost Debugging
You should have enabled the `WP_DEBUG` set to `TRUE` in your `wp-config.php` file. There are a few other useful debugging options which you can enable:
```
/* Debug Config */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
error_reporting( E_ALL );
ini_set( 'display_errors', 'yes' );

define( 'FS_METHOD', 'direct' ); // Allows you to upload/update themes/plugins/core from your localhost
```

This is the best practice when it comes to localhost work - having the debug turned on. However, there might be some rare cases where the debug notes are so many, that you might need to turn off the debugging for a while. Again, this should be something temporary, as you should have the debugging turned on on your localhost by default.

### Localhost Media
You'll need to upload an image for the banner image section, but this will be a dummy image for the purpose of development. No other media will be needed,

## Git Repository Structure and ToC
A short explanation of the structure of the Git repository.

Below you can find the Table of Contents of the repository.

#### the Git repository root folder
This is the folder where we have files and folders like `.gitignore`, `.git`, `README.md`.
This also contains root files, like `ads.txt`, `robotx.txt` and everything else which is required, based on the project.

By default, all WordPress Core files and folders are ignored, so we can keep the Git repository clean and have only the work files.
If the specific project requires something different, note this in the project notes.


#### Anything else
Since this is a plugin we have the root folder and inside it the plugin's files

##  Setup Details
The Git repository contains a few root files and the `wp-content` directory content, so we are going to set up the project following the steps below.

01) Create a new directory on your local web server folder - `www/html`, `htdocs`, etc, based on your OS. The name of the directory is based on your preferences and whatever is going to work best for you.

02) Go to the newly created directory and download the latest version of WordPress from the [official website](https://wordpress.org/download/). You can use the WP-CLI command [wp core download](https://developer.wordpress.org/cli/commands/core/download/). Unless there is anything else mentioned here, we assume the project is running on the latest version of WordPress.

Make sure the directory is writable. Again, this is based on your localhost setup and personal preferences.

03) Navigate to the newly created directory with the fresh downloaded WordPress Core, go to wp-content and clone the repository in there, you should see new folder dx-dark-site which is the plugin's directory

The final goal is to have all Git repository files into your wp-content directory, which includes `.git`, `.gitignore` and everything else.

As stated above, We strongly suggest you to enable the `WP_DEBUG` on your localhost. You can check **Localhost Debugging** section for more details