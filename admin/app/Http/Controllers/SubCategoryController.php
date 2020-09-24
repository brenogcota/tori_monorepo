<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Http\Requests\SubCategoryRequest;
use App\Exceptions\Handler;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Symfony\Component\Debug\Exception\FatalErrorException;

class SubCategoryController extends Controller
{

    private $subcategory;

    public function __construct(SubCategory $subcategory)
    {
        $this->subcategory = $subcategory;
    }

    public function index(Request $request) {
        
        try{

            $subcategories = $this->subcategory->all();

            return $subcategories; 
        } 
        catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Category not created')
                            ->withInput();
        }
        catch (QueryException $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Query error')
                            ->withInput();
        }
        catch (FatalErrorException $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Fatal error')
                            ->withInput();
        }

    }

    public function create()
    {
        return view('admin.pages.category.create');
    }

    public function store(SubCategoryRequest $request)
    {
        
        $subcategory = $this->subcategory;

        try {

            $data = [
                'name' => $request->name,
                'category_id' => $request->category_id,
            ];          

            $subcategory->name = $request->name;
            $subcategory->category_id = $request->category_id;     

            $subcategory->save();

            return redirect()
                    ->back()
                    ->with('message', 'Sub Categoria criada')
                    ->withInput();
            
        }
        catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Category not created')
                            ->withInput();
        }
        catch (QueryException $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Query error')
                            ->withInput();
        }
        catch (FatalErrorException $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Fatal error')
                            ->withInput();
        }
    }

    public function show($id) {
        $subcategory = $this->subcategory->find($id);

        return view('admin.pages.category.show', [
            'category' => $subcategory
        ]);
    }

    public function upgrade($id)
    {
        $subcategory = $this->subcategory->find($id);

        if(!$subcategory) {
            return redirect()
                    ->back()
                    ->with('message', 'Categoria não encontrada')
                    ->withInput();
        }

        return view('admin.pages.category.upgrade', [
            'category' => $subcategory
        ]);
    }

    public function update(Request $request, $id)
    {


        $request->validate([
            'name' => 'required|max:255',
        ]);

        $subcategory = $this->subcategory->find($id);

        if(!$subcategory) {
            return redirect()
                    ->back()
                    ->with('message', 'Categoria não encontrada')
                    ->withInput();
        }

        try {

            $subcategory->name = $request->name; 

            $subcategory->save();

            return redirect()
                    ->back()
                    ->with('message', 'Categoria atualizada')
                    ->withInput();

           
        }
        catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Category not created')
                            ->withInput();
        }
        catch (QueryException $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Query error')
                            ->withInput();
        }    
        catch (FatalErrorException $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Fatal error')
                            ->withInput();
        }
    }

    public function destroy($id) {
        try {

            $subcategory = $this->subcategory->find($id);

            $subcategory->delete();
            
            return redirect()
                    ->back()
                    ->with('message', 'Categoria removida')
                    ->withInput();
                    
        }
        catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Category not removed')
                            ->withInput();
        }
        catch (QueryException $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Query error')
                            ->withInput();
        }
        catch (FatalErrorException $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Fatal error')
                            ->withInput();
        }
    }
    
}
