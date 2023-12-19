<h1>
    技術
</h1>
<h4><a href="{{route('dashboard')}}">ダッシュボード</a></h4>
@foreach($technologies as $technology)
<div>
    <p>
        <a href="{{route('technology.show', $technology)}}">
            {{$technology->technology_name}}
            <br/>
        </a>
    </p>
    <strong>社員：</strong>
    <ul>
        @foreach($technology->employees as $employee)
            <li>
                {{$employee->name}}
            </li>
        @endforeach
    </ul>
    <strong>プロジェクト：</strong>
    <ul>
        @foreach($technology->projects as $project)
            <li>
                {{$project->project_name}}
            </li>
        @endforeach
    </ul>

</div>
@endforeach