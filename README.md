# photocake

*photocake* is a markdown photoblog based on [CakePHP](http://cakephp.org/). It will parse JPG images in a specific folder and create a blog post for each image.

You can find a live demo at [willithiel.de](http://willithiel.de).

## Installation

### CakePHP

*photocake* needs the [CakePHP](http://cakephp.org/) framework to run. You can find version 2.3 of CakePHP on [GitHub](https://github.com/cakephp/cakephp/tree/2.3).

### Database

The database schema can be found in **Config/Schema/database.sql**.

Run **./compress.sh** in the **Config** directory to gzip the .css and .js files (and enable gzip in your webserver).

### Files

Configure the database in **Config/database.php**. There is an example file (**Config/database.example.php**)

### Options

Options are saved in the table 'options', the following Options can be used:

- 'photo_dir' The directory to parse for images (default: Images/)
- 'keywords' Keywords for the HTML header
- 'site_subtitle' The subtitle for the blog
- 'site_title' The title for the blog
- 'license' The license of the photos in the blog (e.g. http://creativecommons.org/licenses/by-nc-sa/3.0/)
- 'about' The adress that should be shown on the about page
- 'email' eMail-Address of the blog owner
- 'twitter' Twitter nickname of the blog owner
- 'facebook' Facebook id of the blog owner
- 'ga_code' Google Analytics ID
- 'defensio_apikey' [Defensio](http://www.defensio.com/api/) API Key (Comment Spam)
- 'publish_immediately' Set to 1 if new photos should be published immediately (Otherwise they are saved as draft)

## Creating Posts

You can add a post to your *photocake* blog by copying a JPG-Image into a directory. *photocake* will extract the EXIF data from the image and create a new blog post.

For title, description, categories and tags of the new post, a JSON-String is expected in the EXIF data for 'ImageDescription':

    {
        "Title":"A Title",
        "Description":"Some *markdown* discription",
        "Category":"Nice images",
        "Tags":"some,comma,separated,tags"
    }

The URL **http://[photocake-url]/photos/refresh** will parse the images in the Images/ folder and update the database.

## Known problems

Depending on your webservers speed and the size and number of JPGs you put in the Images/ folder, it may be a good idea to increase your *max_execution_time* in php.ini (Parsing 40 jpg-images (23 MB) took six minutes on my webserver).