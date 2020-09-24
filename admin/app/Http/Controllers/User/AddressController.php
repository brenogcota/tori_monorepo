<?php

namespace App\Http\Controllers\User;

use App\Models\User\Address;
use App\Exceptions\Handler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use Symfony\Component\Debug\Exception\FatalErrorException;
use App\Http\Controllers\Controller as Controller;

class AddressController extends Controller
{

    private $Address;

    public function __construct(Address $address)
    {
        $this->Address = $address;
    }


    public function create(Request $request)
    {
        $address = $this->Address;

        $address->street = $request->input('street');
        $address->number = $request->input('number');
        $address->complement = $request->input('complement');
        $address->district = $request->input('district');
        $address->state = $request->input('state');
        $address->city = $request->input('city');
        $address->zip_code = $request->input('zip_code');
        $address->user_id = $request->input('user_id');

        if($address->save()) {
            return redirect()
            ->back()
            ->with('message', 'Endereço criado')
            ->withInput();
        }
    }

    public function show($id) 
    {
        try 
        {
        
            $address = $this->Address->where('user_id', $id)->get();

            return view('address.show', ['address' => $address ]); 

        } catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Endereço não criado')
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
        $address = $this->Address->where('id', $id)->get();

        return view('address.upgrade', ['address' => $address ]); 
    }

    public function update(Request $request, $id)
    {
        try 
        {

            $address = $this->Address->where('id', $id)->get();

            if(!$address) {
                return redirect()
                    ->back()
                    ->with('message', 'Usuário não encontrada')
                    ->withInput();
            }

            $address->street = $request->input('street');
            $address->number = $request->input('number');
            $address->complement = $request->input('complement');
            $address->district = $request->input('district');
            $address->state = $request->input('state');
            $address->city = $request->input('city');
            $address->zip_code = $request->input('zip_code');
            $address->user_id = $request->input('user_id');

            if($address->save()){
                return redirect()
                        ->back()
                        ->with('message', 'Endereço atualizado')
                        ->withInput();

            }

                        
        } catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Endereço não atualizado')
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

            $address = $this->Address->where('id', $id)->get();

            if(!$address) {
                return redirect()
                    ->back()
                    ->with('message', 'Usuário não encontrada')
                    ->withInput();
            }

            if($address->delete()){
                return redirect()
                        ->back()
                        ->with('message', 'Endereço removido')
                        ->withInput();

            }


        } catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Endereço não removido')
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