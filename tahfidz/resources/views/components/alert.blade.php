<div class="alert alert-{{ $class }}">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

	@if ($class == 'error')

    <p class="alert-title" style="color: red">{{ $title }}</p>
    <p style="color: red">{{ $message }}</p>

    @else

    <p class="alert-title" style="color: white">{{ $title }}</p>
    <p style="color: white">{{ $message }}</p>

    @endif

</div>