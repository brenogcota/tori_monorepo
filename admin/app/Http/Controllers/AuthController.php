<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Seller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\CookieController;

use App\Exceptions\Handler;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Symfony\Component\Debug\Exception\FatalErrorException;

class AuthController extends Controller
{

    private $Seller;

    public function __construct(Seller $seller)
    {
        $this->Seller = $seller;
    }
    
    public function index(Request $request)
    {
        
        return view('admin.auth.login');
        
    }

    public function signIn(AuthRequest $request) {
        
        try
        {

            $seller = $this->Seller->where('email', $request->username)
                                   ->orWhere('company_name', $request->username)
                                   ->first();
               
            if(!$seller)
            {
                return redirect()
                        ->back()
                        ->with('message', 'Lojista não encontrado')
                        ->withInput();
            }
    
            if (Hash::check($request->password, $seller->password)) {
                $seller->api_token = Str::random(60);
                $seller->save();

                CookieController::setCookie($seller->api_token);

                return redirect()->route('home');
                
            } else {
                return redirect()
                        ->back()
                        ->with('message', 'Senha incorreta')
                        ->withInput(); 
            }

        } 
        catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Erro ao fazer login')
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


    public function logout() {
        CookieController::removeCookie();

        return redirect()->route('auth.signin');
    }

}