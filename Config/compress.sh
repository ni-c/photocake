#!/bin/bash

# Create gzip versions of static files for nginx
files=('../webroot/css/photocake.css' '../webroot/js/photocake.js')
for f in "${files[@]}"; do
	gzip -9 -c "$f" > "$f.gz";
done

