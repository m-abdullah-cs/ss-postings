<table class="table">
    <thead>
      <tr>
        <th style="width: 10px">#</th>
        <th>Title</th>
        <th>Description</th>
        <th>Budget</th>
        <th>Timeline</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($jobs as $key=>$job)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $job->title }}</td>
                <td>{{ $job->description }}</td>
                <td>{{ $job->budget }}</td>
                <td>{{ $job->timeline }}</td>
                <td>
                    <a href="{{route('view-job', $job->id)}}" class="btn btn-secondary">View Job</a>
                </td>
            </tr>
        @endforeach
    </tbody>
    
  </table>