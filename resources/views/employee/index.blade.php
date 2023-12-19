<h1>
    社員
</h1>
<h4><a href="{{route('dashboard')}}">ダッシュボード</a></h4>
@foreach($employees as $employee)
<div>
    <p>
        <a href="{{route('employee.show', $employee)}}">
            {{$employee->name}}
            <br/>
        </a>
    </p>
    <strong>プロジェクト：</strong>
    <ul>
        @foreach($employee->projects as $project)
            <li>
                {{$project->project_name}}
            </li>
        @endforeach
    </ul>
    <strong>技術：</strong>
    <ul>
        @foreach($employee->technologies as $technology)
            <li>
                {{$technology->technology_field}} : {{$technology->technology_name}}
            </li>
        @endforeach
    </ul>

</div>
@endforeach