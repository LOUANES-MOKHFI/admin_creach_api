@if(session()->has('success'))
			<div class="alert alert-success text-center" id="msg">
			{{ session()->get('success') }}
			</div>
@elseif(session()->has('error'))
			<div class="alert alert-danger text-center" id="msg">
			{{ session()->get('error') }}
			</div>
@endif


