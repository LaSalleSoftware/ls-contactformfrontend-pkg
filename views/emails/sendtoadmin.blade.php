[{{ __('lasallesoftwarecontactformfrontend::contactformfrontend.email_automated_msg') }}]
<br /><br />
{{ __('lasallesoftwarecontactformfrontend::contactformfrontend.email_first_name') }}:    {{ $formData['first_name'] }}
<br /><br />
{{ __('lasallesoftwarecontactformfrontend::contactformfrontend.email_surname') }}:       {{ $formData['surname'] }}
<br /><br />
{{ __('lasallesoftwarecontactformfrontend::contactformfrontend.email_email') }}:          {{ $formData['email'] }}
<br /><br /><br />
{{ __('lasallesoftwarecontactformfrontend::contactformfrontend.email_comment') }}:<br />
<pre>
{{ $formData['comment'] }}
</pre>
