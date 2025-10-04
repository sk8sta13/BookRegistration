<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use Illuminate\Http\Request;
use App\Http\Requests\AuthorRequest;
use App\Repositories\Contracts\AuthorRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthorsController extends Controller
{
    protected $repository;

    public function __construct(AuthorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = ($request->has('table_search')) ? $request->table_search : null;
        $authors = $this->repository->search($search, 2);

        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\AuthorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorRequest $request)
    {
        $author = $this->repository->create($request->all());

        return redirect()
            ->route('authors.show', $author->id)
            ->with('success', 'O Autor "' . $author->name . '" foi salvo e está pronto para visualização!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $author = $this->repository->find($id);

        return view('authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $author = $this->repository->find($id);

        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\AuthorRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorRequest $request, int $id)
    {
        $this->repository->update($id, $request->all());

        return redirect()
            ->route('authors.show', $id)
            ->with('success', 'O Autor "' . $request->name . '" foi atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $author = $this->repository->find($id);
        
        if (!$author) {
            return redirect()->route('authors.index')->with('error', 'Autor não encontrado.');
        }

        $authorName = $author->name;
        $this->repository->delete($id); 

        return redirect()
            ->route('authors.index') 
            ->with('success', 'O autor "' . $authorName . '" foi movido para a lixeira (Soft Deleted) com sucesso!');
    }
}
