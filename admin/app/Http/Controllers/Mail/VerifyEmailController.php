<?php

namespace App\Http\Controllers\Mail;

use App\Models\Seller;
use App\Mail\SendMail;
use App\Exceptions\Handler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use Symfony\Component\Debug\Exception\FatalErrorException;
use App\Http\Controllers\Controller as Controller;

class VerifyEmailController extends Controller
{

    private $Seller;

    public function __construct(Seller $seller)
    {
        $this->Seller = $seller;
    }

    public function verifyEmail(Request $request) 
    {

        try 
        {
            $token = $request->query('token');
            $seller = $this->Seller->where('api_token', $token)->first();
    
            if(\is_null($seller)) {
                return redirect()
                        ->back()
                        ->with('message', 'Lojista não encontrado')
                        ->withInput();
            }
    
            $seller->email_verified_at = date("Y-m-d H:i:s");
            $seller->save();

            return view('mail.verify-email', ['nome' => $seller->company_name]);
            
        } catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Server error')
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

    public function resendMail(Request $request) 
    {
        try 
        {
            $token = $request->cookie('token');
            $seller = $this->Seller->where('api_token', $token)->first();
    
            if(\is_null($seller)) {
                return redirect()
                            ->back()
                            ->with('message', 'Lojista não encontrado')
                            ->withInput();
            }
    
            $data = ['nome' => $seller->company_name,'email' => $seller->email, 'token' => $seller->api_token, 'view' => 'mail.welcome'];
            SendMail::sendEmail($data);

            return redirect()
                        ->back()
                        ->with('message', 'Foi enviado um email para alteração da sua senha')
                        ->withInput();
            
        } catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Server error')
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
