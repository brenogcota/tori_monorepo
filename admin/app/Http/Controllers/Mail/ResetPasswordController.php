<?php

namespace App\Http\Controllers\Mail;

use App\Models\Seller;
use App\Mail\SendMail;
use App\Exceptions\Handler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Symfony\Component\Debug\Exception\FatalErrorException;
use App\Http\Controllers\Controller as Controller;

class ResetPasswordController extends Controller
{   
    private $Seller;

    public function __construct(Seller $seller)
    {
        $this->Seller = $seller;
    }

    public function sendForgotPasswordMail(Request $request) 
    {
        try 
        {

            $seller = $this->Seller->where('email', $request->email)->first();

            if(!$seller) {
                return redirect()
                        ->back()
                        ->with('message', 'Lojista não encontrado')
                        ->withInput();
            }


            $data = ['nome' => $seller->company_name, 'email' => $request->email, 'view' => 'mail.forgot-password'];

            SendMail::sendEmail($data);
            return redirect()
                        ->back()
                        ->with('message', 'Foi enviado um email para alteração da sua senha')
                        ->withInput();


        } catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Server Error')
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
        $email = $request->query('email');
        return view('mail.reset-password', ['email' => $email]);
    }

    public function resetPassword(Request $request) 
    {
        $seller = $this->Seller->where('email', $request->email)->first();

        
        $seller->password = Hash::make($request->password);

        $seller->save();
        
        return view('mail.verify-email', ['nome' => $seller->company_name]);

    }

}