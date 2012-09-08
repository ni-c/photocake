<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo Router::url('/',true); ?></loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?php echo Router::url(array('controller'=>'pages','action'=>'about'), true); ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
    </url>
    <?php foreach ($photos as $photo):?>
    <url>
        <loc><?php echo Router::url(array('controller'=>'photos','action'=>'view',$photo['Photo']['id']),true); ?></loc>
        <lastmod><?php echo $this->Time->toAtom($photo['Photo']['modified']); ?></lastmod>
        <priority>0.8</priority>
    </url>
    <?php endforeach; ?>
    <url>
        <loc><?php echo Router::url(array('controller'=>'photos','action'=>'browse'), true); ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
</urlset>