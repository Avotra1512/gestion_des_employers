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
							    <form class="settings-form" method="POST" action="{{ route('employer.update', $employer->id) }}" enctype="multipart/form-data">
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
									    <label for="setting-input-2" class="form-label">IM</label>
									    <input type="number" class="form-control" id="setting-input-2" name="montant_journalier" value="{{ $employer->montant_journalier }}" required>
									@error('montant_journalier')
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
									<!--
                                    <div class="mb-3">
									    <label for="setting-input-2" class="form-label">Date de naissance</label>
									    <input type="date" class="form-control" id="setting-input-2" name="date_naissance" max="{{ date('Y-m-d') }}" value="{{ $employer->date_naissance }}" required>
									</div>
									-->
                                    <div class="mb-3">
									    <label for="setting-input-2" class="form-label">Fonction</label>
									    <select class="form-control" id="setting-input-2" name="sexe" >
                                            <option value=""></option>
											<option >Assistante de direction</option>
											<option >Chauffeur personnel administrative</option>
											<option >Chef de Division étude et planification</option>
											<option >Chef de Division intrants scolaire</option>
											<option >Chef de Division de contrat et affectation</option>
											<option >Chef de Division de controle et audit interne administrative et financière</option>
											<option >Chef de Division de l'éducation fondamentale et de la petite enfance</option>
											<option >Chef de Division de l'éducation non formelle</option>
                                            <option >Chef de Division de l'Ingenerie de formation</option>
											<option >Chef de Division de la gestion des enseignants non fonctionnaires</option>
											<option >Chef de Division de la gestion des risques et catastrophes</option>
											<option >Chef de Division de la Logistique et des comptes matières</option>
											<option >Chef de Division de la statistique</option>
											<option >Chef de Division des affaires juridiques</option>
											<option >Chef de Division des avancements et promotions</option>
											<option >Chef de Division des finances et des comptabilités</option>
											<option >Chef de Division du Contrôle Qualité</option>
											<option >Chef de Division suivi et évaluation</option>
											<option >Chef Service de la Formation Administrative et Pédagogique</option>	
											<option >PRMP</option>
											<option >Personnel d'appui</option>
											<option >Responsable affectation</option>
											<option >Responsable alimentation scolaire</option>
											<option >Responsable chargée de suivi et Evaluation</option>
											<option >Responsable chargé de Contrôle Qualité</option>
											<option >Résponsable congé et reclassement par diplôme</option>
											<option >Responsable courrier</option>
											<option >Responsable de l'alphabétisation</option>
											<option >Responsable de l'enseignement secondaire</option>
											<option >Responsable des avancements et titularisations</option>
											<option >Responsable des écoles privées</option>
											<option >Responsable des personnels non encadrés</option>
											<option >Responsable en évènement et environnement</option>								
											<option >Responsable régional sport scolaire</option>
											<option >Responsable retraité</option>
											<option >Responsable santé scolaire régionale</option>
											<option >Responsable statistique</option>
											<option >Responsable titularisation</option>
											<option >RFC DREN</option>
											<option >Sécretaire particulière</option>
											<option >Stagiaire</option>
                                            <option >Superviseur examen BEPC 2024</option>											
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
										
										<input type="file" class="form-control" id="setting-input-9" name="photos" accept="image/*">
        @error('photos')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        @if($employer->photos)
    <img src="{{ asset('storage/' . $employer->photos) }}" alt="Photo de {{ $employer->nom }}" class="img-thumbnail mt-2" width="100">
@endif


									</div>
									
									<button type="submit" class="btn app-btn-primary" >Mettre à jour</button>
							    </form>
						    </div><!--//app-card-body-->
						    
						</div><!--//app-card-->
	                </div>
            </div><!--//row-->
                


@endsection