<div>
    
    <form id="whois-lookup-form" wire:submit.prevent='store'>

		<div class="form-group{{ $errors->has('domain') ? ' has-error' : '' }}">

			<label for="domain">Domain - пишите каждый домен на отдельной строке</label>
			<textarea name="domain" rows="4" cols="50" wire:model='domain' type="text" class="form-control" placeholder="Domain name" ></textarea>

			@if ($errors->has('domain'))
				<span class="help-block">
					<strong>{{ $errors->first('domain') }}</strong>
				</span>
			@endif
			
		</div>
	
		<button type="submit" class="btn btn-default btn-block btn-lg">Search</button>
	</form>


    <div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<table class="table no-margin">
					<thead>
						<tr>
							<th style="text-align: center">
								Status
							</th>
							
						</tr>
					</thead>
					<tbody id='product_list'>
					   
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
