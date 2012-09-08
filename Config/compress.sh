#!/bin/bash

# Create gzip versions of static files for nginx
files=('../webroot/css/light.css' '../webroot/css/styles.css' '../webroot/js/mootools-more-1.4.0.1.js' '../webroot/js/photocake.js')
for f in "${files[@]}"; do
	gzip -9 -c "$f" > "$f.gz";
done

