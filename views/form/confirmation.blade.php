@extends( config('lasallesoftware-contactformfrontend.where_is_the_base_layout') )

@section('content')

    <div class="flex flex-wrap   mt-5 justify-center">

            <h1 class="text-center text-purple-900 font-bold break-normal text-3xl md:text-5xl">
            {{ __('lasallesoftwarecontactformfrontend::contactformfrontend.page_title_confirmation') }}
            </h1>

    </div>

    
    <div class="m-10">

    <div class="flex flex-wrap mb-6 justify-center bg-white">
        <div class="sm:mt-5 border-solid border-purple-200 border rounded-lg">

            <div class="sm:grid sm:gap-4 sm:grid-cols-3 sm:items-start  m-5">
                <div class="block sm:text-right text-lg font-medium leading-5 text-purple-900 sm:mt-px sm:pt-2">
                {{ __('lasallesoftwarecontactformfrontend::contactformfrontend.label_first_name') }}:
                </div>

                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="max-w-lg flex shadow-sm">    
                        <div class="flex-1 form-input block w-full rounded-none rounded-r-md transition duration-150 ease-in-out text-2xl sm:leading-5 bg-purple-100 text-purple-900 border font-bold" />
                        {{ $formInput['first_name'] }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-5 m-5 sm:border-t sm:border-gray-200">
                <div class="block sm:text-right text-lg font-medium leading-5 text-purple-900 sm:mt-px sm:pt-2">
                {{ __('lasallesoftwarecontactformfrontend::contactformfrontend.label_surname') }}:
                </div>

                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="max-w-lg flex shadow-sm">    
                        <div class="flex-1 form-input block w-full rounded-none rounded-r-md transition duration-150 ease-in-out text-2xl sm:leading-5 bg-purple-100 text-purple-900 border font-bold" />
                        {{ $formInput['surname'] }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-5 m-5 sm:border-t sm:border-gray-200">
                <div class="block sm:text-right text-lg font-medium leading-5 text-purple-900 sm:mt-px sm:pt-2">
                {{ __('lasallesoftwarecontactformfrontend::contactformfrontend.label_email') }}:
                </div>

                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="max-w-lg flex shadow-sm">
                        <div class="flex-1 form-input block w-full rounded-none rounded-r-md transition duration-150 ease-in-out text-2xl sm:leading-5 bg-purple-100 text-purple-900 border font-bold" />
                        {{ $formInput['email'] }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-5 m-5 sm:border-t sm:border-gray-200">
                <div class="block sm:text-right text-lg font-medium leading-5 text-purple-900 sm:mt-px sm:pt-2">
                {{ __('lasallesoftwarecontactformfrontend::contactformfrontend.label_comment') }}:
                </div>

                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="max-w-lg flex shadow-sm">              
                        <div class="flex-1 form-input block w-full rounded-none rounded-r-md transition duration-150 ease-in-out text-2xl sm:leading-5 bg-purple-100 text-purple-900 border font-bold" />
                        {{ $formInput['comment'] }}
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>

    </div>
        


@endsection  