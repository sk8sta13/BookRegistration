<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SubjectRequest;
use App\Repositories\Contracts\SubjectRepositoryInterface;

class SubjectsController extends Controller
{
    protected $repository;

    public function __construct(SubjectRepositoryInterface $repository)
    {
        $this->repository = $repository;
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
        $subjects = $this->repository->search($search);

        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\SubjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        $subject = $this->repository->create($request->all());

        return redirect()
            ->route('subjects.show', $subject->id)
            ->with('success', 'O Assunto "' . $subject->description . '" foi salvo e está pronto para visualização!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $subject = $this->repository->find($id);

        return view('subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $subject = $this->repository->find($id);

        return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\SubjectRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectRequest $request, int $id)
    {
        $this->repository->update($id, $request->all());

        return redirect()
            ->route('subjects.show', $id)
            ->with('success', 'O Assunto "' . $request->description . '" foi atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $subject = $this->repository->find($id);
        
        if (!$subject) {
            return redirect()->route('subjects.index')->with('error', 'Assunto não encontrado.');
        }

        $description = $subject->description;
        $this->repository->delete($id); 

        return redirect()
            ->route('subjects.index') 
            ->with('success', 'O assunto "' . $description . '" foi movido para a lixeira (Soft Deleted) com sucesso!');
    }
}
