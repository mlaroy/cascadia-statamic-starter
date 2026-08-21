<?php

namespace App\Tags;

use Statamic\Tags\Tags;
use Statamic\Facades\Entry;

class Blog extends Tags
{
    /**
     * The {{ blog }} tag.
     *
     * @return string|array
     */
    public function index()
    {
        //

        // echo '<pre>';
        // var_dump( $this->params->all() );
        // echo '</pre>';
        // $categories = $this->params->get(['taxonomy:categories']);
        // var_dump( $categories );

        $entries = Entry::query()
            ->where('collection', 'blog')
            ->orderBy('date', 'desc')
            ->get();

        // echo '<pre>';
        // var_dump( $entries[0] );
        // echo '</pre>';

        return $entries;
    }

    /**
     * The {{ blog:example }} tag.
     *
     * @return string|array
     */
    public function taxonomy()
    {
        $category = $this->params->get('category');
        // echo '<pre>';
        // // var_dump( $this->params->all() );
        // var_dump( $category );
        // echo '</pre>';

        $entries = Entry::query()
            ->where('collection', 'blog')
            ->whereTaxonomy('categories::' . $category)
            ->orderBy('date', 'desc')
            // ->paginate(12)
            ->get();

        return $entries;
    }
}
