@extends('layouts.template')

@section('content')

<h1 class="app-page-title">Administrateurs</h1>
			    <hr class="mb-4">
            <div class="row g-4 settings-section">
	                <div class="col-12 col-md-4">
		                <h3 class="section-title">Ajout</h3>
		                <div class="section-intro">Ajouter ici un nouveau admin</div>
	                </div>
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						    <div class="app-card-body">
							    <form class="settings-form" method="POST" action="{{ route('administrateurs.store') }}">
                                @csrf
                                @method('POST')


								    <div class="mb-3">
									    <label for="setting-input-1" class="form-label">Nom Complet</label>
  
									    <input type="text" class="form-control" id="setting-input-1" name="name" value="{{ old('name') }}" required>
									@error('nom')
									<div class="text-danger">{{ $message }}</div>
									@enderror
									</div>

								    <div class="mb-3">
									    <label for="setting-input-3" class="form-label">Email</label>
									    <input type="email" class="form-control" id="setting-input-3" name="email" value="{{ old('email') }}" required>
									
									@error('email')
									<div class="text-danger">{{ $message }}</div>
									@enderror

									</div>

									<button type="submit" class="btn app-btn-primary" >Enregistrer</button>
							    </form>
						    </div><!--//app-card-body-->
						    
						</div><!--//app-card-->
	                </div>
            </div><!--//row-->
                


@endsection