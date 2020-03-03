This is the sendtoemail.blade.php!!! 
<br /><br />
{{ __('lasallesoftwarecontactformfrontend::contactformfrontend.email_first_name') }}:    {{ $formData['first_name'] }}<br />
{{ __('lasallesoftwarecontactformfrontend::contactformfrontend.email_surname') }}:       {{ $formData['surname'] }}   <br />
{{ __('lasallesoftwarecontactformfrontend::contactformfrontend.email_email') }}:          {{ $formData['email'] }}     <br />
{{ __('lasallesoftwarecontactformfrontend::contactformfrontend.email_contactformid') }}: {{ $formData['uuid'] }}      <br />
<br /><br />
{{ __('lasallesoftwarecontactformfrontend::contactformfrontend.email_comment') }}:<br />
<pre>
{{ $formData['comment'] }}
</pre>
