<?php

namespace App\Http\Controllers\Api;

use App\Filters\BookFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Books API",
 *     version="1.0",
 *     description="API for managing books in the system"
 * )
 */
class BookController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/books",
     *     summary="Retrieve a list of books",
     *     tags={"Books"},
     *     description="Get a paginated list of books with optional filtering, sorting, and pagination.",
     *     @OA\Parameter(
     *         name="author",
     *         in="query",
     *         description="Filter books by author",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="published_year",
     *         in="query",
     *         description="Filter books by published year",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="sort_by",
     *         in="query",
     *         description="Sort books by title or published_year",
     *         required=false,
     *         @OA\Schema(type="string", enum={"title", "published_year"})
     *     ),
     *     @OA\Parameter(
     *         name="order",
     *         in="query",
     *         description="Sorting order (asc for ascending, desc for descending). Default is asc.",
     *         required=false,
     *         @OA\Schema(type="string", enum={"asc", "desc"}, default="asc")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of books retrieved successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Book")
     *             ),
     *             @OA\Property(
     *                 property="meta",
     *                 type="object",
     *                 example={"current_page":1, "total":50, "per_page":10}
     *             ),
     *             @OA\Property(
     *                 property="links",
     *                 type="object",
     *                 example={"first":"url", "last":"url", "prev":null, "next":"url"}
     *             )
     *         )
     *     )
     * )
     */
    public function index( Request $request ) : AnonymousResourceCollection
    {
        $query = BookFilter::apply(Book::query(), $request);

        return BookResource::collection( $query->paginate( 10 ) );
    }

    /**
     * @OA\Post(
     *     path="/api/books",
     *     summary="Create a new book",
     *     tags={"Books"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "author", "published_year", "isbn"},
     *             @OA\Property(property="title", type="string", example="The Great Gatsby"),
     *             @OA\Property(property="author", type="string", example="F. Scott Fitzgerald"),
     *             @OA\Property(property="published_year", type="integer", example=1925),
     *             @OA\Property(property="isbn", type="string", example="9780743273565")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Book created successfully"
     *     )
     * )
     */
    public function store( StoreBookRequest $request ) : BookResource
    {
        $book = Book::create( $request->validated() );

        return new BookResource( $book );
    }

    /**
     * @OA\Get(
     *     path="/api/books/{id}",
     *     summary="Retrieve a specific book",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Book ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Book details retrieved successfully"
     *     )
     * )
     */
    public function show( Book $book ) : BookResource
    {
        return new BookResource( $book );
    }

    /**
     * @OA\Put(
     *     path="/api/books/{id}",
     *     summary="Update a book's details",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Book ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="author", type="string"),
     *             @OA\Property(property="published_year", type="integer"),
     *             @OA\Property(property="isbn", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Book updated successfully"
     *     )
     * )
     */
    public function update( UpdateBookRequest $request, Book $book ) : BookResource
    {
        $book->update( $request->validated() );

        return new BookResource( $book );
    }

    /**
     * @OA\Delete(
     *     path="/api/books/{id}",
     *     summary="Delete a book",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Book ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Book deleted successfully"
     *     )
     * )
     */
    public function destroy( Book $book ) : JsonResponse
    {
        $book->delete();
        return response()->json( ['message' => 'Book deleted'] );
    }
}
