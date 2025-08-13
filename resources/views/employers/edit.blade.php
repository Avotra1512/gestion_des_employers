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
									    <label for="setting-input-2" class="form-label">Matricule</label>
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
									    <select class="form-control" id="setting-input-2" name="sexe">
    <option value="">-- Sélectionnez une fonction --</option>
    <option value="Assistante de direction" {{ $employer->sexe == 'Assistante de direction' ? 'selected' : '' }}>Assistante de direction</option>
    <option value="Chauffeur personnel administrative" {{ $employer->sexe == 'Chauffeur personnel administrative' ? 'selected' : '' }}>Chauffeur personnel administrative</option>
    <option value="Chef de Division étude et planification" {{ $employer->sexe == 'Chef de Division étude et planification' ? 'selected' : '' }}>Chef de Division étude et planification</option>
    <option value="Chef de Division intrants scolaire" {{ $employer->sexe == 'Chef de Division intrants scolaire' ? 'selected' : '' }}>Chef de Division intrants scolaire</option>
    <option value="Chef de Division de contrat et affectation" {{ $employer->sexe == 'Chef de Division de contrat et affectation' ? 'selected' : '' }}>Chef de Division de contrat et affectation</option>
    <option value="Chef de Division de controle et audit interne administrative et financière" {{ $employer->sexe == 'Chef de Division de controle et audit interne administrative et financière' ? 'selected' : '' }}>Chef de Division de controle et audit interne administrative et financière</option>
    <option value="Chef de Division de l'éducation fondamentale et de la petite enfance" {{ $employer->sexe == "Chef de Division de l'éducation fondamentale et de la petite enfance" ? 'selected' : '' }}>Chef de Division de l'éducation fondamentale et de la petite enfance</option>
    <option value="Chef de Division de l'éducation non formelle" {{ $employer->sexe == "Chef de Division de l'éducation non formelle" ? 'selected' : '' }}>Chef de Division de l'éducation non formelle</option>
    <option value="Chef de Division de l'Ingenerie de formation" {{ $employer->sexe == "Chef de Division de l'Ingenerie de formation" ? 'selected' : '' }}>Chef de Division de l'Ingenerie de formation</option>
    <option value="Chef de Division de la gestion des enseignants non fonctionnaires" {{ $employer->sexe == 'Chef de Division de la gestion des enseignants non fonctionnaires' ? 'selected' : '' }}>Chef de Division de la gestion des enseignants non fonctionnaires</option>
    <option value="Chef de Division de la gestion des risques et catastrophes" {{ $employer->sexe == 'Chef de Division de la gestion des risques et catastrophes' ? 'selected' : '' }}>Chef de Division de la gestion des risques et catastrophes</option>
    <option value="Chef de Division de la Logistique et des comptes matières" {{ $employer->sexe == 'Chef de Division de la Logistique et des comptes matières' ? 'selected' : '' }}>Chef de Division de la Logistique et des comptes matières</option>
    <option value="Chef de Division de la statistique" {{ $employer->sexe == 'Chef de Division de la statistique' ? 'selected' : '' }}>Chef de Division de la statistique</option>
    <option value="Chef de Division des affaires juridiques" {{ $employer->sexe == 'Chef de Division des affaires juridiques' ? 'selected' : '' }}>Chef de Division des affaires juridiques</option>
    <option value="Chef de Division des avancements et promotions" {{ $employer->sexe == 'Chef de Division des avancements et promotions' ? 'selected' : '' }}>Chef de Division des avancements et promotions</option>
    <option value="Chef de Division des finances et des comptabilités" {{ $employer->sexe == 'Chef de Division des finances et des comptabilités' ? 'selected' : '' }}>Chef de Division des finances et des comptabilités</option>
    <option value="Chef de Division du Contrôle Qualité" {{ $employer->sexe == 'Chef de Division du Contrôle Qualité' ? 'selected' : '' }}>Chef de Division du Contrôle Qualité</option>
    <option value="Chef de Division suivi et évaluation" {{ $employer->sexe == 'Chef de Division suivi et évaluation' ? 'selected' : '' }}>Chef de Division suivi et évaluation</option>
    <option value="Chef Service de la Formation Administrative et Pédagogique" {{ $employer->sexe == 'Chef Service de la Formation Administrative et Pédagogique' ? 'selected' : '' }}>Chef Service de la Formation Administrative et Pédagogique</option>
    <option value="PRMP" {{ $employer->sexe == 'PRMP' ? 'selected' : '' }}>PRMP</option>
    <option value="Personnel d'appui" {{ $employer->sexe == "Personnel d'appui" ? 'selected' : '' }}>Personnel d'appui</option>
    <option value="Responsable affectation" {{ $employer->sexe == 'Responsable affectation' ? 'selected' : '' }}>Responsable affectation</option>
    <option value="Responsable alimentation scolaire" {{ $employer->sexe == 'Responsable alimentation scolaire' ? 'selected' : '' }}>Responsable alimentation scolaire</option>
    <option value="Responsable chargée de suivi et Evaluation" {{ $employer->sexe == 'Responsable chargée de suivi et Evaluation' ? 'selected' : '' }}>Responsable chargée de suivi et Evaluation</option>
    <option value="Responsable chargé de Contrôle Qualité" {{ $employer->sexe == 'Responsable chargé de Contrôle Qualité' ? 'selected' : '' }}>Responsable chargé de Contrôle Qualité</option>
    <option value="Résponsable congé et reclassement par diplôme" {{ $employer->sexe == 'Résponsable congé et reclassement par diplôme' ? 'selected' : '' }}>Résponsable congé et reclassement par diplôme</option>
    <option value="Responsable courrier" {{ $employer->sexe == 'Responsable courrier' ? 'selected' : '' }}>Responsable courrier</option>
    <option value="Responsable de l'alphabétisation" {{ $employer->sexe == "Responsable de l'alphabétisation" ? 'selected' : '' }}>Responsable de l'alphabétisation</option>
    <option value="Responsable de l'enseignement secondaire" {{ $employer->sexe == "Responsable de l'enseignement secondaire" ? 'selected' : '' }}>Responsable de l'enseignement secondaire</option>
    <option value="Responsable des avancements et titularisations" {{ $employer->sexe == 'Responsable des avancements et titularisations' ? 'selected' : '' }}>Responsable des avancements et titularisations</option>
    <option value="Responsable des écoles privées" {{ $employer->sexe == 'Responsable des écoles privées' ? 'selected' : '' }}>Responsable des écoles privées</option>
    <option value="Responsable des personnels non encadrés" {{ $employer->sexe == 'Responsable des personnels non encadrés' ? 'selected' : '' }}>Responsable des personnels non encadrés</option>
    <option value="Responsable en évènement et environnement" {{ $employer->sexe == 'Responsable en évènement et environnement' ? 'selected' : '' }}>Responsable en évènement et environnement</option>
    <option value="Responsable régional sport scolaire" {{ $employer->sexe == 'Responsable régional sport scolaire' ? 'selected' : '' }}>Responsable régional sport scolaire</option>
    <option value="Responsable retraité" {{ $employer->sexe == 'Responsable retraité' ? 'selected' : '' }}>Responsable retraité</option>
    <option value="Responsable santé scolaire régionale" {{ $employer->sexe == 'Responsable santé scolaire régionale' ? 'selected' : '' }}>Responsable santé scolaire régionale</option>
    <option value="Responsable statistique" {{ $employer->sexe == 'Responsable statistique' ? 'selected' : '' }}>Responsable statistique</option>
    <option value="Responsable titularisation" {{ $employer->sexe == 'Responsable titularisation' ? 'selected' : '' }}>Responsable titularisation</option>
    <option value="RFC DREN" {{ $employer->sexe == 'RFC DREN' ? 'selected' : '' }}>RFC DREN</option>
    <option value="Sécretaire particulière" {{ $employer->sexe == 'Sécretaire particulière' ? 'selected' : '' }}>Sécretaire particulière</option>
    <option value="Stagiaire" {{ $employer->sexe == 'Stagiaire' ? 'selected' : '' }}>Stagiaire</option>
    <option value="Superviseur examen BEPC 2024" {{ $employer->sexe == 'Superviseur examen BEPC 2024' ? 'selected' : '' }}>Superviseur examen BEPC 2024</option>
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