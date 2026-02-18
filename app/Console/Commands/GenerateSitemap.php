<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate sitemap.xml for the website';

    public function handle()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0))
            ->add(Url::create('/about')->setPriority(0.8))
            ->add(Url::create('/contact')->setPriority(0.8));

        // If you have dynamic pages like products or blog posts:
        // foreach (\App\Models\Product::all() as $product) {
        //     $sitemap->add(Url::create("/products/{$product->slug}")->setPriority(0.9));
        // }

       $sitemap->writeToFile('/home3/attilach/public_html/sitemap.xml');

        $this->info('Sitemap generated successfully!');
    }
}
