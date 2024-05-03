<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\BaseMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Auth;

class NewsletterController extends Controller {
    public function subscribe() {
        // Usando il query builder di laravel evitiamo di creare un modello per
        // una tabella con un solo campo
        DB::table('newsletter')
            ->insert(['id' => Auth::user()->getId()]);

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
        $body = $request->mailBody;

        $subscribers = User::findMany(DB::table('newsletter')
            ->get()
            ->map(function($entry) {
                return $entry->id;
            })
        );
        
        foreach($subscribers as $subscriber) {
            \Mail::to($subscriber->email)
                ->send(new BaseMail($subject, $body));
        }

        return back();
    }
    
    public function productMail(Product $product) {
        $subscribers = User::findMany(DB::table('newsletter')
            ->get()
            ->map(function($entry) {
                return $entry->id;
            })
        );
        
        foreach($subscribers as $subscriber) {
            \Mail::to($subscriber->email)
                ->send(new ProductMail($product));
        }

        return back();
    }

    public function test() {
        \Mail::to('federico.dutto@itiscuneo.eu')
            ->send(new TestMail('test', 'test test'));

        return redirect()->route('home.index');
    }
}