<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <h2 class="my-4">Tạo mới xe</h2>
        <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="Description">Description:</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror " id="description" name="description">
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" class="form-control @error('model') is-invalid @enderror " id="model" name="model">
                @error('model')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="form-group">
              <label for="image">Image:</label>
              <input type="file" class="form-control @error('image') is-invalid @enderror " id="image" name="image">
              @error('image')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
          </div>
            <div class="form-group">
                <label for="produced_on">Produced On:</label>
                <input type="date" class="form-control @error('produced_on') is-invalid @enderror " id="produced_on" name="produced_on">
                @error('produced_on')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="">Mf Name</label>
                <select class="form-control" name="mf_id" id="">
                  @foreach ( $mfs as $mf )
                   <option value="{{$mf->id}}">{{$mf->mf_name}}</option>
                  @endforeach
                </select>
              
              @error('mf_id')
              <div class="alert alert-danger">{{ $message }}</div>
            </div>
            
          @enderror
          </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
            <a href="{{ route('cars.index') }}" class="btn btn-primary">Quay lại danh sách</a>
        </form>
        
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>