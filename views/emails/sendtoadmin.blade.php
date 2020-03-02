This is the sendtoemail.blade.php!!! 
<br /><br />
{{ __('lasallesoftwarecontactform::contactform.email_first_name') }}:    {{ $formData['first_name'] }}<br />
{{ __('lasallesoftwarecontactform::contactform.email_surname') }}:       {{ $formData['surname'] }}   <br />
{{ __('lasallesoftwarecontactform::contactform.email_email') }}:         {{ $formData['email'] }}     <br />
{{ __('lasallesoftwarecontactform::contactform.email_contactformid') }}: {{ $formData['uuid'] }}      <br />
<br /><br />
{{ __('lasallesoftwarecontactform::contactform.email_comment') }}:<br />
<pre>
{{ $formData['comment'] }}
</pre>
