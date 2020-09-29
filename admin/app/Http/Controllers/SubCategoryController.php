<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Category;
use App\Http\Requests\SubCategoryRequest;
use App\Exceptions\Handler;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Symfony\Component\Debug\Exception\FatalErrorException;

class SubCategoryController extends Controller
{

    private $Subcategory;
    private $Category;

    public function __construct(SubCategory $subcategory, Category $category)
    {
        $this->Subcategory = $subcategory;
        $this->Category = $category;
    }

    public function index(Request $request) {
        
        try{

            $token = $request->cookie('token');

            $subcategories = DB::table('subcategories')
                                    ->join('categories', 'categories.id', '=', 'subcategories.category_id')
                                    ->join('sellers', 'sellers.id', '=', 'categories.seller_id')
                                    ->select('categories.name as category_name', 'subcategories.name')
                                    ->where('sellers.api_token', $token)
                                    ->orderBy('subcategories.created_at', 'desc')
                                    ->paginate(15);

            return view('admin.pages.subcategory.index', [
                'subcategories' => $subcategories
            ]);
        } 
        catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Sub Category not created')
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

    public function create(Request $request)
    {
        $token = $request->cookie('token');

        $categories =  DB::table('categories')
                            ->join('sellers', 'sellers.id', '=', 'categories.seller_id')
                            ->where('sellers.api_token', $token)
                            ->orderBy('categories.created_at', 'desc')
                            ->paginate(15);

        return view('admin.pages.subcategory.create', [
            'categories' => $categories
        ]);
    }

    public function store(SubCategoryRequest $request)
    {
        
        $subcategory = $this->Subcategory;

        try {
         

            $subcategory->name = $request->name;
            $subcategory->category_id = $request->category_id;     

            $subcategory->save();

            return redirect()
                    ->back()
                    ->with('message', 'Sub Sub Categoria criada')
                    ->withInput();
            
        }
        catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Sub Category not created')
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

        $subcategory = $this->Subcategory->find($id);
        
        return view('admin.pages.subcategory.show', [
            'subcategory' => $subcategory
        ]);
    }

    public function upgrade(Request $request, $id)
    {
        $token = $request->cookie('token');
        $subcategory = $this->Subcategory->find($id);

        $categories = DB::table('subcategories')
                            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
                            ->join('sellers', 'sellers.id', '=', 'categories.seller_id')
                            ->select('categories.name as category_name', 'categories.id as category_id', 'subcategories.name', 'subcategories.id')
                            ->where('sellers.api_token', $token)
                            ->orderBy('subcategories.created_at', 'desc')
                            ->paginate(15);


        return view('admin.pages.subcategory.upgrade', [
            'categories' => $categories,
            'subcategory' => $subcategory
        ]);
    }

    public function update(SubCategoryRequest $request, $id)
    {

        $subcategory = $this->Subcategory->find($id);

        if(!$subcategory) {
            return redirect()
                    ->back()
                    ->with('message', 'Sub Categoria não encontrada')
                    ->withInput();
        }

        try {

            $subcategory->name = $request->name; 

            $subcategory->save();

            return redirect()
                    ->back()
                    ->with('message', 'Sub Categoria atualizada')
                    ->withInput();

           
        }
        catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Sub Category not created')
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

            $subcategory = $this->Subcategory->find($id);

            $subcategory->delete();
            
            return redirect()
                    ->back()
                    ->with('message', 'Sub Categoria removida')
                    ->withInput();
                    
        }
        catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Sub Category not removed')
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
