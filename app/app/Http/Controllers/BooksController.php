<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Repositories\Contracts\BookRepositoryInterface;
use App\Repositories\Contracts\AuthorRepositoryInterface;
use App\Repositories\Contracts\SubjectRepositoryInterface;

class BooksController extends Controller
{
    protected $books;
    protected $authors;
    protected $subjects;

    public function __construct(
        BookRepositoryInterface $books,
        AuthorRepositoryInterface $authors,
        SubjectRepositoryInterface $subjects
    )
    {
        $this->books = $books;
        $this->authors = $authors;
        $this->subjects = $subjects;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = ($request->has('table_search')) ? $request->table_search : null;
        $books = $this->books->search($search);

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = $this->authors->pluck();
        $subjects = $this->subjects->pluck();

        return view('books.create', compact('authors', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\BookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $book = $this->books->create($request->all());

        return redirect()
            ->route('books.show', $book->id)
            ->with('success', 'O Livro "' . $book->title . '" foi salvo e está pronto para visualização!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $book = $this->books->find($id);

        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $book = $this->books->find($id);
        $authors = $this->authors->pluck();
        $subjects = $this->subjects->pluck();

        return view('books.edit', compact('book', 'authors', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\BookRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, int $id)
    {
        $this->books->update($id, $request->all());

        return redirect()
            ->route('books.show', $id)
            ->with('success', 'O Livro "' . $request->title . '" foi atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $book = $this->books->find($id);
        
        if (!$book) {
            return redirect()->route('books.index')->with('error', 'Livro não encontrado.');
        }

        $bookTitle = $book->title;
        $this->books->delete($id); 

        return redirect()
            ->route('books.index') 
            ->with('success', 'O livro "' . $bookTitle . '" foi movido para a lixeira (Soft Deleted) com sucesso!');
    }
}
