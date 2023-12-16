<h1>{{$technology->technology_name}}</h1>
<h2>社員：</h2>
<ul>
    @foreach($technology->employees as $employee)
    <li>
        {{$employee->name}}
    </li>
    @endforeach
</ul>

<h2>プロジェクト：</h2>
<ul>
    @foreach($technology->projects as $project)
    <li>
        {{$project->project_name}}
    </li>
    @endforeach
</ul>


