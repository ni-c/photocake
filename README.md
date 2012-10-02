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

### Step by step
    
#### Clone the CakePHP framework
```bash
git clone git://github.com/cakephp/cakephp.git ~/cakephp
```

#### Update your PHP include path to the cakephp lib path
```bash
vi /etc/php5/cgi/php.ini
```
search for 'include_path' and add "~/cakephp/lib" (`include_path = "~/cakephp/lib"`)
      
#### Restart PHP
```bash
sudo /etc/init.d/php5 restart
```
    
# Clone photocake
```bash
git clone git://github.com/ni-c/photocake.git ~/photocake
git submodule init
git submodule update

```

Make ~/photocake accessible from your webserver.

#### CakePHP

*photocake* needs the [CakePHP](http://cakephp.org/) framework to run. Version 2.3 of CakePHP can be found on [GitHub](https://github.com/cakephp/cakephp/tree/2.3). You should read the [CakePHP Cookbook](http://book.cakephp.org/2.0/en/index.html) for a detailed installation guide. 

#### photocake

**photocake** comes with an install script that asks for your database credentials when you visit your fresh blog the first time. 

To register the git hooks that clear the photocake cache and generate static files you should run the following command after cloning:

```bash
bin/create-hook-symlinks
```

### nginx

If you are using Apache as webserver, then the included .htaccess files will do the URL rewriting. If you are using nginx, then you have to do some configuration. Here is an example configuration file for nginx:

```bash
server {
  listen   80;
  server_name YOURDOMAIN.COM;

  # Serve static content directly with some caching goodness
  location ~* ^.+.(jpg|jpeg|gif|css|png|js|ico|mp3|ogg|html|htm)$ {
    root /var/www/$host;
    access_log        off;
    expires           1d;
    break;
  }

  # Deny .ht files
  location ~ /\.ht {
    access_log        off;
    deny              all;
    break;
  }

  # CakePHP rewrite rules
  location / {
    access_log        off;
    root              ~/photocake;  # Project directory
    index             index.php;

    # Serve static pages immediately
    if (-f $request_filename) {
      break;
    }

    if (!-e $request_filename) {
      rewrite ^/(.+)$ /index.php?url=$1 last;
      break;
      }
    }

  # FastCGI
  location ~ .php$ {
    fastcgi_pass   127.0.0.1:9000;
    fastcgi_index  index.php;
    fastcgi_param  SCRIPT_FILENAME  /~/photocake/$fastcgi_script_name;  # Project directory
    include        fastcgi_params;
  }
}
```

## Creating Posts

You can add a post to your *photocake* blog by copying a JPG-Image into a directory (Default: Files/). *photocake* will extract the EXIF data from the image and create a new blog post. To parse all new images in the folder open /admin/publish.

For title, description, categories and tags of the new post, a JSON-String is expected in the EXIF data for 'ImageDescription':

```json
{
  "Title":"A Title",
  "Description":"Some *markdown* discription",
  "Category":"Nice images",
  "Tags":"some,comma,separated,tags"
}
```

You can use [exiftool](http://owl.phy.queensu.ca/~phil/exiftool/) to view and edit the EXIF data of your images. To set the 'ImageDescription' with exiftool type:

```bash
exiftool -ImageDescription='{"Title":"foo","Description":"bar","Category":"foobar","Tags":"foo,bar"} [filename].jpg
```

## References

Build upon the [CakePHP](http://cakephp.org/) PHP Framework. Inspired by the [pixelpost](http://www.pixelpost.org/) photoblog app and the [The World in 35mm](http://www.pixelpost.org/extend/templates/the-world-in-35mm/) template.

## License

The license under which *photocake* is released is the [GPLv2](http://www.gnu.org/licenses/gpl-2.0.html) (or later) from the Free Software Foundation.
 
