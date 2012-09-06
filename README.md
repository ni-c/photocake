# photocake

*photocake* is a photoblog based on [CakePHP](http://cakephp.org/).

## Installation

### CakePHP

*photocake* needs the [CakePHP](http://cakephp.org/) framework to run. You can find version 2.3 of CakePHP on [GitHub](https://github.com/cakephp/cakephp/tree/2.3).

### Photocake

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

## Creating Posts

You can add a post to your *photocake* blog by copying a JPG-Image into a directory. *photocake* will extract the EXIF data from the image and create a new blog post.

For title, description, categories and tags of the new post, a JSON-String is expected in the EXIF data for 'ImageDescription':

    {
        "title":"A Title",
        "description":"Some *markdown* discription",
        "category":"Nice images",
        "tags":"some,comma,separated,tags
    }

The URL **http://[photocake-url]/photos/refresh** will parse the images in the Images/ folder and update the database.