@extends('layouts.template')

@section('content')

<h1 class="app-page-title">Sérvices</h1>
			    <hr class="mb-4">
            <div class="row g-4 settings-section">
	                <div class="col-12 col-md-4">
		                <h3 class="section-title">Editer</h3>
		                <div class="section-intro"> Modifier le sérvice</div>
	                </div>
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						    <div class="app-card-body">
							    <form class="settings-form" method="POST" action="{{ route('departement.update', $departement->id) }}">
                                @csrf
                                @method('PUT')
								<div class="mb-3">
									    <label for="setting-input-1" class="form-label">Nom du service</label>
                                        
  
									    <textarea type="text" class="form-control" id="setting-input-1" name="apropos" value="{{ $departement->apropos }}" required></textarea>
									@error('apropos')
									<div class="text-danger">{{ $message }}</div>
										
									@enderror
								</div>
								    <div class="mb-3">
									    <label for="setting-input-1" class="form-label">Abreviation</label>
  
									    <input type="text" class="form-control" id="setting-input-1" name="name" value="{{ $departement->name }}" required>
									@error('name')
									<div class="text-danger">{{ $message }}</div>
										
									@enderror
									</div>
									<button type="submit" class="btn app-btn-primary" >Mettre à jour</button>
							    </form>
						    </div><!--//app-card-body-->
						    
						</div><!--//app-card-->
	                </div>
            </div><!--//row-->
                


@endsection