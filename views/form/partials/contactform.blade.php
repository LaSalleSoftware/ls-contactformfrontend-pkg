<form 
    class="w-full max-w-lg bg-white border-solid border-purple-900 border-2 rounded"
    action="{{ config('app.url') }}/contactform/confirmation"
    method="post"
>

    <h1 class="text-left md:text-center font-bold break-normal text-3xl md:text-5xl">
            {{ __('lasallesoftwarecontactform::contactform.page_title_contactformpartial') }}
            </h1>


    @csrf

    <div class="m-5">

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label 
                    class="block uppercase tracking-wide text-purple-900 text-xs font-bold mb-2" 
                    for="first_name"
                >
                {{ __('lasallesoftwarecontactform::contactform.label_first_name') }}
                </label>

                @error('first_name')
                    <div class="text-red-900 font-extrabold">[{{ $message }}]</div>
                @enderror

                <input 
                    class="appearance-none block w-full bg-purple-100 text-purple-900 border border-purple-900 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-bold" 
                    id="first_name"
                    name="first_name"
                    type="text"
                    value="{{ old('first_name') }}"
                    required
                >
            </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label 
                    class="block uppercase tracking-wide text-purple-900 text-xs font-bold mb-2" 
                    for="surname"
                >
                {{ __('lasallesoftwarecontactform::contactform.label_surname') }}
                </label>

                @error('surname')
                    <div class="text-red-900 font-extrabold">[{{ $message }}]</div>
                @enderror

                <input 
                    class="appearance-none block w-full bg-purple-100 text-purple-900 border border-purple-900 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-bold"
                    id="surname"
                    name="surname"
                    type="text"
                    value="{{ old('surname') }}"
                    required
                >
            </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label 
                    class="block uppercase tracking-wide text-purple-900 text-xs font-bold mb-2" 
                    for="email"
                >
                {{ __('lasallesoftwarecontactform::contactform.label_email') }}
                </label>

                @error('email')
                    <div class="text-red-900 font-extrabold">[{{ $message }}]</div>
                @enderror

                <input 
                    class="appearance-none block w-full bg-purple-100 text-purple-900 border border-purple-900 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-bold"
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                >
            </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label 
                    class="block uppercase tracking-wide text-purple-900 text-xs font-bold mb-2" 
                    for="comment"
                >
                {{ __('lasallesoftwarecontactform::contactform.label_comment') }}
                </label>

                @error('comment')
                    <div class="text-red-900 font-extrabold">[{{ $message }}]</div>
                @enderror

                <textarea 
                    class="no-resize appearance-none block w-full bg-purple-100 text-purple-900 border border-purple-900 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-bold h-48 resize-none" 
                    id="comment"
                    name="comment"
                    required
                >{{ old('comment') }}</textarea>
            </div>
        </div>

        <input type="hidden" id="uuid" name="uuid" value="{{ $uuid }}">


        @if (session('securityquestioniswrong'))
            <div class="text-red-900 font-extrabold">[{{ session('securityquestioniswrong')  }}]</div>
        @endif

        <div class="w-full block capitalize tracking-wide text-purple-900 font-bold text-lg mb-2 ">

            {{ __('lasallesoftwarecontactform::contactform.label_question') }} {{ $question['first_number'] }} + {{ $question['second_number'] }}? 

                <input type="hidden" id="first_number" name="first_number" value="{{ $question['first_number'] }}">
                <input type="hidden" id="second_number" name="second_number" value="{{ $question['second_number'] }}">
                
                <input 
                    class="appearance-none block w-full bg-purple-100 text-purple-900 border border-purple-900 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-bold"
                    id="security_answer"
                    name="security_answer"
                    type="text"
                    required
                >
        </div>

        <div class="md:flex md:items-center">
            <div class="md:w-1/3">
                <button 
                    class="shadow bg-purple-900 hover:bg-purple-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                    type="submit"
                >
                {{ __('lasallesoftwarecontactform::contactform.button_submit_contactformpartial') }}
                </button>
            </div>
            <div class="md:w-2/3"></div>
        </div>

    </div>    
</form>