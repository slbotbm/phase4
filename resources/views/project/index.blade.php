<h1>
    プロジェクト
</h1>
<h4><a href="{{route('dashboard')}}">ダッシュボード</a></h4>
@foreach($projects as $project)
<div>
    <p>
        <a href="{{route('project.show', $project)}}">
            {{$project->project_name}}
            <br/>
        </a>
    </p>
    <strong>社員：</strong>
    <ul>
        @foreach($project->employees as $employee)
            <li>
                {{$employee->name}}
            </li>
        @endforeach
    </ul>
    <strong>技術：</strong>
    <ul>
        @foreach($project->technologies as $technology)
            <li>
                {{$technology->technology_field}} : {{$technology->technology_name}}
            </li>
        @endforeach
    </ul>

</div>
@endforeach