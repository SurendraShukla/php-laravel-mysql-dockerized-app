@isset($commitsByUsers)
<table class="table table-striped">
    <thead>
    <tr>
        <th>Activity datetime</th>
        <th>Message</th>
        <th>Username</th>
        <th>Link</th>
    </tr>
    </thead>
    <tbody>
    @foreach($commitsByUsers as $commitInfo)
        <tr>
            <td>{{ $commitInfo->activityDateTime }}</td>
            <td>{{ $commitInfo->message }}</td>
            <td>{{ $commitInfo->username }}</td>
            <td>
                <a href="{{ $commitInfo->link }}}">
                    <img src="/img/{{ $commitInfo->type }}.png">
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endisset

