@extends('layouts.template')

@section('content')

<div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Liste des Administrateurs</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<div class="col-auto">
							<form action="{{ route('administrateurs.search') }}" method="GET" class="table-search-form row gx-1 align-items-center">
    <div class="col-auto">
        <input type="text" id="search-admin" name="searchorders" class="form-control search-orders" 
               placeholder="Rechercher un administrateur" value="{{ $searchTerm ?? '' }}">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn app-btn-secondary">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </div>
    <div class="col-auto">
        <a href="{{ route('administrateurs') }}" class="btn btn-secondary">
            <i class="fa-solid fa-rotate-right"></i>
        </a>
    </div>
</form>
</div>
							    
							    <div class="col-auto">						    
								    <a class="btn app-btn-secondary" href="{{ route('administrateurs.create') }}">
									<i class="fa-solid fa-plus"></i>
									    Ajouter Administrateur
									</a>
							    </div>
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->

				@if (Session::get('success_message'))
				    <div class="alert alert-success">{{ Session::get('success_message') }}</div>	
				@endif
				@if (Session::get('error_message'))
				    <div class="alert alert-danger">{{ Session::get('error_message') }}</div>	
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
												<th class="cell">Nom de l'administrateur</th>
												<th class="cell">Email</th>
												<th class="cell"></th>
											</tr>
										</thead>
										<tbody>

                                        @forelse ($admins as $admin)
                                            
                                        <tr> 
												<td class="cell">{{ $admin->id }}</td>
												<td class="cell">{{ $admin->name }}</td>
												<td class="cell">{{ $admin->email }}</td>
												
												<td class="cell">
												    <a class="btn-sm app-btn-secondary" href="{{ route('administrateurs.delete', $admin->id) }}">Supprimer</a>
												</td>
											    
                                        </tr>

                                        @empty

                                        <tr> 
											<td class="cell" colspan="9">Aucun employer ajoutés</td>
												
                                        </tr>
                                            
                                        @endforelse

											

		
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
						<nav class="app-pagination">
						{{ $admins->links() }}	

						</nav><!--//app-pagination-->
						
			        </div><!--//tab-pane-->
			        

				</div><!--//tab-content-->

</div>

@endsection