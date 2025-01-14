@extends('layouts.template')

@section('content')

<div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Liste des Employers</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								<form action="{{ route('employer.search') }}" method="GET" class="table-search-form row gx-1 align-items-center">
    <div class="col-auto">
        <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn app-btn-secondary"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <div class="col-auto">
        <a href="{{ route('employer.search') }}" class="btn btn-secondary"><i class="fa-solid fa-rotate-right"></i></a>
    </div>
</form>

					                
							    </div><!--//col-->
							    
							    <div class="col-auto">						    
								    <a class="btn app-btn-secondary" href="{{ route('employer.create') }}">
									    <i class="fa-solid fa-plus"></i>
									    Ajouter Employer
									</a>
							    </div>
                                <div class="col-auto">
        <a href="{{ route('export.employers') }}" class="btn btn-secondary"><i class="fa fa-download"></i></a>
    </div>
   
    
						    </div><!--//row-->
                            
					    </div><!--//table-utilities-->
                        
				    </div><!--//col-auto-->

                    <div class="col-auto">
    <form action="{{ route('import.employers') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Bouton de soumission du formulaire -->
        <input type="file" name="file" required>
        <button type="submit" class="btn btn-secondary"><i class="fa fa-upload"></i></button>
    </form>
</div>

			    </div><!--//row-->
                @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
                @endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
     
				@if (Session::get('success_message'))
				    <div class="alert alert-success">{{ Session::get('success_message') }}</div>	
				@endif
			   
				
				<div class="search-result">
    @if(isset($searchTerm) && $searchTerm != '')
	    <div class="alert alert-info">
            <h5>Résultats pour la recherche : "{{ $searchTerm }}"</h5>
        </div>
    @endif
    <div class="tab-content" id="orders-table-tab-content">
        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
            <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="app-card-body">
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left">
                            <thead>
                                <tr>
                                   
                                    <th class="cell">#</th>
                                    <th class="cell">IM</th>
                                    <th class="cell">Nom</th>
                                    <th class="cell">Prenom</th>
                                    <!--<th class="cell">Date de naissance</th>-->
                                    
                                    <th class="cell">Email</th>
                                    <th class="cell">Contact</th>
                                    <th class="cell">Sérvices</th>
                                    <th class="cell">Fonction</th>
                                    <th class="cell">Photos</th>
                                    <th class="cell"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($employers as $employer)
                                    <tr> 
                                      
                                        <td class="cell">{{ $employer->id}}</td>
                                        <td class="cell">{{ $employer->montant_journalier }}</td>
                                        <td class="cell">{{ $employer->nom }}</td>
                                        <td class="cell">{{ $employer->prenom }}</td>
                                        <!--<td class="cell">{{ $employer->date_naissance }}</td>-->
                                        
                                        <td class="cell">{{ $employer->email }}</td>
                                        <td class="cell">{{ $employer->contact }}</td>
                                        <td class="cell">{{ $employer->departement->name }}</td>
                                        <td class="cell">{{ $employer->sexe }}</td>
                                        <td>
                    								@if ($employer->photos)
                        								<img src="{{ asset('storage/' . $employer->photos) }}" alt="Photo de {{ $employer->nom }}" width="50" height="50">
                    								@else
                        								<span>Aucune photos</span>
                    								@endif
                								</td>
												<td>
                                            <a class="btn-sm app-btn-secondary" href="{{ route('employer.edit', $employer->id) }}">Modifier</a></td>
                                         <td><a class="btn-sm app-btn-secondary" href="{{ route('employer.delete', $employer->id) }}">Retirer</a>
                                        </td>
                                        <td><a href="{{ route('employer.print', $employer->id) }}" class="btn-sm app-btn-secondary">Imprimer</a></td>
                                    </tr>
                                @empty
                                    <tr> 
                                        <td class="cell" colspan="9">Aucun employer ajoutés</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>      
            </div>
            <nav class="app-pagination">
                {{ $employers->links() }}
            </nav>
        </div>
    </div>
</div>



@endsection