@extends('layouts.admin')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')

    <div class = "card">

        <div class = "card-header">
            Send an email to the subscribers
        </div>

        <div class = "card-body">
            
            <form method="POST" action="{{ route('newsletter.mail.send') }}" enctype="multipart/form-data">
                
                @csrf
                <div class="row">
                    <div class="col">
                      <div class="mb-3 row">

                        <label class = "col-lg-2 col-md-6 col-sm-12 col-form-label">Subject:</label>
                    
                        <div class = "col-lg-10 col-md-6 col-sm-12">
                            <input type = "text" name = "subject" class = "form-control">
                        </div>

                      </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Body:</label>
                    <textarea class="form-control" name="body" rows="3"></textarea>
                </div>

                <div class = "row mt-3">
                    <div class = "col text-end">
                        <button type = "submit" class = "btn bg-primary text-white mb-2">Send</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection
