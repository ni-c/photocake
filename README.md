# photocake

## About

*photocake* is a markdown photoblog based on [CakePHP](http://cakephp.org/). It is able to parse Jpeg-files and create blog posts using the EXIF data of the images.

You can find a live demo of *photocake* at [willithiel.de](http://willithiel.de).

## Features

- Fast (Ultrafast with Nginx)
- Multilingualized (Currently English and German)
- Resizing of images (if necessary) with ImageMagick
- Needs only (well-formated markdown) EXIF data to create photo posts

## Installation

### CakePHP

*photocake* needs the [CakePHP](http://cakephp.org/) framework to run. Version 2.3 of CakePHP can be found on [GitHub](https://github.com/cakephp/cakephp/tree/2.3). You should read the [CakePHP Cookbook](http://book.cakephp.org/2.0/en/index.html) for a detailed installation guide. 

### photocake

**photocake** comes with an install script that asks for your database credentials when you visit your fresh blog the first time. 

Optional: Run **./compress.sh** in the **Config** directory to gzip the .css and .js files (and enable gzip in your webserver).

## Creating Posts

You can add a post to your *photocake* blog by copying a JPG-Image into a directory (Default: Files/). *photocake* will extract the EXIF data from the image and create a new blog post.

For title, description, categories and tags of the new post, a JSON-String is expected in the EXIF data for 'ImageDescription':

    {
        "Title":"A Title",
        "Description":"Some *markdown* discription",
        "Category":"Nice images",
        "Tags":"some,comma,separated,tags"
    }

You can use [exiftool](http://owl.phy.queensu.ca/~phil/exiftool/) to view and edit the EXIF data of your images. To set the 'ImageDescription' with exiftool type:

    exiftool -ImageDescription='{"Title":"foo","Description":"bar","Category":"foobar","Tags":"foo,bar"} [filename].jpg

## References

Build upon the [CakePHP](http://cakephp.org/) PHP Framework. Inspired by the [pixelpost](http://www.pixelpost.org/) photoblog app and the [The World in 35mm](http://www.pixelpost.org/extend/templates/the-world-in-35mm/) template.

## License

The license under which *photocake* is released is the [GPLv2](http://www.gnu.org/licenses/gpl-2.0.html) (or later) from the Free Software Foundation.
 