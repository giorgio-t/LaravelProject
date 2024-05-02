<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    
    public function index() {
    
        $viewData = [];
        $viewData['title'] = "Lista prodotti disponibili";
        $viewData['products'] = Product::all();

        return view('admin.products.indexProduct')->with("viewData",$viewData);
    
    }
    public function store(Request $request){

        $request -> validate([
            "name" => "required|max:255",
            "description" => "required",
            "price" => "required|numeric|gt:0",
            "image" => "image",
        ]);
    

        $product = new Product();
        
        $product["name"] = $request->input('name');
        $product["description"] = $request->input('description');
        $product["price"] = $request->input('price');
        $product["image"] = "noImage.jpg";

        $product->save();

        if($request->hasFile('image'))
        {
        
            $imageName = $product->getName().".".$request->file('image')->extension();
            
            //salva immagine nella cartella public
            //passiamo nome file aggiornato e path dove prendere risorsa orginaria
            Storage::disk('public')->put(
                $imageName, 
                file_get_contents($request->file('image')->getRealPath()));
            
            $product->setImage($imageName);
            $product->save();
            
        }

        if($request->has('newsletter'))    
            return redirect()->route("newsletter.mail.product")->with("product", $product);
        else
            return back();
    }

    public function delete($id){
        Product::destroy($id);
        return back();
    }

    //funzione per leggere il prodotto che si vuole modificare
    public function edit($id){
        $product = Product::findOrFail($id);
        $viewData = [];
        $viewData['title'] = 'Modifica prodotto';
        $viewData['product'] = $product;

        return view('admin.products.editProduct')->with("viewData" , $viewData);

    }

    public function update(Request $request, $id){

        $request -> validate([
            "name" => "required|max:255",
            "description" => "required",
            "price" => "required|numeric|gt:0",
            "image" => "image",
        ]);
    

        $product = Product::findOrFail($id);
        
        $product->setName($request->input('name'));
        $product->setDescription($request->input('description'));
        $product->setPrice($request->input('price'));
        $product->setAvailability($request->input('disabilita',1)); //se è checkato prende valore di disabilita, altrimenti 1
        $product->save();

        if($request->hasFile('image'))
        {
        
            $imageName = $product->getName().".".$request->file('image')->extension();
            
            //salva immagine nella cartella public
            //passiamo nome file aggiornato e path dove prendere risorsa orginaria
            Storage::disk('public')->put(
                $imageName, 
                file_get_contents($request->file('image')->getRealPath()));
            
            $product->setImage($imageName);
        }

        $product->save();

        if($request->has('newsletter')) NewsletterController::productMail($product);

        return redirect()->route('admin.products.indexProduct');
    }
}