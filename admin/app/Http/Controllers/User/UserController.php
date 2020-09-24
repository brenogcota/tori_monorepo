<?php

namespace App\Http\Controllers\User;

use App\Models\User\User;
use App\Http\Controllers\User\AddressController;
use App\Exceptions\Handler;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use Symfony\Component\Debug\Exception\FatalErrorException;
use App\Http\Controllers\Controller as Controller;


class UserController extends Controller
{

    private $User;
    private $Address;

    public function __construct(User $user, AddressController $address)
    {
        $this->User = $user;
        $this->Address = $address;
    }

    public function index() {
        $users = $this->User->paginate(15);
         
           
        if(!$users ) {
            return redirect()
            ->back()
            ->with('message', 'Usuário ou endereço não encontrado')
            ->withInput();
        }
        return view('admin.pages.user.index', ['users' => $users ]); 
    }

    public function show($id) 
    {
        try 
        {
        
            $user = DB::table('users')
                        ->join('addresses', 'users.id', '=', 'addresses.user_id')
                        ->where('users.id', '=', $id)
                        ->select('users.name', 'users.email', 'users.phone', 'addresses.*')
                        ->get();

            if(!$user) {
                return redirect()
                ->back()
                ->with('message', 'Usuário ou endereço não encontrado')
                ->withInput();
            }

            return $user;
            return view('admin.pages.user.show', ['user' => $user ]); 

        } catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Usuário não encontrado')
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

    public function upgrade($id) {
        $user = $this->User->find($id);

        return view('admin.pages.user.upgrade', ['user' => $user ]); 

    }

    public function update(Request $request, $id)
    {
        try 
        {

            $user = $this->User->find($id);

            if(!$user) {
                return redirect()
                ->back()
                ->with('message', 'Usuário ou endereço não encontrado')
                ->withInput();
            }
            

    
            $this->User->where('id', $id)
                        ->update(array(
                            'name' => $request->name,
                            'phone' => $request->phone,
                        ));
            
            return view('admin.pages.user.show', ['user' => $user ]); 
                        
        } catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Usuário não encontrado')
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

    public function destroy($id) 
    {
        try {

            $user = $this->User->find($id);

            if(!$user) {
                return redirect()
                ->back()
                ->with('message', 'Usuário ou endereço não encontrado')
                ->withInput();
            }

    
            if($user->delete()){
                return redirect()
                ->back()
                ->with('message', 'Usuário removido')
                ->withInput();
            }

        } catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Usuário não removido')
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