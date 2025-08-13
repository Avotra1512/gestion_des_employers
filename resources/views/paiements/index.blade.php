@extends('layouts.template')

@section('content')

<div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Liste des Paiements</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								<form action="{{ route('paiements.search') }}" method="GET" class="table-search-form row gx-1 align-items-center">
    <div class="col-auto">
        <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn app-btn-secondary"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <div class="col-auto">
        <a href="{{ route('paiements.search') }}" class="btn btn-secondary"><i class="fa-solid fa-rotate-right"></i></a>
    </div>
</form>


							    </div><!--//col-->

							    <div class="col-auto">
								    <a class="btn app-btn-secondary" href="{{ route('paiements.create') }}">
									    <i class="fa-solid fa-plus"></i>
									    Ajouter un Paiement
									</a>
							    </div>

<form action="{{ route('paiements.searchByDate') }}" method="GET" class="row g-2 mb-3">
    <div class="col-md-4">
        <label for="start_date" class="form-label">Date début</label>
        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
    </div>
    <div class="col-md-4">
        <label for="end_date" class="form-label">Date fin</label>
        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
    </div>
    <div class="col-md-4 d-flex align-items-end">
        <button type="submit" class="btn btn-primary me-2">Rechercher</button>
        <a href="{{ route('paiements.index') }}" class="btn btn-secondary">Réinitialiser</a>
    </div>
</form>

						    </div><!--//row-->

					    </div><!--//table-utilities-->

				    </div><!--//col-auto-->

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

                                    <th class="cell">Matricule</th>
                                    <th class="cell">Employé</th>
                                    <th class="cell">Montant</th>
                                    <th class="cell">Date de paiement</th>

                                    <th class="cell"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($salaires as $salaire)
                                    <tr>

                                        <td class="cell">{{ $salaire->employer->montant_journalier}}</td>
                                        <td class="cell">{{ $salaire->employer->nom }} {{ $salaire->employer->prenom }}</td>
                                        <td class="cell">{{ number_format($salaire->montant, 0, ',', ' ') }} Ar</td>

                                        <td class="cell">{{ $salaire->date_paiement }}</td>

												<td>
                                            <a class="btn-sm app-btn-secondary" href="{{ route('paiements.edit', $salaire->id) }}">Modifier</a></td>
                                         <td><a class="btn-sm app-btn-secondary" href="{{ route('paiements.destroy', $salaire->id) }}">Retirer</a>
                                        </td>
                                        <td><a href="{{ route('paiements.print', $salaire->id) }}" class="btn-sm app-btn-secondary">Recu</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="cell" colspan="9">Aucun paiements enregistré.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <nav class="app-pagination">
                {{ $salaires->links() }}

            </nav>
        </div>
    </div>
</div>
<script>
    const startInput = document.getElementById('start_date');
    const endInput = document.getElementById('end_date');

    startInput.addEventListener('change', function () {
        // Met à jour l'attribut min de la date de fin
        endInput.min = this.value;

        // Si la date de fin est avant la date de début, on la vide
        if (endInput.value && endInput.value < this.value) {
            endInput.value = '';
        }
    });
</script>



@endsection
