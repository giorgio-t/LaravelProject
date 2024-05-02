@extends('layouts.admin');
@section('title',$viewData['title']);
@section('content')
<div class="card mb-4">
  <div class="card-header">
    Modifica prodotto
  </div>
  <div class="card-body">
    @if($errors->any())
    <ul class="alert alert-danger list-unstyled">
      @foreach($errors->all() as $error)
      <li>* {{ $error }}</li>
      @endforeach
    </ul>
    @endif

    <form method="POST" action="{{ route('admin.products.update', $viewData['product']->getId() )}}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="col">
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Name:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="name" value="{{$viewData['product']->getName()}}" type="text" class="form-control">
            </div>
          </div>
        </div>
        
        <div class="col">
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Price:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="price" value="{{$viewData['product']->getPrice()}}" type="number" class="form-control">
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Image:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input class="form-control" type="file" name="image">
            </div>
          </div>
        </div>
        <div class="col">
          &nbsp;
        </div>
      </div>
      
      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description" rows="3">{{$viewData['product']->getDescription()}}</textarea>
      </div>
      
      <!-- siabilita il prodotto per non farlo più comparire nella lista dei prodotti disponibili-->
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="0" name="disabilita" 
          @if($viewData['product']->getAvailability() == false)
           checked 
          @endif>
        <label class="form-check-label" for="flexCheckDisabled">
            prodotto disabilitato
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="newsletter">
        <label>Send email to the subscribers</label>
      <div class = "row mt-3">
      
      <button type="submit" class="btn btn-primary mt-3">Modifica</button>
    </form>
  </div>
</div>

@endsection




