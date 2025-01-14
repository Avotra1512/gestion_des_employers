@extends('layouts.template')

@section('content')

<div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Liste des sérvices</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								<form action="{{ route('departement.search') }}" method="GET" class="table-search-form row gx-1 align-items-center">
    <div class="col-auto">
        <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn app-btn-secondary"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <div class="col-auto">
        <a href="{{ route('departement.search') }}" class="btn btn-secondary"><i class="fa-solid fa-rotate-right"></i></a>
    </div>
</form>
					                
							    </div><!--//col-->
							    
							    <div class="col-auto">						    
								    <a class="btn app-btn-secondary" href="{{ route('departement.create') }}">
									<i class="fa-solid fa-plus"></i>
									    Ajouter un sérvice
									</a>
							    </div>
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
			   
			    
			    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
				    <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">Tout les sérvices</a>
				</nav>
				
				@if (Session::get('success_message'))
				    <div class="alert alert-success">{{ Session::get('success_message') }}</div>	
				@endif
				@if (Session::get('error'))
				    <div class="alert alert-danger">{{ Session::get('error') }}</div>	
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
												<th class="cell">N°</th>
												<th class="cell">Sigle</th>
												<th class="cell">Intitulé</th>
												<th class="cell"></th>
												<th class="cell"></th>
											</tr>
										</thead>
										<tbody>

                                        @forelse ($departements as $departement)
                                            
                                        <tr> 
												<td class="cell">{{ $departement->id }}</td>
												<td class="cell"><span class="truncate">{{ $departement->name }}</span></td>
												<td class="cell">
                                                <span class="d-inline-block text-truncate" style="max-width: 600px;" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $departement->apropos }}">
                                            {{ $departement->apropos }}
                                                </span>
                                                </td>


												<td class="cell"><a class="btn-sm app-btn-secondary" href="{{route('departement.edit', $departement->id)}}">Editer</a></td>
												<td class="cell"><a class="btn-sm app-btn-secondary" href="{{route('departement.delete', $departement->id)}}">Retirer</a></td>
												<td class="cell"><a class="btn-sm app-btn-secondary" href="{{route('departement.employes', $departement->id)}}">Voir employer</a></td>
											    
                                        </tr>

                                        @empty

                                        <tr> 
											<td class="cell" colspan="2">Aucun sérvice ajoutés</td>
												
                                        </tr>
                                            
                                        @endforelse

											

		
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
						<nav class="app-pagination">
						{{ $departements->links() }}	

						</nav><!--//app-pagination-->
						
			        </div><!--//tab-pane-->
			        
			        
				</div><!--//tab-content-->
				</div>


@endsection