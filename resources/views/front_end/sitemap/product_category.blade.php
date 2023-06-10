<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>http://chungauto.vn/</loc>
        <lastmod>2021-03-21</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1</priority>
    </url>
    @foreach ($categories as $row)
        <url>
            <loc>{{ Route('fe.product.category',["slug"=>$row->slug,"id"=>$row->id]) }}</loc>
            <lastmod>{{ $row->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>