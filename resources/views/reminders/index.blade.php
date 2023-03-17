@extends('reminders.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Demo practicle test</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('reminders.create') }}"> Create New Reminder</a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
          $(document).ready(function() {

            $('.delete-form').on('submit', function(e) {
              e.preventDefault();

              $.ajax({
                  type: 'post',
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: $(this).data('route'),
                  data: {
                    '_method': 'delete'
                  },
                  success: function (response, textStatus, xhr) {
                    alert(response)
                    window.location='/reminders'
                  }
              });
            })
          });
        </script>

   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Description</th>
            <th>DateTime</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($reminders as $reminder)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $reminder->title }}</td>
            <td>{{ $reminder->description }}</td>
            <td>{{ $reminder->datetime }}</td>

            <td>
                <form action="{{ route('reminders.destroy',$reminder->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('reminders.show',$reminder->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('reminders.edit',$reminder->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $reminders->links() !!}
      
@endsection
