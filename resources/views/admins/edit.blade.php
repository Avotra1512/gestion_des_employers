@extends('layouts.template')

@section('content')

<h1 class="app-page-title">Employers</h1>
			    <hr class="mb-4">
            <div class="row g-4 settings-section">
	                <div class="col-12 col-md-4">
		                <h3 class="section-title">Editer</h3>
		                <div class="section-intro">Modifier un employer</div>
	                </div>
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						    <div class="app-card-body">
							    <form class="settings-form" method="POST" action="{{ route('employer.update', $employer->id) }}">
                                @csrf
                                @method('PUT')

                                    <div class="mb-3">
									    <label for="setting-input-3" class="form-label">Sérvices</label>
									    <select name="departement_id" id="departement_id" class="form-control">
                                            <option value=""></option>
                                               @foreach ($departements as $departement)
											   <option value="{{$departement->id}}" {{ $employer->departement_id === $departement->id ? 'selected' : '' }}>{{$departement->name}}</option>
												
											   @endforeach

                                        </select>
                                    @error('departement_id')
									<div class="text-danger">{{ $message }}</div>
									@enderror


								    </div>

								    <div class="mb-3">
									    <label for="setting-input-1" class="form-label">Nom</label>
  
									    <input type="text" class="form-control" id="setting-input-1" name="nom" value="{{ $employer->nom }}" required>
									@error('nom')
									<div class="text-danger">{{ $message }}</div>
									@enderror
									</div>
									<div class="mb-3">
									    <label for="setting-input-2" class="form-label">Prenom</label>
									    <input type="text" class="form-control" id="setting-input-2" name="prenom" value="{{ $employer->prenom }}" required>
									</div>
                                    <div class="mb-3">
									    <label for="setting-input-2" class="form-label">Date de naissance</label>
									    <input type="date" class="form-control" id="setting-input-2" name="date_naissance" value="{{ $employer->date_naissance }}" required>
									</div>
                                    <div class="mb-3">
									    <label for="setting-input-2" class="form-label">Genre</label>
									    <select class="form-control" id="setting-input-2" name="sexe" value="{{ $employer->sexe }}">
									    <option>Féminin</option>
										<option>Masculin</option>
									    </select>
									</div>
								    <div class="mb-3">
									    <label for="setting-input-3" class="form-label">Addresse Email</label>
									    <input type="email" class="form-control" id="setting-input-3" name="email" value="{{ $employer->email }}" required>
									
									@error('email')
									<div class="text-danger">{{ $message }}</div>
									@enderror

									</div>
                                    <div class="mb-3">
									    <label for="setting-input-2" class="form-label">Contact</label>
									    <input type="text" class="form-control" id="setting-input-2" name="contact" value="{{ $employer->contact }}" required>
									@error('contact')
									<div class="text-danger">{{ $message }}</div>
									@enderror
									</div>
                                    <div class="mb-3">
									    <label for="setting-input-2" class="form-label">Photos</label>
									    <!--<input type="file" name="photos" accept="image/*" class="form-control" id="setting-input-2" value="{{ old('photos') }}" required>-->
										<input type="text" name="photos" accept="image/*" class="form-control" id="setting-input-2" value="{{ $employer->photos }}" required>
									</div>
									<div class="mb-3">
									    <label for="setting-input-2" class="form-label">Montant à journalier</label>
									    <input type="number" class="form-control" id="setting-input-2" name="montant_journalier" value="{{ $employer->montant_journalier }}" required>
									@error('montant_journalier')
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