@component('mail::message')
# وظائف جديدة اليوم

هذه بعض الوظائف التي قد تهمك:

@foreach($jobs as $job)
- **{{ $job->title }}** في {{ $job->company_name }}
  [تفاصيل الوظيفة]({{ route('jobs.show', $job->id) }})
@endforeach

@component('mail::button', ['url' => route('jobs.index')])
عرض جميع الوظائف
@endcomponent

شكراً لك،
{{ config('app.name') }}
@endcomponent
