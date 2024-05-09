@extends('layouts.mail')
@section('content')

<h1 style="font-size: 20px; line-height: 24px; font-family: 'Helvetica', Arial, sans-serif; font-weight: 600; text-decoration: none; color: #000000;">We inform you we have just updated {{ $product->getName() }} in the store!</h1>

<p style="font-size: 15px; line-height: 24px; font-family: 'Helvetica', Arial, sans-serif; font-weight: 400; text-decoration: none; color: #919293;">Product description: {{ $product->getDescription() }}</p>              
<p style="font-size: 15px; line-height: 24px; font-family: 'Helvetica', Arial, sans-serif; font-weight: 400; text-decoration: none; color: #919293;">Price: {{ $product->getPrice() }}</p>                        

<p><img src="{{ $message->embed('./storage/' . $product->getImage()) }}" style="max-width: 100%;"></p>

@endsection