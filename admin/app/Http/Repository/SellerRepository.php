<?php

namespace App\Http\Repository;

use App\Models\Seller;
use App\Http\Controllers\ImageController;
use App\Exceptions\Handler;
use App\Mail\SendMail;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Symfony\Component\Debug\Exception\FatalErrorException;

class SellerRepository
{
    
    private $Seller;
    private $imageStore;

    public function __construct(Seller $seller, ImageController $imageStore)
    {
        $this->Seller = $seller;
        $this->imageStore = $imageStore;
    }

    public function index() {
        $sellers = $this->Seller
                            ->latest()
                            ->paginate(15);;

        return $sellers;
    }


    public function store($data)
    {
        
        $seller = $this->Seller;

        try {

            $seller->email = $data['email'];
            $seller->company_name = $data['company_name'];
            $seller->zip_code = $data['zip_code'];
            $seller->cnpj = $data['cnpj'];
            $seller->bank = $data['bank'];
            $seller->agency = $data['agency'];
            $seller->account = $data['account'];
            $seller->roles = $data['roles'];

            if($data['password'] !== $data['password_confirmation']) {
                return redirect()
                            ->back()
                            ->with('message', 'Senhas não conferem')
                            ->withInput();
            }

            $seller->password = Hash::make($data['password']);
            $seller->api_token = Str::random(60);

            $folder = '/seller';
            $imageName = $this->imageStore->store($data, $folder);

            $seller->image = $imageName;


            if($seller->save()) {
                $data = ['nome' => $seller->company_name,'email' => $seller->email, 'token' => $seller->api_token, 'view' => 'mail.welcome'];
                SendMail::sendEmail($data);
            }
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
        $seller = $this->Seller->find($id);

        return $seller;
    }

    public function upgrade($id)
    {
        $sellerExist = $this->Seller->find($id);

        return $sellerExist;
    }

    public function update($data, $id)
    {

        $sellerExist = $this->Seller->find($id);

        if(!$sellerExist) {
            return redirect()
                    ->back()
                    ->with('message', 'Usuário não encontrado')
                    ->withInput();
        }
        
        $data['image'] = $data['image'] ? $data['image'] : $sellerExist->image;

        try {

            $sellerExist->email = $data['email'];
            $sellerExist->company_name = $data['company_name'];
            $sellerExist->zip_code = $data['zip_code'];
            $sellerExist->cnpj = $data['cnpj'];
            $sellerExist->bank = $data['bank'];
            $sellerExist->agency = $data['agency'];
            $sellerExist->account = $data['account'];
            $sellerExist->roles = $data['roles'];

            $folder = '/seller';
            $imageName = $this->imageStore->store($data, $folder);

            $sellerExist->image = $imageName;

            $sellerExist->save();
            
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

    public function destroy($id) {
        try {

            $seller = $this->Seller->find($id);
        
            $seller->delete();
    
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