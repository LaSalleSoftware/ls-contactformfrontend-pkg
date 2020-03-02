@extends( config('lasallesoftware-contactformfrontend.where_is_the_base_layout') )

@section('content')

    {{-- START: Contact Form --}}
    <div class="m-10">
        @include('lasallesoftwarecontactform::form.partials.contactform')
    </div>
    {{-- END: Contact Form --}}
            
@endsection    