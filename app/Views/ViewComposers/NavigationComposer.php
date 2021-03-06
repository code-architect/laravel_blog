<?php

namespace App\Views\ViewComposers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Seo;
use Carbon\Carbon;
use Illuminate\View\View;

class NavigationComposer
{
    public function compose(View $view)
    {
        $this->composeCategories($view);
        $this->composePopularPosts($view);
        $this->composeSeoPages($view);
        $this->composeSingleBanner($view);
        $this->composeThreeBanner($view);
    }

    private function composeCategories(View $view)
    {
        $categories = Category::with(['posts' => function($query){
        $query->where('published_at', '<=', Carbon::now());
        }])->orderBy('title', 'asc')->get();

        $view->with('categories', $categories);
    }

    private function composePopularPosts(View $view)
    {
        $popularPosts = Post::published()->popular()->take(3)->get();
        $view->with('popularPosts', $popularPosts);
    }

    private function composeSeoPages(View $view)
    {
        $pagesSeo = Seo::all();
        $view->with('pagesSeo', $pagesSeo);
    }

    private function composeSingleBanner(View $view)
    {
        $singleBanner = Post::special()->inRandomOrder()->take(1)->get();
        $view->with('singleBanner', $singleBanner);
    }

    private function composeThreeBanner(View $view)
    {
        $threeBanner = Post::featured()->inRandomOrder()->take(3)->get();
        $view->with('threeBanner', $threeBanner);
    }

}