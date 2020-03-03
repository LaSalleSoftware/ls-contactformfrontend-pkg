@extends( config('lasallesoftware-contactformfrontend.where_is_the_base_layout') )

@section('content')

    <div class="container m-auto p-8 text-grey-darkest font-bold">
        <div class="flex flex-wrap -mx-2 mb-2">

            <h1 class="text-left md:text-center font-bold break-normal text-3xl md:text-5xl">
            {{ __('lasallesoftwarecontactformfrontend::contactformfrontend.page_title_confirmation') }}
            </h1>

        </div>
    </div>


@endsection  