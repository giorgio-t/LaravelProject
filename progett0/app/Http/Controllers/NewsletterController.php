<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ProductMail;
use App\Mail\BaseMail;
use App\Mail\EditMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Auth;

class NewsletterController extends Controller {
    public static function subscribe($userId) {
        // Usando il query builder di laravel evitiamo di creare un modello per
        // una tabella con un solo campo
        DB::table('newsletter')
            ->insert(['id' => $userId]);

        return redirect()->route('home.index');
    }
    
    public function unsubscribe() {
        DB:table('newsletter')
            ->where('id', Auth::user()->getId())
            ->delete();

        return redirect()->route('home.index');
    }

    public function sendMail(Request $request) {
        $subject = $request->subject;
        $body = $request->body;

        $subscribers = NewsletterController::subscribers();
        
        foreach($subscribers as $subscriber) {
            \Mail::to($subscriber->email)
                ->send(new BaseMail($subject, $body));
        }

        return back();
    }
    
    public static function productMail(Product $product) {
        $subscribers = NewsletterController::subscribers();
        
        foreach($subscribers as $subscriber) {
            \Mail::to($subscriber->email)
                ->send(new ProductMail($product));
        }

        return back();
    }

    public static function editMail(Product $product) {
        $subscribers = NewsletterController::subscribers();
        
        foreach($subscribers as $subscriber) {
            \Mail::to($subscriber->email)
                ->send(new EditMail($product));
        }

        return back();
    }

    private static function subscribers() {

        return User::findMany(DB::table('newsletter')
            ->get()
            ->map(function($entry) {
                return $entry->id;
            })
        );
    }

    public function test() {
        \Mail::to('federico.dutto@itiscuneo.eu')
            ->send(new TestMail('test', 'test test'));

        return redirect()->route('home.index');
    }
}