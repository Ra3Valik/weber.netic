<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class BookFilter
{
    /**
     * Apply filters to the book query.
     *
     * @param Builder $query
     * @param Request $request
     * @return Builder
     */
    public static function apply( Builder $query, Request $request ) : Builder
    {
        if ( $request->filled( 'author' ) ) {
            $query->where( 'author', 'LIKE', '%' . $request->author . '%' );
        }

        if ( $request->filled( 'published_year' ) ) {
            $query->where( 'published_year', $request->published_year );
        }

        if ( $request->filled( 'sort_by' ) ) {
            $query->orderBy( $request->sort_by, $request->get( 'order', 'asc' ) );
        }

        return $query;
    }
}
