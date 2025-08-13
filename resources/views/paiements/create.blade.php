@extends('layouts.template')

@section('content')

<h1 class="app-page-title">Salaires</h1>
			    <hr class="mb-4">
            <div class="row g-4 settings-section">
	                <div class="col-12 col-md-4">
		                <h3 class="section-title">Ajout</h3>
		                <div class="section-intro">Ajouter ici une nouvelle paiement</div>
	                </div>
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						    <div class="app-card-body">
							<form class="settings-form" method="POST" action="{{ route('paiements.store') }}" enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                    <div class="mb-3">
									    <label for="setting-input-3" class="form-label">Nom de l'employé</label>
									    <select name="employer_id" id="employer_id" class="form-control">
    <option value=""></option>
    @foreach ($employers as $employer)
        <option value="{{ $employer->id }}" {{ old('employer_id') == $employer->id ? 'selected' : '' }}>
            {{ $employer->nom }} {{ $employer->prenom }} 
        </option>
    @endforeach
</select>
                                    @error('employer_id')
									<div class="text-danger">{{ $message }}</div>
									@enderror


								    </div>

									<div class="mb-3">
									    <label for="setting-input-2" class="form-label">Montant</label>
									    <input type="number" class="form-control" id="setting-input-2" name="montant" value="{{ old('mmontant') }}" required>
									@error('montant')
									<div class="text-danger">{{ $message }}</div>
									@enderror
									</div>

                                    <div class="mb-3">
									    <label for="setting-input-2" class="form-label">Date de paiement</label>
									 
                                    @php
                                $today = date('Y-m-d');
                                    @endphp

                                    <input type="date" name="date_paiement" class="form-control" id="setting-input-2"
                                    value="{{ $today }}"
                                    min="{{ $today }}"
                                    max="{{ $today }}" required>
               
                                    </div> 
									<button type="submit" class="btn app-btn-primary" >Enregistrer</button>
							    </form>
						    </div><!--//app-card-body-->
						    
						</div><!--//app-card-->
	                </div>
            </div><!--//row-->
                


@endsection