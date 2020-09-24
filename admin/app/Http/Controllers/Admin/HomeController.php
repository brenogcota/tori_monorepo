<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Seller;
use App\Models\User\User;
use App\Http\Controllers\ImageController;
use App\Exceptions\Handler;
use App\Http\Controllers\Controller as Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Symfony\Component\Debug\Exception\FatalErrorException;

class HomeController extends Controller
{
    private $Seller;
    private $User;
    private $Product;

    public function __construct(Seller $seller, User $user, Product $product)
    {
        $this->Seller = $seller;
        $this->User = $user;
        $this->Product = $product;
    }

    public function index() {
        $users = $this->User->count();
        $sellers = $this->Seller->count();
        $products = $this->Product->count();

        return view('welcome', [
            'users' => $users,
            'sellers' => $sellers,
            'products' => $products
        ]);
    }
}
