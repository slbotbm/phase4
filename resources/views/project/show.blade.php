<h1>{{$project->project_name}}</h1>
<h2>社員：</h2>
<ul>
    @foreach($project->employees as $employee)
    <li>
        {{$employee->name}}
    </li>
    @endforeach
</ul>

<h2>技術：</h2>
<ul>
    @foreach($project->technologies as $technology)
    <li>
        {{$technology->technology_name}}
    </li>
    @endforeach
</ul>


