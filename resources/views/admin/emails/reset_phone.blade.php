@component('mail::message')

<center>
	 <p><bdi>{{ trans('admin.welcome',['name'=>$data['name']]) }}</bdi></p><br>
	 You have requested to change your account number

{{-- @component('mail::button', ['url' => $data['url']])
{{ trans('admin.reset_link_here') }} --}}

 <h1>
	Verification code :
	<br/>
	<center>  {{ $data['otp'] }}</center>
</h1>

{{--@endcomponent
{{ trans('admin.copy_reset_link') }}
<a href="{{ $data['url'] }}">
	{{ $data['url'] }}
</a> --}}


{{ trans('admin.thanks') }},<br>
{{ config('app.name') }}

</center>
@endcomponent
