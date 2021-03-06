@extends('layouts.app')
@section('content')
        {{-- <div class="page-header">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Opportunities</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Opportunities</li>
              </ol>
            </nav>
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-danger text-white mr-2">
                <i class="mdi mdi-folder-outline"></i>                 
              </span> 
              <a class="btn btn-sm btn-gradient-danger mt-2" href="{{ route('opportunities.create') }}">+Create Opportunity</a>
            </h3>
          </div> --}}
          <div class="row">
          	<div class="col-lg-12 grid-margin stretch-card">
          	<div class="card">
			
			<div class="card-body">
			<form class="form-inline" method="post" action="opportunities/changeStatus">
				@csrf
				<div class="form-row" style="margin-bottom:30px;">
						<div class="form-group mb-2">
								<label for="inputSalesStage"><h4><b>Opportunity Name</b></h4></label>
								<select id="inputSalesStage" name="opportunity_name" class="form-control {{ $errors->has('opportunity_name') ? ' is-invalid' : '' }}" style="width:400px;">
									<option value="">Choose...</option>
									@foreach( $opportunities as $opportunity)
								<option value="{{ $opportunity->opportunity_name }}" {{ old('opportunity_name')==$opportunity->opportunity_name? 'selected':'' }}>{{ $opportunity->opportunity_name }}</option>
								@endforeach       
								</select>
						</div>
					<div class="form-group mb-2">
							<label for="inputSalesStage"><h4><b>Sales Stage:</b></h4></label>
							<select id="inputSalesStage" name="sales_stage" class="form-control {{ $errors->has('sales_stage') ? ' is-invalid' : '' }}" style="width:400px;">
								<option value="">Choose...</option>
								@foreach(['Prospecting', 'Qualification', 'EOI', 'Needs Analysis', 'Value Proposition', 'Id Decision Makers', 'Perception Analysis', 'Proposal/Price Quote',
								'Negotiation/Review', 'Closed Won', 'Closed Lost', 'Submitted', 'Did Not Persue', 'Not Submitted'] as $value => $text)
							<option value="{{ $text }}" {{ old('sales_stage')==$value? 'selected':'' }}>{{$text}}</option>
							@endforeach       
							</select>
					</div>
					<div class="form-group mx-sm-2 mb-3">
								<button type="submit" class="btn btn-outline-danger btn-sm ">Update</button>
								</div>
				</div>
			</form>
				<div class="card-title row">
					<div class="text col-md-4">
							Showing all Opportunities
					</div>
				
				<div class=" col-md-8">
						<a href="{{ route('opportunities.create') }}" style="float:right" class="btn btn-outline-danger btn-sm pull-right"><i class="fa fa-fw fa-reply-all"></i>Create Opportunity</a>
					</div>
				 </div>
				 
				<table class="table example" >
					<thead>
						<tr>
							<th>Opportunity Name</th>
							<th>Expected Close Date</th>
							<th>OM_number</th>
							<th>Status</th>
							<th>Team</th>
							<th>Funded By</th>
							<th>Assigned To</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
						
							@foreach($opportunities as $opportunity)
							<tr>
							<td>{{$opportunity->opportunity_name}}</td>
							<td>{{$opportunity->date}}</td>
							<td><strong>AH-{{$opportunity->OM_number}}-OM</strong></td>
							<td class="text-success"><i>{{ $opportunity->sales_stage }}</i></td>
							<td>{{$opportunity->team}}</td>
							<td>{{$opportunity->funded_by}}</td>
							<td>{{$opportunity->assigned_to}}</td>
							<td>
									<form action="{{ route('opportunities.destroy', $opportunity->id)}}" method="post">
											@csrf
										<input name="_method" type="hidden" value="DELETE">
										<div class="btn-group">
												<a href="{{ route('opportunities.edit', $opportunity->id) }}" class="btn btn-outline-danger btn-xs"><i class="fa fa-eye"></i></a>
												<a href="{{ route('opportunities.edit', $opportunity->id) }}" class="btn btn-outline-danger btn-xs"><i class="fa fa-edit"></i></a>
												<button type="submit" class="btn btn-outline-danger btn-xs" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
												</div>
									</form>
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
@endSection