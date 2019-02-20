<?php

namespace DeskFlix\Http\Controllers\Admin;

use DeskFlix\Form\CategoryForm;
use DeskFlix\Models\Category;
use Illuminate\Http\Request;
use DeskFlix\Http\Requests\CategoryCreateRequest;
use DeskFlix\Http\Requests\CategoryUpdateRequest;
use DeskFlix\Repositories\CategoryRepository;
use DeskFlix\Http\Controllers\Controller;

class CategoriesController extends Controller
{

    /**
     * @var CategoryRepository
     */
    protected $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $categories = $this->repository->paginate();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $form = \FormBuilder::create(CategoryForm::class, [
            'url' => route('admin.categories.store'),
            'method' => 'POST'
        ]);

        return view('admin.categories.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = \FormBuilder::create(CategoryForm::class);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();

        $this->repository->create($data);

        $request->session()->flash('message', 'Categoria criada com sucesso.');

        return redirect()->route('admin.categories.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //TESTAR DEPOIS, PASSAR PARAM $ID
        /*$category = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $category,
            ]);
        }*/

        return view('admin.categories.show', compact('category'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        $form = \FormBuilder::create(CategoryForm::class, [
            'url' => route('admin.categories.update', ['categoria' => $category->id]),
            'method' => 'PUT',
            'model' => $category
        ]);

        return view('admin.categories.edit', compact('form'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $form = \FormBuilder::create(CategoryForm::class);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->update($data, $id);

        $request->session()->flash('message', 'Categoria alterada com sucesso.');

        return redirect()->route('admin.categories.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        /*TESTAR DEPOIS
          $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Category deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Category deleted.');*/

        $this->repository->delete($id);
        $request->session()->flash('message', 'Categoria excluída com sucesso.');
        return redirect()->route('admin.categories.index');
    }
}
