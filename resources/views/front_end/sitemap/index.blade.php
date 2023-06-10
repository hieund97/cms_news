<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ route('fe.sitemap_product_category') }}</loc>
    </sitemap>
    <sitemap>
        <loc>{{ route('fe.sitemap_product') }}</loc>
    </sitemap>
    <sitemap>
        <loc>{{ route('fe.sitemap_product_tag') }}</loc>
    </sitemap>
    <sitemap>
        <loc>{{ route('fe.sitemap_article') }}</loc>
    </sitemap>
    <sitemap>
        <loc>{{ route('fe.sitemap_article_category') }}</loc>
    </sitemap>
    <sitemap>
        <loc>{{ route('fe.sitemap_article_tag') }}</loc>
    </sitemap>
    <sitemap>
        <loc>{{ route('fe.sitemap_page') }}</loc>
    </sitemap>
</sitemapindex>