@extends('layouts.template')

@section('content')
<style>
	.table-container {
        display: grid;
        grid-template-columns: 160px 300px 100px 1fr;
        gap: 10px;
        align-items: center;
    }
    .table-header {
        font-weight: bold;
        text-align: left;
    }
    .table-cell {
        padding: 5px;
    }
	.espace {
        display: inline-block;
        width: 100px;
    }
</style>

<div class="row g-3 mb-4 align-items-center justify-content-between">
	<div class="col-auto">
	    <h1 class="app-page-title mb-0">Liste des employés dans le service : {{ $departements->name }}</h1>
	</div>
</div>

@if($employers->count() > 0)
<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
	    <div class="app-card app-card-orders-table shadow-sm mb-5">
		    <div class="app-card-body">
			    <div class="table-responsive">
			        <table class="table app-table-hover mb-0 text-left">
			            <thead>
			                <tr>
			                    <th class="cell">IM</th>
			                    <th class="cell">Nom</th>
			                    <th class="cell">Prénom</th>
			                    <th class="cell">Email</th>
			                    <th class="cell">Contact</th>
			                    <th class="cell">Fonction</th>
			                    <th class="cell">Photo</th>
			                </tr>
			            </thead>
			            <tbody>
			                @foreach($employers as $employer)
			                    <tr>
			                        <td class="cell">{{ $employer->montant_journalier }}</td>
			                        <td class="cell">{{ $employer->nom }}</td>
			                        <td class="cell">{{ $employer->prenom }}</td>
			                        <td class="cell">{{ $employer->email }}</td>
			                        <td class="cell">{{ $employer->contact }}</td>
			                        <td class="cell">{{ $employer->sexe }}</td>
			                        <td>
                                                    @if ($employer->photos)
                        								<img src="{{ asset('storage/' . $employer->photos) }}" alt="Photo de {{ $employer->nom }}" width="50" height="50">
                    								@else
                        								<span>Aucune photos</span>
                    								@endif
			                        </td>
			                    </tr>
			                @endforeach
			            </tbody>
			        </table>
			    </div>
		    </div>
	    </div>
    </div>
</div>
@else
    <p>Aucun employé n'est associé à ce service.</p>
@endif

<a href="{{ route('departement.index') }}" class="btn btn-primary">Retour</a>
@endsection
