<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellerRequest;
use App\Http\Repository\SellerRepository;
use App\Exceptions\Handler;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Symfony\Component\Debug\Exception\FatalErrorException;

class SellerController extends Controller
{
    
    private $repository;

    public function __construct(SellerRepository $seller)
    {
        $this->repository = $seller;
    }

    
    public function index() {
        $sellers = $this->repository->index();

        return view('admin.pages.seller.index', [
            'sellers' => $sellers
        ]);
    } 

    public function create()
    {
        return view('admin.pages.seller.create');
    }

    public function store(SellerRequest $request)
    {
        
        $seller = $this->repository;

        try {

            $data = [
                'image' => $request->image,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'zip_code' => $request->zip_code,
                'cnpj' => $request->cnpj,
                'bank' => $request->bank,
                'agency' => $request->agency,
                'account' => $request->account,
                'roles' => $request->roles,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation
            ];

            $seller->store($data);

            return redirect()
                        ->back()
                        ->with('message', 'Lojista criado')
                        ->withInput();
            

        }
        catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Seller not created')
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
        $seller = $this->repository->show($id);

        return view('admin.pages.seller.show', [
            'seller' => $seller
        ]);
    }

    public function upgrade($id)
    {
        $sellerExist = $this->repository->upgrade($id);

        if(!$sellerExist) {
            return redirect()
                    ->back()
                    ->with('message', 'Usuário não encontrado')
                    ->withInput();
        }

        return view('admin.pages.seller.upgrade', [
            'seller' => $sellerExist
        ]);
    }

    public function update(Request $request, $id)
    {

        $seller = $this->repository;
        
        $request->validate([
            'image' => 'nullable|mimes:jpeg,jpg,png',
            'company_name' => 'required|max:255',
            'zip_code' => 'required|max:255',
            'cnpj' => 'required|max:255',
            'bank' => 'required|max:255',
            'agency' => 'required|max:255',
            'account' => 'required|max:255'
        ]);

        try {

            $data = [
                'image' => $request->image,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'zip_code' => $request->zip_code,
                'cnpj' => $request->cnpj,
                'bank' => $request->bank,
                'agency' => $request->agency,
                'account' => $request->account,
                'roles' => $request->roles
            ];

            $seller->update($data, $id);

            return redirect()
                        ->back()
                        ->with('message', 'Usuário atualizado')
                        ->withInput();
        

        }
        catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Seller not updated')
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

            $this->repository->destroy($id);          

            return redirect()
                        ->back()
                        ->with('message', 'Usuário removido')
                        ->withInput();
            
            
        }
        catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Seller not removed')
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