<div>
    <p>Hello {{ $user->name }}</p>
    <b>we review your application for {{ $job->title }} job and select you to interview</b> <br>
    <b>
        <i>
            <a href="{{ route('user.interviews',$user->id) }}">Interview details</a>
        </i>
    </b>
</div>
