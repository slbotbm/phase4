<h1>{{$employee->name}}</h1>
<h2>プロジェクト：</h2>
<ul>
    @foreach($employee->projects as $project)
    <li>
        {{$project->project_name}}
    </li>
    @endforeach
</ul>

<h2>技術：</h2>
<ul>
    @foreach($employee->technologies as $technology)
    <li>
        {{$technology->technology_name}}
    </li>
    @endforeach
</ul>


